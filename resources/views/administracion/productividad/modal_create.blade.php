<div class="modal fade" id="altaProductividadModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="formCrearProductividad"
            method="POST"
            action="{{ route('administracion.productividad.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Nuevo Indicador</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            {{-- Empleado --}}
            <div class="col-md-6">
              <label class="form-label">Empleado</label>
              <select name="empleado_id"
                      class="form-select @error('empleado_id') is-invalid @enderror"
                      required>
                <option value="">-- Seleccione --</option>
                @foreach($empleados as $id=>$name)
                  <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
              </select>
              @error('empleado_id')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            {{-- Indicador --}}
            <div class="col-md-6">
              <label class="form-label">Indicador</label>
              <input type="text" name="indicador"
                     class="form-control @error('indicador') is-invalid @enderror"
                     required>
              @error('indicador')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            {{-- Valor --}}
            <div class="col-md-6">
              <label class="form-label">Valor</label>
              <input type="number" step="0.01" name="valor"
                     class="form-control @error('valor') is-invalid @enderror"
                     required>
              @error('valor')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            {{-- Fecha --}}
            <div class="col-md-6">
              <label class="form-label">Fecha</label>
              <input type="date" name="fecha"
                     class="form-control @error('fecha') is-invalid @enderror"
                     required>
              @error('fecha')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary"
                  data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
