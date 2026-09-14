<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-medium">Ονοματεπώνυμο</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror"
                   required autofocus>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-medium">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-medium">Κωδικός πρόσβασης</label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-medium">Επιβεβαίωση κωδικού</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="form-control" required>
        </div>

        <button type="submit" class="btn btn-quiz-success w-100">
            Εγγραφή
        </button>

        <p class="text-center text-muted small mt-4 mb-0">
            Έχεις ήδη λογαριασμό;
            <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">
                Σύνδεση
            </a>
        </p>
    </form>
</x-guest-layout>
