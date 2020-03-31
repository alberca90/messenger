<template>
  <div class="container-fluid py-4 h-100">
    <div class="row h-100">
      <div class="col-4">
        <contacts-form-component />
        <contacts-list-component />
      </div>
      <div class="col-8 h-100">
        <active-conversation-component v-if="selectedConversation"></active-conversation-component>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    user: Object
  },
  mounted() {
    //this.getConversations();
    this.$store.commit("setUser", this.user);
    this.$store.dispatch("getConversations").then(() => {
      // Si ponemos directamente una ruta en el navegador, no se ejecuta el botón de seleccionar conversación, por lo que lo cargamos aquí
      const conversationId = this.$route.params.conversationId;
      if (conversationId) {
        const conversation = this.$store.getters.getConversationById(
          conversationId
        );
        this.$store.dispatch("getMessages", conversation);
      }
    });

    //Canal propio de cada usuario
    Echo.private("users." + this.user.id).listen("MessageSend", data => {
      //console.log('recibo evento');
      const message = data.message;
      message.written_by_me = false;
      this.addMessage(message);
    });

    //canal general para ver si alguien está conectado
    Echo.join("messenger")
      .here(users => {
        users.forEach(user => this.changeStatus(user, true));
      })
      .joining(user => {
        this.changeStatus(user, true);
      })
      .leaving(user => {
        this.changeStatus(user, false);
      });
  },
  methods: {
    changeStatus(user, status) {
      const index = this.$store.state.conversations.findIndex(conversation => {
        return conversation.contact_id == user.id;
      });
      if (index >= 0)
        this.$set(this.$store.state.conversations[index], "online", status);
    },
    addMessage(message){
      this.$store.commit('addMessage', message);
    }
  },
  computed: {
    selectedConversation() {
      return this.$store.state.selectedConversation;
    }
  }
};
</script>