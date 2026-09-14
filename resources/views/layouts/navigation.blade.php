<nav class="navbar navbar-expand-lg navbar-quiz" x-data="{ open: false }" @click.outside="open = false">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <div class="d-flex align-items-center justify-content-center rounded-2"
                 style="width: 36px; height: 36px; background: linear-gradient(135deg, #3b82f6, #4f46e5);">
                <i class="bi bi-patch-check-fill text-white"></i>
            </div>
            <span>Quiz ΑΣΕΠ</span>
        </a>

        <!-- Mobile Toggle (hamburger) -->
        <button class="navbar-toggler border-0 d-lg-none" type="button" @click="open = !open">
            <i class="bi fs-3" :class="open ? 'bi-x-lg' : 'bi-list'"></i>
        </button>

        <!-- Desktop Menu (visible only on lg+) -->
        <div class="d-none d-lg-flex flex-grow-1">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        <i class="bi bi-house-door"></i> Αρχική
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('study.*') ? 'active' : '' }}"
                       href="{{ route('study.index') }}">
                        <i class="bi bi-book"></i> Μελέτη
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('quiz.index') || request()->routeIs('quiz.play') ? 'active' : '' }}"
                       href="{{ route('quiz.index') }}">
                        <i class="bi bi-bullseye"></i> Quiz
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('quiz.leaderboard') ? 'active' : '' }}"
                       href="{{ route('quiz.leaderboard') }}">
                        <i class="bi bi-trophy"></i> Κατάταξη
                    </a>
                </li>
            </ul>

            <!-- User Dropdown -->
            <div class="dropdown">
                <button class="btn btn-light d-flex align-items-center gap-2"
                        type="button" data-bs-toggle="dropdown">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold"
                         style="width: 32px; height: 32px; font-size: 0.85rem;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="text-dark">{{ Auth::user()->name }}</span>
                    <i class="bi bi-chevron-down small"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person me-2"></i> Το προφίλ μου
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Αποσύνδεση
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Alpine) -->
    <div x-show="open"
         x-cloak
         x-transition:enter="transition"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="d-lg-none border-top bg-white col-12">

        <div class="container py-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        <i class="bi bi-house-door"></i> Αρχική
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('study.*') ? 'active' : '' }}"
                       href="{{ route('study.index') }}">
                        <i class="bi bi-book"></i> Μελέτη
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('quiz.index') || request()->routeIs('quiz.play') ? 'active' : '' }}"
                       href="{{ route('quiz.index') }}">
                        <i class="bi bi-bullseye"></i> Quiz
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('quiz.leaderboard') ? 'active' : '' }}"
                       href="{{ route('quiz.leaderboard') }}">
                        <i class="bi bi-trophy"></i> Κατάταξη
                    </a>
                </li>

                <li><hr class="dropdown-divider my-2"></li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person"></i> Το προφίλ μου
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start">
                            <i class="bi bi-box-arrow-right"></i> Αποσύνδεση
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
