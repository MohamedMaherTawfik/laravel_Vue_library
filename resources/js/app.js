import { createApp } from "vue";
import App from "./App.vue"; // <-- import root component
import router from "./router";
import axios from "axios";

// your imports (bootstrap, css, etc.)
import "./bootstrap";
import "animate.css";
import "../css/app.css";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-icons/font/bootstrap-icons.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

import RegisterComponent from "./components/registerComponent.vue";
import LoginComponent from "./components/loginComponent.vue";
import HomePageComponent from "./components/homePageComponent.vue";
import navbarComponent from "./components/navbarComponent.vue";
import dividerComponent from "./components/dividerComponent.vue";
import details from "./views/home/details.vue";
import footer from "./components/footerComponent.vue";

const app = createApp(App); // <-- pass App.vue as root
app.component("register-component", RegisterComponent);
app.component("login-component", LoginComponent);
app.component("home-component", HomePageComponent);
app.component("navbar-component", navbarComponent);
app.component("divider-component", dividerComponent);
app.component("details-component", details);
app.component("footer-component", footer);
app.use(router);
app.mount("#app");
