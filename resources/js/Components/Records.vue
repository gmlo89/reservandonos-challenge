<script setup>
import { computed, onMounted, ref } from "vue";

const places = ref([]);

const filters = ref({
    placeName: null,
    reservationsCount: null,
    likesCount: null,
    preferredCustomerName: null,
});

const rows = computed(() => {
    return _.filter(places.value, (item) => {
        
        if( filters.value.placeName && !item.name.includes(filters.value.placeName) )
            return false;
        if( filters.value.preferredCustomerName && !item.preferredCustomerName.includes(filters.value.preferredCustomerName) )
            return false;

        if( filters.value.reservationsCount && item.reservationsCount !== filters.value.reservationsCount )
            return false;
        
        if( filters.value.likesCount && item.likes !== filters.value.likesCount )
            return false;

        return true;
    });
});

onMounted(() => {
    axios.get(route("api.places.top-50")).then((response) => {
        places.value = response.data.data;
    });
});
</script>
<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Records</h5>
            <table class="table table-striped">
                <thead>
                    <tr class="table-primary">
                        <th class="text-center">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputPlaceName"
                                    placeholder="Filtrar"
                                    v-model="filters.placeName"
                                />
                                <label for="inputPlaceName">Lugar</label>
                            </div>
                        </th>
                        <th class="text-center">
                            <div class="form-floating mb-3">
                                <input
                                    type="number"
                                    class="form-control"
                                    id="inputReservationsCount"
                                    placeholder="Filtrar"
                                    v-model="filters.reservationsCount"
                                />
                                <label for="inputReservationsCount">Reservaciones</label>
                            </div>
                        </th>
                        <th class="text-center">
                            <div class="form-floating mb-3">
                                <input
                                    type="number"
                                    class="form-control"
                                    id="inputLikes"
                                    placeholder="Filtrar"
                                    v-model="filters.likesCount"
                                />
                                <label for="inputLikes">Likes</label>
                            </div>
                        </th>
                        <th class="text-center">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputPreferredCustomer"
                                    placeholder="Filtrar"
                                    v-model="filters.preferredCustomerName"
                                />
                                <label for="inputPreferredCustomer">Cliente Preferido</label>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="rows.length == 0">
                        <td colspan="4" class="text-center text-muted">
                            - No hay registros para mostrar -
                        </td>
                    </tr>
                    <tr v-for="row in rows" :key="row.id">
                        <td>{{ row.name }}</td>
                        <td class="text-center">{{ row.reservationsCount }}</td>
                        <td class="text-center">{{ row.likes }}</td>
                        <td>{{ row.preferredCustomerName }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
