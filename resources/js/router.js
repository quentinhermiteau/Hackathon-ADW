import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./pages/Home.vue";
import PageNotFound from "./pages/PageNotFound.vue";
import Login from "./pages/Login.vue";
import Projects from "./pages/Projects.vue";

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            component: Home
        },
        {
            path: "/connexion",
            component: Login
        },
        {
            path: "/projets",
            component: Projects
        },
        {
            path: "*",
            component: PageNotFound
        }
    ]
});
