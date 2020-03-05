<template>
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h1>Inscription</h1>
            </div>
        </div>

        <form @submit.prevent="register">
            <div class="row">
                <div class="col s12 input-field">
                    <label for="lastname">Nom</label>
                    <input type="text" id="lastname" v-model="user.lastname">
                </div>
            </div>

            <div class="row">
                <div class="col s12 input-field">
                    <label for="firstname">Prénom</label>
                    <input type="text" id="firstname" v-model="user.firstname">
                </div>
            </div>

            <div class="row">
                <div class="col s12 input-field">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" v-model="user.email">
                </div>
            </div>

            <div class="row">
                <div class="col s12 input-field">
                    <label for="birthday" class="activate">Date de naissance</label>
                    <input type="date" id="birthday" v-model="user.birthday">
                </div>
            </div>

            <div class="row">
                <div class="col s12 input-field">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" v-model="user.password">
                </div>
            </div>

            <div class="row">
                <div class="col s12 input-field">
                    <label for="password_confirmation">Confirmation de mot de passe</label>
                    <input type="password" id="password_confirmation" v-model="user.password_confirmation">
                </div>
            </div>

            <div class="col s12 input-field">
                <label for="specialization_id" class="active">Spécialisation</label>
                <select class="browser-default" id="specialization_id" v-model="user.specialization_id">
                    <option value=0 selected> -- Choisissez une spécialisation -- </option>
                    <option value=1>Conseil</option>
                    <option value=2>Créatif</option>
                    <option value=3>Content</option>
                    <option value=4>Digital</option>
                    <option value=5>Acquisition</option>
                    <option value=6>Event</option>
                </select>
            </div>

            <div class="row">
                <div class="col s12 center">
                    <button type="submit" class="btn waves-effect waves-light green">S'inscrire</button>
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
                lastname: "",
                firstname: "",
                email: "",
                birthday: "",
                password: "",
                password_confirmation: ""
            }
        };
    },
    methods: {
        ...mapActions([
            "axiosErrorHandler"
        ]),
        register() {
            axios.post("/api/v1/registration", this.user).then(response => {
                M.toast({
                    html: "Inscription réussie, redirection...",
                    classes: "green"
                });

                setTimeout(() => {
                    this.$router.push("/connexion");
                }, 2000);
            }).catch(this.axiosErrorHandler);
        }
    } 
};
</script>
