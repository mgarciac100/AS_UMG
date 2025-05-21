<div class="modal fade" id="altaPrestacionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="formCrearPrestacion"
            method="POST"
            action="{{ route('administracion.prestaciones.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Nueva Prestación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            {{-- Empleado --}}
            <div class="col-md-6">
              <label class="form-label">Empleado</label>
              <select name="empleado"
                      class="form-select @error('empleado') is-invalid @enderror"
                      required>
                <option value="">-- Seleccione --</option>
                @foreach($empleadosList as $id => $name)
                  <option value="{{ $id }}" {{ old('empleado')==$id?'selected':'' }}>
                    {{ $name }}
                  </option>
                @endforeach
              </select>
              @error('empleado')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            {{-- Tipo --}}
            <div class="col-md-6">
              <label class="form-label">Tipo</label>
              <select name="tipo"
                      class="form-select @error('tipo') is-invalid @enderror"
                      required>
                <option value="">-- Seleccione --</option>
                @foreach($tipos as $k=>$v)
                  <option value="{{ $k }}" {{ old('tipo')==$k?'selected':'' }}>
                    {{ $v }}
                  </option>
                @endforeach
              </select>
              @error('tipo')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            {{-- Monto --}}
            <div class="col-md-6">
              <label class="form-label">Monto</label>
              <input type="number"
                     name="monto"
                     step="0.01"
                     value="{{ old('monto') }}"
                     class="form-control @error('monto') is-invalid @enderror"
                     required>
              @error('monto')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            {{-- Fecha --}}
            <div class="col-md-6">
              <label class="form-label">Fecha</label>
              <input type="date"
                     name="fecha"
                     value="{{ old('fecha') }}"
                     class="form-control @error('fecha') is-invalid @enderror"
                     required>
              @error('fecha')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
