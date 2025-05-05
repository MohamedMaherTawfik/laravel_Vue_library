<template>
    <div class="d-flex flex-column flex-md-row min-vh-100">
        <!-- Left Side: Welcome -->
        <div
            class="d-none d-md-flex flex-column justify-content-center align-items-center text-white w-100 w-md-50 p-5 bg-cover bg-center"
            style="
                background-image: url('/images/library.jpg');
                background-size: cover;
                background-position: center;
                height: 100vh; /* or any height you want */
            "
        ></div>

        <!-- Right Side: Registration Form -->
        <div
            class="d-flex justify-content-center align-items-center w-100 w-md-50 p-4"
            style="background-color: #031B36FF;"
        >
            <div
                class="card shadow-lg p-4 rounded-4 w-100"
                style="max-width: 100%; background-color: #031B3652;"
            >
                <h3 class="text-center text-white mb-4 fw-bold">New Account</h3>

                <form @submit.prevent="register">
                    <div class="form-floating mb-3">
                        <input
                            v-model="form.name"
                            type="text"
                            id="name"
                            class="form-control bg-dark bg-opacity-10 text-white border border-white rounded"
                            placeholder="Username"
                            required
                            style="--bs-bg-opacity: 0.1"
                        />
                        <label for="name" class="text-white">Username</label>
                    </div>

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

                    <div class="form-floating mb-3">
                        <input
                            v-model="form.phone"
                            type="text"
                            id="phone"
                            class="form-control bg-dark bg-opacity-10 text-white border border-white rounded"
                            placeholder="Phone"
                            style="--bs-bg-opacity: 0.1"
                        />
                        <label for="phone" class="text-white">Phone</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input
                            v-model="form.year"
                            type="text"
                            id="year"
                            class="form-control bg-dark bg-opacity-10 text-white border border-white rounded"
                            placeholder="Academic Year"
                            style="--bs-bg-opacity: 0.1"
                        />
                        <label for="year" class="text-white"
                            >Academic Year</label
                        >
                    </div>

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

                    <div class="form-floating mb-3">
                        <input
                            v-model="form.confirmPassword"
                            type="password"
                            id="confirmPassword"
                            class="form-control bg-dark bg-opacity-10 text-white border border-white rounded"
                            placeholder="Confirm Password"
                            required
                            style="--bs-bg-opacity: 0.1"
                        />
                        <label for="confirmPassword" class="text-white"
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
                name: "",
                email: "",
                phone: "",
                year: "",
                password: "",
                confirmPassword: "",
            },
            loading: false,
            error: null,
            success: null,
        };
    },
    methods: {
        async register() {
            this.loading = true;
            this.error = null;
            this.success = null;

            if (this.form.password !== this.form.confirmPassword) {
                this.error = "Passwords do not match.";
                this.loading = false;
                return;
            }

            try {
                const response = await axios.post("/api/auth/register", {
                    name: this.form.name,
                    email: this.form.email,
                    phone: this.form.phone,
                    year: this.form.year,
                    password: this.form.password,
                });
                this.success = "Registration successful!";
                this.form = {
                    name: "",
                    email: "",
                    phone: "",
                    year: "",
                    password: "",
                    confirmPassword: "",
                };
            } catch (err) {
                this.error =
                    err.response?.data?.message || "Registration failed.";
            } finally {
                this.loading = false;
            }
        },
    },
};
</script>

<style>
.bg-teal {
    background-color: #006d77;
}
</style>
