<template>
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h1>Nouveau projet</h1>
            </div>
        </div>

        <form @submit.prevent="add">
            <div class="row">
                <div class="col s12 input-field">
                    <label for="name">Nom</label>
                    <input type="text" id="name" v-model="project.name">
                </div>
                
                <div class="col s12 input-field">
                    <label for="description">Description</label>
                    <textarea id="description" class="materialize-textarea" v-model="project.description"></textarea>
                </div>

                <div class="col s12 input-field">
                    <label for="realisation_date" class="active">Date de réalisation</label>
                    <input type="date" id="realisation_date" class="materialize-textarea" v-model="project.realisation_date">
                </div>

                <div class="col s12 input-field">
                    <label for="status" class="active">Statut</label>
                    <select class="browser-default" id="status" v-model="project.status">
                        <option value=""> -- Choisissez un statut -- </option>
                        <option value="WAITING">En attente</option>
                        <option value="IN_PROGRESS">En cours</option>
                        <option value="DONE">Terminé</option>
                    </select>
                </div>

                <div class="col s12 input-field">
                    <label for="client_name">Client</label>
                    <input type="text" id="client_name" v-model="project.client_name">
                </div>

                <div class="col s12 input-field">
                    <label for="contact_lastname">Nom du contact</label>
                    <input type="text" id="contact_lastname" v-model="project.contact_lastname">
                </div>
                
                <div class="col s12 input-field">
                    <label for="contact_firstname">Prénom du contact</label>
                    <input type="text" id="contact_firstname" v-model="project.contact_firstname">
                </div>

                <div class="col s12 input-field">
                    <label for="contact_phone_number">Téléphone du contact</label>
                    <input type="tel" id="contact_phone_number" v-model="project.contact_phone_number">
                </div>

                <div class="col s12 input-field">
                    <label for="budget_min">Budget minimum</label>
                    <input type="number" id="budget_min" v-model="project.budget_min">
                </div>

                <div class="col s12 input-field">
                    <label for="budget_max">Budget maximum</label>
                    <input type="number" id="budget_max" v-model="project.budget_max">
                </div>

                <div class="col s12 input-field">
                    <label for="agent_id" class="active">Agent</label>

                    <select class="browser-default" id="agent_id" v-model="project.agent_id">
                        <option value=0> -- Choisissez un agent -- </option>
                        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.lastname }} {{ user.firstname }}</option>
                    </select>
                </div>
                
                <div class="col s12 input-field">
                    <label for="referent_id" class="active">Référent</label>

                    <select class="browser-default" id="referent_id" v-model="project.referent_id">
                        <option value=0> -- Choisissez un référent -- </option>
                        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.lastname }} {{ user.firstname }}</option>
                    </select>
                </div>

                 <div class="col s12 center">
                     <button class="btn waves-effect waves-light green" type="submit">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import axios from "axios";

export default {
    data() {
        return {
            project: {
                name: "",
                description: "",
                realisation_date: "",
                status: "",
                client_name: "",
                contact_lastname: "",
                contact_firstname: "",
                contact_phone_number: "",
                budget_min: "",
                budget_max: "",
                agent_id: 0,
                referent_id: 0
            },
            users: []
        };
    },
    methods: {
        ...mapGetters([
            "getToken"
        ]),
        ...mapActions([
            "axiosErrorHandler"
        ]),
        add() {
            axios.post("/api/v1/projects", this.project, {
                headers: {
                    "Authorization": `Bearer ${this.getToken()}`
                }
            }).then(response => {
                M.toast({
                    html: "Projet créé avec succès",
                    classes: "green"
                });
            }).catch(this.axiosErrorHandler);
        }
    },
    created() {
        axios.get("/api/v1/users", {
            headers: {
                "Authorization": `Bearer ${this.getToken()}`
            }
        }).then(response => {
            this.users = response.data;
        }).catch(this.axiosErrorHandler);
    }
};
</script>
