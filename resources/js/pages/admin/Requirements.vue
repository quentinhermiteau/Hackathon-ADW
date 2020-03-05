<template>
    <div class="container">
        <div class="col s12 center">
            <h1>Gestion des formations</h1>
        </div>
        
        <table class="striped centered">
            <thead>
                <th>
                    <div class="input-field">
                        <label for="name">Nom</label>
                        <input type="text" id="name" v-model="search.name"/>
                    </div>
                </th>
                <th>
                    <div class="input-field">
                        <label for="link">Lien</label>
                        <input type="text" id="link" v-model="search.link"/>
                    </div>
                </th>
                <th>Spécialisation</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <tr v-bind:key="requirement.id" v-for="requirement in filterRequirements">
                    <td>{{requirement.name}}</td>
                    <td>{{requirement.link}}</td>
                    <select class="browser-default" v-model="requirement.specialization_id">
                        <option :value="specialization.id" v-bind:key="specialization.id" v-for="specialization in specializations">
                            {{specialization.name}}
                        </option>
                    </select>
                    <td class="actions">
                        <i class="material-icons tooltipped orange-text cursors" data-position="bottom" data-tooltip="Modifier" v-on:click="updateRequirement(requirement)">edit</i>
                        <i class="material-icons tooltipped red-text cursors" data-position="bottom" data-tooltip="Supprimer" v-on:click="deleteRequirement(requirement)">delete</i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
import axios from 'axios';
import {mapGetters, mapActions} from 'vuex';

export default {
    data() {
        return {
            requirements: [],
            specializations: [],
            search: {
                name: '',
                link: ''
            }
        };
    },
    created() {
        this.getRequirements();
        this.getSpecializations();
    },
    computed: {
        filterRequirements() {
            return this.requirements.filter(requirement => {
                return requirement.name.includes(this.search.name) &&
                requirement.link.includes(this.search.link)
            }).sort((requirementA, requirementB) => {
                return new Date(requirementA.created_at) > new Date(requirementB.created_at);
            });
        }
    },
    methods: {
        ...mapGetters(['getToken']),
        ...mapActions(['axiosErrorHandler']),
        getSpecializations() {
            axios({
                method: 'GET',
                url: '/api/v1/specializations',
                headers: {
                    Authorization: `Bearer ${this.getToken()}`
                }
            }).then(response => {
                this.specializations = response.data;
            }).catch(this.axiosErrorHandler);
        },
        getRequirements() {
            axios({
                method: 'GET',
                url: '/api/v1/requirements',
                headers: {
                    Authorization: `Bearer ${this.getToken()}`
                }
            }).then(response => {
                this.requirements = response.data;
            }).catch(this.axiosErrorHandler)
        },
        updateRequirement(requirement) {
            axios({
                method: 'PUT',
                url: `/api/v1/requirements/${requirement.id}`,
                data: requirement,
                headers: {
                    Authorization: `Bearer ${this.getToken()}`
                }
            }).then(response => {
                M.toast({html: 'Formation modifiée avec succès.', classes: 'green'});
            }).catch(this.axiosErrorHandler)
        },
        deleteRequirement(requirement) {
            axios({
                method: 'DELETE',
                url: `/api/v1/requirements/${requirement.id}`,
                data: requirement,
                headers: {
                    Authorization: `Bearer ${this.getToken()}`
                }
            }).then(response => {
                M.toast({html: 'Formation supprimée avec succès.', classes: 'green'});
                this.getRequirements();
            }).catch(this.axiosErrorHandler)
        }
    }
}
</script>