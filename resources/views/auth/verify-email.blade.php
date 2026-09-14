<x-guest-layout>
    <div class="text-center mb-4">
        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
             style="width: 64px; height: 64px; background: linear-gradient(135deg, #3b82f6, #4f46e5);">
            <i class="bi bi-envelope-check text-white fs-2"></i>
        </div>
        <h2 class="h4 fw-bold mb-2">Επιβεβαίωση Email</h2>
        <p class="text-muted small mb-0">
            Σου στείλαμε ένα email με σύνδεσμο επιβεβαίωσης.
            Έλεγξε το inbox σου και πάτησε τον σύνδεσμο.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success small">
            <i class="bi bi-check-circle"></i>
            Στάλθηκε νέος σύνδεσμος επιβεβαίωσης στο email σου.
        </div>
    @endif

    <div class="d-flex flex-column gap-2">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-quiz-primary w-100">
                <i class="bi bi-arrow-clockwise"></i> Επαναποστολή email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary w-100">
                <i class="bi bi-box-arrow-right"></i> Αποσύνδεση
            </button>
        </form>
    </div>
</x-guest-layout>
