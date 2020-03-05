<template>
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h1>Projet</h1>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="highlight responsive-table">
                    <tbody>
                        <tr>
                            <th>Nom</th>
                            <td>{{ project.name }}</td>
                        </tr>

                        <tr>
                            <th>Description</th>
                            <td>{{ project.description }}</td>
                        </tr>

                        <tr>
                            <th>Date de réalisation</th>
                            <td>{{ project.realisation_date | date }}</td>
                        </tr>

                        <tr>
                            <th>Statut</th>
                            <td>{{ project.status | status }}</td>
                        </tr>

                        <tr>
                            <th>Client</th>
                            <td>{{ project.client_name }}</td>
                        </tr>

                        <tr>
                            <th>Nom du contact</th>
                            <td>{{ project.contact_lastname }}</td>
                        </tr>

                        <tr>
                            <th>Prénom du contact</th>
                            <td>{{ project.contact_firstname }}</td>
                        </tr>

                        <tr>
                            <th>Téléphone du contact</th>
                            <td>{{ project.contact_phone_number }}</td>
                        </tr>

                        <tr>
                            <th>Budget minimum</th>
                            <td>{{ project.budget_min }}</td>
                        </tr>

                        <tr>
                            <th>Budget maximum</th>
                            <td>{{ project.budget_max }}</td>
                        </tr>

                        <tr>
                            <th>Référent</th>
                            <td>{{ referent(project.referent_id) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col s12 center">
                <button class="btn waves-effect waves-light green">se positionner</button>
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
        referent(id) {
            const foundUser = this.users.find(user => user.id === id);

            if (!foundUser) {
                return "Inconnu";
            }

            return `${foundUser.firstname} ${foundUser.lastname}`;
        }
    },
    filters: {
        status(name) {
            switch(name) {
                case "WAITING":
                    return "En attente";

                case "IN_PROGRESS":
                    return "En cours";

                case "DONE":
                    return "Fait";

                default:
                    return "Erreur";
            }
        },
        date(stringDate) {
            const date = new Date(stringDate);

            return `${date.getDate().toString().padStart(2, "0")}/${(date.getMonth() + 1).toString().padStart(2, "0")}/${date.getFullYear()}`;
        }
    },
    created() {
        const options = {
            headers: {
                Authorization: `Bearer ${this.getToken()}`
            }
        };

        axios.get(`/api/v1/projects/${this.$route.params.id}`, options).then(response => {
            this.project = response.data;
        }).catch(this.axiosErrorHandler);

        axios.get("/api/v1/users", options).then(response => {
            this.users = response.data;
        }).catch(this.axiosErrorHandler);
    }
};
</script>
