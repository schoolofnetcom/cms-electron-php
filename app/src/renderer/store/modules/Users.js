const state = {
  all: [],
  oneUser: {}
}

const mutations = {
  updateUsersList (state, res) {
    state.all = res.data
  },
  updateUser (state, res) {
    state.oneUser = res.data
  },
  addToUsersList(state, res) {
    state.all.push(res.data)
  }
}

const actions = {
  listUsers(context) {
    window.axios.get('/api/v1/users').then((res) => {
      context.commit('updateUsersList', res)
    })
  },
  getUser(context, id) {
    return window.axios.get('/api/v1/users/' + id).then((res) => {
      context.commit('updateUser', res)
    })
  },
  createUser(context, data) {
    let qs = require('qs');
    data = qs.stringify(data);

    let config = {
      swalTitle: 'Usuário salvo com sucesso',
      swalMessage: 'Seu novo usuário já está disponível'
    }

    return window.axios.post('/api/v1/users', data, config).then((res) => {
      context.commit('addToUsersList', res)
      return res;
    })
  },
  updateUser(context, data) {
    let qs = require('qs');
    let id = data.id;
    data = qs.stringify(data);

    let config = {
      swalTitle: 'Usuário salvo com sucesso',
      swalMessage: 'Sua alteração foi publicada'
    }

    return window.axios.put('/api/v1/users/' + id, data, config).then((res) => {
      return res;
    })
  },
  removeUser(context, id) {
    return window.axios.delete('/api/v1/users/' + id).then((res) => {
      return res;
    })
  }

}

export default {
  state,
  mutations,
  actions
}
