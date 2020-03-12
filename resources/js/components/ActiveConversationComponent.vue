<template>
  <div>
    <div class="row h-100">
      <div class="col-8">
        <div class="card h-100">
          <div class="card-header">Conversación Activa</div>
          <div class="card-body">
            <div class="card-text">
              <div class="media mb-2">
                <img
                  src="https://picsum.photos/id/237/60/60"
                  class="rounded-circle img-fluid"
                  alt="usuario 1"
                />
                <div class="media-body m-1">
                  <div class="card p-1">gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</div>
                </div>
              </div>
              <div class="media mb-2">
                
                <div class="media-body m-1">
                  <div class="card p-1">Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. fringilla. Donec lacinia congue felis in faucibus.</div>
                </div>
                <img
                  src="https://picsum.photos/id/237/60/60"
                  class="rounded-circle img-fluid"
                  alt="usuario 1"
                />
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="input-group">
              <input
                type="text"
                class="form-control"
                placeholder="Escribe un mensaje....."
                aria-label="Mensaje"
              />
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Enviar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <img
          src="https://picsum.photos/id/237/60/60"
          class="rounded-circle img-fluid m-1"
          alt="usuario 1"
        />
        <p>Usuario seleccionado</p>
        <hr />
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value id="desactivarNoti" />
          <label class="form-check-label" for="desactivarNoti">Desactivar notificaciones</label>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  }
};
</script>
