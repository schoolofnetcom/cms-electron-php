<template>
  <div class="container-fluid">
      <div class="row">
        <div class="col-1 nav">
          <p class="display-6">
            <small>AÇÕES</small>
          </p>

          <a :href="'#/posts/' + post.id" class="btn btn-secondary" title="Voltar">
            <i class="fa fa-arrow-circle-left"></i>
          </a>
        </div>
        <div class="col-11">
          <div class="card">
            <div class="card-body">
              <h5 class="title"><i class="fa fa-file-text-o"></i> {{ post.title }} <small>Edição de artigo do blog</small></h5>

              <form @submit.prevent="save()">
                <div class="form-group">
                  <label for="title">Título</label>
                  <input type="text" class="form-control" id="title" placeholder="Título da página" v-model="post.title">
                </div>
                <div class="form-group">
                  <label for="slug">URL</label>
                  <input type="text" class="form-control" id="slug" placeholder="Url da página" v-model="post.slug">
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
      editor: null
    }
  },
  computed: {
    post() {
      return this.$store.state.Posts.onePost
    }
  },
  methods: {
    save() {
      this.post.body = this.editor.getData();
      this.$store.dispatch('updatePost', this.post)
        .then((res) => {
          this.$router.push({path: '/posts/' + this.post.id})
        })
    }
  },
  mounted () {

    ClassicEditor
      .create(document.querySelector('#body'))
      .then(editor => {
        this.editor = editor;

        this.$store.dispatch('getPost', this.$route.params.id).then((res) => {
          console.log(res)
          this.editor.setData(this.post.body);
        })
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

