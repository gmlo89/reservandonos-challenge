import './bootstrap';

import './../scss/app.scss';
import 'bootstrap-icons/font/bootstrap-icons.css'

import { createApp, h } from 'vue';
import App from '@/Components/App.vue';
import router from './router';

createApp(App).use(router).mount('#app')