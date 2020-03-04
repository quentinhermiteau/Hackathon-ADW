import Vue from "vue";
import VueX, { Store } from "vuex";

Vue.use(VueX);

export default new Store({
    state: {
        token: null
    },
    mutations: {
        SET_TOKEN(state, token) {
            state.token = token;
        }
    },
    actions: {
        setToken(context, token) {
            context.commit("SET_TOKEN", token);
        }
    },
    getters: {
        getToken(state) {
            return state.token;
        }
    }
});
