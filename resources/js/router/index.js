import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/home/home.vue";
import Login from "../views/auth/login.vue";
import Register from "../views/auth/register.vue";

const routes = [
    { path: "/", component: Home },
    { path: "/login", component: Login, meta: { hideNavbar: true } },
    { path: "/register", component: Register, meta: { hideNavbar: true } },
    // Add other routes here
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
