import axios from 'axios'
import swal from 'sweetalert2'

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

    if (err.response && err.response.status == 422) {
        title = 'Verifique os dados'
        text = 'O servidor recusou os dados informado, confira as informações'
    }

    swal({
        title: title,
        text: text,
        type: 'error',
        confirmButtonText: 'Eu entendo'
    })

    return Promise.reject(error);
});

window.axios = axios
