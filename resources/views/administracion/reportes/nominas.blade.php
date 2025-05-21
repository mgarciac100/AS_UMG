{{-- resources/views/administracion/reportes/nominas.blade.php --}}
@extends('layouts.contentNavbarLayout')

@section('title','Reporte de Nóminas')

{{-- Incluimos el CSS de DataTables Buttons --}}
@section('page-style')
  <link rel="stylesheet"
        href="https://cdn.datatables.net/buttons/2.3.7/css/buttons.dataTables.min.css"/>
@endsection

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="mb-4">Reporte de Nóminas</h4>
    <a href="{{ route('administracion.reportes.index') }}"
       class="btn btn-secondary mb-4">
      <i class="mdi mdi-arrow-left"></i> Regresar
    </a>

    <table id="tablaNominasMensual"
           class="table table-striped table-bordered w-100">
      <thead>
      <tr>
        <th>Año</th>
        <th>Mes</th>
        <th>Total Bruto</th>
        <th>Total Deducciones</th>
      </tr>
      </thead>
      <tbody>
      @foreach($reporteMensual as $r)
        <tr>
          <td>{{ $r->anio }}</td>
          <td>{{ \Carbon\Carbon::create()->month($r->mes)->format('F') }}</td>
          <td>{{ number_format($r->total_bruto,2) }}</td>
          <td>{{ number_format($r->total_deducciones,2) }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>

    <h4 class="mt-5 mb-4">Reporte de Nóminas por Colaborador y Año</h4>

    <table id="tablaNominasUsuario"
           class="table table-striped table-bordered w-100">
      <thead>
      <tr>
        <th>Colaborador</th>
        <th>Año</th>
        <th>Total Bruto</th>
        <th>Total Deducciones</th>
      </tr>
      </thead>
      <tbody>
      @foreach($reporteUsuario as $u)
        <tr>
          <td>{{ $u->nombre }}</td>
          <td>{{ $u->anio }}</td>
          <td>{{ number_format($u->total_bruto,2) }}</td>
          <td>{{ number_format($u->total_deducciones,2) }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection

@section('page-script')
  {{-- DataTables Buttons scripts --}}
  <script src="https://cdn.datatables.net/buttons/2.3.7/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.7/js/buttons.html5.min.js"></script>

  <script>
    $(function(){
      const dtOptions = {
        language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json' },
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'excelHtml5',
            text: '📥 Excel',
            titleAttr: 'Exportar a Excel'
          }
        ],
        pageLength: 10,
        destroy: true
      };

      $('#tablaNominasMensual').DataTable(dtOptions);
      $('#tablaNominasUsuario').DataTable(dtOptions);
    });
  </script>
@endsection
