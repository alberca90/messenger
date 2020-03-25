<template>
  <div class="container py-4 h-100">
    <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" :value="csrfToken">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" :value="user.email" />
        </div>
        <div class="form-group col-md-6">
          <label for="name">Nombre</label>
          <input type="text" name="name" class="form-control" :value="user.name" />
        </div>
        <div class="form-group col-md-6">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Password" />
        </div>
        <div class="form-group col-md-6">
          <label for="image">Seleccione su imagen de perfil</label>
           <img
            :src="image"
            class="rounded-circle img-fluid"
            alt="Imagen actutal"
          />
          <input type="file" name="image" class="form-control-file">
         
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
  </div>
</template>

<script>
export default {
  props:{
    user: Object,
    csrfToken: String
  },
  computed:{
    image(){
      return `/users/${this.user.image}`;
    }
  }
};
</script>

