<template>
    <div>
        <h1>Gestion utilisateurs</h1>
        
        <table>
            <thead>
                <th><input placeholder="Nom" v-model="search.lastname"/></th>
                <th><input placeholder="Prénom" v-model="search.firstname"/></th>
                <th><input placeholder="Émail" v-model="search.email"/></th>
                <th><input placeholder="Date de naissance" v-model="search.birthday"/></th>
                <th><input placeholder="Description" v-model="search.description"/></th>
                <th>Spécialisations</th>
                <th>Compétences</th>
                <th><input placeholder="Rôle" v-model="search.role"/></th>
                <th><input placeholder="Statut" v-model="search.status"/></th>
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
                        <select v-model="user.role">
                            <option value="ADMIN">Admin</option>
                            <option value="AGENT">Agent</option>
                        </select>
                    </td>
                    <td>
                        <select v-model="user.status">
                            <option value="ENABLED">Activé</option>
                            <option value="DISABLED">Désactivé</option>
                        </select>
                    </td>
                    <td>
                        <button v-on:click="showUser(user)">Visualiser</button> -
                        <button v-on:click="updateUser(user)">Modifier</button> -
                        <button v-on:click="deleteUser(user)">Supprimer</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            token: "eyJpdiI6ImQ3cWZUclhyT29UUStmc2NzQmVkQ1E9PSIsInZhbHVlIjoiOGo5ME0wWjZoamRIRTR4ekRtVWZlcjJ3aFlRNFJhQk11MWd4VkVPRCt6ck4xZWYySFJUSFQwZVcxYWZTdlwvYkFzUG1CRHh6MlwvcndcL3IzMjVOcjlZTG9ObVhFYkZyRnZLc094Zm5NUGVpd2FraEZ1V1hEaDUzeEN4ZDgreUFjeDByYnk3MFFWdUtcL3kzT1NxMFc5TzIybGxDQkhTdjJYM1ZEUG96TEJRTVg4OEJleHpyNkEyRmVsYXFDdEh5ZFFKUndwK0JoR21zRm5Cb0pKWUZYTnVJWURsblRWZFJBYkFuV09neGJ5OGZUam1hZ2tHVENsK3JqZVc0eW82NExTNHE2SmZFTjYyNjJycWEwYjE3d01DRWVXdmJiNVpXQzhRekhTTEFVa3JxVjdLMjFKbzBod1RNaUxlN0FhbFhpTFJIIiwibWFjIjoiZjMxNzZmZmRhYmMxYTcyMzAwM2ViOTY1ZDJjMTMyMjI0ODcwNDA4MDIwZTUzYmM1YjkwMjdmMzM1MGQ1YjlkNCJ9",
            users: [],
            search: {
                lastname: '',
                firstname: '',
                email: '',
                birthday: '',
                description: '',
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
                user.description.includes(this.search.description) &&
                user.role.includes(this.search.role) &&
                user.status.includes(this.search.status)
            });
        }
    },
    methods: {
        getUsers() {
            axios({method: 'GET', url: '/api/v1/users', headers: {'Authorization': `Bearer ${this.token}`}})
            .then(response => {
                this.users = response.data;
            }).catch(error => {
                console.error(error);
            })
        },
        showUser(user) {
            this.$router.push(`/profil/${user.id}`);
        },
        updateUser(user) {
            axios({method: 'PUT', url: `/api/v1/users/${user.id}`, data: user, headers: {'Authorization': `Bearer ${this.token}`}})
            .then(response => {
                console.log('User modifié');
            }).catch(error => {
                console.error(error);
            })
        },
        deleteUser(user) {
            axios({method: 'DELETE', url: `/api/v1/users/${user.id}`, data: user, headers: {'Authorization': `Bearer ${this.token}`}})
            .then(response => {
                console.log(response);
                this.getUsers();
            }).catch(error => {
                console.log(error);
            })
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