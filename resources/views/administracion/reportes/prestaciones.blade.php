@extends('layouts.contentNavbarLayout')
@section('title','Reporte de Prestaciones')

@section('content')
  <h4>Reporte de Prestaciones</h4>
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Tipo</th><th>Cantidad</th><th>Total Monto</th>
    </tr>
    </thead>
    <tbody>
    @foreach($reporte as $r)
      <tr>
        <td>{{ $tipos[$r->prsTipoPrestacion] ?? $r->prsTipoPrestacion }}</td>
        <td>{{ $r->cantidad }}</td>
        <td>{{ number_format($r->total_monto,2) }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
