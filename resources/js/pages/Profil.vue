<template>
    <div class="container">
        <!-- Mes informations -->
        <div class="section">
            <div class="row">
                <div class="col s12 center">
                    <h1>Mes informations</h1>
                </div>
            </div>

            <div class="row">
                <div class="col s6 center">
                    <div class="input-field">
                        <label for="lastname">Nom</label>
                        <input type="text" id="lastname" v-model="user.lastname"/>
                    </div>
                    <div class="input-field">
                        <label for="firstname">Prénom</label>
                        <input type="text" id="firstname" v-model="user.firstname"/>
                    </div>
                </div>
                <div class="col s6 center">
                    <div class="input-field">
                        <label for="email">Email</label>
                        <input type="text" id="email" v-model="user.email"/>
                    </div>
                    <div class="input-field">
                        <label for="birthday">Néé le</label>
                        <input type="date" id="birthday" class="materialize-textarea" v-model="user.birthday"/>
                    </div>
                </div>
                <div class="col s8 offset-s2 center">
                    <div class="input-field">
                        <label for="description">Description</label>
                        <input type="text" id="description" v-model="user.description"/>
                    </div>
                </div>
                <div class="col s12 center">
                    <button @click="update" class="btn waves-effect waves-light orange">Modifier</button>
                </div>

                <div class="col s12 center flow-text cursors" style="bottom: 0;" @click="scrollToReviews" ref="reviews">
                    Vos reviews par ici <i class="material-icons" id="arrow">arrow_downward</i>
                </div>
            </div>

        </div>
        <div class="section">
            <!-- Reviews -->
            <div class="row">
                <div class="col s12 center">
                    <h1>Reviews</h1>
                </div>

                <div class="row">
                    <table class="highlight striped centered">
                        <thead>
                            <tr>
                                <th>Agent</th>
                                <th>Note</th>
                                <th>Commentaire</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-bind:key="review.id" v-for="review in reviews">
                                <td>{{review.reviewer.lastname}} {{review.reviewer.firstname}}</td>
                                <td>{{review.mark}}/5</td>
                                <td>{{review.comment}}</td>
                                <td><i class="material-icons red-text">outlined_flag</i></td>
                            </tr>
                        </tbody>
                    </table>
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
            reviews: []
        }
    },
    methods: {
        ...mapGetters(['getUser', 'getToken']),
        ...mapActions(['setUser']),
        update() {
            axios({
                method: "PUT",
                url: `/api/v1/users/${this.user.id}`,
                headers: {
                    "Authorization": `Bearer ${this.getToken()}`
                },
                data: this.user
            }).then(response => {
                this.setUser(this.user)
                M.toast({
                    html: "Informations mis à jour",
                    classes: "green"
                });
            }).catch(this.axiosErrorHandler);
        },
        scrollToReviews() {
            window.scroll({
                top: this.$refs.reviews.offsetTop + (2 * 64),
                left: 0,
                behavior: 'smooth'
            });
        }
    },
    mounted() {
        this.user = this.getUser();

        this.$nextTick(() => {
            M.updateTextFields();
        });

        axios.get("api/v1/reviews", {
            headers: {
                Authorization: `Bearer ${this.getToken()}`
            }
        }).then(response => {
            this.reviews = response.data;
        }).catch(this.axiosErrorHandler);
    }
}
</script>

<style scoped>
    tr {
        border-bottom: none;
    }

    .section {
        height: calc(100vh - 64px);
    }

    #arrow {
        animation: slide 2s ease-in-out infinite;
    }

    @keyframes slide {
        0%,
        100% {
            transform: translate(0, 0);
        }

        50% {
            transform: translate(0, 10px);
        }
    }
</style>