<template>
  <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="title"><i class="fa fa-file-text-o"></i> Autenticação <small>Informe suas credenciais</small></h5>

              <form @submit.prevent="auth()">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Email..." v-model="user.email">
                </div>
                <div class="form-group">
                  <label for="password">Senha</label>
                  <input type="password" class="form-control" id="password" placeholder="Sua senha" v-model="user.password">
                </div>
                <button type="submit" class="btn btn-primary">Acessar</button>
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  data() {
      return {
          user: {}
      }
  },
  methods: {
      auth() {
          let config = {
              swalTitle: 'Autenticado com sucesso',
              swalMessage: 'Você acessou com sucesso'
          }
          let qs = require('qs');
          let data = qs.stringify(this.user);

          window.axios.post('/auth/token', data, config).then((res) => {
              window.axios.defaults.headers.common['Authorization'] = res.data.token;
              window.localStorage.setItem('token', res.data.token);
              this.$router.push({path: '/'});
          });
      }
  }
}
</script>

