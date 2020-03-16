<template>
  <div>
    <div class="row h-100">
      <div class="col-8">
        <div class="card h-100">
          <div class="card-header">Conversación Activa</div>
          <div class="card-body">
            <div class="card-text">
              <message-conversation-component
                :class="{'media-right': message.written_by_me}"
                v-for="message in messages"
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
          src="https://picsum.photos/id/237/60/60"
          class="rounded-circle img-fluid m-1"
          alt="usuario 1"
        />
        <p>{{contactName}}</p>
        <hr />
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value id="desactivarNoti" />
          <label class="form-check-label" for="desactivarNoti">Desactivar notificaciones</label>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    contactId: Number,
    contactName: String,
    messages: Array
  },
  data() {
    return {
      newMessage: ""
    };
  },
  mounted() {
  },
  methods: {
    postMessage() {
      const params = {
        to_id: this.contactId,
        content: this.newMessage
      };

      axios.post("/api/messages", params).then(response => {
        //console.log(response.data);
        this.newMessage = "";
        //this.getMessages();
      });
    }
  }
  // watch: {
  //   contactId(value){
  //     //console.log('ContactId =' +value)
  //     this.getMessages(value);
  //   }
  // }
};
</script>
