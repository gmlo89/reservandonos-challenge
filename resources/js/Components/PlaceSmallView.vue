<script setup>
import { computed } from "vue";
import LikeButton from "./LikeButton.vue";

const props = defineProps({
    place: {
        required: true,
        type: Object,
    },
    isSmallVersion: {
        required: false,
        type: Boolean,
        default: false
    }
});

const imgUrl = computed(() => {
    return props.place.image_url ?? props.place.img_url;
})
</script>
<template>
    <div class="card-place">
        <div class="image-container">
            <LikeButton :place="place" />
            <img :src="imgUrl" :alt="place.name" />
        </div>
        <div class="card-body">
            <div class="row logo-and-name d-flex align-items-center">
                <div class="col-2" v-if="!isSmallVersion">
                    <img
                        :src="place.logo_url"
                        :alt="place.name"
                        class="img-fluid"
                    />
                </div>
                <div :class="{ 'col-10': !isSmallVersion, 'col-12': isSmallVersion }">
                    <h5 class="card-title">
                        <router-link
                            :to="{
                                name: 'place',
                                params: { placeId: place.id },
                            }"
                            >{{ place.name }}</router-link
                        >
                    </h5>
                </div>
            </div>
            <div class="row my-2" v-if="!isSmallVersion">
                <div class="col-6 text-truncate">
                    <i class="bi bi-tags-fill text-pink"></i>
                    {{ place.categories }}
                </div>
                <div class="col-6 text-end">
                    <i class="bi bi-clock-fill text-blue"></i>
                    {{ place.schedule }}
                </div>
            </div>

            <div class="row d-flex align-items-center justify-content-between" v-if="!isSmallVersion">
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
