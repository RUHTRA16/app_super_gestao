<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro - CNS Libras</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Seu CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="login-page">


  <!-- Fundo com blur -->
  <div class="login-bg"></div>

  <!-- Conteúdo central -->
  <main class="login-wrap">
    <div class="card login-card shadow-lg border-0 position-relative">

      <!-- BOTÃO FECHAR (X) -->
      <a href="/" class="login-close" aria-label="Voltar para a página inicial">
        <i class="bi bi-x-lg"></i>
      </a>

      <div class="card-body p-4 p-md-5">

        <!-- Logo -->
        <div class="text-center mb-4">
          <img src="{{ asset('images/logosite.png') }}" alt="Logo" height="48" class="mb-2">
          <h4 class="mb-1">Criar conta</h4>
          <p class="text-muted mb-0">Preencha seus dados para se cadastrar</p>
        </div>

        <!-- Formulário -->
        <form method="POST" action="{{ route('register.post') }}">
          @csrf

          {{-- Mensagens de erro --}}
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <!-- Nome -->
          <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text"
                  class="form-control @error('name') is-invalid @enderror"
                  id="name"
                  name="name"
                  value="{{ old('name') }}"
                  placeholder="Seu nome completo"
                  required>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email"
                  class="form-control @error('email') is-invalid @enderror"
                  id="email"
                  name="email"
                  value="{{ old('email') }}"
                  placeholder="seuemail@exemplo.com"
                  required>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Senha -->
          <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <div class="input-group">
              <input type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    id="password"
                    name="password"
                    placeholder="Crie uma senha"
                    required>

              <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
            @error('password')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
            <small class="text-muted">Use pelo menos 8 caracteres.</small>
          </div>

          <!-- Confirmar Senha -->
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar senha</label>
            <div class="input-group">
              <input type="password"
                    class="form-control"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Repita a senha"
                    required>

              <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <!-- Termos -->
          <div class="form-check mb-3">
            <input class="form-check-input @error('terms') is-invalid @enderror"
                  type="checkbox"
                  id="terms"
                  name="terms"
                  value="1"
                  {{ old('terms') ? 'checked' : '' }}
                  required>
            <label class="form-check-label" for="terms">
              Concordo com os termos de uso
            </label>
            @error('terms')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          <!-- Botão -->
          <button type="submit" class="btn btn-dark w-100 py-2">
            Cadastrar
          </button>

          <!-- Já tem conta -->
          <div class="text-center mt-3">
            <span class="text-muted">Já tem conta?</span>
            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
              Entrar
            </a>
          </div>

        </form>

      </div>
    </div>
  </main>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Mostrar / ocultar senha -->
  <script>
    // Senha
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const iconPass = togglePassword.querySelector('i');

    togglePassword.addEventListener('click', () => {
      const isPassword = passwordInput.type === 'password';
      passwordInput.type = isPassword ? 'text' : 'password';
      iconPass.classList.toggle('bi-eye');
      iconPass.classList.toggle('bi-eye-slash');
    });

    // Confirmar senha
    const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
    const passwordConfirmInput = document.getElementById('password_confirmation');
    const iconConfirm = togglePasswordConfirm.querySelector('i');

    togglePasswordConfirm.addEventListener('click', () => {
      const isPassword = passwordConfirmInput.type === 'password';
      passwordConfirmInput.type = isPassword ? 'text' : 'password';
      iconConfirm.classList.toggle('bi-eye');
      iconConfirm.classList.toggle('bi-eye-slash');
    });
  </script>

</body>
</html>
