<template>
    <section class="bg-white py-3 shadow-sm">
        <div
            class="container d-flex align-items-center justify-content-between"
        >
            <!-- Left: Logo and Brand -->
            <div class="d-flex align-items-center">
                <img
                    src="/images/logo.png"
                    alt="Logo"
                    class="rounded-circle me-2"
                    width="40"
                    height="40"
                />
                <router-link
                    to="/"
                    class="text-decoration-none fw-bold fs-4 text-dark"
                    >Smart Library</router-link
                >
            </div>

            <!-- Center: Navigation Links -->
            <div class="d-flex gap-4">
                <router-link
                    to="/"
                    class="text-decoration-none text-dark fw-medium"
                    >Home</router-link
                >
                <router-link
                    to="/courses"
                    class="text-decoration-none text-dark fw-medium"
                    >My Books</router-link
                >
                <router-link
                    to="/wishlist"
                    class="text-decoration-none text-dark fw-medium"
                    >Wishlist</router-link
                >
                <router-link
                    to="/profile"
                    class="text-decoration-none text-dark fw-medium"
                    >Profile</router-link
                >
                <router-link
                    to="/contact"
                    class="text-decoration-none text-dark fw-medium"
                    >Contact-us</router-link
                >
            </div>

            <!-- Right: Search, Cart, User -->
            <div class="d-flex align-items-center gap-3">
                <div class="position-relative">
                    <input
                        type="text"
                        placeholder="Search for books . . ."
                        class="form-control rounded-pill px-4"
                        style="width: 250px"
                    />
                    <i
                        class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                    ></i>
                </div>

                <!-- <div class="position-relative me-2">
                    <i class="bi bi-cart2 fs-5 text-dark"></i>
                    <span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="font-size: 0.6rem"
                        >1</span
                    >
                </div> -->

                <!-- Authentication Section -->
                <div v-if="isAuthenticated" class="dropdown">
                    <button
                        class="btn dropdown-toggle fw-medium"
                        type="button"
                        id="userDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        {{ username }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li>
                            <router-link class="dropdown-item" to="/profile"
                                >Profile</router-link
                            >
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <button class="dropdown-item" @click="handleLogout">
                                Logout
                            </button>
                        </li>
                    </ul>
                </div>
                <div v-else class="d-flex gap-2">
                    <router-link
                        to="/login"
                        class="btn btn-outline-primary px-3"
                    >
                        Sign In
                    </router-link>
                    <router-link to="/register" class="btn btn-primary px-3">
                        Sign Up
                    </router-link>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "Navbar",
    data() {
        return {
            isAuthenticated: false, // Change this based on your auth state
            username: "Mohamed", // Replace with dynamic username
        };
    },
    methods: {
        handleLogout() {
            // Implement your logout logic here
            this.isAuthenticated = false;
            // You might want to redirect to login page after logout
            // this.$router.push('/login');
        },
    },
    // You might want to check authentication status when component mounts
    mounted() {
        // Example: this.isAuthenticated = checkAuthStatus();
    },
};
</script>

<style scoped>
.dropdown-toggle::after {
    display: none;
}
</style>
