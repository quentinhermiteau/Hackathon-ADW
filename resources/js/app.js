import Vue from "vue";
import App from "./App.vue";
import router from "./router.js";
import store from "./store.js";

window.addEventListener("load", function() {
    if (!document.getElementById("app")) {
        throw new ReferenceError("Missing <div id='app'></div>");
    }

    new Vue({
        el: "#app",
        router,
        store,
        render(createElement) {
            return createElement(App);
        }
    });
});
