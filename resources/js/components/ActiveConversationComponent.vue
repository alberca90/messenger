<template>
  <div>
    <div class="row h-100">
      <div class="col-8">
        <div class="card h-100">
          <div class="card-header">Conversación Activa</div>
          <div id="messages-container" class="card-body">
            <div class="card-text">
              <message-conversation-component
                :class="{'media-right': message.written_by_me}"
                v-for="message in messages"
                :image="message.written_by_me ? myImageProfile : imageProfile"
                :key="message.id"
              >{{ message.content }}</message-conversation-component>
            </div>
          </div>
          <div class="card-footer">
            <form @submit.prevent="postMessage" autocomplete="off">
              <div class="input-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Escribe un mensaje....."
                  v-model="newMessage"
                />
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit">Enviar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-4">
        <img
          :src="imageProfile"
          class="rounded-circle img-fluid m-1"
          alt="usuario 1"
        />
        <p>{{selectedConversation.contact.name}}</p>
        <hr />
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value id="desactivarNoti" />
          <label class="form-check-label" for="desactivarNoti">Desactivar notificaciones</label>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
#messages-container {
  max-height: calc(100vh - 77px);
  overflow-y: auto;
}
</style>
<script>
export default {
  data() {
    return {
      newMessage: ""
    };
  },
  mounted() {},
  methods: {
    postMessage() {
      this.$store.dispatch('postMessage', this.newMessage);
    },
    scrollToBottom() {
      const el = document.querySelector("#messages-container");
      el.scrollTop = el.scrollHeight;
    }
  },
  updated(){
    this.scrollToBottom();
  },
  computed:{
    imageProfile(){
      return `/users/`+this.$store.state.selectedConversation.contact.image;
    },
    myImageProfile(){
      return `/users/`+this.$store.state.user.image;
    },
    messages(){
      return this.$store.state.messages;
    },
    selectedConversation(){
      return this.$store.state.selectedConversation;
    }
  }
};
</script>
