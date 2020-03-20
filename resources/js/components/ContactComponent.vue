<template>
  <div class="list-group-item list-group-item-action">
    <a href="#">
      <div class="row p-2">
        <div class="col-3">
          <img
            src="https://picsum.photos/id/237/60/60"
            class="rounded-circle img-fluid"
            alt="usuario 1"
          />
        </div>
        <div class="col-6 align-self-center">
          <p class="mb-1">{{conversation.contact.name}}</p>
          <p class="text-muted small mb-1">{{conversation.last_message}}</p>
        </div>
        <div class="col-3">
          <p class="text-muted small">{{ lastTime }}</p>
        </div>
      </div>
    </a>
  </div>
</template>

<script>
export default {
  props: {
    conversation: Object
  },
  data() {
    return{}
  },
  mounted() {},
  computed:{
    lastTime(){
      return moment(this.conversation.last_time, "YYYYMMDD h:mm:ss").locale('es').fromNow();
    }
  }
};
</script>
