<x-app-layout>
    <div class="container py-4" style="max-width: 900px;">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('study.index') }}" class="text-muted text-decoration-none small">
                <i class="bi bi-arrow-left"></i> Πίσω στην επιλογή
            </a>
            <a href="{{ route('home') }}" class="text-muted text-decoration-none small">
                <i class="bi bi-house-door"></i> Αρχική
            </a>
        </div>

        <!-- Title -->
        <div class="mb-4">
            <h1 class="h2 fw-bold mb-2">
                <i class="bi bi-book text-primary"></i> Μελέτη
            </h1>
            <p class="text-muted mb-3">
                {{ $questions->count() }} ερωτήσεις από
                {{ $categories->count() }} {{ $categories->count() === 1 ? 'κατηγορία' : 'κατηγορίες' }}
            </p>

            <!-- Category chips -->
            <div class="d-flex flex-wrap gap-2">
                @foreach($categories as $cat)
                    <span class="badge-category">
                        {{ $cat->name }}
                    </span>
                @endforeach
            </div>
        </div>

        <!-- Questions -->
        <div class="d-flex flex-column gap-3">
            @foreach($questions as $i => $q)
                <div class="card-quiz p-4">

                    <!-- Header ερώτησης -->
                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                             style="width: 32px; height: 32px; font-size: 0.85rem;">
                            {{ $i + 1 }}
                        </div>
                        <div class="flex-grow-1">
                            @if($q->category)
                                <div class="mb-1">
                                    <span class="badge-category">{{ $q->category->name }}</span>
                                </div>
                            @endif
                            <h2 class="h5 fw-semibold text-dark mb-0">
                                {{ $q->text }}
                            </h2>
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="d-flex flex-column gap-2 ps-4">
                        @foreach($q->options as $idx => $opt)
                            @php $isCorrect = ($idx === $q->correct_index); @endphp

                            <div class="d-flex align-items-start gap-3 p-3 rounded-3
                                        {{ $isCorrect
                                            ? 'bg-success bg-opacity-10 border border-success border-2'
                                            : 'bg-light' }}">

                                <!-- Icon -->
                                <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle fw-bold"
                                     style="width: 26px; height: 26px; font-size: 0.75rem;
                                            {{ $isCorrect
                                                ? 'background: #10b981; color: white;'
                                                : 'background: #e5e7eb; color: #6b7280;' }}">
                                    @if($isCorrect)
                                        <i class="bi bi-check-lg"></i>
                                    @else
                                        {{ chr(65 + $idx) }}
                                    @endif
                                </div>

                                <!-- Text -->
                                <span class="flex-grow-1 small pt-1
                                             {{ $isCorrect
                                                ? 'text-success fw-semibold'
                                                : 'text-dark' }}">
                                    {{ $opt }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer -->
        <div class="text-center mt-5 mb-4">
            <a href="{{ route('study.index') }}" class="btn btn-quiz-primary px-4">
                <i class="bi bi-book"></i> Νέα Μελέτη
            </a>
            <a href="{{ route('quiz.index') }}" class="btn btn-outline-secondary px-4">
                <i class="bi bi-bullseye"></i> Δοκίμασε Quiz
            </a>
        </div>
    </div>
</x-app-layout>
