<div class="modal fade" id="altaColaboradorModal" tabindex="-1" aria-labelledby="altaColaboradorLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" action="{{ route('administracion.empleados.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="altaColaboradorLabel">Alta de Colaborador</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          {{-- Datos de Usuario --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Nombre de usuario</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Correo electrónico</label>
              <input type="email" name="email" class="form-control" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Contraseña</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Confirmar contraseña</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>
          </div>

          <hr>

          {{-- Datos de Empleado --}}
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
                <option value="" disabled selected>-- Seleccione un puesto --</option>
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
            <input class="form-check-input" type="checkbox" name="estado" value="1" id="estadoActivo" checked>
            <label class="form-check-label" for="estadoActivo">
              Activo
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Colaborador</button>
        </div>
      </form>
    </div>
  </div>
</div>
