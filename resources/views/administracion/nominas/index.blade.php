@extends('layouts.contentNavbarLayout')
@section('title','Gestión de Nóminas')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h4>Nóminas</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#altaNominaModal">
      + Nueva Nómina
    </button>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-hover">
    <thead>
    <tr>
      <th>ID</th><th>Empleado</th><th>Periodo</th>
      <th>Inicio</th><th>Fin</th>
      <th>Bruto</th><th>Deducciones</th><th>Neto</th>
      <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nominas as $n)
      <tr>
        <td>{{ $n->nmnNominaID }}</td>
        <td>{{ $n->empleado->empNombre }} {{ $n->empleado->empApellidos }}</td>
        <td>{{ $periodos[$n->nmnPeriodo] }}</td>
        <td>{{ $n->nmnFechaInicio->format('d/m/Y') }}</td>
        <td>{{ $n->nmnFechaFin->format('d/m/Y') }}</td>
        <td>{{ number_format($n->nmnSalarioBruto,2) }}</td>
        <td>{{ number_format($n->nmnDeducciones,2) }}</td>
        <td>{{ number_format($n->nmnSalarioNeto,2) }}</td>
        <td>
          <button class="btn btn-sm btn-outline-secondary btn-edit"
                  data-bs-toggle="modal"
                  data-bs-target="#editarNominaModal"
                  data-url="{{ route('administracion.nominas.update',$n->nmnNominaID) }}"
                  data-empleado="{{ $n->nmnEmpleado }}"
                  data-periodo="{{ $n->nmnPeriodo }}"
                  data-fecha_inicio="{{ $n->nmnFechaInicio->format('Y-m-d') }}"
                  data-fecha_fin="{{ $n->nmnFechaFin->format('Y-m-d') }}"
                  data-bruto="{{ $n->nmnSalarioBruto }}"
                  data-deducciones="{{ $n->nmnDeducciones }}"
          >✎</button>

          <form action="{{ route('administracion.nominas.destroy',['nomina' => $n->nmnNominaID]) }}"
                method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Eliminar esta nómina?')">🗑</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>

  {{ $nominas->links() }}

  @include('administracion.nominas.modal_create')
  @include('administracion.nominas.modal_edit')
@endsection
@section('page-script')
  <script>
    $(function(){
      // Al abrir el modal de alta, se resetean los campos
      $('#altaNominaModal').on('show.bs.modal', function(){
        $('#formCrearNomina')[0].reset();
      });

      // Al abrir el modal de edición, se inyectan URL y valores
      $('#editarNominaModal').on('show.bs.modal', function(e){
        const btn  = $(e.relatedTarget);
        const form = $('#formEditarNomina');

        // 1) Ponemos la acción (ruta PUT) en el form
        form.attr('action', btn.data('url'));

        // 2) Rellenamos cada campo con los data-attributes del botón
        form.find('select[name="empleado"]').val(btn.data('empleado'));
        form.find('select[name="periodo"]').val(btn.data('periodo'));
        form.find('input[name="fecha_inicio"]').val(btn.data('fecha_inicio'));
        form.find('input[name="fecha_fin"]').val(btn.data('fecha_fin'));
        form.find('input[name="bruto"]').val(btn.data('bruto'));
        form.find('input[name="deducciones"]').val(btn.data('deducciones'));
      });
    });
  </script>
@endsection
