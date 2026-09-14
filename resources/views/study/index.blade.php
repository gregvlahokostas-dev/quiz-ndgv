<x-app-layout>
    <div class="container py-4" style="max-width: 1100px;"
         x-data="{
            selected: [],
            categories: {{ $categories->map(fn($c) => ['id' => $c->id, 'count' => $c->questions_count])->toJson() }},

            get totalAvailable() {
                return this.categories
                    .filter(c => this.selected.includes(c.id))
                    .reduce((sum, c) => sum + c.count, 0);
            }
         }">

        <!-- Back -->
        <div class="mb-4">
            <a href="{{ route('home') }}" class="text-muted text-decoration-none small">
                <i class="bi bi-arrow-left"></i> Πίσω στο μενού
            </a>
        </div>

        <!-- Header -->
        <div class="mb-4">
            <h1 class="h2 fw-bold mb-2">
                <i class="bi bi-book text-primary"></i> Μελέτη
            </h1>
            <p class="text-muted">
                Επίλεξε κατηγορίες για να δεις τις ερωτήσεις με τις σωστές απαντήσεις.
            </p>
        </div>

        <form method="POST" action="{{ route('study.show') }}">
            @csrf

            <!-- Categories -->
            <div class="row g-3 mb-4">
                @foreach($categories as $cat)
                    <div class="col-md-6 col-lg-4">
                        <label class="category-card h-100 mb-0">
                            <input type="checkbox"
                                   name="categories[]"
                                   value="{{ $cat->id }}"
                                   x-model.number="selected"
                                   class="d-none">

                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <div class="fw-semibold text-dark">{{ $cat->name }}</div>

                                <div class="category-check">
                                    <template x-if="selected.includes({{ $cat->id }})">
                                        <i class="bi bi-check text-white fw-bold" style="font-size: 0.75rem;"></i>
                                    </template>
                                </div>
                            </div>

                            <div class="text-muted small mt-2">
                                {{ $cat->questions_count }} ερωτήσεις
                            </div>
                        </label>
                    </div>
                @endforeach
            </div>

            <!-- Actions -->
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <button type="submit"
                        :disabled="selected.length === 0"
                        class="btn btn-quiz-primary">
                    <i class="bi bi-book"></i>
                    Έναρξη Μελέτης
                    <template x-if="selected.length > 0">
                        <span>(<span x-text="totalAvailable"></span> ερωτήσεις)</span>
                    </template>
                </button>

                <span x-show="selected.length > 0"
                      class="text-muted small"
                      x-text="selected.length + ' ' + (selected.length === 1 ? 'κατηγορία επιλεγμένη' : 'κατηγορίες επιλεγμένες')"></span>

                <span x-show="selected.length === 0"
                      class="text-muted small">
                    Επίλεξε τουλάχιστον μία κατηγορία
                </span>
            </div>
        </form>
    </div>
</x-app-layout>
