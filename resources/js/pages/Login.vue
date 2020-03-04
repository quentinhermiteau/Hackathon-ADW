<template>
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h1>Les Agents du Web</h1>
            </div>
        </div>

        <form @submit.prevent="login">
            <div class="row">
                <div class="col s12 input-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" v-model="user.email">
                </div>
            </div>

            <div class="row">
                <div class="col s12 input-field">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" v-model="user.password">
                </div>
            </div>

            <div class="row">
                <div class="col s12 center">
                    <button class="btn waves-effects waves-light green" type="submit">Connexion</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import { mapActions } from "vuex";

export default {
    data() {
        return {
            user: {
                email: "",
                password: ""
            }
        };
    },
    methods: {
        ...mapActions([
            "setToken",
            "axiosErrorHandler"
        ]),
        login() {
            axios.post("/api/v1/login", {
                email: this.user.email,
                password: this.user.password
            }).then(response => {
                this.setToken(response.data);

                M.toast({
                    html: "Connexion réussie",
                    classes: "green"
                });
                
                setTimeout(() => {
                    this.$router.push("/");
                }, 2000);
            }).catch(this.axiosErrorHandler);
        }
    }
};
</script>
