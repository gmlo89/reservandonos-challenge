import { createRouter, createWebHashHistory } from 'vue-router';

import Places from '@/Components/Places.vue';
import PlaceDetail from '@/Components/PlaceDetail.vue';

const routes = [
    {
        path: '/', component: Places, name: 'home'
    },
    {
        path: '/place/:placeId', component: PlaceDetail, name: 'place'
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

export default router;