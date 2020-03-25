<template>

    <div class="media mb-2">
      <img
        :src="image"
        width="48"
        height="48"
        class="rounded-circle img-fluid"
        alt="usuario 1"
      />
      <div class="media-body m-1">
        <div class="card p-1">
            <slot></slot>
        </div>
      </div>
    </div>

</template>

<script>
export default {
  props: {
    image: String
  },
  data() {
    return {};
  }
};
</script>

