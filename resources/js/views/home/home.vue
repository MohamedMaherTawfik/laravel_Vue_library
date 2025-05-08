<template>
    <div class="min-vh-100 bg-white">
        <!-- Navigation Bar -->
        <navbar-component></navbar-component>
        <!-- End Navigation Bar -->

        <!-- Animated Wave Divider -->
        <divider-component></divider-component>
        <!--End Animated Wave Divider -->

        <!-- Hero Section -->
        <section class="py-5 bg-light">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-3 fw-bold mb-4">
                            Premium books for Your Lifestyle
                        </h1>
                        <p class="lead mb-4 text-muted">
                            Discover Books that makes a difference
                        </p>
                        <p class="mb-4">
                            We curate the finest selection of books to enhance
                            your daily life. Quality meets affordability in our
                            collection.
                        </p>
                        <router-link
                            to="/products"
                            class="btn btn-primary btn-lg px-4 me-2"
                            >Read Now</router-link
                        >
                        <router-link
                            to="/about"
                            class="btn btn-outline-primary btn-lg px-4"
                            >Learn More</router-link
                        >
                    </div>
                    <div class="col-lg-6">
                        <img
                            src="../../../../public/images/logohitos.jpg"
                            alt="Premium Products"
                            class="img-fluid rounded shadow"
                        />
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us Section -->
        <section class="py-5" id="about">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <img
                            src="../../../../public/images/about-us.jpg"
                            alt="About Our Company"
                            class="img-fluid rounded shadow"
                        />
                    </div>
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-4">About Our Library</h2>
                        <p class="lead text-muted mb-4">
                            Founded in 2010, we've been delivering quality
                            products to satisfied customers worldwide.
                        </p>
                        <p class="mb-4">
                            Our mission is to provide exceptional books that
                            improve your daily life while maintaining the
                            highest standards of quality and customer service.
                            We carefully select each item in our inventory to
                            ensure it meets our rigorous standards.
                        </p>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <div class="me-3 text-primary">
                                        <i
                                            class="bi bi-check-circle-fill fs-4"
                                        ></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold">
                                            Quality Assurance
                                        </h5>
                                        <p class="text-muted mb-0">
                                            Rigorous quality checks
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <div class="me-3 text-primary">
                                        <i
                                            class="bi bi-check-circle-fill fs-4"
                                        ></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold">Customer Focus</h5>
                                        <p class="text-muted mb-0">
                                            Satisfaction guaranteed
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Category Section -->
        <section class="py-5 bg-light" id="categories">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Our Book Categories</h2>
                    <p class="text-muted">Explore our diverse collection</p>
                </div>

                <!-- Loading State -->
                <div v-if="loading" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3">Loading categories...</p>
                </div>

                <!-- Error State -->
                <div v-else-if="error" class="alert alert-danger">
                    Failed to load categories: {{ error }}
                    <button
                        @click="fetchCategories"
                        class="btn btn-sm btn-outline-danger ms-3"
                    >
                        Retry
                    </button>
                </div>

                <!-- Success State -->
                <div v-else>
                    <!-- Categories Grid -->
                    <div class="row g-4">
                        <div
                            class="col-md-3 col-lg-3"
                            v-for="category in categoryTabs[activeTab]"
                            :key="category.id"
                        >
                            <div
                                class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden category-card"
                            >
                                <img
                                    :src="`/storage/categorey/${category.image}`"
                                    class="card-img-top"
                                    :alt="category.name"
                                    style="height: 180px; object-fit: cover"
                                    @error="handleImageError"
                                />
                                <div class="card-body text-center">
                                    <h5
                                        class="card-title fw-bold text-capitalize"
                                    >
                                        {{ category.name }}
                                    </h5>
                                    <router-link
                                        :to="`/category/${category.id}`"
                                        class="btn btn-outline-primary mt-2"
                                    >
                                        Browse Collection
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Navigation -->
                    <ul
                        class="pagination justify-content-center mt-4"
                        v-if="totalTabs > 1"
                    >
                        <li
                            class="page-item"
                            :class="{ disabled: activeTab === 0 }"
                        >
                            <button
                                class="page-link"
                                @click="changeTab(activeTab - 1)"
                                :disabled="activeTab === 0"
                            >
                                &laquo;
                            </button>
                        </li>

                        <li
                            class="page-item"
                            v-for="(tab, index) in categoryTabs"
                            :key="index"
                            :class="{ active: activeTab === index }"
                        >
                            <button class="page-link" @click="changeTab(index)">
                                {{ index + 1 }}
                            </button>
                        </li>

                        <li
                            class="page-item"
                            :class="{ disabled: activeTab === totalTabs - 1 }"
                        >
                            <button
                                class="page-link"
                                @click="changeTab(activeTab + 1)"
                                :disabled="activeTab === totalTabs - 1"
                            >
                                &raquo;
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Categorey Section -->

        <!-- Find Us On Section -->
        <section class="py-5 bg-grey" id="social">
            <div class="container py-5 text-center">
                <h2 class="fw-bold mb-4">Find Us On</h2>
                <p class="lead text-muted mb-5">
                    Connect with us on social media for updates and promotions
                </p>
                <div class="d-flex justify-content-center flex-wrap gap-4">
                    <!-- Facebook - Blue -->
                    <a
                        href="#"
                        class="btn btn-outline-primary btn-lg rounded-circle ml-5 p-3 social-btn"
                    >
                        <i class="bi bi-facebook fs-4"></i>
                    </a>

                    <!-- Twitter - Primary Color -->
                    <a
                        href="#"
                        class="btn btn-outline-primary btn-lg rounded-circle ml-5 p-3 social-btn"
                        style="color: #1da1f2; border-color: #1da1f2"
                    >
                        <i class="bi bi-twitter fs-4"></i>
                    </a>

                    <!-- Instagram - Red-Orange -->
                    <a
                        href="#"
                        class="btn btn-outline-danger btn-lg rounded-circle ml-5 p-3 social-btn"
                        style="color: #dc2743; border-color: #dc2743"
                    >
                        <i class="bi bi-instagram fs-4"></i>
                    </a>

                    <!-- LinkedIn - Blue (like Facebook) -->
                    <a
                        href="#"
                        class="btn btn-outline-primary btn-lg rounded-circle ml-5 p-3 social-btn"
                    >
                        <i class="bi bi-linkedin fs-4"></i>
                    </a>

                    <!-- YouTube - Red -->
                    <a
                        href="#"
                        class="btn btn-outline-danger btn-lg rounded-circle ml-5 p-3 social-btn"
                    >
                        <i class="bi bi-youtube fs-4"></i>
                    </a>
                </div>
            </div>
        </section>
        <!-- End Find US On  -->

        <!-- Animated Wave Divider -->
        <divider-component></divider-component>
        <!-- End Animated Wave Divider -->

        <!-- Books Section -->
        <section class="py-5 bg-light" id="books">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Our Book Collection</h2>
                    <p class="text-muted">Browse our latest titles</p>
                </div>

                <!-- Loading State -->
                <div v-if="loading" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3">Loading books...</p>
                </div>

                <!-- Error State -->
                <div v-else-if="error" class="alert alert-danger">
                    Failed to load books: {{ error }}
                    <button
                        @click="fetchBooks"
                        class="btn btn-sm btn-outline-danger ms-3"
                    >
                        Retry
                    </button>
                </div>

                <!-- Success State -->
                <div v-else>
                    <!-- Books Grid -->
                    <div class="row g-4">
                        <div
                            class="col-md-3 col-lg-3"
                            v-for="book in bookTabs[activeTab]"
                            :key="book.id"
                        >
                            <div
                                class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden book-card"
                            >
                                <img
                                    :src="`/storage/books/${book.image}`"
                                    class="card-img-top"
                                    :alt="book.title"
                                    style="height: 200px; object-fit: cover"
                                    @error="handleImageError"
                                />
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">
                                        {{ book.title }}
                                    </h5>
                                    <p class="text-muted small mb-2">
                                        {{ book.author }}
                                    </p>
                                    <p class="text-primary fw-bold">
                                        ${{ book.price }}
                                    </p>
                                    <router-link
                                        :to="`/book/${book.id}`"
                                        class="btn btn-outline-primary mt-2"
                                    >
                                        View Details
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Navigation -->
                    <ul
                        class="pagination justify-content-center mt-4"
                        v-if="totalTabs > 1"
                    >
                        <li
                            class="page-item"
                            :class="{ disabled: activeTab === 0 }"
                        >
                            <button
                                class="page-link"
                                @click="changeTab(activeTab - 1)"
                                :disabled="activeTab === 0"
                            >
                                &laquo;
                            </button>
                        </li>

                        <li
                            class="page-item"
                            v-for="(tab, index) in bookTabs"
                            :key="index"
                            :class="{ active: activeTab === index }"
                        >
                            <button class="page-link" @click="changeTab(index)">
                                {{ index + 1 }}
                            </button>
                        </li>

                        <li
                            class="page-item"
                            :class="{ disabled: activeTab === totalTabs - 1 }"
                        >
                            <button
                                class="page-link"
                                @click="changeTab(activeTab + 1)"
                                :disabled="activeTab === totalTabs - 1"
                            >
                                &raquo;
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Books Section -->

        <!-- Client Reviews Section -->
        <section class="py-5" id="reviews">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">What Our Customers Say</h2>
                    <p class="text-muted">
                        Trusted by thousands of happy customers
                    </p>
                </div>
                <div class="row g-4">
                    <div
                        class="col-md-4"
                        v-for="(review, index) in customerReviews"
                        :key="index"
                    >
                        <div class="card h-100 border-0 shadow-sm rounded-3">
                            <div class="card-body p-4">
                                <div class="d-flex mb-3">
                                    <img
                                        :src="review.avatar"
                                        class="rounded-circle me-3"
                                        width="50"
                                        height="50"
                                        :alt="review.name"
                                    />
                                    <div>
                                        <h5 class="mb-0">{{ review.name }}</h5>
                                        <div class="text-warning small">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">{{ review.comment }}</p>
                            </div>
                            <div
                                class="card-footer bg-white border-0 small text-muted"
                            >
                                {{ review.date }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- End Client Reviews Section -->

        <!-- Newsletter Section -->
        <section class="py-5 bg-primary text-white">
            <div class="container py-5 text-center">
                <h2 class="fw-bold mb-4">Subscribe to Our Newsletter</h2>
                <p class="lead mb-5">
                    Get the latest updates and exclusive offers
                </p>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <form class="input-group">
                            <input
                                type="email"
                                class="form-control form-control-lg"
                                placeholder="Your email address"
                            />
                            <button class="btn btn-dark btn-lg" type="submit">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-5 bg-dark text-white">
            <div class="container py-4">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <h5 class="fw-bold mb-3">ShopHub</h5>
                        <p class="text-muted">
                            Your one-stop shop for quality products. We're
                            committed to providing excellent customer service
                            and premium products.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"
                                ><i class="bi bi-facebook fs-5"></i
                            ></a>
                            <a href="#" class="text-white"
                                ><i class="bi bi-twitter fs-5"></i
                            ></a>
                            <a href="#" class="text-white"
                                ><i class="bi bi-instagram fs-5"></i
                            ></a>
                            <a href="#" class="text-white"
                                ><i class="bi bi-linkedin fs-5"></i
                            ></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <h5 class="fw-bold mb-3">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <router-link
                                    to="/"
                                    class="text-muted text-decoration-none"
                                    >Home</router-link
                                >
                            </li>
                            <li class="mb-2">
                                <router-link
                                    to="/about"
                                    class="text-muted text-decoration-none"
                                    >About Us</router-link
                                >
                            </li>
                            <li class="mb-2">
                                <router-link
                                    to="/products"
                                    class="text-muted text-decoration-none"
                                    >Products</router-link
                                >
                            </li>
                            <li class="mb-2">
                                <router-link
                                    to="/contact"
                                    class="text-muted text-decoration-none"
                                    >Contact</router-link
                                >
                            </li>
                            <li class="mb-2">
                                <router-link
                                    to="/faq"
                                    class="text-muted text-decoration-none"
                                    >FAQ</router-link
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <h5 class="fw-bold mb-3">Customer Service</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a
                                    href="#"
                                    class="text-muted text-decoration-none"
                                    >Shipping Policy</a
                                >
                            </li>
                            <li class="mb-2">
                                <a
                                    href="#"
                                    class="text-muted text-decoration-none"
                                    >Return Policy</a
                                >
                            </li>
                            <li class="mb-2">
                                <a
                                    href="#"
                                    class="text-muted text-decoration-none"
                                    >Privacy Policy</a
                                >
                            </li>
                            <li class="mb-2">
                                <a
                                    href="#"
                                    class="text-muted text-decoration-none"
                                    >Terms & Conditions</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <h5 class="fw-bold mb-3">Contact Us</h5>
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2">
                                <i class="bi bi-geo-alt me-2"></i> 123 Street,
                                City, Country
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-telephone me-2"></i> +1 234 567
                                890
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-envelope me-2"></i>
                                info@shophub.com
                            </li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4 bg-secondary" />
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0">
                            &copy; {{ new Date().getFullYear() }} ShopHub. All
                            rights reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <img
                            src="../../../../public/images/libro.avif"
                            alt="Payment Methods"
                            class="img-fluid rounded-circle"
                            style="max-height: 30%"
                        />
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "CategorySection",
    data() {
        return {
            baseUrl: "http://127.0.0.1:8000/api",
            categories: [],
            books: [], // Added books data property
            loading: true,
            error: null,
            activeTab: 0,
            itemsPerTab: 4,
            booksPerTab: 8,
        };
    },
    created() {
        this.fetchAllData(); // Changed to fetch both
    },
    computed: {
        categoryTabs() {
            const tabs = [];
            for (let i = 0; i < this.categories.length; i += this.itemsPerTab) {
                tabs.push(this.categories.slice(i, i + this.itemsPerTab));
            }
            return tabs;
        },
        bookTabs() {
            // Added computed property for books pagination
            const tabs = [];
            for (let i = 0; i < this.books.length; i += this.booksPerTab) {
                tabs.push(this.books.slice(i, i + this.booksPerTab));
            }
            return tabs;
        },
        totalTabs() {
            return Math.ceil(this.categories.length / this.itemsPerTab);
        },
        totalBookTabs() {
            // Added computed property for books total tabs
            return Math.ceil(this.books.length / this.booksPerTab);
        },
    },
    methods: {
        async fetchAllData() {
            // Updated to fetch both endpoints
            this.loading = true;
            this.error = null;

            try {
                // Fetch both endpoints concurrently
                const [categoriesResponse, booksResponse] = await Promise.all([
                    axios.get(`${this.baseUrl}/categorey`),
                    axios.get(`${this.baseUrl}/book`),
                ]);

                if (categoriesResponse.data.success) {
                    this.categories = categoriesResponse.data.data;
                }

                if (booksResponse.data.success) {
                    this.books = booksResponse.data.data;
                } else {
                    console.warn("Books API returned unsuccessful response");
                }
            } catch (error) {
                this.error = this.getErrorMessage(error);
                console.error("Error fetching data:", error);
            } finally {
                this.loading = false;
            }
        },

        getErrorMessage(error) {
            if (error.response) {
                return (
                    error.response.data?.message ||
                    `Server error: ${error.response.status}`
                );
            } else if (error.request) {
                return "Network error - no response from server";
            } else {
                return error.message || "Unknown error occurred";
            }
        },

        handleImageError(event) {
            event.target.src = "/path/to/default-image.jpg";
        },

        changeTab(index) {
            this.activeTab = index;
        },
    },
};
</script>

<style scoped>
.navbar {
    padding: 1rem 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.card {
    transition: all 0.3s ease;
    border: none;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
}

section {
    padding: 5rem 0;
}

.btn-link {
    text-decoration: none;
    color: var(--bs-primary);
    padding-left: 0;
}

.btn-link:hover {
    text-decoration: underline;
}

.bi-star-fill {
    color: gold;
}

.rounded-circle {
    object-fit: cover;
}

.wave-divider-grey {
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
    /* background: #e5e7eb; gray-200 */
    margin-bottom: -1px;
}

.wave-divider-grey svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 100px;
}

.wave-grey-1 {
    fill: #e5e7eb; /* gray-200 */
    animation: waveFlow 10s linear infinite;
}

.wave-grey-2 {
    fill: #e5e7eb; /* gray-200 */
    animation: waveFlow 8s linear infinite reverse;
    opacity: 0.7;
}

.wave-grey-3 {
    fill: #e5e7eb; /* gray-200 */
    animation: waveFlow 6s linear infinite;
    opacity: 0.5;
}

@keyframes waveFlow {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

@media (max-width: 768px) {
    section {
        padding: 3rem 0;
    }

    .display-3 {
        font-size: 2.5rem;
    }
}
</style>
