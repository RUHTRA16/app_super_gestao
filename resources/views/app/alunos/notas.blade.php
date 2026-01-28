@extends('layouts.app')
@section('title', 'Minhas Notas')

@section('content')
  <h2>Minhas Notas</h2>
  <p class="text-muted">
    Olá, {{ auth()->user()->name }} 👋  
    Aqui você verá suas notas.
  </p>

  <div class="alert alert-info">
    (Em breve: notas por disciplina)
  </div>
@endsection
