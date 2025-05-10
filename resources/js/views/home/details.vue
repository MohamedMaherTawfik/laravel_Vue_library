<template>
    <div class="container mt-10">
        <!-- Category Banner Section -->
        <div
            class="card mb-5 border-0 shadow-sm overflow-hidden"
            style="background-color: #f5f5f5"
        >
            <div class="row g-0 align-items-center">
                <!-- Left Image -->
                <div class="col-md-4">
                    <img
                        :src="`../storage/categorey/${category.image}`"
                        :alt="category.name"
                        @error="handleImageError"
                        alt="Category Image"
                        class="img-fluid rounded-start w-100 h-100 object-fit-cover"
                        style="max-height: 300px"
                    />
                </div>

                <!-- Right Content -->
                <div class="col-md-8">
                    <div class="card-body">
                        <nav class="mb-2 text-muted small">
                            <span>Home</span> &rsaquo;
                            <span>{{ category.name }}</span>
                        </nav>
                        <h2 class="card-title fw-bold mb-1">
                            {{ category.name }}
                        </h2>

                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-dark">
                                {{ category.book.length }}
                                {{
                                    category.book.length === 1
                                        ? "Book"
                                        : "Books"
                                }}</span
                            >
                            <span class="badge bg-success">Free Shipping</span>
                            <span class="badge bg-danger text-white"
                                >New Arrivals</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #f5f5f5 -->
        <!-- Category Books Section -->
    </div>

    <div
        class="d-flex flex-column min-vh-100 text-black"
        style="background-color: #ffffff"
    >
        <!-- Loading State -->
        <div
            v-if="loading"
            class="d-flex justify-content-center align-items-center vh-100"
        >
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3">Loading books...</p>
            </div>
        </div>

        <!-- Error State -->
        <div
            v-else-if="error"
            class="d-flex justify-content-center align-items-center vh-100"
        >
            <div class="text-center">
                <div class="text-danger mb-3">
                    <i class="fas fa-exclamation-triangle fa-3x"></i>
                </div>
                <p>Error loading books: {{ error }}</p>
                <button @click="fetchCategory" class="btn btn-primary mt-3">
                    Try Again
                </button>
            </div>
        </div>

        <!-- Content -->
        <div v-else class="container py-5">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5"
            >
                <div class="mb-3 mb-md-0">
                    <h1 class="fw-bold">{{ category.name }}</h1>
                    <p class="text-muted">
                        Discover our collection of
                        {{ category.name.toLowerCase() }}
                    </p>
                </div>
                <!-- <div class="badge bg-dark text-white rounded-pill p-3">
                    <span class="fs-6">
                        {{ category.book.length }}
                        {{ category.book.length === 1 ? "Book" : "Books" }}
                    </span>
                </div> -->
            </div>

            <div class="row g-4">
                <div
                    class="col-12 col-sm-6 col-lg-4 col-xl-3"
                    v-for="book in category.book"
                    :key="book.id"
                >
                    <ProductCard
                        :title="book.title"
                        :price="book.price"
                        :image="book.image"
                        :author="book.author"
                        :description="book.description"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import ProductCard from "../../components/ProductCard.vue";

export default {
    components: { ProductCard },
    data() {
        return {
            category: { book: [] },
            loading: true,
            error: null,
        };
    },
    created() {
        this.fetchCategory();
    },
    methods: {
        async fetchCategory() {
            this.loading = true;
            this.error = null;

            try {
                const categoryId = this.$route.params.id;
                const response = await axios.get(
                    `http://127.0.0.1:8000/api/categorey/${categoryId}`
                );

                if (response.data.success) {
                    this.category = response.data.data;
                } else {
                    this.error =
                        response.data.message || "Failed to load category";
                }
            } catch (err) {
                this.error =
                    err.response?.data?.message ||
                    err.message ||
                    "Network error";
            } finally {
                this.loading = false;
            }
        },
    },
    watch: {
        "$route.params.id": {
            handler() {
                this.fetchCategory();
            },
            immediate: true,
        },
    },
};
</script>

<style scoped>
/* If any custom styling is needed later */
</style>
