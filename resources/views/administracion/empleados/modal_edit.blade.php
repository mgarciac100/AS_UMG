<div class="modal fade" id="editarColaboradorModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="formEditar" method="POST" action="#">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title">Editar Colaborador</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <!-- Copie aquí los mismos campos que en create, pero sin usuario/email/password -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Nombre(s)</label>
              <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Apellidos</label>
              <input type="text" name="apellidos" class="form-control" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Fecha de nacimiento</label>
              <input type="date" name="fecha_nac" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Fecha de ingreso</label>
              <input type="date" name="fecha_ing" class="form-control" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Puesto</label>
              <select name="puesto" class="form-select" required>
                <option value="" disabled>-- Seleccione un puesto --</option>
                @foreach($puestos as $id => $desc)
                  <option value="{{ $id }}">{{ $desc }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Salario diario</label>
              <input type="number" step="0.01" name="salario" class="form-control" required>
            </div>
          </div>
          <div class="form-check mb-0">
            <input type="checkbox" name="estado" value="1" class="form-check-input" id="editEstado">
            <label class="form-check-label" for="editEstado">Activo</label>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>
