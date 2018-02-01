<template>
  <div class="container-fluid">
      <div class="row">
        <div class="col-1 nav">
          <p class="display-6">
            <small>AÇÕES</small>
          </p>

          <a :href="'#/users/' + user.id" class="btn btn-secondary" title="Voltar">
            <i class="fa fa-arrow-circle-left"></i>
          </a>
        </div>
        <div class="col-11">
          <div class="card">
            <div class="card-body">
              <h5 class="title"><i class="fa fa-file-text-o"></i> {{ user.title }} <small>Remoção de usuário</small></h5>

              <div class="alert alert-danger">
                Tem certeza que quer remover este usuário, essa ação não poderá ser desfeita!
              </div>

            </div>
            <div class="card-footer">
              <a :href="'#/users/' + user.id" class="btn btn-secondary">Não remover</a>
              <a href="" class="btn btn-primary" @click.prevent="remove()">Apagar definitivamente</a>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  methods: {
    remove() {
      this.$store.dispatch('removeUser', this.user.id)
        .then(() => {
          this.$router.push({path: '/users'});
        })
    }
  },
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
