<template>
  <div class="container-fluid">
      <div class="row">
        <div class="col-1 nav">
          <p class="display-6">
            <small>AÇÕES</small>
          </p>

          <a href="#/users" class="btn btn-secondary" title="Voltar">
            <i class="fa fa-arrow-circle-left"></i>
          </a>
        </div>
        <div class="col-11">
          <div class="card">
            <div class="card-body">
              <h5 class="title"><i class="fa fa-file-text-o"></i> {{ user.name }} <small>Visualização de usuário</small></h5>

              <div v-html="user.email"></div>

            </div>
            <div class="card-footer">
              <a :href="'#/users/edit/' + user.id" class="btn btn-primary">Editar</a>
              <a :href="'#/users/remove/' + user.id" class="btn btn-danger">Remover</a>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  computed: {
    user() {
      return this.$store.state.Users.oneUser
    }
  },
  mounted () {
    this.$store.dispatch('getUser', this.$route.params.id)
  }
}
</script>
