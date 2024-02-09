import './bootstrap';
import '../css/app.css';

import Search from '@/Components/Search.vue';
import Sorting from '@/Components/Sorting.vue';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'
import { notify } from './Plugins/notify';
import VueApexCharts from 'vue3-apexcharts';

createInertiaApp({
    title: (title) => `Flavorwave | ${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Toast)
            .use(notify)
            .use(VueApexCharts)
            .use(ZiggyVue, Ziggy)
            .component('Search',Search)
            .component('Sorting',Sorting)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
