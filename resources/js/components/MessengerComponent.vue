<template>
  <div class="container-fluid py-4 h-100">
    <div class="row h-100">
      <div class="col-4">
        <contacts-list-component v-on:conversationSelected="changeActiveConversation($event)"></contacts-list-component>
      </div>
      <div class="col-8 h-100">
        <active-conversation-component v-if="selectedConversation" 
        :contact-id="selectedConversation.contact_id" 
        :contact-name="selectedConversation.contact.name"
        :messages="messages">
        
        </active-conversation-component>
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
    return{
      selectedConversation: null,
      messages: []
    }
  },
  mounted() {
    Echo.channel('example')
    .listen('MessageSend', (data) => {
      const message = data.message;
      message.written_by_me = (this.userId == message.from_id);
      this.messages.push(message);
    });
  },
  methods:{
    changeActiveConversation(conversation){
      this.selectedConversation = conversation;
      this.getMessages();
    },
    getMessages() {
      axios.get("/api/messages?contact_id=" + this.selectedConversation.contact_id).then(response => {
        //console.log(response.data);
        this.messages = response.data;
      });
    },
  }
  
};
</script>