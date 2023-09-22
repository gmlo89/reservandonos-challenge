<script setup>
import { ref } from "vue";
import Swal from "sweetalert2";

const props = defineProps({
    place: {
        required: true,
        type: Object,
    },
});

const form = ref({
    name: null,
    lastName: null,
    date: null,
    time: null,
    placeId: props.place.id,
});

const isLoading = ref(false);

const errorMessage = ref(null);

const sendForm = () => {
    errorMessage.value = null;
    isLoading.value = true;
    axios
        .post(route("reservation.store"), form.value)
        .then((response) => {
            isLoading.value = false;
            Swal.fire({
                title: "¡Felicidades!",
                text: "Tu reservación se ha realizado con éxito",
                icon: "success",
            });
        })
        .catch((error) => {
            isLoading.value = false;
            errorMessage.value = error.response.data.message;
        });
};
</script>
<template>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">
                <i class="bi bi-calendar2-heart"></i> Reservar
            </h5>
            <div class="alert alert-warning" role="alert" v-if="errorMessage">
                {{ errorMessage }}
            </div>
            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    id="inputName"
                    v-model="form.name"
                />
                <label for="inputName">Nombre</label>
            </div>
            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    id="inputLastName"
                    v-model="form.lastName"
                />
                <label for="inputLastName">Apellido</label>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input
                            type="date"
                            class="form-control"
                            id="inputDate"
                            v-model="form.date"
                        />
                        <label for="inputDate">Fecha</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input
                            type="time"
                            class="form-control"
                            id="inputTime"
                            @input="(event) => (form.time = event.target.value)"
                        />
                        <label for="inputTime">Hora</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer d-grid gap-2">
            <button type="button" class="btn btn-primary rounded-0" @click="sendForm">
                Reservar
            </button>
        </div>
    </div>
</template>
