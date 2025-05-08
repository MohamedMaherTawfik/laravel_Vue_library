<template>
    <section class="bg-gray-100 py-3">
        <div class="container d-flex align-items-center">
            <!-- Left: Brand Name -->
            <router-link
                to="/"
                class="text-decoration-none fs-5 text-dark fw-bold me-auto"
            >
                Smart Library
            </router-link>

            <!-- Center: Navigation Links -->
            <div
                class="d-flex justify-content-center gap-4 position-absolute start-50 translate-middle-x"
            >
                <router-link
                    to="/"
                    class="text-decoration-none text-black opacity-70 fw-medium"
                    >Home</router-link
                >
                <router-link
                    to="/login"
                    class="text-decoration-none text-black opacity-70 fw-medium"
                    >Login</router-link
                >
                <router-link
                    to="/register"
                    class="text-decoration-none text-black opacity-70 fw-medium"
                    >Register</router-link
                >
            </div>
        </div>
    </section>
</template>

<style scoped>
.bg-gray-100 {
    background-color: #f8f9fa;
}
.gap-4 > * {
    margin-right: 1.5rem;
}
.gap-4 > :last-child {
    margin-right: 0;
}
</style>
