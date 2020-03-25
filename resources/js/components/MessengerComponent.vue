<template>
  <div class="container-fluid py-4 h-100">
    <div class="row h-100">
      <div class="col-4">
        <div class="input-group mb-3">
          <input
            type="text"
            v-model="querySearch"
            class="form-control"
            placeholder="Buscar contacto..."
            aria-label="contacto"
          />
        </div>
        <contacts-list-component
          v-on:conversationSelected="changeActiveConversation($event)"
          :conversations="conversationsFiltered"
        ></contacts-list-component>
      </div>
      <div class="col-8 h-100">
        <active-conversation-component
          v-if="selectedConversation"
          :contact-id="selectedConversation.contact_id"
          :contact-name="selectedConversation.contact.name"
          :contact-image="selectedConversation.contact.image"
          :my-image="user.image"
          :messages="messages"
          @messageCreated="addMessage($event)"
        ></active-conversation-component>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    user: Object
  },
  data() {
    return {
      selectedConversation: null,
      messages: [],
      conversations: [],
      querySearch: ''
    };
  },
  mounted() {
    this.getConversations();
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
    changeActiveConversation(conversation) {
      this.selectedConversation = conversation;
      this.getMessages();
    },
    getMessages() {
      axios
        .get("/api/messages?contact_id=" + this.selectedConversation.contact_id)
        .then(response => {
          //console.log(response.data);
          this.messages = response.data;
        });
    },
    addMessage(message) {
      //Buscamos una conversation concreta en el array de conversations
      const conversation = this.conversations.find(function(conversation) {
        return (
          conversation.contact_id == message.from_id ||
          conversation.contact_id == message.to_id
        );
      });

      //Vemos si hemos enviado nosotros el mensaje o viene de otro contacto
      const author =
        this.user.id === message.from_id ? "Tú" : conversation.contact.name;

      conversation.last_message = author + ": " + message.content;
      conversation.last_time = message.to_id;

      if (
        this.selectedConversation.contact_id == message.from_id ||
        this.selectedConversation.contact_id == message.to_id
      ) {
        this.messages.push(message);
      }
    },
    getConversations() {
      axios.get("/api/conversations").then(response => {
        this.conversations = response.data;
      });
    },
    changeStatus(user, status) {
      const index = this.conversations.findIndex(conversation => {
        return conversation.contact_id == user.id;
      });
      if(index >= 0) this.$set(this.conversations[index], "online", status);
    }
  },
  computed:{
    conversationsFiltered(){
      return this.conversations.filter(
        (conversation) => conversation.contact.name.toLowerCase().includes(this.querySearch.toLowerCase())
      );
    }
  }
};
</script>