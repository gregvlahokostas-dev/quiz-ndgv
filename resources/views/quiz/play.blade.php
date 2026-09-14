<x-app-layout>
    <div class="container py-4" style="max-width: 800px;"
         x-data="{
            current: 0,
            total: {{ $questions->count() }},
            answers: {},
            showConfirm: false,

            get answeredCount() {
                return Object.keys(this.answers).filter(k => this.answers[k] !== null && this.answers[k] !== undefined).length;
            },

            get unansweredCount() {
                return this.total - this.answeredCount;
            },

            isAnswered(questionId) {
                return this.answers[questionId] !== undefined
                    && this.answers[questionId] !== null
                    && this.answers[questionId] !== '';
            },

            setAnswer(questionId, value) {
                this.answers[questionId] = value;
            },

            goTo(index) {
                if (index >= 0 && index < this.total) {
                    this.current = index;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            },

            openConfirm() {
                this.showConfirm = true;
            },

            closeConfirm() {
                this.showConfirm = false;
            }
         }">

        <!-- Header με progress -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <span class="small text-muted">
                Ερώτηση <strong class="text-dark" x-text="current + 1"></strong> / {{ $questions->count() }}
            </span>
            <span class="badge-stat">
                Απαντημένες: <span x-text="answeredCount"></span> / {{ $questions->count() }}
            </span>
        </div>

        <!-- Progress bar -->
        <div class="progress mb-4">
            <div class="progress-bar"
                 :style="`width: ${(answeredCount / total) * 100}%`"></div>
        </div>

        <!-- Progress dots -->
        <div class="d-flex justify-content-center flex-wrap gap-2 mb-4">
            @foreach($questions as $i => $q)
                <button type="button"
                        @click="goTo({{ $i }})"
                        class="btn p-0 rounded-circle"
                        style="width: 12px; height: 12px; border: none;"
                        :style="{
                            background: current === {{ $i }}
                                ? '#2563eb'
                                : (isAnswered({{ $q->id }}) ? '#10b981' : '#d1d5db'),
                            transform: current === {{ $i }} ? 'scale(1.4)' : 'scale(1)',
                            transition: 'all 0.2s'
                        }"></button>
            @endforeach
        </div>

        <!-- Φόρμα -->
        <form method="POST" action="{{ route('quiz.submit') }}" x-ref="quizForm">
            @csrf

            <!-- Hidden inputs -->
            <template x-for="(value, key) in answers" :key="key">
                <input type="hidden" :name="`answers[${key}]`" :value="value">
            </template>

            <!-- Ερωτήσεις -->
            @foreach($questions as $i => $q)
                <div x-show="current === {{ $i }}"
                     x-transition:enter="transition"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100">

                    <div class="card-quiz p-4 mb-4">
                        <!-- Category chip -->
                        @if($q->category)
                            <div class="mb-2">
                                <span class="badge-category">{{ $q->category->name }}</span>
                            </div>
                        @endif

                        <!-- Ερώτηση -->
                        <h2 class="h5 fw-semibold text-dark mb-4">
                            {{ $q->text }}
                        </h2>

                        <!-- Απαντήσεις -->
                        <div class="d-flex flex-column gap-2">
                            @foreach($q->options as $idx => $opt)
                                <label class="answer-option mb-0">
                                    <input type="radio"
                                           name="q_{{ $q->id }}"
                                           value="{{ $idx }}"
                                           @change="setAnswer({{ $q->id }}, {{ $idx }})"
                                           class="d-none">

                                    <div class="d-flex align-items-center gap-3">
                                        <div class="custom-radio"></div>
                                        <span class="flex-grow-1 small text-dark">
                                            {{ $opt }}
                                        </span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </form>

        <!-- Πλοήγηση -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <button type="button"
                    @click="goTo(current - 1)"
                    :disabled="current === 0"
                    class="btn btn-outline-secondary fw-semibold px-4">
                <i class="bi bi-arrow-left"></i> Πίσω
            </button>

            <button type="button"
                    @click="goTo(current + 1)"
                    :disabled="current === total - 1"
                    class="btn btn-quiz-primary px-4">
                Επόμενη <i class="bi bi-arrow-right"></i>
            </button>
        </div>

        <!-- Διαχωριστικό -->
        <div class="d-flex align-items-center gap-3 my-4">
            <div class="flex-grow-1 border-top"></div>
            <span class="text-uppercase text-muted small fw-medium">Ή τερμάτισε το quiz</span>
            <div class="flex-grow-1 border-top"></div>
        </div>

        <!-- Υποβολή -->
        <button type="button"
                @click="openConfirm()"
                class="btn btn-quiz-success w-100 py-3 fw-bold">
            <i class="bi bi-check-circle"></i>
            Υποβολή Quiz
        </button>

        <!-- ═══════ MODAL ΕΠΙΒΕΒΑΙΩΣΗΣ ═══════ -->
        <!-- ═══════ MODAL ΕΠΙΒΕΒΑΙΩΣΗΣ ═══════ -->
        <template x-if="showConfirm">
            <div @keydown.escape.window="closeConfirm()"
                 class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center p-3"
                 style="z-index: 1050;">

                <!-- Backdrop -->
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark"
                     style="opacity: 0.6;"
                     @click="closeConfirm()"></div>

                <!-- Modal card -->
                <div class="bg-white rounded-3 shadow-lg position-relative p-4 modal-fade-in"
                     style="max-width: 460px; width: 100%; z-index: 1;">

                    <!-- Icon -->
                    <div class="text-center mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                             style="width: 64px; height: 64px;"
                             :class="unansweredCount > 0 ? 'bg-warning bg-opacity-10' : 'bg-success bg-opacity-10'">
                            <i class="bi fs-2"
                               :class="unansweredCount > 0
                               ? 'bi-exclamation-triangle text-warning'
                               : 'bi-check-circle text-success'"></i>
                        </div>
                    </div>

                    <!-- Title -->
                    <h3 class="h4 fw-bold text-center mb-3"
                        x-text="unansweredCount > 0
                        ? 'Ολοκλήρωση Quiz;'
                        : 'Έτοιμος/η για υποβολή;'"></h3>

                    <!-- Message -->
                    <div class="text-center text-muted mb-4">
                        <template x-if="unansweredCount === 0">
                            <p class="mb-0">
                                Έχεις απαντήσει σε <strong class="text-success">όλες τις <span x-text="total"></span> ερωτήσεις</strong>.
                                <br>Θέλεις να υποβάλεις το quiz;
                            </p>
                        </template>

                        <template x-if="unansweredCount > 0">
                            <div>
                                <p class="mb-2">
                                    Έχεις απαντήσει σε
                                    <strong class="text-primary"><span x-text="answeredCount"></span> από <span x-text="total"></span></strong>
                                    ερωτήσεις.
                                </p>
                                <div class="alert alert-warning small py-2 mb-0">
                                    <i class="bi bi-exclamation-triangle"></i>
                                    Οι <strong><span x-text="unansweredCount"></span> αναπάντητες</strong>
                                    θα μετρηθούν ως <strong>λάθος</strong>.
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex gap-2">
                        <button type="button"
                                @click="closeConfirm()"
                                class="btn btn-outline-secondary flex-grow-1 fw-semibold py-2">
                            Όχι, συνέχισε
                        </button>

                        <button type="button"
                                @click="$refs.quizForm.submit()"
                                class="btn flex-grow-1 fw-semibold py-2"
                                :class="unansweredCount > 0 ? 'btn-warning text-white' : 'btn-quiz-success'">
                            Ναι, υποβολή
                        </button>
                    </div>
                </div>
            </div>
        </template>
        <!-- ═══════ /MODAL ═══════ -->
    </div>
</x-app-layout>
