<x-app-layout>
    <div class="container py-4" style="max-width: 1100px;"
         x-data="{
            selected: [],
            categories: {{ $categories->map(fn($c) => ['id' => $c->id, 'count' => $c->questions_count])->toJson() }},
            amount: 20,

            init() {
                this.updateMax();
                this.$watch('selected', () => this.updateMax());
            },

            get maxAmount() {
                if (this.selected.length === 0) return 100;
                const total = this.categories
                    .filter(c => this.selected.includes(c.id))
                    .reduce((sum, c) => sum + c.count, 0);
                return Math.min(100, total);
            },

            get totalAvailable() {
                return this.categories
                    .filter(c => this.selected.includes(c.id))
                    .reduce((sum, c) => sum + c.count, 0);
            },

            get fillPercent() {
                if (this.maxAmount <= 5) return 100;
                return ((this.amount - 5) / (this.maxAmount - 5)) * 100;
            },

            updateMax() {
                if (this.amount > this.maxAmount) this.amount = this.maxAmount;
                if (this.amount < 5) this.amount = 5;
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
                <i class="bi bi-bullseye text-success"></i> Quiz
            </h1>
            <p class="text-muted">Επίλεξε ενότητες και δοκίμασε τις γνώσεις σου</p>
        </div>

        <form method="POST" action="{{ route('quiz.start') }}">
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

            <!-- Slider card -->
            <div class="card-quiz p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <label class="fw-semibold text-dark">Αριθμός ερωτήσεων</label>
                    <div class="display-6 fw-bold text-primary" x-text="amount"></div>
                </div>

                <input type="range"
                       name="amount"
                       x-model.number="amount"
                       :min="5"
                       :max="maxAmount"
                       step="1"
                       :style="`background: linear-gradient(to right,
                           #2563eb 0%,
                           #2563eb ${fillPercent}%,
                           #e5e7eb ${fillPercent}%,
                           #e5e7eb 100%)`"
                       class="slider-custom">

                <div class="d-flex justify-content-between small text-muted mt-2">
                    <span>5</span>
                    <span x-show="selected.length > 0" class="text-primary fw-semibold">
                        Διαθέσιμες: <span x-text="totalAvailable"></span>
                    </span>
                    <span x-text="maxAmount"></span>
                </div>

                <p x-show="selected.length === 0" class="small text-muted text-center mt-3 mb-0">
                    Επίλεξε τουλάχιστον μία κατηγορία για να ξεκινήσεις
                </p>

                <p x-show="selected.length > 0 && maxAmount < 5"
                   class="small text-danger text-center mt-3 mb-0">
                    Οι επιλεγμένες κατηγορίες έχουν λιγότερες από 5 ερωτήσεις
                </p>
            </div>

            <!-- Submit -->
            <button type="submit"
                    :disabled="selected.length === 0 || maxAmount < 5"
                    class="btn btn-quiz-success">
                <i class="bi bi-play-circle"></i>
                Έναρξη Quiz (<span x-text="amount"></span> ερωτήσεις)
            </button>
        </form>
    </div>
</x-app-layout>
