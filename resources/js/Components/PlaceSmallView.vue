<script setup>
import LikeButton from './LikeButton.vue';


const props = defineProps({
    place: {
        required: true,
        type: Object,
    },
});
</script>
<template>
    <div class="card-place">
        <div class="image-container">
            <LikeButton :place="place" />
            <img :src="place.image_url" :alt="place.name" />
        </div>
        <div class="card-body">
            <div class="row logo-and-name d-flex align-items-center">
                <div class="col-2">
                    <img
                        :src="place.logo_url"
                        :alt="place.name"
                        class="img-fluid"
                    />
                </div>
                <div class="col-10">
                    <h5 class="card-title">
                        {{ place.name }}
                    </h5>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-6 text-truncate">
                    <i class="bi bi-tags-fill text-pink"></i>
                    {{ place.categories }}
                </div>
                <div class="col-6 text-end">
                    <i class="bi bi-clock-fill text-blue"></i>
                    {{ place.schedule }}
                </div>
            </div>

            <div class="row d-flex align-items-center justify-content-between">
                <div class="col-6">
                    <span class="score-badge"
                        ><i class="bi bi-star-fill"></i> {{ place.score }}</span
                    >
                    <span
                        ><i class="bi bi-cash text-success"></i>
                        {{ place.price_range }}</span
                    >
                </div>
                <div class="col-6 text-truncate">
                    <span
                        ><i class="bi bi-geo-alt-fill text-warning"></i>
                        {{ place.location }}</span
                    >
                </div>
            </div>
        </div>
    </div>
</template>
