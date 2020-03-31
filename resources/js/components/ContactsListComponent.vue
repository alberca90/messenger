<template>
  <div class="list-group">
    <contact-component
      v-for="conversation in conversationsFiltered"
      :key="conversation.id"
      :conversation="conversation"
      :selected="isSelected(conversation)"
      @click.native="selectConversation(conversation)"
    ></contact-component>
  </div>
</template>

<script>
export default {
  methods: {
    selectConversation(conversation) {
      this.$router.push("/chat/" + conversation.id, () => {
        this.$store.dispatch("getMessages", conversation);
      });
    },
    isSelected(conversation) {
      if (this.$store.state.selectedConversation)
        return this.$store.state.selectedConversation.id === conversation.id;

      return false;
    }
  },
  computed: {
    selectedConversation() {
      return this.$store.state.selectConversation;
    },
    conversationsFiltered() {
      return this.$store.getters.conversationsFiltered;
    }
  }
};
</script>
