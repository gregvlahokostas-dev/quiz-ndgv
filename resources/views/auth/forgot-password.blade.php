<x-guest-layout>
    <div class="text-center mb-4">
        <h2 class="h4 fw-bold mb-2">Ξέχασες τον κωδικό σου;</h2>
        <p class="text-muted small mb-0">
            Δώσε το email σου και θα σου στείλουμε σύνδεσμο για να ορίσεις νέο κωδικό.
        </p>
    </div>

    @if (session('status'))
        <div class="alert alert-success small">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="form-label fw-medium">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   required autofocus>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-quiz-primary w-100">
            <i class="bi bi-envelope"></i> Αποστολή συνδέσμου
        </button>

        <p class="text-center text-muted small mt-4 mb-0">
            <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">
                <i class="bi bi-arrow-left"></i> Επιστροφή στη σύνδεση
            </a>
        </p>
    </form>
</x-guest-layout>
