<script setup>
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";

import ReservationForm from './ReservationForm.vue';
import LikeButton from "./LikeButton.vue";


const route_ = useRoute();

const place = ref(null);

onMounted(() => {
    axios
        .get(route("api.places.detail", route_.params.placeId))
        .then((response) => {
            place.value = response.data.place;
        });
});
</script>
<template>
    <div v-if="place">
        <h2>{{ place.details.name }}</h2>
        <div class="row">
            <div class="col-4">
                <ReservationForm :place="place" />
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Horarios</h5>
                        <ul>
                            <li
                                v-for="(schedule, Index) in place.details
                                    .schedules"
                                :key="Index"
                            >
                                {{ schedule.weekday }}
                                {{ schedule.start }} -
                                {{ schedule.end }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Amenidades</h5>
                        <ul>
                            <li
                                v-for="amenity in place.details.amenities"
                                :key="amenity.id"
                                v-text="amenity.name"
                            ></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <img
                            :src="place.details.main_img"
                            :alt="place.details.name"
                            class="img-fluid"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
