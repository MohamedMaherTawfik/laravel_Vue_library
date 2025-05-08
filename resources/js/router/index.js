import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/home/home.vue";
import Login from "../views/auth/login.vue";
import Register from "../views/auth/register.vue";

const routes = [
    { path: "/", component: Home },
    { path: "/login", component: Login },
    { path: "/register", component: Register },
    // Add other routes here
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
