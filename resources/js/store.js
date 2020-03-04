import Vue from "vue";
import VueX, { Store } from "vuex";
import M from "materialize-css";
import router from "./router.js";


Vue.use(VueX);

export default new Store({
    state: {
        token: window.localStorage.getItem("token")
    },
    mutations: {
        SET_TOKEN(state, token) {
            state.token = token;

            window.localStorage.setItem("token", token);
        }
    },
    actions: {
        setToken(context, token) {
            context.commit("SET_TOKEN", token);
        },
        axiosErrorHandler(context, error) {
            console.log("ERROR HANDLER");

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
        }
    }
});
