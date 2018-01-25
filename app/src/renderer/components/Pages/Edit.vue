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
              <h5 class="title"><i class="fa fa-file-text-o"></i> {{ page.title }} <small>Edição de página do site</small></h5>

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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
  data() {
    return {
      editor: null
    }
  },
  computed: {
    page() {
      return this.$store.state.Pages.onePage
    }
  },
  methods: {
    save() {
      this.page.body = this.editor.getData();
      this.$store.dispatch('updatePage', this.page)
        .then((res) => {
          this.$router.push({path: '/pages/' + this.page.id})
        })
    }
  },
  mounted () {

    ClassicEditor
      .create(document.querySelector('#body'))
      .then(editor => {
        this.editor = editor;

        this.$store.dispatch('getPage', this.$route.params.id).then((res) => {
          console.log(res)
          this.editor.setData(this.page.body);
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

