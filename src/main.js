import { createApp } from "vue";
import App from "./App.vue";
import "./registerServiceWorker";
import router from "./router";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import Toaster from "@meforma/vue-toaster";

createApp(App).use(router).use(Toaster).mount("#app");
