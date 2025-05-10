<template>
    <div class="d-flex flex-column flex-md-row min-vh-100">
        <!-- Left Side: Welcome -->
        <div
            class="d-none d-md-flex flex-column justify-content-center align-items-center text-white w-100 w-md-50 p-5 bg-cover bg-center"
            style="
                background-image: url('/images/library.jpg');
                background-size: cover;
                background-position: center;
                height: 100vh;
            "
        >
            <h1 class="display-4 fw-bold">BRAFY</h1>
            <p class="lead">SINCE 1989</p>
        </div>

        <!-- Right Side: Registration Form -->
        <div
            class="d-flex justify-content-center align-items-center w-100 w-md-50 p-4"
            style="background-color: #031b36ff"
        >
            <div
                class="card shadow-lg p-4 rounded-4 w-100"
                style="max-width: 100%; background-color: #031b3652"
            >
                <h3 class="text-center text-white mb-4 fw-bold">New Account</h3>

                <form @submit.prevent="register">
                    <!-- Username Field -->
                    <div class="form-floating mb-3">
                        <input
                            v-model="form.username"
                            type="text"
                            id="username"
                            class="form-control bg-dark bg-opacity-10 text-white border border-white rounded"
                            placeholder="Username"
                            required
                            style="--bs-bg-opacity: 0.1"
                        />
                        <label for="username" class="text-white"
                            >Username</label
                        >
                    </div>

                    <!-- First Name Field -->
                    <div class="form-floating mb-3">
                        <input
                            v-model="form.first_name"
                            type="text"
                            id="first_name"
                            class="form-control bg-dark bg-opacity-10 text-white border border-white rounded"
                            placeholder="First Name"
                            required
                            style="--bs-bg-opacity: 0.1"
                        />
                        <label for="first_name" class="text-white"
                            >First Name</label
                        >
                    </div>

                    <!-- Last Name Field -->
                    <div class="form-floating mb-3">
                        <input
                            v-model="form.last_name"
                            type="text"
                            id="last_name"
                            class="form-control bg-dark bg-opacity-10 text-white border border-white rounded"
                            placeholder="Last Name"
                            required
                            style="--bs-bg-opacity: 0.1"
                        />
                        <label for="last_name" class="text-white"
                            >Last Name</label
                        >
                    </div>

                    <!-- Email Field -->
                    <div class="form-floating mb-3">
                        <input
                            v-model="form.email"
                            type="email"
                            id="email"
                            class="form-control bg-dark bg-opacity-10 text-white border border-white rounded"
                            placeholder="Email"
                            required
                            style="--bs-bg-opacity: 0.1"
                        />
                        <label for="email" class="text-white">Email</label>
                    </div>

                    <!-- Phone Field -->
                    <div class="form-floating mb-3">
                        <input
                            v-model="form.phone"
                            type="tel"
                            id="phone"
                            class="form-control bg-dark bg-opacity-10 text-white border border-white rounded"
                            placeholder="Phone"
                            required
                            style="--bs-bg-opacity: 0.1"
                        />
                        <label for="phone" class="text-white">Phone</label>
                    </div>

                    <!-- Password Field -->
                    <div class="form-floating mb-3">
                        <input
                            v-model="form.password"
                            type="password"
                            id="password"
                            class="form-control bg-dark bg-opacity-10 text-white border border-white rounded"
                            placeholder="Password"
                            required
                            style="--bs-bg-opacity: 0.1"
                        />
                        <label for="password" class="text-white"
                            >Password</label
                        >
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-floating mb-3">
                        <input
                            v-model="form.password_confirmation"
                            type="password"
                            id="password_confirmation"
                            class="form-control bg-dark bg-opacity-10 text-white border border-white rounded"
                            placeholder="Confirm Password"
                            required
                            style="--bs-bg-opacity: 0.1"
                        />
                        <label for="password_confirmation" class="text-white"
                            >Confirm Password</label
                        >
                    </div>

                    <div class="d-flex justify-content-center">
                        <button
                            type="submit"
                            class="btn btn-primary w-35 mb-2"
                            :disabled="loading"
                        >
                            <span
                                v-if="loading"
                                class="spinner-border spinner-border-sm me-2"
                                role="status"
                                aria-hidden="true"
                            ></span>
                            Create account
                        </button>
                    </div>

                    <div class="text-center my-2 text-muted">or</div>

                    <div class="d-flex flex-column align-items-center">
                        <button class="btn bg-white text-black w-50">
                            <i class="fa-brands fa-google"></i> Sign up with
                            Google
                        </button>

                        <button class="btn btn-primary w-50 mt-2">
                            <i class="fa-brands fa-facebook"></i> Sign up with
                            Facebook
                        </button>
                    </div>

                    <p class="text-center text-white mt-3">
                        Already have an account?
                        <a
                            href="/login"
                            class="text-decoration-none text-primary"
                        >
                            Sign in
                        </a>
                    </p>
                </form>

                <div v-if="error" class="alert alert-danger mt-3">
                    {{ error }}
                </div>
                <div v-if="success" class="alert alert-success mt-3">
                    {{ success }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                email: "",
                password: "",
            },
            loading: false,
            error: null,
            success: null,
            validationErrors: {},
        };
    },
    methods: {
        async login() {
            this.loading = true;
            this.error = null;
            this.success = null;
            this.validationErrors = {};

            try {
                const response = await this.$http.post(
                    "/api/auth/login",
                    this.form
                );

                // Handle successful login
                this.handleSuccessfulLogin(response);
            } catch (error) {
                this.handleLoginError(error);
            } finally {
                this.loading = false;
            }
        },

        handleSuccessfulLogin(response) {
            // Store token and set auth header
            const token = response.data.data.access_token;
            localStorage.setItem("auth_token", token);
            this.$http.defaults.headers.common[
                "Authorization"
            ] = `Bearer ${token}`;

            // Show success message
            this.success = response.data.message || "Login successful!";

            // Redirect after short delay
            setTimeout(() => {
                window.location.href = "/home"; // Or this.$router.push('/home')
            }, 1500);
        },

        handleLoginError(error) {
            if (error.response.status === 422) {
                // Laravel validation errors
                this.validationErrors = error.response.data.errors;
                this.error = "Please fix the validation errors";
            } else if (error.response.status === 401) {
                this.error = "Invalid credentials. Please try again.";
            } else {
                this.error =
                    error.response?.data?.message ||
                    "Login failed. Please try again later.";
            }
        },
    },
    mounted() {
        // Clear any existing auth data
        if (localStorage.getItem("auth_token")) {
            localStorage.removeItem("auth_token");
            delete this.$http.defaults.headers.common["Authorization"];
        }
    },
};
</script>

<style>
.bg-teal {
    background-color: #006d77;
}
</style>
