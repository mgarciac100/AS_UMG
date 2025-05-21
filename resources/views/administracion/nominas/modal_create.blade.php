<!-- Modal: Alta de Nómina -->
<div class="modal fade" id="altaNominaModal" tabindex="-1" aria-labelledby="altaNominaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="formCrearNomina"
            method="POST"
            action="{{ route('administracion.nominas.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="altaNominaLabel">Nueva Nómina</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <!-- Empleado -->
            <div class="col-md-6">
              <label for="empleado" class="form-label">Empleado</label>
              <select id="empleado"
                      name="empleado"
                      class="form-select @error('empleado') is-invalid @enderror"
                      required>
                <option value="">-- Seleccione un empleado --</option>
                @foreach($empleados as $id => $nombre)
                  <option value="{{ $id }}"
                    {{ old('empleado') == $id ? 'selected' : '' }}>
                    {{ $nombre }}
                  </option>
                @endforeach
              </select>
              @error('empleado')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Periodo -->
            <div class="col-md-6">
              <label for="periodo" class="form-label">Periodo</label>
              <select id="periodo"
                      name="periodo"
                      class="form-select @error('periodo') is-invalid @enderror"
                      required>
                <option value="">-- Seleccione un periodo --</option>
                @foreach($periodos as $key => $label)
                  <option value="{{ $key }}"
                    {{ old('periodo') == $key ? 'selected' : '' }}>
                    {{ $label }}
                  </option>
                @endforeach
              </select>
              @error('periodo')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Fecha Inicio -->
            <div class="col-md-6">
              <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
              <input type="date"
                     id="fecha_inicio"
                     name="fecha_inicio"
                     value="{{ old('fecha_inicio') }}"
                     class="form-control @error('fecha_inicio') is-invalid @enderror"
                     required>
              @error('fecha_inicio')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Fecha Fin -->
            <div class="col-md-6">
              <label for="fecha_fin" class="form-label">Fecha de fin</label>
              <input type="date"
                     id="fecha_fin"
                     name="fecha_fin"
                     value="{{ old('fecha_fin') }}"
                     class="form-control @error('fecha_fin') is-invalid @enderror"
                     required>
              @error('fecha_fin')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Salario Bruto -->
            <div class="col-md-4">
              <label for="bruto" class="form-label">Salario bruto</label>
              <input type="number"
                     step="0.01"
                     id="bruto"
                     name="bruto"
                     value="{{ old('bruto') }}"
                     class="form-control @error('bruto') is-invalid @enderror"
                     required>
              @error('bruto')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Deducciones -->
            <div class="col-md-4">
              <label for="deducciones" class="form-label">Deducciones</label>
              <input type="number"
                     step="0.01"
                     id="deducciones"
                     name="deducciones"
                     value="{{ old('deducciones') }}"
                     class="form-control @error('deducciones') is-invalid @enderror"
                     required>
              @error('deducciones')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Salario Neto (readonly) -->
            <div class="col-md-4">
              <label class="form-label">Salario neto</label>
              <input type="text"
                     class="form-control"
                     value="Se calculará automáticamente"
                     readonly>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"
                  class="btn btn-outline-secondary"
                  data-bs-dismiss="modal">Cancelar</button>
          <button type="submit"
                  class="btn btn-primary">Guardar Nómina</button>
        </div>
      </form>
    </div>
  </div>
</div>
