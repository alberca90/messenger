<template>
  <div>
    <div class="input-group mb-3">
      <input
        type="text"
        class="form-control"
        placeholder="Buscar contacto..."
        aria-label="contacto"
      />
    </div>

    <div class="list-group">
      <contact-component
        v-for="conversation in conversations"
        :key="conversation.id"
        :conversation="conversation"
        @click.native="selectConversation(conversation)"
      ></contact-component>
      <!-- <contact-component class="list-group-item-info"></contact-component>    
      <contact-component class="list-group-item-success"></contact-component>-->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      conversations: [],
      newMessage: "",
      contactId: 2
    };
  },
  mounted() {
    this.getConversations();
  },
  methods: {
    getConversations() {
      axios.get("/api/conversations").then(response => {
        this.conversations = response.data;
      });
    },
    selectConversation(conversation){
      //console.log(conversation);
      this.$emit('conversationSelected', conversation)
    }
  }
};
</script>
