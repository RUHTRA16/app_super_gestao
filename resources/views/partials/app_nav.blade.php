<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="{{ route('app.dashboard') }}">
      <i class="bi bi-mortarboard-fill me-2"></i> Sistema do Curso
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#appNavbar"
      aria-controls="appNavbar" aria-expanded="false" aria-label="Alternar navegação">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="appNavbar">

      <!-- MENU ESQUERDA -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('app.dashboard') ? 'active' : '' }}"
             href="{{ route('app.dashboard') }}">
            <i class="bi bi-speedometer2 me-1"></i> Dashboard
          </a>
        </li>

        {{-- ===== MENU SOMENTE PARA ADMIN ===== --}}
        @if(auth()->user()->role === 'admin')

          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('app.alunos.*') ? 'active' : '' }}"
               href="{{ route('app.alunos.index') }}">
              <i class="bi bi-people-fill me-1"></i> Alunos
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('app.matriculas.*') ? 'active' : '' }}"
               href="{{ route('app.matriculas.index') }}">
              <i class="bi bi-person-lines-fill me-1"></i> Matrículas
            </a>
          </li>

        @endif

        {{-- ===== MENU SOMENTE PARA ALUNO ===== --}}
        @if(auth()->user()->role === 'student')

          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('app.aluno.notas') ? 'active' : '' }}"
               href="{{ route('app.aluno.notas') }}">
              <i class="bi bi-journal-check me-1"></i> Minhas Notas
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('app.aluno.chamadas') ? 'active' : '' }}"
               href="{{ route('app.aluno.chamadas') }}">
              <i class="bi bi-clipboard-check me-1"></i> Minhas Chamadas
            </a>
          </li>

        @endif

      </ul>

      <!-- MENU DIREITA -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
          </a>

          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="{{ route('Página_Inicial') }}">
                <i class="bi bi-house-door me-2"></i> Página inicial
              </a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
              <form method="POST" action="{{ route('logout') }}" class="px-3">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100">
                  <i class="bi bi-box-arrow-right me-2"></i> Sair
                </button>
              </form>
            </li>
          </ul>
        </li>
      </ul>

    </div>
  </div>
</nav>
