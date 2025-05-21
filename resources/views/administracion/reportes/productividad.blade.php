@extends('layouts.contentNavbarLayout')
@section('title','Reporte de Productividad')

@section('content')
  <h4>Reporte de Productividad</h4>
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Indicador</th><th>Registros</th><th>Valor Promedio</th>
    </tr>
    </thead>
    <tbody>
    @foreach($reporte as $r)
      <tr>
        <td>{{ $r->indicador }}</td>
        <td>{{ $r->registros }}</td>
        <td>{{ number_format($r->promedio_valor,2) }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
