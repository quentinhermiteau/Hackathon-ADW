<template>
    <h1>Profil utilisateur</h1>
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