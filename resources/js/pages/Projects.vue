<template>
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h1>Projets</h1>
            </div>
        </div>

        <div class="row">
            <div class="col s12 center">
                <table class="responsive-table">
                    <thead>
                        <th>Nom</th>
                        <th>Deadline</th>
                        <th>Statut</th>
                        <th>Client</th>
                        <th>Budget min.</th>
                        <th>Budget max.</th>
                        <th>Référent</th>
                    </thead>
                    
                    <tbody>
                        <tr v-for="project in projects" :key="project.id">
                            <td>{{ project.name }}</td>
                            <td>{{ project.realisation_date }}</td>
                            <td>{{ project.statut }}</td>
                            <td>{{ project.client_name }}</td>
                            <td>{{ project.budget_min }}</td>
                            <td>{{ project.budget_max }}</td>
                            <td>{{ project.referent_id }}</td>
                            <td class="actions">
                                <router-link :to="getProjectRoute(project.id)">
                                    <i class="material-icons cursors black-text">remove_red_eye</i>
                                </router-link>

                                <i class="material-icons cursors">pan_tool</i>
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
        getProjectRoute(id) {
            return `/projet/${id}`;
        }
    },
    created() {
        axios.get("api/v1/projects", {
            headers: {
                Authorization: `Bearer ${this.getToken()}`
            }
        }).then(response => {
            this.projects = response.data;
        }).catch(this.axiosErrorHandler);
    }
};
</script>
