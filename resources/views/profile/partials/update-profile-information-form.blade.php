<form method="post" action="{{ route('profile.update') }}" class="mt-3">
    @csrf
    @method('patch')

    <div class="mb-3">
        <label for="name" class="form-label fw-medium">Ονοματεπώνυμο</label>
        <input id="name" name="name" type="text"
               value="{{ old('name', $user->name) }}"
               class="form-control @error('name') is-invalid @enderror"
               required autofocus autocomplete="name">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label fw-medium">Email</label>
        <input id="email" name="email" type="email"
               value="{{ old('email', $user->email) }}"
               class="form-control @error('email') is-invalid @enderror"
               required autocomplete="username">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="alert alert-warning small mt-2 mb-0">
                Το email σου δεν έχει επιβεβαιωθεί.
                <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link btn-sm p-0 align-baseline">
                        Πατήσε εδώ για επαναποστολή
                    </button>
                </form>
                @if (session('status') === 'verification-link-sent')
                    <div class="mt-1 text-success">
                        Στάλθηκε νέος σύνδεσμος επιβεβαίωσης στο email σου.
                    </div>
                @endif
            </div>
        @endif
    </div>

    <div class="d-flex align-items-center gap-3">
        <button type="submit" class="btn btn-quiz-primary">
            <i class="bi bi-check-lg"></i> Αποθήκευση
        </button>

        @if (session('status') === 'profile-updated')
            <span class="text-success small">
                <i class="bi bi-check-circle-fill"></i> Αποθηκεύτηκε!
            </span>
        @endif
    </div>
</form>
