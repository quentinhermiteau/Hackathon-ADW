<template>
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h1>Nouvelle formation</h1>
            </div>
        </div>

        <form @submit.prevent="add">
            <div class="row">
                <div class="col s12 input-field">
                    <label for="name">Nom</label>
                    <input type="text" id="name" v-model="requirement.name">
                </div>
                
                <div class="col s12 input-field">
                    <label for="link">Lien</label>
                    <textarea id="link" class="materialize-textarea" v-model="requirement.link"></textarea>
                </div>

                <select class="browser-default" id="specialization_id" v-model="requirement.specialization_id">
                    <option value=0> -- Choisissez une spécialisation -- </option>
                    <option v-for="specialization in specializations" :key="specialization.id" :value="specialization.id">{{ specialization.name }}</option>
                </select>

                 <div class="col s12 center">
                     <button class="btn waves-effect waves-light green" type="submit">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import axios from "axios";

export default {
    data() {
        return {
            requirement: {
                name: "",
                link: "",
                specialization_id: 0
            },
            specializations: []
        };
    },
    methods: {
        ...mapGetters([
            "getToken"
        ]),
        ...mapActions([
            "axiosErrorHandler"
        ]),
        add() {
            axios.post("/api/v1/requirements", this.requirement, {
                headers: {
                    "Authorization": `Bearer ${this.getToken()}`
                }
            }).then(response => {
                M.toast({
                    html: "Formation créée avec succès",
                    classes: "green"
                });
            }).catch(this.axiosErrorHandler);
        }
    },
    created() {
        axios.get("/api/v1/specializations", {
            headers: {
                "Authorization": `Bearer ${this.getToken()}`
            }
        }).then(response => {
            this.specializations = response.data;
        }).catch(this.axiosErrorHandler);
    }
};
</script>
