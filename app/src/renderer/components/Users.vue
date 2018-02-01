<template>
  <div class="container-fluid">
      <div class="row">
        <div class="col-1 nav">
          <p class="display-6">
            <small>AÇÕES</small>
          </p>

          <a href="#/users/add" class="btn btn-secondary" title="Novo usuário">
            <i class="fa fa-plus"></i>
          </a>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="title"><i class="fa fa-file-text-o"></i> Usuários <small>Gerenciamento de usuários</small></h5>

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users">
                    <th scope="row">{{ user.id }}</th>
                    <td>{{ user.name }}</td>
                    <td>
                      <div>{{ user.email }}</div>
                    </td>
                    <td class="text-right">
                      <a :href="'#/users/' + user.id" class="btn btn-primary btn-sm">ver</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  computed: {
    users() {
      return this.$store.state.Users.all
    }
  },
  mounted() {
    this.$store.dispatch('listUsers')
  }
}
</script>
