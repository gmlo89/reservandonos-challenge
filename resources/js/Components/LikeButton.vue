<script setup>
import { onMounted, ref } from "vue";
import { useReward } from "vue-rewards";

const props = defineProps({
    place: {
        required: true,
        type: Object,
    },
});

const id = ref("likeButton" + props.place.id);

const isLoading = ref(false);

const sendLike = () => {
    isLoading.value = true;
    axios
        .put(route("api.places.like"), {
            placeId: props.place.id,
        })
        .then((response) => {
            isLoading.value = false;
            const { reward, isAnimating } = useReward(id.value, "confetti", {
                startVelocity: 10,
                spread: 180,
                elementCount: 100,
                position: 'absolute'
            });
            reward();
        });
};
</script>
<template>
    <button type="button" class="like-button" @click="sendLike" :id="id" :disabled="isLoading">
        <i class="bi bi-heart-fill"></i>
    </button>
</template>
