<template>
  <div>
    <div class="input-group mb-3">
      <input
        type="text"
        class="form-control"
        placeholder="Buscar contacto..."
        aria-label="contacto"
      />
    </div>

    <div class="list-group">
      <contact-component class="list-group-item-info"></contact-component>
      <contact-component></contact-component>
      <contact-component class="list-group-item-success"></contact-component>
    </div>
  </div>
</template>

<script>
export default {};
</script>
