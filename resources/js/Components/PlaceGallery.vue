<script setup>
import { ref } from "vue";
import { Carousel, Slide } from "vue3-carousel";

import "vue3-carousel/dist/carousel.css";

const currentSlide = ref(0);

const slideTo = (val) => {
    currentSlide.value = val;
};

const props = defineProps({
    place: {
        required: true,
        type: Object,
    },
});
</script>
<template>
    <div
        v-if="place.details.gallery && place.details.gallery.length > 0"
        class="card mt-3"
    >
        <div class="card-body">
            <h3 class="card-title"><i class="bi bi-images text-primary"></i> Galería</h3>
            <Carousel
                id="gallery"
                class="showing-gallery"
                :items-to-show="1"
                :wrap-around="false"
                v-model="currentSlide"
            >
                <Slide v-for="img in place.details.gallery" :key="img.id">
                    <div class="carousel__item">
                        <img :src="img.file" alt="" />
                    </div>
                </Slide>
            </Carousel>

            <Carousel
                id="thumbnails"
                class="thumbnails-gallery"
                :items-to-show="5"
                :wrap-around="true"
                v-model="currentSlide"
                ref="carousel"
            >
                <Slide
                    v-for="(img, Index) in place.details.gallery"
                    :key="img.id"
                >
                    <div class="carousel__item" @click="slideTo(Index)">
                        <img :src="img.file" alt="" />
                    </div>
                </Slide>
            </Carousel>
        </div>
    </div>
</template>
