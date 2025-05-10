<template>
    <div>
        <navbar-component v-if="!$route.meta.hideNavbar" />
        <router-view />
    </div>
</template>

<script>
export default {
    name: "App",
    created() {
        // Set up axios headers when app initializes
        this.setupAxios();
    },
    methods: {
        setupAxios() {
            // Get CSRF token from meta tag
            const token = document.head.querySelector(
                'meta[name="csrf-token"]'
            );

            if (token) {
                window.axios.defaults.headers.common["X-CSRF-TOKEN"] =
                    token.content;
            }

            // Always set this for API requests
            window.axios.defaults.headers.common["X-Requested-With"] =
                "XMLHttpRequest";

            // Set base URL if needed
            window.axios.defaults.baseURL = "/api";
        },
    },
};
</script>
