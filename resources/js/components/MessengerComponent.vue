<template>
  <div class="container-fluid py-4 h-100">
    <div class="row h-100">
      <div class="col-4">
        <contacts-list-component
          v-on:conversationSelected="changeActiveConversation($event)"
          :conversations="conversations"
        ></contacts-list-component>
      </div>
      <div class="col-8 h-100">
        <active-conversation-component
          v-if="selectedConversation"
          :contact-id="selectedConversation.contact_id"
          :contact-name="selectedConversation.contact.name"
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
    userId: Number
  },
  data() {
    return {
      selectedConversation: null,
      messages: [],
      conversations: []
    };
  },
  mounted() {
    this.getConversations();
    Echo.private("users." + this.userId).listen("MessageSend", data => {
      //console.log('recibo evento');
      const message = data.message;
      message.written_by_me = false;
      this.addMessage(message);
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
      const conversation = this.conversations.find(function(conversation){
        return conversation.contact_id == message.from_id ||
        conversation.contact_id == message.to_id
      });

      //Vemos si hemos enviado nosotros el mensaje o viene de otro contacto
      const author = this.userId === message.from_id ? 'Tú' : conversation.contact.name;

      conversation.last_message = author+': '+message.content;
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
  }
};
</script>