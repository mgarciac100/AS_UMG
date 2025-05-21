<div class="modal fade" id="editarNominaModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="formEditarNomina" method="POST" action="#">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title">Editar Nómina</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label>Empleado</label>
              <select name="empleado" class="form-select" required>
                @foreach(\App\Models\Empleados::all() as $emp)
                  <option value="{{ $emp->empEmpleadosID }}">
                    {{ $emp->empNombre }} {{ $emp->empApellidos }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label>Periodo</label>
              <select name="periodo" class="form-select" required>
                @foreach($periodos as $k=>$v)
                  <option value="{{ $k }}">{{ $v }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label>Fecha inicio</label>
              <input type="date" name="fecha_inicio" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Fecha fin</label>
              <input type="date" name="fecha_fin" class="form-control" required>
            </div>

            <div class="col-md-4">
              <label>Salario bruto</label>
              <input type="number" step="0.01" name="bruto" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>Deducciones</label>
              <input type="number" step="0.01" name="deducciones" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>Salario neto</label>
              <input type="text" class="form-control" readonly>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary"
                  data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>
