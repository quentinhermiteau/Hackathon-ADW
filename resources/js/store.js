import Vue from "vue";
import VueX, { Store } from "vuex";
import router from "./router.js";

Vue.use(VueX);

export default new Store({
    state: {
        token: window.localStorage.getItem("token"),
        role: window.localStorage.getItem("role")
    },
    mutations: {
        SET_TOKEN(state, token) {
            state.token = token;

            if (!token) {
                window.localStorage.removeItem("token");
            } else {
                window.localStorage.setItem("token", token);
            }
        },
        SET_ROLE(state, role) {
            state.role = role;

            if (!role) {
                window.localStorage.removeItem("role");
            } else {
                window.localStorage.setItem("role", role);
            }
        }
    },
    actions: {
        setToken(context, token) {
            context.commit("SET_TOKEN", token);
        },
        setRole(context, role) {
            context.commit("SET_ROLE", role);
        },
        axiosErrorHandler(context, error) {
            console.log(error);

            if (error.response.status === 403) {
                M.toast({
                    html: "Vous n'avez pas les autorisations nécessaires pour effectuer cette action",
                    classes: "red"
                });

                router.push("/");

                return;
            }

            if (error.response.status === 422) {
                M.toast({
                    html: Object.values(error.response.data.errors)[0][0],
                    classes: "red"
                });
                
                return;
            }

            if (error.response.status === 498) {
                M.toast({
                    html: "Session expirée",
                    classes: "red"
                });

                context.commit("SET_TOKEN", null);

                router.push("/connexion");
                
                return;
            }

            if (error.response.status === 401) {
                M.toast({
                    html: "Identifiants invalides",
                    classes: "red"
                });

                return;
            }

            M.toast({
                html: "Erreur innatendue, merci de réessayer plus tard",
                classes: "red"
            });
        }
    },
    getters: {
        getToken(state) {
            return state.token;
        },
        getRole(state) {
            return state.role;
        }
    }
});
