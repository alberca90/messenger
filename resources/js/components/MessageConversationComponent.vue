<template>

    <div class="media mb-2">
      <img
        src="https://picsum.photos/id/237/60/60"
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
    // props: ['written-by-me'],
  data() {
    return {};
  }
};
</script>

