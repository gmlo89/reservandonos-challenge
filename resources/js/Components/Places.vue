<script setup>
import { computed, onMounted, ref } from "vue";
import PlaceSmallView from './PlaceSmallView.vue';

const places = ref([]);

const nextPage = ref(route("api.places"));

const loading = ref(false);

const requestNewPage = () => {
    loading.value = true;
    axios.get(nextPage.value).then((response) => {
        places.value = _.concat(places.value, response.data.data.places);
        nextPage.value = response.data.data.nextPage;
        loading.value = false;
    });
};

onMounted(() => requestNewPage());

const rows = computed(() => {
    return _.chunk(places.value, 3);
});
</script>
<template>
    <div class="row mb-5" v-for="(row, Index) in rows" :key="Index">
        <div class="col-4" v-for="place in row" :key="place.id">
            <PlaceSmallView :place="place" />
        </div>
    </div>
    <div class="row mt-2 mb-5">
        <div class="col-12 text-end">
            <button
                type="button"
                class="btn btn-primary rounded-pill"
                :disabled="loading"
                v-if="nextPage"
                @click="requestNewPage"
            >
                Ver más
            </button>
        </div>
    </div>
</template>
