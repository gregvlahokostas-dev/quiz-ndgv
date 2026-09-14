<button type="button"
        class="btn btn-outline-danger"
        data-bs-toggle="modal"
        data-bs-target="#deleteAccountModal">
    <i class="bi bi-trash"></i> Διαγραφή λογαριασμού
</button>

<!-- Bootstrap Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle text-danger"></i>
                        Διαγραφή λογαριασμού
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted">
                        Είσαι σίγουρος/η ότι θέλεις να διαγράψεις τον λογαριασμό σου;
                        <strong>Όλα τα δεδομένα θα χαθούν οριστικά.</strong>
                    </p>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-medium">
                            Εισάγετε τον κωδικό σας για επιβεβαίωση
                        </label>
                        <input id="password" name="password" type="password"
                               class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                               placeholder="Κωδικός">
                        @error('password', 'userDeletion')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Ακύρωση
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Διαγραφή
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
