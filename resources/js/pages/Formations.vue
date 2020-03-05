<template>
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h1>Formations</h1>
            </div>
        </div>

        <div class="row">
            <div class="col s4" v-bind:key="requirement.id" v-for="requirement in user.requirements">
                <p>
                    {{requirement.name}} - <a :href="requirement.link" target="blank">Lien de la formation</a>
                    <br>
                    <span>Valider cette compétence:</span>
                </p>
                <div class="switch">
                    <label>
                    Off
                    <input type="checkbox" @change="updateRequirement(requirement.id, $event)">
                    <span class="lever"></span>
                    On
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col s12 center">
                    <button class="btn" @click="updateUser">Valider mes compétences</button>
                </div>
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
            user: {},
        }
    },
    methods: {
        ...mapGetters(['getUser', 'getToken']),
        ...mapActions(['setUser', 'axiosErrorHandler']),
        updateRequirement(id, event) {
            axios.put(`/api/v1/users/${this.user.id}/requirements/${id}`, {
                status: event.currentTarget.checked,
            }).then(response => {
            }).catch(this.axiosErrorHandler);
        },
        updateUser() {
            axios.put(`/api/v1/users/${this.user.id}`, this.user, {
                headers: {
                    "Authorization": `Bearer ${this.getToken()}`
                }
            }).then(response => {
                this.$router.push('/validation')
            }).catch(this.axiosErrorHandler);
        }
    },
    mounted() {
        this.user = this.getUser();

        this.$nextTick(() => {
            M.updateTextFields();
        });
    }
}
</script>

<style>
    input[type=checkbox]:not(:checked),
    input[type=checkbox]:checked {
        position: initial;
        opacity: 1;
        pointer-events: initial;
    }
</style>