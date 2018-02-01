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
              <h5 class="title"><i class="fa fa-file-text-o"></i> {{ user.name }} <small>Edição de usuário do blog</small></h5>

              <form @submit.prevent="save()">
                <div class="form-group">
                  <label for="name">Nome</label>
                  <input type="text" class="form-control" id="name" placeholder="nome do usuário" v-model="user.name">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Email para autenticação" v-model="user.email">
                </div>
                <div class="form-group">
                  <label for="password">Senha</label>
                  <input type="password" class="form-control" id="password" placeholder="Uma senha segura, informe apenas se for alterar." v-model="user.password">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
              </form>

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
  methods: {
    save() {
      this.$store.dispatch('updateUser', this.user)
        .then((res) => {
          this.$router.push({path: '/users/' + this.user.id})
        })
    }
  }
}
</script>
