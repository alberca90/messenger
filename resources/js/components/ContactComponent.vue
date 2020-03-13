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
          <p class="mb-1">{{name}}</p>
          <p class="text-muted small mb-1">{{lastMessage}}</p>
        </div>
        <div class="col-3">
          <p class="text-muted small">{{lastTime}}</p>
        </div>
      </div>
    </a>
  </div>
</template>

<script>
export default {
    data(){
        return{
            name: "Álvaro Alberca",
            lastMessage: "Tú: Nos vemos!!",
            lastTime: "1:37 PM"
        }
    },
    mounted() {
        
    }
};
</script>
