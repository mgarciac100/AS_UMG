@extends('layouts/contentNavbarLayout')

@section('title', 'Administración de Usuarios')

@section('content')
  <div class="row gy-4">
    <!-- Tabla de Usuarios -->
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- Encabezado con búsqueda y acciones -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <input type="search" class="form-control" placeholder="Buscar usuario..." id="searchBox" />
            </div>
            <div class="d-flex gap-2">
              <select class="form-select w-auto" id="rowCount">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="25">25</option>
              </select>
              <button class="btn btn-outline-secondary">Exportar</button>
              <button class="btn btn-primary">+ Agregar Usuario</button>
            </div>
          </div>

          <!-- Tabla -->
          <div class="table-responsive">
            <table id="tablaUsuarios" class="table  table-hover">
              <thead class="table-light">
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th class="text-center">Acciones</th>
              </tr>
              </thead>
              <tbody>
              @foreach($UsuariosRoles as $usuario)
                <tr>
                  <td>{{ $usuario->id }}</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="badge bg-info-subtle  text-info text-uppercase rounded-circle me-2 text-dark " style="width: 40px; height: 40px; line-height: 40px; text-align: center;">
                        {{ substr($usuario->name, 0, 1) }}
                      </span>
                      {{ $usuario->name }}
                    </div>
                  </td>
                  <td>{{ $usuario->email }}</td>
                  <td>
                    @foreach($usuario->roles as $rol)
                      <span class="badge bg-primary-subtle text-primary me-1">
                        {{ $rol->nombre }}
                      </span>
                    @endforeach
                  </td>
                  <td class="text-center">
                    <a href="#" class="text-secondary me-2"><i class="mdi mdi-pencil-outline"></i></a>
                    <a href="#" class="text-danger me-2"><i class="mdi mdi-delete-outline"></i></a>
                    <a href="#" class="text-secondary"><i class="mdi mdi-dots-vertical"></i></a>
                  </td>
                </tr>
              @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--/ Tabla de Usuarios -->
  </div>
@endsection

@section('page-script')
  <script>
    $(document).ready(function () {
      let table = $('#tablaUsuarios').DataTable({
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        pageLength: 10,
        lengthChange: false,
        dom: 't<"d-flex justify-content-between align-items-center px-3"ip>',
      });

      // Filtro de búsqueda
      $('#searchBox').on('keyup', function () {
        table.search(this.value).draw();
      });

      // Cambio de cantidad por página
      $('#rowCount').on('change', function () {
        table.page.len(this.value).draw();
      });
    });
  </script>
@endsection
