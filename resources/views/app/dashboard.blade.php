@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h2 class="mb-0">Dashboard</h2>
    <span class="text-muted">Bem-vindo, {{ auth()->user()->name }} 👋</span>
  </div>

  <div class="row g-3">
    <div class="col-md-4">
      <a class="text-decoration-none" href="{{ route('app.alunos.index') }}">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="fw-semibold"><i class="bi bi-people-fill me-2"></i>Alunos</div>
            <div class="text-muted small">Cadastrar e gerenciar alunos</div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4">
      <a class="text-decoration-none" href="{{ route('app.notas.index') }}">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="fw-semibold"><i class="bi bi-journal-check me-2"></i>Notas</div>
            <div class="text-muted small">Lançar e consultar notas</div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4">
      <a class="text-decoration-none" href="{{ route('app.chamadas.index') }}">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="fw-semibold"><i class="bi bi-clipboard-check me-2"></i>Chamadas</div>
            <div class="text-muted small">Registrar frequência</div>
          </div>
        </div>
      </a>
    </div>
  </div>
@endsection
