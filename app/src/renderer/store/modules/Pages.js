const state = {
  all: [],
  onePage: {}
}

const mutations = {
  updatePagesList (state, res) {
    state.all = res.data
  },
  updatePage (state, res) {
    state.onePage = res.data
  },
  addToPagesList(state, res) {
    state.all.push(res.data)
  }
}

const actions = {
  listPages(context) {
    window.axios.get('http://localhost:8000/api/v1/pages').then((res) => {
      context.commit('updatePagesList', res)
    })
  },
  getPage(context, id) {
    return window.axios.get('http://localhost:8000/api/v1/pages/' + id).then((res) => {
      context.commit('updatePage', res)
    })
  },
  createPage(context, data) {
    let qs = require('qs');
    data = qs.stringify(data);

    let config = {
      swalTitle: 'Página salva com sucesso',
      swalMessage: 'Sua nova página já está disponível'
    }

    return window.axios.post('http://localhost:8000/api/v1/pages', data, config).then((res) => {
      context.commit('addToPagesList', res)
      return res;
    })
  },
  updatePage(context, data) {
    let qs = require('qs');
    let id = data.id;
    data = qs.stringify(data);

    let config = {
      swalTitle: 'Página salva com sucesso',
      swalMessage: 'Sua nova página já está disponível'
    }

    return window.axios.put('http://localhost:8000/api/v1/pages/' + id, data, config).then((res) => {
      return res;
    })
  },
  removePage(context, id) {
    return window.axios.delete('http://localhost:8000/api/v1/pages/' + id).then((res) => {
      return res;
    })
  }

}

export default {
  state,
  mutations,
  actions
}
