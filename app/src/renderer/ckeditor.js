import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const editor = ClassicEditor;

export default editor;

let token = window.axios.defaults.headers.common['Authorization'];
let baseURL = window.axios.defaults.baseURL;

editor
    .build
    .config = {
        toolbar: [
            'headings', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo',
            'imagetextalternative', 'insertimage', 'imagestylefull', 'imagestyleside'
        ],
        ckfinder: {
            uploadUrl: baseURL + '/api/v1/image/upload?token=' + token
        }
    }
