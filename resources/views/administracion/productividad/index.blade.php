@extends('layouts.contentNavbarLayout')
@section('title','Indicadores de Productividad')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h4>Indicadores de Productividad</h4>
    <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#altaProductividadModal">
      + Nuevo Indicador
    </button>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-hover">
    <thead>
    <tr>
      <th>ID</th>
      <th>Empleado</th>
      <th>Indicador</th>
      <th>Valor</th>
      <th>Calificación</th>
      <th>Fecha</th>
      <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $i)
      <tr>
        <td>{{ $i->id }}</td>
        <td>{{ $i->empleado->empNombre }} {{ $i->empleado->empApellidos }}</td>
        <td>{{ $i->indicador }}</td>
        <td>{{ number_format($i->valor,2) }}</td>
        {{-- Calificación en estrellas --}}
        <td>
          @php
            // Redondeamos el valor a entero entre 0 y 5
            $stars = min(5, max(0, (int) round($i->valor)));
          @endphp
          @for($s = 1; $s <= 5; $s++)
            @if($s <= $stars)
              <i class="mdi mdi-star text-warning"></i>
            @else
              <i class="mdi mdi-star-outline text-secondary"></i>
            @endif
          @endfor
        </td>
        <td>{{ $i->fecha->format('d/m/Y') }}</td>
        <td>
          {{-- Editar --}}
          <button class="btn btn-sm btn-outline-secondary btn-edit"
                  data-bs-toggle="modal"
                  data-bs-target="#editarProductividadModal"
                  data-url="{{ route('administracion.productividad.update',['item'=>$i->id]) }}"
                  data-empleado_id="{{ $i->empleado_id }}"
                  data-indicador="{{ $i->indicador }}"
                  data-valor="{{ $i->valor }}"
                  data-fecha="{{ $i->fecha->format('Y-m-d') }}"
          >✎</button>

          {{-- Eliminar --}}
          <form action="{{ route('administracion.productividad.destroy',['item'=>$i->id]) }}"
                method="POST" class="d-inline"
                onsubmit="return confirm('¿Eliminar este indicador?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">🗑</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>

  {{ $items->links() }}

  @include('administracion.productividad.modal_create')
  @include('administracion.productividad.modal_edit')
@endsection

@section('page-script')
  <script>
    $(function(){
      // Al abrir “Nuevo Indicador”
      $('#altaProductividadModal').on('show.bs.modal', ()=> {
        $('#formCrearProductividad')[0].reset();
      });

      // Al abrir “Editar Indicador”
      $('#editarProductividadModal').on('show.bs.modal', function(e){
        const btn  = $(e.relatedTarget);
        const form = $('#formEditarProductividad');

        form.attr('action', btn.data('url'));
        form.find('select[name="empleado_id"]').val(btn.data('empleado_id'));
        form.find('input[name="indicador"]').val(btn.data('indicador'));
        form.find('input[name="valor"]').val(btn.data('valor'));
        form.find('input[name="fecha"]').val(btn.data('fecha'));
      });
    });
  </script>
@endsection
