@extends('layouts.contentNavbarLayout')
@section('title','Gestión de Colaboradores')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h4>Colaboradores</h4>
    <button type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#altaColaboradorModal">
      + Alta Colaborador
    </button>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-hover">
    <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Puesto</th>
      <th>Usuario</th>
      <th>Rol</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($empleados as $e)
      <tr>
        <td>{{ $e->empEmpleadosId }}</td>
        <td>{{ $e->empNombre }} {{ $e->empApellidos }}</td>
        <td>{{ $e->puesto->pstDescripcion }}</td>
        <td>{{ $e->user->email }}</td>
        <td>

          @foreach($e->user->roles as $r)
            <span class="badge bg-secondary">{{ $r->nombre }}</span>
          @endforeach
        </td>
        <td>
          @if($e->empEstado)
            <span class="text-success">Activo</span>
          @else
            <span class="text-danger">Inactivo</span>
          @endif
        </td>
        <td>
          <button
            type="button"
            class="btn btn-sm btn-outline-secondary btn-edit"
            data-bs-toggle="modal"
            data-bs-target="#editarColaboradorModal"
            data-url="{{ route('administracion.empleados.update', $e) }}"
            data-nombre="{{ $e->empNombre }}"
            data-apellidos="{{ $e->empApellidos }}"
            data-fecha_nac="{{ $e->empFechaNacimiento->format('Y-m-d') }}"
            data-fecha_ing="{{ $e->empFechaIngreso->format('Y-m-d') }}"
            data-puesto="{{ $e->empPuestoID }}"
            data-salario="{{ $e->empSalarioDiario }}"
            data-estado="{{ $e->empEstado }}"
          >
            ✎
          </button>

          <form action="{{ route('administracion.empleados.destroy',$e) }}"
                method="POST" class="d-inline"
                onsubmit="return confirm('¿Seguro desea dar de baja este colaborador?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">🗑</button>
          </form>

        </td>
      </tr>
    @endforeach
    </tbody>
  </table>

  {{ $empleados->links() }}
  @include('administracion.empleados.modal_create')
  @include('administracion.empleados.modal_edit')
@endsection

@section('page-script')
  <script>
    $(function(){
      $('#editarColaboradorModal').on('show.bs.modal', function(e){
        const btn = $(e.relatedTarget);
        const form = $('#formEditar');

        form.attr('action', btn.data('url'));

        // Rellenamos datos
        form.find('input[name="nombre"]').val(btn.data('nombre'));
        form.find('input[name="apellidos"]').val(btn.data('apellidos'));
        form.find('input[name="fecha_nac"]').val(btn.data('fecha_nac'));
        form.find('input[name="fecha_ing"]').val(btn.data('fecha_ing'));
        form.find('select[name="puesto"]').val(btn.data('puesto'));
        form.find('input[name="salario"]').val(btn.data('salario'));
        form.find('input[name="estado"]').prop('checked', btn.data('estado') == 1);
      });
    });
  </script>
@endsection



