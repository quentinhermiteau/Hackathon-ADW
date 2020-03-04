import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./pages/Home.vue";
import PageNotFound from "./pages/PageNotFound.vue";
import Login from "./pages/Login.vue";
import Projects from "./pages/Projects.vue";
import store from "./store.js";

Vue.use(VueRouter);

const router = new VueRouter({
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

router.beforeEach(function(to, from, next) {
    if (to.path !== "/connexion" && !store.state.token) {
        M.toast({
            html: "Merci de vous connecter",
            classes: "red"
        });

        next("/connexion");

        return;
    }

    if (to.path === "/connexion" && store.state.token) {
        M.toast({
            html: "Déjà connecté",
            classes: "orange"
        });

        next(from.path);

        return;
    }

    next();
});

export default router;
