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
              <h5 class="title"><i class="fa fa-file-text-o"></i> Novo artigo <small>Inclusão de novo artigo no blog</small></h5>

              <form @submit.prevent="save()">
                <div class="form-group">
                  <label for="title">Título</label>
                  <input type="text" class="form-control" id="title" placeholder="Título do artigo" v-model="post.title">
                </div>
                <div class="form-group">
                  <label for="slug">URL</label>
                  <input type="text" class="form-control" id="slug" placeholder="Url do artigo" v-model="post.slug">
                </div>
                <div class="form-group">
                  <label for="body">Conteúdo</label>
                  <textarea class="form-control" id="body" rows="3" v-model="post.body"></textarea>
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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


export default {
  data() {
    return {
      post: {},
      editor: null
    }
  },
  methods: {
    save() {
      this.post.body = this.editor.getData();
      this.$store.dispatch('createPost', this.post)
        .then((res) => {
          this.$router.push({path: '/posts'})
        })
    }
  },
  mounted () {
    ClassicEditor
      .create(document.querySelector('#body'))
      .then(editor => {
        this.editor = editor;
      })
      .catch(err => {
        console.error(err.stack);
      })
  }
}
</script>

<style>
  .ck-editor__editable {
    min-height: 260px;
  }
</style>

