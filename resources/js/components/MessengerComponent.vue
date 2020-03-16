<template>
  <div class="container-fluid py-4 h-100">
    <div class="row h-100">
      <div class="col-4">
        <contacts-list-component v-on:conversationSelected="changeActiveConversation($event)"></contacts-list-component>
      </div>
      <div class="col-8 h-100">
        <active-conversation-component v-if="selectedConversation" :contact-id="selectedConversation.contact_id" :contact-name="selectedConversation.contact.name"></active-conversation-component>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    
  },
  data() {
    return{
      selectedConversation: null
    }
  },
  methods:{
    changeActiveConversation(conversation){
      //console.log('Nueva conversacion seleccionada', conversation);
      this.selectedConversation = conversation;
    }
  },
  mounted() {}
};
</script>