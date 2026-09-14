<x-app-layout>
    <div class="container py-4" style="max-width: 800px;">

        @php
            $percentage = $attempt->total_questions > 0
                ? round(($attempt->score / $attempt->total_questions) * 100)
                : 0;

            // Emoji + μήνυμα ανάλογα με το σκορ
            if ($percentage >= 90) {
                $emoji = '🏆';
                $message = 'Εξαιρετικά!';
                $color = 'success';
            } elseif ($percentage >= 70) {
                $emoji = '🎉';
                $message = 'Πολύ καλά!';
                $color = 'success';
            } elseif ($percentage >= 50) {
                $emoji = '👍';
                $message = 'Καλή προσπάθεια!';
                $color = 'warning';
            } else {
                $emoji = '📚';
                $message = 'Χρειάζεται λίγη ακόμα μελέτη.';
                $color = 'danger';
            }

            $minutes = floor($attempt->duration_seconds / 60);
            $seconds = $attempt->duration_seconds % 60;
        @endphp

            <!-- Score Card -->
        <div class="card-quiz text-center p-5 mb-4 mt-3">
            <div class="display-1 mb-3">{{ $emoji }}</div>

            <div class="display-3 fw-bold text-{{ $color }} mb-2">
                {{ $attempt->score }} / {{ $attempt->total_questions }}
            </div>

            <p class="h4 text-muted mb-4">{{ $message }}</p>

            <!-- Stats -->
            <div class="d-flex justify-content-center gap-4 flex-wrap mb-4">
                <div class="text-center">
                    <div class="h5 fw-bold text-primary mb-0">{{ $percentage }}%</div>
                    <div class="small text-muted">Επιτυχία</div>
                </div>
                <div class="text-center">
                    <div class="h5 fw-bold text-primary mb-0">{{ $minutes }}:{{ str_pad($seconds, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="small text-muted">Χρόνος</div>
                </div>
                <div class="text-center">
                    <div class="h5 fw-bold text-success mb-0">{{ $attempt->score }}</div>
                    <div class="small text-muted">Σωστές</div>
                </div>
                <div class="text-center">
                    <div class="h5 fw-bold text-danger mb-0">{{ $attempt->total_questions - $attempt->score }}</div>
                    <div class="small text-muted">Λάθος</div>
                </div>
            </div>

            <!-- Progress -->
            <div class="progress mb-4" style="height: 12px;">
                <div class="progress-bar bg-{{ $color }}"
                     style="width: {{ $percentage }}%"></div>
            </div>

            <!-- Actions -->
            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                <a href="{{ route('quiz.index') }}" class="btn btn-quiz-primary px-4">
                    <i class="bi bi-arrow-repeat"></i> Νέο Quiz
                </a>
                <a href="{{ route('quiz.leaderboard') }}" class="btn btn-outline-primary px-4">
                    <i class="bi bi-trophy"></i> Κατάταξη
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-house-door"></i> Αρχική
                </a>
            </div>
        </div>

        <!-- Αναλυτικά αποτελέσματα -->
        <h2 class="h4 fw-bold mb-3">
            <i class="bi bi-list-check text-primary"></i> Αναλυτικά αποτελέσματα
        </h2>

        <div class="d-flex flex-column gap-3">
            @foreach($details as $i => $d)
                <div class="card-quiz p-4 border-start border-4
                            {{ $d['is_correct'] ? 'border-success' : 'border-danger' }}">

                    <!-- Header -->
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0"
                             style="width: 32px; height: 32px; font-size: 0.85rem;
                                    background: {{ $d['is_correct'] ? '#10b981' : '#ef4444' }};">
                            {{ $i + 1 }}
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="h6 fw-semibold text-dark mb-2">
                                {{ $d['question']->text }}
                            </h3>
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="d-flex flex-column gap-2 ps-5">
                        @foreach($d['question']->options as $idx => $opt)
                            @php
                                $isCorrect = ($idx === $d['question']->correct_index);
                                $isSelected = ($idx === $d['selected']);
                            @endphp

                            <div class="d-flex align-items-start gap-2 p-2 rounded small
                                        {{ $isCorrect ? 'bg-success bg-opacity-10 text-success fw-semibold' : '' }}
                                        {{ $isSelected && !$isCorrect ? 'bg-danger bg-opacity-10 text-danger text-decoration-line-through' : '' }}
                                        {{ !$isCorrect && !$isSelected ? 'text-muted' : '' }}">

                                <span class="flex-shrink-0">
                                    @if($isCorrect)
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                    @elseif($isSelected)
                                        <i class="bi bi-x-circle-fill text-danger"></i>
                                    @else
                                        <i class="bi bi-circle"></i>
                                    @endif
                                </span>

                                <span>{{ $opt }}</span>

                                @if($isSelected && !$isCorrect)
                                    <span class="ms-auto small text-danger">(η απάντησή σου)</span>
                                @elseif($isSelected && $isCorrect)
                                    <span class="ms-auto small text-success">(σωστή)</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer actions -->
        <div class="text-center mt-5 mb-4">
            <a href="{{ route('quiz.index') }}" class="btn btn-quiz-primary px-4">
                <i class="bi bi-arrow-repeat"></i> Νέο Quiz
            </a>
        </div>
    </div>
</x-app-layout>
