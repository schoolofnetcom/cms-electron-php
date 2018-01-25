<template>
  <div class="container-fluid">
      <div class="row">
        <div class="col-1 nav">
          <p class="display-6">
            <small>AÇÕES</small>
          </p>

          <a href="#/pages" class="btn btn-secondary" title="Voltar">
            <i class="fa fa-arrow-circle-left"></i>
          </a>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="title"><i class="fa fa-file-text-o"></i> {{ page.title }} <small>Visualização de página do site</small></h5>

              <div v-html="page.body"></div>

            </div>
            <div class="card-footer">
              <a :href="'#/pages/edit/' + page.id" class="btn btn-primary">Editar</a>
              <a :href="'#/pages/remove/' + page.id" class="btn btn-danger">Remover</a>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  computed: {
    page() {
      return this.$store.state.Pages.onePage
    }
  },
  mounted () {
    this.$store.dispatch('getPage', this.$route.params.id)
  }
}
</script>
