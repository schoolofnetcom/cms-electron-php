const state = {
  all: [],
  onePost: {}
}

const mutations = {
  updatePostsList (state, res) {
    state.all = res.data
  },
  updatePost (state, res) {
    state.onePost = res.data
  },
  addToPostsList(state, res) {
    state.all.push(res.data)
  }
}

const actions = {
  listPosts(context) {
    window.axios.get('/api/v1/posts').then((res) => {
      context.commit('updatePostsList', res)
    })
  },
  getPost(context, id) {
    return window.axios.get('/api/v1/posts/' + id).then((res) => {
      context.commit('updatePost', res)
    })
  },
  createPost(context, data) {
    let qs = require('qs');
    data = qs.stringify(data);

    let config = {
      swalTitle: 'Artigo salvo com sucesso',
      swalMessage: 'Seu novo artigo já está disponível'
    }

    return window.axios.post('/api/v1/posts', data, config).then((res) => {
      context.commit('addToPostsList', res)
      return res;
    })
  },
  updatePost(context, data) {
    let qs = require('qs');
    let id = data.id;
    data = qs.stringify(data);

    let config = {
      swalTitle: 'Artigo salvo com sucesso',
      swalMessage: 'Sua alteração foi publicada'
    }

    return window.axios.put('/api/v1/posts/' + id, data, config).then((res) => {
      return res;
    })
  },
  removePost(context, id) {
    return window.axios.delete('/api/v1/posts/' + id).then((res) => {
      return res;
    })
  }

}

export default {
  state,
  mutations,
  actions
}
