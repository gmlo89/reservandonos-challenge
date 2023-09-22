import { createRouter, createWebHashHistory } from 'vue-router';

import Places from '@/Components/Places.vue';
import PlaceDetail from '@/Components/PlaceDetail.vue';
import Records from '@/Components/Records.vue';

const routes = [
    {
        path: '/', component: Places, name: 'home'
    },
    {
        path: '/place/:placeId', component: PlaceDetail, name: 'place'
    },
    {
        path: '/records', component: Records, name: 'records'
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

export default router;