<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro</title>
</head>
<body>
  <h2>Cadastro</h2>

  @if ($errors->any())
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  @endif

  <form method="POST" action="{{ route('register.post') }}">
    @csrf

    <div>
      <label>Nome</label><br>
      <input type="text" name="name" value="{{ old('name') }}" required>
    </div>

    <div>
      <label>E-mail</label><br>
      <input type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div>
      <label>Senha</label><br>
      <input type="password" name="password" required>
    </div>

    <div>
      <label>Confirmar senha</label><br>
      <input type="password" name="password_confirmation" required>
    </div>

    <button type="submit">Cadastrar</button>
  </form>

  <p><a href="{{ route('login') }}">Voltar para login</a></p>
</body>
</html>
