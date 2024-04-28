import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist';
import '../css/app.css';
import CKEditor from '@ckeditor/ckeditor5-vue';
import {Ziggy} from "./ziggy.js";

// ----------------start_of_Handling_Resize-------------
function handleResize() {
    if (window.innerWidth > 768){
        window.scrollTo(0, 0);
    }
}
window.addEventListener('resize', handleResize);

// ----------------end_of_Handling_Resize-------------

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use( CKEditor )
            .use(ZiggyVue, Ziggy)
            .mount(el)
    },
})
