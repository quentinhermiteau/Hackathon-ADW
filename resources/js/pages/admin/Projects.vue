<template>
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h1>Projets <router-link to="/admin/projet/nouveau"><button class="btn waves-effect waves-light green">nouveau</button></router-link></h1>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="responsive-table">
                    <thead>
                        <th>Nom</th>
                        <th>Deadline</th>
                        <th>Statut</th>
                        <th>Client</th>
                        <th>Budget min.</th>
                        <th>Budget max.</th>
                        <th>Référent</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                        <tr v-for="project in projects" :key="project.id">
                            <td>{{ project.name }}</td>
                            <td>{{ project.realisation_date | date }}</td>
                            <td>{{ project.status | translate }}</td>
                            <td>{{ project.client_name }}</td>
                            <td>{{ project.budget_min }}</td>
                            <td>{{ project.budget_max }}</td>
                            <td>{{ project.referent.lastname }} {{ project.referent.firstname }}</td>

                            <td class="actions">
                                <router-link :to="getAdminProjectViewLink(project.id)">
                                    <i class="material-icons orange-text cursors">edit</i>
                                </router-link>

                                <i class="material-icons red-text cursors modal-trigger" :data-target="getModalDeleteIdentifier(project.id)">delete_forever</i>

                                <!-- Modal Structure -->
                                <div :id="getModalDeleteIdentifier(project.id)" class="modal">
                                    <div class="modal-content">
                                        <h4>Confirmation de suppression</h4>
                                        <p>Une fois que le projet est supprimé, il n'est pas possible de retourner en arrière. Êtes-vous sûr de vouloir continuer ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
                                        <a @click="remove(project.id)" href="#!" class="modal-close waves-effect waves-light btn red">Supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
            projects: []
        };
    },
    methods: {
        ...mapGetters([
            "getToken"
        ]),
        ...mapActions([
            "axiosErrorHandler"
        ]),
        getAdminProjectViewLink(id) {
            return `/admin/projet/${id}`;
        },
        remove(id) {
            axios.delete(`/api/v1/projects/${id}`, {
                headers: {
                    "Authorization": `Bearer ${this.getToken()}`
                },
                data: {
                    id
                }
            }).then(response => {
                M.toast({
                    html: "Projet supprimé",
                    classes: "green"
                });

                return axios.get("/api/v1/projects", {
                    headers: {
                        Authorization: `Bearer ${this.getToken()}`
                    }
                }).then(response => {
                    this.projects = response.data;
                });
            }).catch(this.axiosErrorHandler);
        },
        getModalDeleteIdentifier(id) {
            return `modal-delete-${id}`;
        }
    },
    filters: {
        translate(status) {
            switch (status) {
                case "WAITING":
                    return "En attente";

                case "IN_PROGRESS":
                    return "En cours";

                case "DONE":
                    return "Terminé";

                default:
                    return "Erreur";
            }
        },
        date(stringDate) {
            const date = new Date(stringDate);

            return `${(date.getDate()).toString().padStart(2, "0")}/${(date.getMonth() + 1).toString().padStart(2, "0")}/${date.getFullYear()}`;
        }
    },
    created() {
        axios.get("/api/v1/projects", {
            headers: {
                "Authorization": `Bearer ${this.getToken()}`
            }
        }).then(response => {
            this.projects = response.data; 
            this.$nextTick(() => {
                M.Modal.init(document.querySelectorAll(".modal"), {});
            });
        }).catch(this.axiosErrorHandler);
    }
};
</script>
