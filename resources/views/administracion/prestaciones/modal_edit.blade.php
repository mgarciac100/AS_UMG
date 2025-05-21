<div class="modal fade" id="editarPrestacionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="formEditarPrestacion" method="POST" action="#">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Editar Prestación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            {{-- Mismos campos que en create --}}
            <div class="col-md-6">
              <label class="form-label">Empleado</label>
              <select name="empleado" class="form-select" required>
                @foreach($empleadosList as $id => $name)
                  <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Tipo</label>
              <select name="tipo" class="form-select" required>
                @foreach($tipos as $k=>$v)
                  <option value="{{ $k }}">{{ $v }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Monto</label>
              <input type="number" step="0.01" name="monto" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Fecha</label>
              <input type="date" name="fecha" class="form-control" required>
            </div>
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
