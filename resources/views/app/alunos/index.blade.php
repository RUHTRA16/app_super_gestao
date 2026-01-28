@extends('layouts.app')
@section('title', 'Alunos')

@section('content')
<div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
  <div>
    <h2 class="mb-0">Alunos</h2>
    <div class="text-muted">Gerencie cadastro e pesquisa de alunos</div>
  </div>

  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovoAluno">
    <i class="bi bi-plus-lg me-1"></i> Novo aluno
  </button>
</div>

<div class="card shadow-sm">
  <div class="card-body">

    <form method="GET" action="{{ route('app.alunos.index') }}" class="row g-2 align-items-center mb-3">
      <div class="col-md-8">
        <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control"
               placeholder="Buscar por nome, e-mail ou telefone...">
      </div>
      <div class="col-md-4 d-flex gap-2">
        <button class="btn btn-dark w-100" type="submit">
          <i class="bi bi-search me-1"></i> Buscar
        </button>
        <a class="btn btn-outline-secondary w-100" href="{{ route('app.alunos.index') }}">
          Limpar
        </a>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Nascimento</th>
            <th>Status</th>
            <th class="text-end">Ações</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($students as $student)
          <tr>
            <td class="fw-semibold">{{ $student->name }}</td>
            <td>{{ $student->email ?? '-' }}</td>
            <td>{{ $student->phone ?? '-' }}</td>
            <td>{{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') : '-' }}</td>
            <td>
              @if ($student->active)
                <span class="badge text-bg-success">Ativo</span>
              @else
                <span class="badge text-bg-secondary">Inativo</span>
              @endif
            </td>
            <td class="text-end">

              <!-- Editar -->
              <button
                class="btn btn-sm btn-outline-secondary btn-edit"
                data-bs-toggle="modal"
                data-bs-target="#modalEditarAluno"
                data-id="{{ $student->id }}"
                data-name="{{ $student->name }}"
                data-email="{{ $student->email }}"
                data-phone="{{ $student->phone }}"
                data-birth_date="{{ $student->birth_date }}"
                data-active="{{ $student->active ? 1 : 0 }}"
              >
                <i class="bi bi-pencil-square me-1"></i> Editar
              </button>

              <!-- Excluir -->
              <form method="POST"
                    action="{{ route('app.alunos.destroy', $student) }}"
                    class="d-inline"
                    onsubmit="return confirm('Tem certeza que deseja excluir este aluno?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">
                  <i class="bi bi-trash me-1"></i> Excluir
                </button>
              </form>

            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center text-muted py-4">
              Nenhum aluno encontrado.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-end">
      {{ $students->links() }}
    </div>
  </div>
</div>

<!-- ================= MODAL NOVO ALUNO ================= -->
<div class="modal fade" id="modalNovoAluno" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" action="{{ route('app.alunos.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Novo aluno</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nome *</label>
              <input type="text" name="name" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">E-mail</label>
              <input type="email" name="email" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="form-label">Telefone</label>
              <input type="text" name="phone" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="form-label">Data de nascimento</label>
              <input type="date" name="birth_date" class="form-control">
            </div>

            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="active" value="1" checked>
                <label class="form-check-label">Aluno ativo</label>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ================= MODAL EDITAR ALUNO ================= -->
<div class="modal fade" id="modalEditarAluno" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formEditarAluno" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title">Editar aluno</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nome *</label>
              <input type="text" id="edit_name" name="name" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">E-mail</label>
              <input type="email" id="edit_email" name="email" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="form-label">Telefone</label>
              <input type="text" id="edit_phone" name="phone" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="form-label">Data de nascimento</label>
              <input type="date" id="edit_birth_date" name="birth_date" class="form-control">
            </div>

            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="edit_active" name="active" value="1">
                <label class="form-check-label">Aluno ativo</label>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar alterações</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.querySelectorAll('.btn-edit').forEach(btn => {
  btn.addEventListener('click', () => {
    const id = btn.dataset.id;
    const baseUrl = "{{ url('/app/alunos') }}";

    document.getElementById('formEditarAluno').action = `${baseUrl}/${id}`;
    document.getElementById('edit_name').value = btn.dataset.name ?? '';
    document.getElementById('edit_email').value = btn.dataset.email ?? '';
    document.getElementById('edit_phone').value = btn.dataset.phone ?? '';
    document.getElementById('edit_birth_date').value = btn.dataset.birth_date ?? '';
    document.getElementById('edit_active').checked = btn.dataset.active === '1';
  });
});
</script>
@endsection