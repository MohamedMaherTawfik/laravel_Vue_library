<template>
    <div class="min-vh-100 bg-white">
        <!-- Navbar -->
        <navbar-component></navbar-component>

        <!-- Animated Wave Divider -->
        <divider-component></divider-component>
        <!--End Animated Wave Divider -->

        <!-- Category Hero Section -->
        <section class="py-5 bg-light">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <router-link to="/">Home</router-link>
                                </li>
                                <li class="breadcrumb-item">
                                    <router-link to="/categories"
                                        >Categories</router-link
                                    >
                                </li>
                                <li
                                    class="breadcrumb-item active"
                                    aria-current="page"
                                >
                                    {{ category.name }}
                                </li>
                            </ol>
                        </nav>
                        <h1 class="display-3 fw-bold mb-4 text-capitalize">
                            {{ category.name }}
                        </h1>
                        <p
                            class="lead mb-4 text-muted"
                            v-if="category.description"
                        >
                            {{ category.description }}
                        </p>
                        <div class="d-flex align-items-center mb-4">
                            <span class="badge bg-primary me-2">
                                {{ products.length }} Books
                            </span>
                            <span class="text-muted small">
                                Last updated:
                                {{ formatDate(category.updated_at) }}
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img
                            :src="categoryImage"
                            :alt="category.name"
                            class="img-fluid rounded shadow"
                            style="max-height: 300px; object-fit: cover"
                            @error="handleImageError"
                        />
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section class="py-5">
            <div class="container py-5">
                <div
                    class="d-flex justify-content-between align-items-center mb-5"
                >
                    <h2 class="fw-bold">Books in this Category</h2>
                    <div class="d-flex align-items-center">
                        <span class="me-2">Sort by:</span>
                        <select
                            class="form-select"
                            v-model="sortOption"
                            style="width: auto"
                        >
                            <option value="title_asc">Title (A-Z)</option>
                            <option value="title_desc">Title (Z-A)</option>
                            <option value="price_asc">
                                Price (Low to High)
                            </option>
                            <option value="price_desc">
                                Price (High to Low)
                            </option>
                            <option value="date_desc">Newest First</option>
                            <option value="date_asc">Oldest First</option>
                        </select>
                    </div>
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
                        @click="fetchCategoryDetails"
                        class="btn btn-sm btn-outline-danger ms-3"
                    >
                        Retry
                    </button>
                </div>

                <!-- Empty State -->
                <div v-else-if="products.length === 0" class="text-center py-5">
                    <div class="mb-4">
                        <i
                            class="bi bi-book text-muted"
                            style="font-size: 5rem"
                        ></i>
                    </div>
                    <h4 class="fw-bold mb-3">No Books Found</h4>
                    <p class="text-muted mb-4">
                        This category doesn't have any books yet. Check back
                        later!
                    </p>
                    <router-link to="/categories" class="btn btn-primary">
                        Browse Other Categories
                    </router-link>
                </div>

                <!-- Success State -->
                <div v-else>
                    <!-- Products Grid -->
                    <div class="row g-4">
                        <div
                            class="col-md-4 col-lg-3"
                            v-for="product in sortedProducts"
                            :key="product.id"
                        >
                            <div
                                class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card"
                            >
                                <img
                                    :src="productImage(product)"
                                    class="card-img-top"
                                    :alt="product.title"
                                    style="height: 200px; object-fit: cover"
                                    @error="handleImageError"
                                />
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">
                                        {{ product.title }}
                                    </h5>
                                    <p class="text-muted small mb-2">
                                        {{ product.author }}
                                    </p>
                                    <div
                                        class="d-flex justify-content-between align-items-center"
                                    >
                                        <p class="text-primary fw-bold mb-0">
                                            ${{ product.price }}
                                        </p>
                                        <span
                                            class="badge bg-secondary text-capitalize"
                                            v-if="product.condition"
                                        >
                                            {{ product.condition }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-0 pt-0">
                                    <router-link
                                        :to="`/book/${product.id}`"
                                        class="btn btn-outline-primary w-100"
                                    >
                                        View Details
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <nav
                        aria-label="Page navigation"
                        class="mt-5"
                        v-if="totalPages > 1"
                    >
                        <ul class="pagination justify-content-center">
                            <li
                                class="page-item"
                                :class="{ disabled: currentPage === 1 }"
                            >
                                <button
                                    class="page-link"
                                    @click="changePage(currentPage - 1)"
                                    :disabled="currentPage === 1"
                                >
                                    Previous
                                </button>
                            </li>

                            <li
                                class="page-item"
                                v-for="page in visiblePages"
                                :key="page"
                                :class="{ active: currentPage === page }"
                            >
                                <button
                                    class="page-link"
                                    @click="changePage(page)"
                                >
                                    {{ page }}
                                </button>
                            </li>

                            <li
                                class="page-item"
                                :class="{
                                    disabled: currentPage === totalPages,
                                }"
                            >
                                <button
                                    class="page-link"
                                    @click="changePage(currentPage + 1)"
                                    :disabled="currentPage === totalPages"
                                >
                                    Next
                                </button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>

        <!-- Related Categories Section -->
        <section class="py-5 bg-light" v-if="relatedCategories.length > 0">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Related Categories</h2>
                    <p class="text-muted">Explore similar collections</p>
                </div>

                <div class="row g-4">
                    <div
                        class="col-md-3 col-lg-2"
                        v-for="relatedCat in relatedCategories"
                        :key="relatedCat.id"
                    >
                        <router-link
                            :to="`/category/${relatedCat.id}`"
                            class="text-decoration-none"
                        >
                            <div
                                class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden text-center category-card"
                            >
                                <img
                                    :src="`/storage/categorey/${relatedCat.image}`"
                                    class="card-img-top"
                                    :alt="relatedCat.name"
                                    style="height: 120px; object-fit: cover"
                                    @error="handleImageError"
                                />
                                <div class="card-body">
                                    <h5
                                        class="card-title fw-bold text-capitalize mb-0"
                                    >
                                        {{ relatedCat.name }}
                                    </h5>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="py-5 bg-primary text-white">
            <div class="container py-5 text-center">
                <h2 class="fw-bold mb-4">Stay Updated</h2>
                <p class="lead mb-5">
                    Subscribe to get notified about new books in this category
                </p>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <form class="input-group">
                            <input
                                type="email"
                                class="form-control form-control-lg"
                                placeholder="Your email address"
                                v-model="email"
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
                        <h5 class="fw-bold mb-3">BookHub</h5>
                        <p class="text-muted">
                            Your one-stop shop for quality books. We're
                            committed to providing excellent customer service
                            and premium reading materials.
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
                                    to="/categories"
                                    class="text-muted text-decoration-none"
                                    >Categories</router-link
                                >
                            </li>
                            <li class="mb-2">
                                <router-link
                                    to="/books"
                                    class="text-muted text-decoration-none"
                                    >All Books</router-link
                                >
                            </li>
                            <li class="mb-2">
                                <router-link
                                    to="/contact"
                                    class="text-muted text-decoration-none"
                                    >Contact</router-link
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
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <h5 class="fw-bold mb-3">Contact Us</h5>
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2">
                                <i class="bi bi-geo-alt me-2"></i> 123 Book
                                Street, Library City
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-telephone me-2"></i> +1 234 567
                                890
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-envelope me-2"></i>
                                info@bookhub.com
                            </li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4 bg-secondary" />
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0">
                            &copy; {{ new Date().getFullYear() }} BookHub. All
                            rights reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <img
                            src="/images/libro.avif"
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
import { ref, computed, watch } from "vue";
import { useRoute } from "vue-router";
import NavbarComponent from "./navbarComponent.vue";
import DividerComponent from "./dividerComponent.vue";

