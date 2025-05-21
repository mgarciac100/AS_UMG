@extends('layouts.contentNavbarLayout')
@section('title','Reportes de Administración')

@section('content')
  <div class="row gy-4">
    <div class="col-12">
      <h4 class="mb-4">Reportes</h4>
      <div class="row g-4">
        {{-- Tarjeta de Nóminas --}}
        <div class="col-md-4">
          <a href="{{ route('administracion.reportes.nominas') }}" class="text-decoration-none">
            <div class="card h-100 shadow-sm hover-shadow">
              <div class="card-body d-flex flex-column">
                <div class="mb-3">
                  <i class="mdi mdi-cash-multiple mdi-36px text-primary"></i>
                </div>
                <h5 class="card-title">Nóminas</h5>
                <p class="card-text text-muted flex-grow-1">
                  Sumarios mensuales de salarios brutos y deducciones.
                </p>
                <span class="badge bg-primary align-self-start">Ver reporte</span>
              </div>
            </div>
          </a>
        </div>

        {{-- Tarjeta de Prestaciones --}}
        <div class="col-md-4">
          <a href="{{ route('administracion.reportes.prestaciones') }}" class="text-decoration-none">
            <div class="card h-100 shadow-sm hover-shadow">
              <div class="card-body d-flex flex-column">
                <div class="mb-3">
                  <i class="mdi mdi-gift-outline mdi-36px text-success"></i>
                </div>
                <h5 class="card-title">Prestaciones</h5>
                <p class="card-text text-muted flex-grow-1">
                  Totales y conteos agrupados por tipo de prestación.
                </p>
                <span class="badge bg-success align-self-start">Ver reporte</span>
              </div>
            </div>
          </a>
        </div>

        {{-- Tarjeta de Productividad --}}
        <div class="col-md-4">
          <a href="{{ route('administracion.reportes.productividad') }}" class="text-decoration-none">
            <div class="card h-100 shadow-sm hover-shadow">
              <div class="card-body d-flex flex-column">
                <div class="mb-3">
                  <i class="mdi mdi-chart-line mdi-36px text-warning"></i>
                </div>
                <h5 class="card-title">Productividad</h5>
                <p class="card-text text-muted flex-grow-1">
                  Promedios y conteos de indicadores por tipo.
                </p>
                <span class="badge bg-warning text-dark align-self-start">Ver reporte</span>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
