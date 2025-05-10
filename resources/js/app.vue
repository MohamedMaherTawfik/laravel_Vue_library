<template>
    <div>
        <navbar-component v-if="!$route.meta.hideNavbar" />
        <router-view />
    </div>

    <div>
        <footer-component v-if="!$route.meta.hideFooter" />
    </div>
</template>

<script>
export default {
    name: "App",
    created() {
        this.setupAxios();
    },
    methods: {
        setupAxios() {
            // Get CSRF token from meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]');

            if (csrfToken) {
                window.axios.defaults.headers.common["X-CSRF-TOKEN"] =
                    csrfToken.content;
            }

            // Set base URL for API endpoints
            window.axios.defaults.baseURL = "/api";

            // Handle token refresh (if using JWT)
            this.setupAuthInterceptor();
        },

        setupAuthInterceptor() {
            window.axios.interceptors.response.use(
                (response) => response,
                (error) => {
                    if (error.response?.status === 401) {
                        // Handle unauthorized errors
                        localStorage.removeItem("auth_token");
                        this.$router.push("/login");
                    }
                    return Promise.reject(error);
                }
            );
        },
    },
};
</script>
