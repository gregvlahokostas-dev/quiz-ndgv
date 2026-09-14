<x-app-layout>
    <div class="container py-5" style="max-width: 900px;">
        <!-- Header -->
        <div class="text-center mb-5 mt-4">
            <h1 class="display-5 fw-bold text-dark mb-3">Quiz Γνώσεων ΑΣΕΠ</h1>
            <p class="text-muted fs-5">Τι θα ήθελες να κάνεις σήμερα;</p>
        </div>

        <!-- 2 Cards -->
        <div class="row g-4 mb-5">
            <!-- 📖 ΜΕΛΕΤΗ -->
            <div class="col-md-6">
                <a href="{{ route('study.index') }}" class="home-card study h-100">
                    <div class="home-card-icon study">
                        <i class="bi bi-book text-primary fs-2"></i>
                    </div>
                    <h2 class="h3 fw-bold text-dark mb-2">Μελέτη</h2>
                    <p class="text-muted mb-0">
                        Διάβασε τις ερωτήσεις με τις σωστές απαντήσεις highlighted.
                        Ιδανικό για προετοιμασία.
                    </p>
                </a>
            </div>

            <!-- 🎯 QUIZ -->
            <div class="col-md-6">
                <a href="{{ route('quiz.index') }}" class="home-card quiz h-100">
                    <div class="home-card-icon quiz">
                        <i class="bi bi-bullseye text-success fs-2"></i>
                    </div>
                    <h2 class="h3 fw-bold text-dark mb-2">Quiz</h2>
                    <p class="text-muted mb-0">
                        Δοκίμασε τις γνώσεις σου με χρονομετρημένο quiz και
                        δες τη θέση σου στον πίνακα επιδόσεων.
                    </p>
                </a>
            </div>
        </div>

        <!-- Leaderboard link -->
        <div class="text-center">
            <a href="{{ route('quiz.leaderboard') }}"
               class="d-inline-flex align-items-center gap-2 text-muted text-decoration-none fw-medium">
                <i class="bi bi-trophy"></i>
                Δες τον Πίνακα Επιδόσεων
            </a>
        </div>
    </div>
</x-app-layout>
