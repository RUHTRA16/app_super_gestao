<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
</head>
<body>
  <h2>Login</h2>

  @if ($errors->any())
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  @endif

  <form method="POST" action="{{ route('login.post') }}">
    @csrf

    <div>
      <label>E-mail</label><br>
      <input type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div>
      <label>Senha</label><br>
      <input type="password" name="password" required>
    </div>

    <button type="submit">Entrar</button>
  </form>

  <p><a href="{{ route('register') }}">Criar conta</a></p>
</body>
</html>
