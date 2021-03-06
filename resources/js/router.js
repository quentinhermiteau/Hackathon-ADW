import AdminProject from "./pages/admin/Project.vue";
import AdminProjectNew from "./pages/admin/ProjectNew.vue";
import AdminProjects from "./pages/admin/Projects.vue";
import AdminRequirement from "./pages/admin/Requirement.vue";
import AdminRequirementNew from "./pages/admin/RequirementNew.vue";
import AdminRequirements from "./pages/admin/Requirements.vue";
import AdminUsers from "./pages/admin/Users.vue";
import Formations from "./pages/Formations.vue";
import Home from "./pages/Home.vue";
import Login from "./pages/Login.vue";
import PageNotFound from "./pages/PageNotFound.vue";
import Profil from "./pages/Profil.vue";
import Project from "./pages/Project.vue";
import Projects from "./pages/Projects.vue";
import Registration from "./pages/Registration.vue";
import store from "./store.js";
import Validation from "./pages/Validation.vue";
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/", component: Home },
        { path: "/admin/formation/nouveau", component: AdminRequirementNew },
        { path: "/admin/formations", component: AdminRequirements },
        { path: "/admin/projet/nouveau", component: AdminProjectNew },
        { path: "/admin/projets", component: AdminProjects },
        { path: "/admin/agents", component: AdminUsers },
        { path: "/admin/projet/nouveau", component: AdminProjectNew },
        { path: "/admin/projets", component: AdminProjects },
        { path: "/connexion", component: Login },
        { path: "/inscription", component: Registration },
        { path: "/projets", component: Projects },
        { path: "/formations", component: Formations },
        { path: "/validation", component: Validation },
        { path: "/admin/formation/:id", component: AdminRequirement },
        { path: "/admin/projet/:id", component: AdminProject },
        { path: "/profil", component: Profil },
        { path: "/projet/:id", component: Project },
        { path: "*", component: PageNotFound }
    ]
});

router.beforeEach(function(to, from, next) {
    window.scroll({
        top: 0,
        left: 0,
        behavior: "smooth"
    });

    if (!["/connexion", "/inscription", "/"].includes(to.path) && !store.state.token) {
        M.toast({
            html: "Merci de vous connecter",
            classes: "red"
        });

        next("/connexion");

        return;
    }

    if (["/inscription", "/connexion", "/"].includes(to.path) && store.state.token) {
        M.toast({
            html: "Déjà connecté",
            classes: "orange"
        });

        router.push("/profil");

        return;
    }

    next();
});

export default router;
