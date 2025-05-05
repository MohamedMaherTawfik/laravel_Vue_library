// resources/js/app.js

import 'bootstrap/dist/css/bootstrap.min.css'; // ✅ Add this line
import 'bootstrap';

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
