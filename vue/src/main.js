import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import { autoAnimatePlugin } from "@formkit/auto-animate/vue";
import "vue-toastification/dist/index.css";
import Toast from "vue-toastification";
import { createPinia } from "pinia";

const toastificationOptions = {
    transition: "Vue-Toastification__fade",
    maxToasts: 4,
    newestOnTop: true,
};

const pinia = createPinia();

createApp(App)
    .use(autoAnimatePlugin)
    .use(Toast, toastificationOptions)
    .use(pinia)
    .mount("#app");
