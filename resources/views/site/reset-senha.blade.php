<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Redefinir senha - CNS Libras</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="login-page">
  <div class="login-bg"></div>

  <main class="login-wrap">
    <div class="card login-card shadow-lg border-0 position-relative">
      <a href="/" class="login-close" aria-label="Voltar para a página inicial">
        <i class="bi bi-x-lg"></i>
      </a>

      <div class="card-body p-4 p-md-5">

        <div class="text-center mb-4">
          <img src="{{ asset('images/logosite.png') }}" alt="Logo" height="48" class="mb-2">
          <h4 class="mb-1">Redefinir senha</h4>
          <p class="text-muted mb-0">Crie uma nova senha para sua conta</p>
        </div>

        @if (session('status'))
          <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if(empty($token))
          <div class="alert alert-danger">
          Link inválido ou expirado. Solicite novamente em “Esqueci a senha”.
          </div>
        @endif

        <form method="POST" action="/reset-senha">
          @csrf

          <input type="hidden" name="token" value="{{ $token ?? '' }}">

          <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email" value="{{ $email }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Nova senha</label>
            <input type="password" class="form-control" name="password" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Confirmar nova senha</label>
            <input type="password" class="form-control" name="password_confirmation" required>
          </div>

          <button class="btn btn-dark w-100 py-2" type="submit">
            Salvar nova senha
          </button>

          <div class="text-center mt-3">
            <a href="/login" class="text-decoration-none fw-semibold">Voltar para o login</a>
          </div>
        </form>

      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
