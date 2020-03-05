<template>
    <div class="container">
        <div class="col s12 center">
            <h1>Gestion utilisateurs</h1>
        </div>
        
        <table class="striped centered responsive-table">
            <thead>
                <th>
                    <div class="input-field">
                        <label for="lastname">Nom</label>
                        <input type="text" id="lastname" v-model="search.lastname"/>
                    </div>
                </th>
                <th>
                    <div class="input-field">
                        <label for="firstname">Prénom</label>
                        <input type="text" id="firstname" v-model="search.firstname"/>
                    </div>
                </th>
                <th>
                    <div class="input-field">
                        <label for="email">Émail</label>
                        <input type="text" id="email" v-model="search.email"/>
                    </div>
                </th>
                <th>
                    <div class="input-field">
                        <label for="birthday">Néé le</label>
                        <input type="text" id="birthdade naissance" v-model="search.birthday"/>
                    </div>
                </th>
                <th>Description</th>
                <th>Spécialisations</th>
                <th>Compétences</th>
                <th>Rôles</th>
                <th>Statut</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <tr v-bind:key="user.id" v-for="user in filterUsers">
                    <td>{{user.lastname}}</td>
                    <td>{{user.firstname}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.birthday}}</td>
                    <td>{{user.description}}</td>
                    <td>{{getSpecializations(user)}}</td>
                    <td>{{getSkills(user)}}</td>
                    <td>
                        <select class="browser-default" v-model="user.role">
                            <option value="ADMIN">Admin</option>
                            <option value="AGENT">Agent</option>
                        </select>
                    </td>
                    <td>
                        <select class="browser-default" v-model="user.status">
                            <option value="ENABLED">Activé</option>
                            <option value="DISABLED">Désactivé</option>
                        </select>
                    </td>
                    <td class="actions">
                        <i class="material-icons tooltipped green-text cursors" data-position="bottom" data-tooltip="Visualiser" v-on:click="showUser(user)">remove_red_eye</i>
                        <i class="material-icons tooltipped orange-text cursors" data-position="bottom" data-tooltip="Modifier" v-on:click="updateUser(user)">edit</i>
                        <i class="material-icons tooltipped red-text cursors" data-position="bottom" data-tooltip="Supprimer" v-on:click="deleteUser(user)">delete_forever</i>
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
            users: [],
            search: {
                lastname: '',
                firstname: '',
                email: '',
                birthday: '',
                role: '',
                status: '',
            }
        };
    },
    created() {
        this.getUsers();
    },
    computed: {
        filterUsers() {
            return this.users.filter(user => {
                return user.lastname.includes(this.search.lastname) &&
                user.firstname.includes(this.search.firstname) &&
                user.email.includes(this.search.email) &&
                user.birthday.includes(this.search.birthday) &&
                user.role.includes(this.search.role) &&
                user.status.includes(this.search.status)
            }).sort((userA, userB) => {
                return new Date(userA.created_at) > new Date(userB.created_at);
            });
        }
    },
    methods: {
        ...mapGetters(['getToken']),
        ...mapActions(['axiosErrorHandler']),
        getUsers() {
            axios({method: 'GET', url: '/api/v1/users', headers: {Authorization: `Bearer ${this.getToken()}`}})
            .then(response => {
                this.users = response.data;
            }).catch(this.axiosErrorHandler)
        },
        showUser(user) {
            this.$router.push(`/profil/${user.id}`);
        },
        updateUser(user) {
            axios({method: 'PUT', url: `/api/v1/users/${user.id}`, data: user, headers: {Authorization: `Bearer ${this.getToken()}`}})
            .then(response => {
                M.toast({html: 'Utilisateur modifié avec succès.', classes: 'green'});
            }).catch(this.axiosErrorHandler)
        },
        deleteUser(user) {
            axios({method: 'DELETE', url: `/api/v1/users/${user.id}`, data: user, headers: {Authorization: `Bearer ${this.getToken()}`}})
            .then(response => {
                M.toast({html: 'Utilisateur supprimé avec succès.', classes: 'green'});
                this.getUsers();
            }).catch(this.axiosErrorHandler)
        },
        getSpecializations(user) {
            return user.specializations.map(specialization => specialization.name).join(', ');
        },
        getSkills(user) {
            return user.specializations.map(specialization => specialization.skills.map(skill => skill.name)).join(', ');
        }
    }
}
</script>
