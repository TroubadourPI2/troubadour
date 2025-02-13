import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');

import Iconify from '@iconify/iconify';
window.Iconify = Iconify;
import Swal from 'sweetalert2';
window.Swal = Swal;

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token non trouvé ');
}