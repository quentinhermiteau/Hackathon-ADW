<template>
    <div class="container">
        <div class="col s12 center">
            <h1>Profil utilisateur</h1>
        </div>

        <div>
            <div class="input-field">
                <label for="lastname">Nom</label>
                <input type="text" v-model="user.lastname"/>
            </div>
            <div class="input-field">
                <label for="firstname">Prénom</label>
                <input id="firstname" type="text" v-model="user.firstname"/>
            </div>
            <div class="input-field">
                <label for="email">Email</label>
                <input id="email" type="text" v-model="user.email"/>
            </div>
            <div class="input-field">
                <label for="birthday">Néé le</label>
                <input id="birthday" type="text" v-model="user.birthday"/>
            </div>
            <div class="input-field">
                <label for="description">Description</label>
                <input id="description" type="text" v-model="user.description"/>
            </div>
            <div>
                Spécialisations:
                {{user.specializations.map(specialization => specialization.name).join(', ')}}
            </div>
            <div>
                Compétences:
                {{user.specializations.map(specialization => specialization.skills.map(skill => skill.name)).join(', ')}}
            </div>
        </div>
    </div>
    
</template>

<script>
import axios from 'axios';
import {mapGetters, mapActions} from 'vuex';

export default {
    data() {
        return {
            user: {}
        }
    },
    created() {
        axios({method: 'GET', url: `/api/v1/users/${this.$route.params.id}`, headers: {'Authorization': `Bearer ${this.getToken()}`}})
        .then(response => {
            this.user = response.data;
        }).catch(this.axiosErrorHandler)
    },
    methods: {
        ...mapGetters(['getToken']),
        ...mapActions(['axiosErrorHandler'])
    }
}
</script>