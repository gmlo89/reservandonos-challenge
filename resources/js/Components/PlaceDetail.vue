<script setup>
import { computed, onMounted, ref, watch } from "vue";
import { useRoute } from "vue-router";
import PlaceSmallView from "./PlaceSmallView.vue";

import ReservationForm from "./ReservationForm.vue";
import PlaceGallery from "./PlaceGallery.vue";

const route_ = useRoute();

const place = ref(null);

watch(
    () => route_.params.placeId,
    (newId) => {
        getPlace(newId);
    }
);
onMounted(() => {
    getPlace(route_.params.placeId);
});

const getPlace = (placeId) => {
    axios.get(route("api.places.detail", placeId)).then((response) => {
        place.value = response.data.place;
    });
};

const closerPlaces = computed(() => {
    if (!place.value) return [];
    return _.take(place.value.details.closer_places, 3);
});
</script>
<template>
    <div v-if="place" class="place-detail">
        <div class="card mb-4 place-header">
            <div class="card-body">
                <h2>{{ place.details.name }}</h2>
                <p>
                    <a
                        target="_blank"
                        class="me-3"
                        :href="`https://maps.google.com?q=${place.details.geolocation.latitude},${place.details.geolocation.longitude}`"
                        ><i class="bi bi-geo-alt-fill"></i>
                        <span>{{
                            place.details.geolocation.text_direction
                        }}</span></a
                    >
                    <a :href="`tel:${place.details.schema.telephone}`"
                        ><i class="bi bi-telephone-fill"></i>
                        <span>{{ place.details.schema.telephone }}</span></a
                    >
                </p>
                <p v-if="place.details.categories.length > 0">
                    <span
                        class="badge rounded-pill text-bg-primary me-1"
                        v-for="category in place.details.categories"
                        :key="category.id"
                        v-text="category.name"
                    ></span>
                </p>
                <p>
                    <i class="bi bi-cash text-success"></i>
                    {{ place.details.range_price }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <ReservationForm :place="place" />
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-clock-history"></i> Horarios
                        </h5>
                        <ul class="list-unstyled ps-3">
                            <li
                                v-for="(schedule, Index) in place.details
                                    .schedules"
                                :key="Index"
                                class="d-flex justify-content-between"
                            >
                                <span class="text-capitalize fw-light">{{
                                    schedule.weekday
                                }}</span>
                                <span>
                                    {{ schedule.start }} -
                                    {{ schedule.end }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-list-check"></i> Amenidades
                        </h5>
                        <ul class="list-unstyled ps-3">
                            <li
                                v-for="amenity in place.details.amenities"
                                :key="amenity.id"
                                class="d-flex align-items-center"
                            >
                                <i
                                    class="bi bi-check2-circle me-2 text-primary"
                                ></i>
                                <span>{{ amenity.name }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="main-img-container">
                            <img
                                class="logo"
                                :src="place.details.logo_img"
                                alt="logo"
                            />
                            <img
                                :src="place.details.main_img"
                                :alt="place.details.name"
                                class="img-fluid main-img"
                            />
                        </div>
                    </div>
                    <div
                        class="card-body"
                        v-html="place.details.description"
                    ></div>
                </div>
                <PlaceGallery :place="place" />
            </div>
        </div>
        <hr />
        <h3 class="my-3">
            <i class="bi bi-shop-window text-primary"></i> Otros lugares cercas
        </h3>
        <div class="row">
            <div class="col-4" v-for="other in closerPlaces" :key="other.id">
                <PlaceSmallView is-small-version :place="other" />
            </div>
        </div>
    </div>
</template>
