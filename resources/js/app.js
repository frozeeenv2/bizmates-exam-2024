import "./bootstrap";

import { createApp } from "vue";
import App from "./app.vue";

const app = createApp(App);

app.provide("countryData", window.countryData);
app.mount("#app");
