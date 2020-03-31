<template>
  <div class="input-group mb-3">
    <input
      type="text"
      v-model="querySearch"
      class="form-control"
      placeholder="Buscar contacto..."
      aria-label="contacto"
    />
  </div>
</template>

<script>
export default {
  computed: {
    querySearch:{
      get () {
        return this.$store.state.querySearch
      },
      set (value) {
        this.$store.commit('newQuerySearch', value)
      }
    }
  }
};
</script>
