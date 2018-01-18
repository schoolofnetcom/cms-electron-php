<template>
  <div class="container-fluid">
      <div class="row">
        <div class="col-1">
          <a href="#/pages" class="btn btn-secondary" title="Voltar">
            <i class="fa fa-arrow-circle-left"></i>
          </a>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="title"><i class="fa fa-file-text-o"></i> Nova página <small>Inclusão de nova página no site</small></h5>

              <form @submit.prevent="save()">
                <div class="form-group">
                  <label for="title">Título</label>
                  <input type="text" class="form-control" id="title" placeholder="Título da página" v-model="page.title">
                </div>
                <div class="form-group">
                  <label for="slug">URL</label>
                  <input type="text" class="form-control" id="slug" placeholder="Url da página" v-model="page.slug">
                </div>
                <div class="form-group">
                  <label for="body">Conteúdo</label>
                  <textarea class="form-control" id="body" rows="3" v-model="page.body"></textarea>
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
import swal from 'sweetalert2'

export default {
  data() {
    return {
      page: {}
    }
  },
  methods: {
    save() {
      this.$store.dispatch('createPage', this.page)
        .then((res) => {
          swal({
            title: 'Salvo com sucesso',
            text: 'Sua nova página já está disponível',
            type: 'success',
            confirmButtonText: 'Ok!'
          })
          this.$router.push({path: '/pages'})
        })
        .catch((err) => {
          let title = 'Algo deu errado'
          let text = 'Uma situação inesperada ocorreu no servidor, por favor, entre em contato com o administrador'

          if (err.response && err.response.status == 422) {
            title = 'Verifique os dados'
            text = 'O servidor recusou os dados informado, confira as informações'
          }

          swal({
            title: title,
            text: text,
            type: 'error',
            confirmButtonText: 'Eu entendo'
          })
        })
    }
  }
}
</script>

