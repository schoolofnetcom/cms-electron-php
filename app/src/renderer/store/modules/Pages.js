const state = {
  all: []
}

const mutations = {
  updatePagesList (state, res) {
    state.all = res.data
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
  createPage(context, data) {
    let qs = require('qs');
    data = qs.stringify(data);
    return window.axios.post('http://localhost:8000/api/v1/pages', data).then((res) => {
      context.commit('addToPagesList', res)
      return res;
    })
  }
}

export default {
  state,
  mutations,
  actions
}
