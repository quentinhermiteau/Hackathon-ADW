import AdminProject from "./pages/admin/Project.vue";
import AdminProjectNew from "./pages/admin/ProjectNew.vue";
import AdminProjects from "./pages/admin/Projects.vue";
import AdminUsers from "./pages/admin/Users.vue";
import Agents from "./pages/Agents.vue";
import Home from "./pages/Home.vue";
import Login from "./pages/Login.vue";
import PageNotFound from "./pages/PageNotFound.vue";
import Profil from "./pages/Profil.vue";
import Project from "./pages/Project.vue";
import Projects from "./pages/Projects.vue";
import Vue from "vue";
import VueRouter from "vue-router";
import store from "./store.js";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "*", component: PageNotFound },
        { path: "/", component: Home },
        { path: "/admin/projet/:id", component: AdminProject },
        { path: "/admin/projet/nouveau", component: AdminProjectNew },
        { path: "/admin/projets", component: AdminProjects },
        { path: "/admin/users", component: AdminUsers },
        { path: "/agents", component: Agents },
        { path: "/connexion", component: Login },
        { path: "/profil/:id", component: Profil },
        { path: "/projet/:id", component: Project },
        { path: "/projets", component: Projects }
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
