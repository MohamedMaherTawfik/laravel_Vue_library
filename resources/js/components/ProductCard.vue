<template>
    <div class="card h-100 border-0 shadow-sm bg-dark bg-opacity-10 text-white">
        <!-- Book Cover -->
        <div class="ratio ratio-4x3">
            <img
                :src="`../storage/books/${image}`"
                :alt="title"
                class="card-img-top object-fit-cover"
                @error="handleImageError"
            />
        </div>

        <!-- Book Details -->
        <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-bold text-black">{{ title }}</h5>
            <p class="text-black-50 small">by {{ author }}</p>

            <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold text-black text-primary"
                    >${{ price.toFixed(2) }}</span
                >
                <button class="btn btn-sm btn-outline-dark">
                    <i class="fas fa-eye"></i>
                    View Details
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            required: true,
        },
        price: {
            type: Number,
            required: true,
        },
        image: {
            type: String,
            required: true,
        },
        author: {
            type: String,
            required: true,
        },
        description: {
            type: String,
            required: true,
        },
    },
    methods: {
        handleImageError(e) {
            e.target.src =
                "https://via.placeholder.com/300x400?text=Book+Cover";
        },
        truncateDescription(text) {
            return text.length > 100 ? text.substring(0, 100) + "..." : text;
        },
    },
};
</script>

<style scoped>
.card {
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
}
</style>
