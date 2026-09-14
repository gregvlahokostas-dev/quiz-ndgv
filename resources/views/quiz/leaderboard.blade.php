<x-app-layout>
    <div class="container py-4" style="max-width: 900px;">

        <!-- Back -->
        <div class="mb-4">
            <a href="{{ route('home') }}" class="text-muted text-decoration-none small">
                <i class="bi bi-arrow-left"></i> Πίσω στο μενού
            </a>
        </div>

        <!-- Header -->
        <div class="text-center mb-5">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                 style="width: 80px; height: 80px; background: linear-gradient(135deg, #fbbf24, #f59e0b);">
                <i class="bi bi-trophy text-white fs-1"></i>
            </div>
            <h1 class="h2 fw-bold mb-2">Πίνακας Επιδόσεων</h1>
            <p class="text-muted">Οι καλύτερες επιδόσεις όλων των χρηστών</p>
        </div>

        @if($top->isEmpty())
            <!-- Empty state -->
            <div class="card-quiz text-center p-5">
                <i class="bi bi-trophy text-muted" style="font-size: 3rem;"></i>
                <h3 class="h5 fw-bold mt-3 mb-2">Δεν υπάρχουν επιδόσεις ακόμα</h3>
                <p class="text-muted mb-4">Γίνε ο πρώτος που θα ολοκληρώσει ένα quiz!</p>
                <a href="{{ route('quiz.index') }}" class="btn btn-quiz-primary">
                    <i class="bi bi-bullseye"></i> Ξεκίνα Quiz
                </a>
            </div>
        @else
            <!-- Top 3 podium -->
            @if($top->count() >= 3)
                <div class="row g-3 mb-5 align-items-end">
                    <!-- 2nd place -->
                    <div class="col-4">
                        <div class="card-quiz text-center p-3 podium-2">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2"
                                 style="width: 50px; height: 50px; background: #cbd5e1;">
                                <i class="bi bi-trophy-fill text-white fs-4"></i>
                            </div>
                            <div class="badge bg-secondary mb-2">🥈 2η θέση</div>
                            <div class="fw-bold text-dark text-truncate small">
                                {{ $top[1]->user->name }}
                            </div>
                            <div class="text-primary fw-bold">
                                {{ $top[1]->score }}/{{ $top[1]->total_questions }}
                            </div>
                        </div>
                    </div>

                    <!-- 1st place -->
                    <div class="col-4">
                        <div class="card-quiz text-center p-3 podium-1 border-warning border-2">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2"
                                 style="width: 60px; height: 60px; background: linear-gradient(135deg, #fbbf24, #f59e0b);">
                                <i class="bi bi-trophy-fill text-white fs-3"></i>
                            </div>
                            <div class="badge bg-warning text-dark mb-2">🥇 1η θέση</div>
                            <div class="fw-bold text-dark text-truncate small">
                                {{ $top[0]->user->name }}
                            </div>
                            <div class="text-primary fw-bold fs-5">
                                {{ $top[0]->score }}/{{ $top[0]->total_questions }}
                            </div>
                        </div>
                    </div>

                    <!-- 3rd place -->
                    <div class="col-4">
                        <div class="card-quiz text-center p-3 podium-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2"
                                 style="width: 50px; height: 50px; background: #d97706;">
                                <i class="bi bi-trophy-fill text-white fs-4"></i>
                            </div>
                            <div class="badge bg-warning text-dark mb-2" style="background: #d97706 !important; color: white !important;">
                                🥉 3η θέση
                            </div>
                            <div class="fw-bold text-dark text-truncate small">
                                {{ $top[2]->user->name }}
                            </div>
                            <div class="text-primary fw-bold">
                                {{ $top[2]->score }}/{{ $top[2]->total_questions }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Full table -->
            <h2 class="h5 fw-bold mb-3">
                <i class="bi bi-list-ol text-primary"></i> Όλες οι επιδόσεις
            </h2>

            <div class="card-quiz overflow-hidden p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3" style="width: 60px;">#</th>
                            <th class="py-3">Χρήστης</th>
                            <th class="py-3 text-center">Επιδόσεις</th>
                            <th class="py-3 text-center d-none d-md-table-cell">Χρόνος</th>
                            <th class="py-3 text-end pe-4 d-none d-md-table-cell">Ημερομηνία</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($top as $i => $attempt)
                            <tr>
                                <td class="px-4 py-3">
                                    @if($i === 0)
                                        <span class="badge bg-warning text-dark">🥇</span>
                                    @elseif($i === 1)
                                        <span class="badge bg-secondary">🥈</span>
                                    @elseif($i === 2)
                                        <span class="badge" style="background: #d97706; color: white;">🥉</span>
                                    @else
                                        <span class="text-muted fw-semibold">{{ $i + 1 }}</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                             style="width: 32px; height: 32px; font-size: 0.85rem;">
                                            {{ strtoupper(substr($attempt->user->name, 0, 1)) }}
                                        </div>
                                        <span class="fw-semibold text-dark text-truncate">
                                                {{ $attempt->user->name }}
                                            </span>
                                    </div>
                                </td>
                                <td class="py-3 text-center">
                                        <span class="badge-category">
                                            {{ $attempt->score }}/{{ $attempt->total_questions }}
                                        </span>
                                </td>
                                <td class="py-3 text-center text-muted small d-none d-md-table-cell">
                                    @php
                                        $min = floor($attempt->duration_seconds / 60);
                                        $sec = $attempt->duration_seconds % 60;
                                    @endphp
                                    {{ $min }}:{{ str_pad($sec, 2, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="py-3 text-end pe-4 text-muted small d-none d-md-table-cell">
                                    {{ $attempt->created_at->format('d/m/Y') }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-4">
                <a href="{{ route('quiz.index') }}" class="btn btn-quiz-primary">
                    <i class="bi bi-bullseye"></i> Βελτίωσε τη θέση σου
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
