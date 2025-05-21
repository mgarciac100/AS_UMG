<div class="modal fade" id="editarProductividadModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="formEditarProductividad" method="POST" action="#">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Editar Indicador</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Empleado</label>
              <select name="empleado_id" class="form-select" required>
                @foreach($empleados as $id=>$name)
                  <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Indicador</label>
              <input type="text" name="indicador" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Valor</label>
              <input type="number" step="0.01" name="valor" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Fecha</label>
              <input type="date" name="fecha" class="form-control" required>
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
