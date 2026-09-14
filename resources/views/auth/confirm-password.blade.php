<x-guest-layout>
    <div class="text-center mb-4">
        <h2 class="h4 fw-bold mb-2">Επιβεβαίωση Κωδικού</h2>
        <p class="text-muted small mb-0">
            Αυτή είναι μια ασφαλής περιοχή. Επιβεβαίωσε τον κωδικό σου πριν συνεχίσεις.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-4">
            <label for="password" class="form-label fw-medium">Κωδικός</label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="current-password">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-quiz-primary w-100">
            <i class="bi bi-shield-lock"></i> Επιβεβαίωση
        </button>
    </form>
</x-guest-layout>
