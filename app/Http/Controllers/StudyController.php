<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

class StudyController extends Controller
{
    /**
     * Σελίδα επιλογής κατηγοριών για μελέτη.
     */
    public function index()
    {
        $categories = Category::withCount('questions')->get();
        return view('study.index', compact('categories'));
    }

    /**
     * Εμφάνιση ερωτήσεων + σωστών απαντήσεων.
     */
    public function show(Request $request)
    {
        $data = $request->validate([
            'categories'   => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
        ]);

        $questions = Question::whereIn('category_id', $data['categories'])
            ->with('category')
            ->inRandomOrder()
            ->get();

        $categories = Category::whereIn('id', $data['categories'])->get();

        return view('study.show', compact('questions', 'categories'));
    }
}
