import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/home/home.vue";
import Login from "../views/auth/login.vue";
import Register from "../views/auth/register.vue";
import detail from "../views/home/details.vue";

const routes = [
    { path: "/", component: Home },
    {
        path: "/login",
        component: Login,
        meta: { hideNavbar: true, hideFooter: true },
    },
    {
        path: "/register",
        component: Register,
        meta: { hideNavbar: true, hideFooter: true },
    },
    { path: "/category/:id", component: detail, name: "details" },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
