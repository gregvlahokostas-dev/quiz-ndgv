<x-app-layout>
    <div class="container py-4" style="max-width: 800px;">

        <!-- Back -->
        <div class="mb-4">
            <a href="{{ route('home') }}" class="text-muted text-decoration-none small">
                <i class="bi bi-arrow-left"></i> Πίσω στο μενού
            </a>
        </div>

        <!-- Header -->
        <div class="mb-4">
            <h1 class="h2 fw-bold mb-2">
                <i class="bi bi-person-circle text-primary"></i> Το Προφίλ μου
            </h1>
            <p class="text-muted">Διαχειρίσου τα στοιχεία του λογαριασμού σου</p>
        </div>

        <!-- Update Profile Info -->
        <div class="card-quiz p-4 mb-4">
            <h2 class="h5 fw-bold mb-1">Στοιχεία Προφίλ</h2>
            <p class="text-muted small mb-4">Ενημέρωσε το όνομα και το email σου</p>

            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Update Password -->
        <div class="card-quiz p-4 mb-4">
            <h2 class="h5 fw-bold mb-1">Αλλαγή Κωδικού</h2>
            <p class="text-muted small mb-4">Βεβαιώσου ότι χρησιμοποιείς ισχυρό κωδικό</p>

            @include('profile.partials.update-password-form')
        </div>

        <!-- Delete Account -->
        <div class="card-quiz p-4 border-danger border-2">
            <h2 class="h5 fw-bold text-danger mb-1">Διαγραφή Λογαριασμού</h2>
            <p class="text-muted small mb-4">
                Μόλις διαγραφεί ο λογαριασμός σου, όλα τα δεδομένα θα χαθούν οριστικά.
            </p>

            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
