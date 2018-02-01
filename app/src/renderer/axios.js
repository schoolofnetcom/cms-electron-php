import axios from 'axios'
import swal from 'sweetalert2'
import store from './store'
import router from './router'

if (window.localStorage.getItem('token')) {
    axios.defaults.headers.common['Authorization'] = window.localStorage.getItem('token');
}

axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

axios.interceptors.request.use(function (config) {
    let defaultTitle = 'Salvo com sucesso';
    let defaultMessage = 'O registro foi salvo com sucesso';

    if (config.method === 'delete') {
        defaultTitle = 'Removido com sucesso';
        defaultMessage = 'O registro foi removido com sucesso';
    }

    if (config.method !== 'get') {
        swal({
            title: config.swalTitle || defaultTitle,
            text: config.swalMessage || defaultMessage,
            type: 'success',
            confirmButtonText: 'Ok!'
        })
    }


    return config;
}, function (err) {
    return Promise.reject(error);
});

axios.interceptors.response.use(response => {
    return response;
}, function (err) {
    let title = 'Algo deu errado'
    let text = 'Uma situação inesperada ocorreu no servidor, por favor, entre em contato com o administrador'
    let btnLabel = 'Eu entendo'
    let closeCallback = (result) => result;

    if (err.response && err.response.status == 401) {
        title = 'Autenticação!'
        text = 'Você precisa estar logado para acessar este recurso'
        btnLabel = 'Autenticar'
        closeCallback = (result) => router.push({ path: '/auth'})
    }

    if (err.response && err.response.status == 422) {
        title = 'Verifique os dados'
        text = 'O servidor recusou os dados informado, confira as informações'
    }

    swal({
        title: title,
        text: text,
        type: 'error',
        confirmButtonText: btnLabel
    }).then(closeCallback)

    return Promise.reject(error);
});

window.axios = axios
