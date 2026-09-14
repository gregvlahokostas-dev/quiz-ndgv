<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\QuizAttempt;
use App\Models\AttemptAnswer;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('questions')->get();
        return view('quiz.index', compact('categories'));
    }

    public function start(Request $request)
    {
        $data = $request->validate([
            'categories'   => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'amount'       => 'required|integer|min:1|max:100',
        ]);

        $questions = Question::whereIn('category_id', $data['categories'])
            ->inRandomOrder()
            ->limit($data['amount'])
            ->get();

        session([
            'quiz' => [
                'category_ids' => $data['categories'],
                'question_ids' => $questions->pluck('id')->toArray(),
                'started_at'   => now()->timestamp,
            ]
        ]);

        return redirect()->route('quiz.play');
    }

    public function play()
    {
        $quiz = session('quiz');
        if (!$quiz) return redirect()->route('quiz.index');

        $questions = Question::whereIn('id', $quiz['question_ids'])
            ->get()
            ->keyBy('id');

        $ordered = collect($quiz['question_ids'])
            ->map(fn($id) => $questions[$id] ?? null)
            ->filter();

        return view('quiz.play', ['questions' => $ordered]);
    }

    public function submit(Request $request)
    {
        $quiz = session('quiz');
        if (!$quiz) return redirect()->route('quiz.index');

        // ⚠️ Εδώ έρχονται ΜΟΝΟ οι απαντημένες (οι null δεν στέλνονται)
        $answers = $request->input('answers', []);

        $attempt = QuizAttempt::create([
            'user_id'          => auth()->id(),
            'total_questions'  => count($quiz['question_ids']),
            'category_ids'     => $quiz['category_ids'],
            'duration_seconds' => now()->timestamp - $quiz['started_at'],
            'score'            => 0, // θα ενημερωθεί μετά
        ]);

        $score = 0;
        $details = [];

        foreach ($quiz['question_ids'] as $qid) {
            $question = Question::find($qid);
            $selected = $answers[$qid] ?? null; // ← null αν δεν απαντήθηκε

            $isCorrect = ($selected !== null && (int)$selected === (int)$question->correct_index);

            AttemptAnswer::create([
                'quiz_attempt_id' => $attempt->id,
                'question_id'     => $qid,
                'selected_index'  => $selected, // μπορεί να είναι null
                'is_correct'      => $isCorrect,
            ]);

            if ($isCorrect) $score++;

            $details[] = [
                'question'   => $question,
                'selected'   => $selected,
                'is_correct' => $isCorrect,
            ];
        }

        $attempt->update(['score' => $score]);
        session()->forget('quiz');

        return view('quiz.result', compact('attempt', 'details'));
    }

    public function leaderboard()
    {
        $top = QuizAttempt::with('user')
            ->orderByDesc('score')
            ->orderBy('duration_seconds')
            ->limit(50)
            ->get();

        return view('quiz.leaderboard', compact('top'));
    }
}
