import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

import axios from "axios";
window.axios = axios;

// Set default headers
window.axios.defaults.headers.common = {
    "X-Requested-With": "XMLHttpRequest",
};
