<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - CNS Libras</title>

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
          <h4 class="mb-1">Entrar</h4>
          <p class="text-muted mb-0">Acesse sua conta para continuar</p>
        </div>

        <!-- Formulário -->
        <form method="POST" action="/login">
          @csrf

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   name="email"
                   placeholder="seuemail@exemplo.com"
                   required>
          </div>

          <!-- Senha com ícone de olho -->
          <div class="mb-3">
            <label for="password" class="form-label">Senha</label>

            <div class="input-group">
              <input type="password"
                     class="form-control"
                     id="password"
                     name="password"
                     placeholder="Digite sua senha"
                     required>

              <button class="btn btn-outline-secondary"
                      type="button"
                      id="togglePassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <!-- Lembrar / Esqueci -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember" name="remember">
              <label class="form-check-label" for="remember">Lembrar</label>
            </div>

            <a href="/esquecisenha" class="text-decoration-none">
              Esqueci a senha
            </a>
          </div>

          <!-- Botão -->
          <button type="submit" class="btn btn-dark w-100 py-2">
            Entrar
          </button>

          <!-- Cadastro -->
          <div class="text-center mt-3">
            <span class="text-muted">Não tem conta?</span>
            <a href="/cadastro" class="text-decoration-none fw-semibold">
              Cadastre-se
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
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const icon = togglePassword.querySelector('i');

    togglePassword.addEventListener('click', () => {
      const isPassword = passwordInput.type === 'password';
      passwordInput.type = isPassword ? 'text' : 'password';
      icon.classList.toggle('bi-eye');
      icon.classList.toggle('bi-eye-slash');
    });
  </script>

</body>
</html>
