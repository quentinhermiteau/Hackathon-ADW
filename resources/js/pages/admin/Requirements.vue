<template>
    <div class="container">
        <div class="col s12 center">
            <h1>Gestion des formations <router-link to="/admin/formation/nouveau"><button class="btn waves-effect waves-light green">nouveau</button></router-link></h1>
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
                        <router-link :to="getAdminRequirementViewLink(requirement.id)">
                            <i class="material-icons orange-text cursors">edit</i>
                        </router-link>
                        <i class="material-icons red-text cursors modal-trigger" :data-target="getModalDeleteIdentifier(requirement.id)">delete_forever</i>

                        <!-- Modal Structure -->
                        <div :id="getModalDeleteIdentifier(requirement.id)" class="modal">
                            <div class="modal-content">
                                <h4>Confirmation de suppression</h4>
                                <p>Une fois que la formation est supprimée, il n'est pas possible de retourner en arrière. Êtes-vous sûr de vouloir continuer ?</p>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
                                <a @click="remove(requirement.id)" href="#!" class="modal-close waves-effect waves-light btn red">Supprimer</a>
                            </div>
                        </div>
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
        getAdminRequirementViewLink(id) {
            return `/admin/formation/${id}`;
        },
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
                
                this.$nextTick(() => {
                    M.Modal.init(document.querySelectorAll(".modal"), {});
                });
            }).catch(this.axiosErrorHandler)
        },
        remove(id) {
            axios.delete(`/api/v1/requirements/${id}`, {
                headers: {
                    "Authorization": `Bearer ${this.getToken()}`
                },
                data: {
                    id
                }
            }).then(response => {
                M.toast({
                    html: "Formation supprimée",
                    classes: "green"
                });

                return axios.get("/api/v1/requirements", {
                    headers: {
                        Authorization: `Bearer ${this.getToken()}`
                    }
                }).then(response => {
                    this.requirements = response.data;
                });
            }).catch(this.axiosErrorHandler);
        },
        getModalDeleteIdentifier(id) {
            return `modal-delete-${id}`;
        }
    }
}
</script>