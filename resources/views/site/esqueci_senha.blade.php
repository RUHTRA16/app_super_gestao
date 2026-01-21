<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar senha - CNS Libras</title>

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

      <!-- Botão fechar -->
      <a href="/" class="login-close" aria-label="Voltar para a página inicial">
        <i class="bi bi-x-lg"></i>
      </a>

      <div class="card-body p-4 p-md-5">

        <!-- Logo -->
        <div class="text-center mb-4">
          <img src="{{ asset('images/logosite.png') }}" alt="Logo" height="48" class="mb-2">
          <h4 class="mb-1">Esqueci a senha</h4>
          <p class="text-muted mb-0">
            Informe seu e-mail e enviaremos um link para redefinir sua senha.
          </p>
        </div>

        <!-- Formulário -->
        <form method="POST" action="/esqueci-senha">
          @csrf

          <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   name="email"
                   placeholder="seuemail@exemplo.com"
                   required>
          </div>

          <button type="submit" class="btn btn-dark w-100 py-2">
            Enviar link de recuperação
          </button>

          <div class="text-center mt-3">
            <a href="/login" class="text-decoration-none fw-semibold">
              Voltar para o login
            </a>
          </div>
        </form>

        <hr class="my-4">

        <div class="text-center">
          <span class="text-muted">Não tem conta?</span>
          <a href="/cadastro" class="text-decoration-none fw-semibold">
            Cadastre-se
          </a>
        </div>

      </div>
    </div>
  </main>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
