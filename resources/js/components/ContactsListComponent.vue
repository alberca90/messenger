<template>
    <div class="list-group">
      <contact-component
        v-for="conversation in conversations"
        :key="conversation.id"
        :conversation="conversation"
        :selected="selectedConversationId === conversation.id"
        @click.native="selectConversation(conversation)"
      ></contact-component>
    </div>

</template>

<script>
export default {
  props:{
    conversations: Array
  },
  data() {
    return {
      selectedConversationId: null
    };
  },
  mounted() {
    
  },
  methods: {
    selectConversation(conversation){
      this.selectedConversationId = conversation.id;
      this.$emit('conversationSelected', conversation);
    }
  }
};
</script>
