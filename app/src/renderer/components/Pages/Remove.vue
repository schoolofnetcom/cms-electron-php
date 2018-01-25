<template>
  <div class="container-fluid">
      <div class="row">
        <div class="col-1 nav">
          <p class="display-6">
            <small>AÇÕES</small>
          </p>

          <a :href="'#/pages/' + page.id" class="btn btn-secondary" title="Voltar">
            <i class="fa fa-arrow-circle-left"></i>
          </a>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="title"><i class="fa fa-file-text-o"></i> {{ page.title }} <small>Remoção de página do site</small></h5>

              <div class="alert alert-danger">
                Tem certeza que quer remover esta página, essa ação não poderá ser desfeita!
              </div>

            </div>
            <div class="card-footer">
              <a :href="'#/pages/' + page.id" class="btn btn-secondary">Não remover</a>
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
      this.$store.dispatch('removePage', this.page.id)
        .then(() => {
          this.$router.push({path: '/pages'});
        })
    }
  },
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
