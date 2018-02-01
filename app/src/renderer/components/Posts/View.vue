<template>
  <div class="container-fluid">
      <div class="row">
        <div class="col-1 nav">
          <p class="display-6">
            <small>AÇÕES</small>
          </p>

          <a href="#/posts" class="btn btn-secondary" title="Voltar">
            <i class="fa fa-arrow-circle-left"></i>
          </a>
        </div>
        <div class="col-11">
          <div class="card">
            <div class="card-body">
              <h5 class="title"><i class="fa fa-file-text-o"></i> {{ post.title }} <small>Visualização de artigo do blog</small></h5>

              <div v-html="post.body"></div>

            </div>
            <div class="card-footer">
              <a :href="'#/posts/edit/' + post.id" class="btn btn-primary">Editar</a>
              <a :href="'#/posts/remove/' + post.id" class="btn btn-danger">Remover</a>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  computed: {
    post() {
      return this.$store.state.Posts.onePost
    }
  },
  mounted () {
    this.$store.dispatch('getPost', this.$route.params.id)
  }
}
</script>
