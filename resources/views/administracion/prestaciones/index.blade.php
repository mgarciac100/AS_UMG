@extends('layouts.contentNavbarLayout')
@section('title','Gestión de Prestaciones')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h4>Prestaciones</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#altaPrestacionModal">
      + Nueva Prestación
    </button>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-hover">
    <thead>
    <tr>
      <th>ID</th><th>Empleado</th><th>Tipo</th>
      <th>Monto</th><th>Fecha</th><th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($prestaciones as $p)
      <tr>
        <td>{{ $p->prsPrestacionID }}</td>
        <td>{{ $p->empleado->empNombre }} {{ $p->empleado->empApellidos }}</td>
        <td>{{ $tipos[$p->prsTipoPrestacion] }}</td>
        <td>{{ number_format($p->prsMonto,2) }}</td>
        <td>{{ $p->prsFecha->format('d/m/Y') }}</td>
        <td>
          {{-- Editar --}}
          <button class="btn btn-sm btn-outline-secondary btn-edit"
                  data-bs-toggle="modal"
                  data-bs-target="#editarPrestacionModal"
                  data-url="{{ route('administracion.prestaciones.update',['prestacion'=>$p->prsPrestacionID]) }}"
                  data-empleado="{{ $p->prsEmpleado }}"
                  data-tipo="{{ $p->prsTipoPrestacion }}"
                  data-monto="{{ $p->prsMonto }}"
                  data-fecha="{{ $p->prsFecha->format('Y-m-d') }}"
          >✎</button>
          {{-- Borrar --}}
          <form action="{{ route('administracion.prestaciones.destroy',['prestacion'=>$p->prsPrestacionID]) }}"
                method="POST" class="d-inline"
                onsubmit="return confirm('Eliminar esta prestación?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">🗑</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>

  {{ $prestaciones->links() }}

  @include('administracion.prestaciones.modal_create')
  @include('administracion.prestaciones.modal_edit')
@endsection

@section('page-script')
  <script>
    $(function(){
      // Reset al abrir "Nueva"
      $('#altaPrestacionModal').on('show.bs.modal', ()=> {
        $('#formCrearPrestacion')[0].reset();
      });

      // Inyectar datos al abrir "Editar"
      $('#editarPrestacionModal').on('show.bs.modal', function(e){
        const btn  = $(e.relatedTarget);
        const form = $('#formEditarPrestacion');

        form.attr('action', btn.data('url'));
        form.find('select[name="empleado"]').val(btn.data('empleado'));
        form.find('select[name="tipo"]').val(btn.data('tipo'));
        form.find('input[name="monto"]').val(btn.data('monto'));
        form.find('input[name="fecha"]').val(btn.data('fecha'));
      });
    });
  </script>
@endsection
