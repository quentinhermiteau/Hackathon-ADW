<template>
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h1>Formation</h1>
            </div>
        </div>

        <div class="row">
            <div class="col s12 input-field">
                <label for="name">Nom</label>
                <input type="text" v-model="requirement.name" id="name">
            </div>

            <div class="col s12 input-field">
                <label for="link">Lien</label>
                <input type="text" v-model="requirement.link" id="link">
            </div>
            
            <div class="col s12 input-field">
                <label for="referent_id" class="active">Spécialization</label>

                <select class="browser-default" id="specialization_id" v-model="requirement.specialization_id">
                    <option v-for="specialization in specializations" :value="specialization.id" v-bind:key="specialization.id">{{ specialization.name }}</option>
                </select>
            </div>

            <div class="col s12 center">
                <button @click="update" class="btn waves-effect waves-light orange">Modifier</button>
                <button class="btn waves-effect waves-light red modal-trigger" data-target="destroy">Supprimer</button>

                 <!-- Modal Structure -->
                 <div id="destroy" class="modal">
                     <div class="modal-content">
                         <h4>Confirmation de suppression</h4>
                        <p>Une fois que la formation est supprimée, il n'est pas possible de retourner en arrière. Êtes-vous sûr de vouloir continuer ?</p>
                     </div>
                     <div class="modal-footer">
                         <a href="#!" class="modal-close waves-effect waves-light btn-flat">Annuler</a>
                         <a href="#!" @click.prevent="destroy" class="modal-close waves-effect waves-light btn red">Supprimer</a>
                     </div>
                 </div>
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
            requirement: {
                name: "",
                link: "",
                specialization_id: "",
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
        update() {
            axios({
                method: "PUT",
                url: `/api/v1/requirements/${this.$route.params.id}`,
                headers: {
                    "Authorization": `Bearer ${this.getToken()}`
                },
                data: this.requirement
            }).then(response => {
                M.toast({
                    html: "Formation mise à jour",
                    classes: "green"
                });
            }).catch(this.axiosErrorHandler);
        },
        destroy() {
            axios.delete(`/api/v1/requirements/${this.$route.params.id}`, {
                headers: {
                    "Authorization": `Bearer ${this.getToken()}`
                },
                data: {
                    id: this.$route.params.id
                }
            }).then(response => {
                this.$router.push("/admin/formations");

                M.toast({
                    html: "Formation supprimée avec succès",
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

        axios.get(`/api/v1/requirements/${this.$route.params.id}`, {
            headers: {
                Authorization: `Bearer ${this.getToken()}`
            }
        }).then(response => {
            this.requirement = response.data;

            this.$nextTick(() => {
                M.Modal.init(document.querySelectorAll(".modal"), {});
                M.updateTextFields();
                M.Sidenav.init(document.querySelectorAll(".sidenav"), {});
            });
            
        }).catch(this.axiosErrorHandler);
    }
};
</script>
