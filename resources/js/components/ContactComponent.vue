<template>
  <!-- <div class="list-group-item list-group-item-action"> -->
  <div :class="[selected ? 'bg-primary' : '', 'list-group-item list-group-item-action']">
    <a href="#">
      <div class="row p-2">
        <div class="col-3">
          <img
            :src="imageProfile"
            class="rounded-circle img-fluid"
            alt="usuario 1"
          />
        </div>
        <div class="col-6 align-self-center">
          <p class="mb-1 text-white bg-success">
          <p :class="[conversation.online ? 'bg-success' : 'bg-danger', 'mb-1 text-white']"> {{conversation.contact.name}}</p>
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
    conversation: Object,
    selected: Boolean
  },
  data() {
    return{}
  },
  mounted() {},
  computed:{
    lastTime(){
      return moment(this.conversation.last_time, "YYYYMMDD h:mm:ss").locale('es').fromNow();
    },
    imageProfile(){
      return `/users/`+this.conversation.contact.image;
    }
  }
};
</script>
