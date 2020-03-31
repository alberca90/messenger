import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
      messages: [],
      selectedConversation: null,
      conversations: [],
      querySearch: '',
      user: null
  },
  mutations: {
      setUser(state, user) {
          state.user = user;
      },
      newMessagesList(state, messages) {
          state.messages = messages;
      },
      addMessage(state, message) {
          //Buscamos una conversation concreta en el array de conversations
          const conversation = state.conversations.find(function (conversation) {
              return (
                  conversation.contact_id == message.from_id ||
                  conversation.contact_id == message.to_id
              );
          });

          //Vemos si hemos enviado nosotros el mensaje o viene de otro contacto
          const author =
              state.user.id === message.from_id ? "Tú" : conversation.contact.name;

          conversation.last_message = author + ": " + message.content;
          conversation.last_time = message.to_id;

          if (
              state.selectedConversation.contact_id == message.from_id ||
              state.selectedConversation.contact_id == message.to_id
          ) {
              state.$store.commit('addMessage', message);
          }
          state.messages.push(message);
      },
      selectConversation(state, conversation) {
          state.selectedConversation = conversation;
      },
      newQuerySearch(state, newValue) {
          state.querySearch = newValue;
      },
      newConversationsList(state, contacts) {
          state.conversations = contacts;
      }
  },
  actions: {
      getMessages(context, conversation) {
          axios
              .get("/api/messages?contact_id=" + conversation.contact_id)
              .then(response => {
                  context.commit('newMessagesList', response.data);
                  context.commit('selectConversation', conversation);
              });
      },
      getConversations(context) {
          axios.get("/api/conversations").then(response => {
              context.commit('newConversationsList', response.data);
          });
      },
      postMessage(context, newMessage) {
          const params = {
              to_id: context.state.selectedConversation.contact_id,
              content: newMessage
          };

          axios.post("/api/messages", params)
              .then(response => {
                  newMessage = "";
                  const message = response.data.message;
                  message.written_by_me = true;
                  //alert(message.content);
                  context.commit('addMessage', message);
              });
      }
  },
  getters: {
      conversationsFiltered(state) {
          return state.conversations.filter(
              (conversation) => conversation.contact.name.toLowerCase().includes(state.querySearch.toLowerCase())
          );
      },
  }
});