export default {
    name: "CategoryDetails",
    components: {
        NavbarComponent,
        DividerComponent,
    },
    setup() {
        const route = useRoute();
        const baseUrl = "http://127.0.0.1:8000/api";
        const category = ref({});
        const products = ref([]);
        const relatedCategories = ref([]);
        const loading = ref(true);
        const error = ref(null);
        const currentPage = ref(1);
        const itemsPerPage = ref(8);
        const sortOption = ref("title_asc");
        const email = ref("");

        const categoryImage = computed(() => {
            return category.value.image
                ? `/storage/categorey/${category.value.image}`
                : "/images/default-category.jpg";
        });

        const sortedProducts = computed(() => {
            const [sortField, sortDirection] = sortOption.value.split("_");
            const sorted = [...products.value];

            sorted.sort((a, b) => {
                let comparison = 0;

                if (sortField === "title") {
                    comparison = a.title.localeCompare(b.title);
                } else if (sortField === "price") {
                    comparison = parseFloat(a.price) - parseFloat(b.price);
                } else if (sortField === "date") {
                    comparison =
                        new Date(a.created_at) - new Date(b.created_at);
                }

                return sortDirection === "asc" ? comparison : -comparison;
            });

            // Apply pagination
            const start = (currentPage.value - 1) * itemsPerPage.value;
            const end = start + itemsPerPage.value;
            return sorted.slice(start, end);
        });

        const totalPages = computed(() => {
            return Math.ceil(products.value.length / itemsPerPage.value);
        });

        const visiblePages = computed(() => {
            const pages = [];
            const maxVisible = 5;
            let start = Math.max(
                1,
                currentPage.value - Math.floor(maxVisible / 2)
            );
            let end = Math.min(totalPages.value, start + maxVisible - 1);

            if (end - start + 1 < maxVisible) {
                start = Math.max(1, end - maxVisible + 1);
            }

            for (let i = start; i <= end; i++) {
                pages.push(i);
            }

            return pages;
        });

        const fetchCategoryDetails = async () => {
            loading.value = true;
            error.value = null;
            const categoryId = route.params.id;

            try {
                const [categoryResponse, productsResponse, relatedResponse] =
                    await Promise.all([
                        axios.get(`${baseUrl}/categorey/${categoryId}`),
                        axios.get(`${baseUrl}/book?category_id=${categoryId}`),
                        axios.get(
                            `${baseUrl}/categorey?related_to=${categoryId}&limit=6`
                        ),
                    ]);

                if (categoryResponse.data.success) {
                    category.value = categoryResponse.data.data;
                } else {
                    throw new Error("Category not found");
                }

                if (productsResponse.data.success) {
                    products.value = productsResponse.data.data;
                }

                if (relatedResponse.data.success) {
                    relatedCategories.value = relatedResponse.data.data;
                }
            } catch (err) {
                error.value = getErrorMessage(err);
                console.error("Error fetching category details:", err);
            } finally {
                loading.value = false;
            }
        };

        const getErrorMessage = (error) => {
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
        };

        const handleImageError = (event) => {
            if (event.target.src.includes("categorey")) {
                event.target.src = "/images/default-category.jpg";
            } else {
                event.target.src = "/images/default-book.jpg";
            }
        };

        const productImage = (product) => {
            return product.image
                ? `/storage/books/${product.image}`
                : "/images/default-book.jpg";
        };

        const changePage = (page) => {
            currentPage.value = page;
            window.scrollTo({ top: 0, behavior: "smooth" });
        };

        const formatDate = (dateString) => {
            if (!dateString) return "N/A";
            const options = { year: "numeric", month: "long", day: "numeric" };
            return new Date(dateString).toLocaleDateString(undefined, options);
        };

        // Watch for route changes to reload data
        watch(
            () => route.params.id,
            (newId) => {
                if (newId) {
                    currentPage.value = 1;
                    fetchCategoryDetails();
                }
            },
            { immediate: true }
        );

        return {
            baseUrl,
            category,
            products,
            relatedCategories,
            loading,
            error,
            currentPage,
            itemsPerPage,
            sortOption,
            email,
            categoryImage,
            sortedProducts,
            totalPages,
            visiblePages,
            fetchCategoryDetails,
            handleImageError,
            productImage,
            changePage,
            formatDate,
        };
    },
};
</script>

<style scoped>
.category-card {
    transition: all 0.3s ease;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.product-card {
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.breadcrumb {
    background-color: transparent;
    padding: 0;
    margin-bottom: 1rem;
}

.breadcrumb-item a {
    color: #6c757d;
    text-decoration: none;
}

.breadcrumb-item.active {
    color: #495057;
}

.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.page-link {
    color: #0d6efd;
}

@media (max-width: 768px) {
    .d-flex.justify-content-between.align-items-center.mb-5 {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .form-select {
        width: 100% !important;
    }
}
</style>
