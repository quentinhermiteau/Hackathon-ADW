<template>
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h1>Projet</h1>
            </div>
        </div>

        <div class="row">
            <div class="col s12 input-field">
                <label for="name">Nom</label>
                <input type="text" v-model="project.name" id="name">
            </div>

            <div class="col s12 input-field">
                <label for="description">Description</label>
                <input type="text" v-model="project.description" id="description">
            </div>
            
            <div class="col s12 input-field">
                <label for="realisation_date">Date de réalisation</label>
                <input type="text" v-model="project.realisation_date" id="realisation_date">
            </div>

            <div class="col s12 input-field">
                <label for="status" class="active">Statut</label>

                <select class="browser-default" v-model="project.status" id="status">
                    <option value="WAITING">En attente</option>
                    <option value="IN_PROGRESS">En cours</option>
                    <option value="DONE">Fait</option>
                </select>
            </div>

            <div class="col s12 input-field">
                <label for="client_name">Nom du client</label>
                <input type="text" v-model="project.client_name" id="client_name">
            </div>

            <div class="col s12 input-field">
                <label for="contact_firstname">Prénom du contact</label>
                <input type="text" v-model="project.contact_firstname" id="contact_firstname">
            </div>

            <div class="col s12 input-field">
                <label for="contact_lastname">Nom du contact</label>
                <input type="text" v-model="project.contact_lastname" id="contact_lastname">
            </div>

            <div class="col s12 input-field">
                <label for="contact_phone_number">Téléphone du contact</label>
                <input type="text" v-model="project.contact_phone_number" id="contact_phone_number">
            </div>

            <div class="col s12 input-field">
                <label for="budget_min">Budget minimum</label>
                <input type="text" v-model="project.budget_min" id="budget_min">
            </div>

            <div class="col s12 input-field">
                <label for="budget_max">Budget maximum</label>
                <input type="text" v-model="project.budget_max" id="budget_max">
            </div>

            <div class="col s12 input-field">
                <label for="referent_id" class="active">Référent</label>

                <select class="browser-default" id="referent_id" v-model="project.referent_id">
                    <option v-for="user in users" :value="user.id">{{ user.lastname }} {{ user.firstname}}</option>
                </select>
            </div>

            <div class="col s12 center">
                <button @click="update" class="btn waves-effect waves-light orange">Modifier</button>
                <button class="btn waves-effect waves-light red modal-trigger" data-target="destroy">Supprimer</button>

                 <!-- Modal Structure -->
                 <div id="destroy" class="modal">
                     <div class="modal-content">
                         <h4>Confirmation de suppression</h4>
                        <p>Une fois que le projet est supprimé, il n'est pas possible de retourner en arrière. Êtes-vous sûr de vouloir continuer ?</p>
                     </div>
                     <div class="modal-footer">
                         <a href="#!" class="modal-close waves-effect waves-light btn-flat">Annuler</a>
                         <a href="#!" @click.prevent="destroy" class="modal-close waves-effect waves-light btn red">Supprimer</a>
                     </div>
                 </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

import { mapGetters, mapActions } from "vuex";

export default {
    data() {
        return {
            project: {
                name: "",
                description: "",
                realisation_date: "",
                status: "",
                client_name: "",
                contact_firstname: "",
                contact_lastname: "",
                contact_phone_number: "",
                budget_min: "",
                budget_max: "",
                referent_id: ""
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
        update() {
            axios({
                method: "PUT",
                url: `/api/v1/projects/${this.$route.params.id}`,
                headers: {
                    "Authorization": `Bearer ${this.getToken()}`
                },
                data: this.project
            }).then(response => {
                M.toast({
                    html: "Projet mis à jour",
                    classes: "green"
                });
            }).catch(this.axiosErrorHandler);
        },
        destroy() {
            axios.delete(`/api/v1/projects/${this.$route.params.id}`, {
                headers: {
                    "Authorization": `Bearer ${this.getToken()}`
                },
                data: {
                    id: this.$route.params.id
                }
            }).then(response => {
                this.$router.push("/admin/projets");

                M.toast({
                    html: "Projet supprimé avec succès",
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

        axios.get(`/api/v1/projects/${this.$route.params.id}`, {
            headers: {
                Authorization: `Bearer ${this.getToken()}`
            }
        }).then(response => {
            this.project = response.data;

            this.$nextTick(() => {
                M.updateTextFields();
                M.Sidenav.init(document.querySelectorAll(".sidenav"), {});
            });
            
        }).catch(this.axiosErrorHandler);
    }
};
</script>
