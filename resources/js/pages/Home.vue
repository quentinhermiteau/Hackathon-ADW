<template>
    <div>
        <div class="row">
            <div class="col s3 center">
                <img src="../../images/logo.svg" class="logo">
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col s12 center">
                    <h1><span class="teal-text">VOS PRESTATIONS EN</span> <span class="red-text">FREELANCE</span></h1>
                </div>
            </div>

            <div class="row"></div>

            <div class="row">
                <div class="col s4 center">
                    <i class="material-icons large">person</i>
                    <p><b>Profitez de formations gratuites</b> données par des professionnels de l'agence 148, certifiée B Corp.</p>
                </div>

                <div class="col s4 center">
                    <i class="material-icons large">business</i>
                    <p><b>Greffez-vous sur un projet</b> qui vous convient et gérez-le comme bon vous semble.</p>
                </div>

                <div class="col s4 center">
                    <i class="material-icons large">thumb_up</i>
                    <p><b>Soyé payé rapidement</b>, par virement ou par chèque, une fois le projet complété et validé par le client et l'agence.</p>
                </div>
            </div>

            <div class="row">
                <div class="col s12 center">
                    <h2><span class="teal-text">NOUS</span> <span class="red-text">RECHERCHONS</span>...</h2>
                </div>
            </div>

            <div class="row">
                <div class="col s4 center">
                    <i class="material-icons large">person_pin</i>
                    <h3>Chef de projet</h3>
                    <p>Gestion de projet, management d'équipes, création de planning, mais également plaisir de travailler ensemble. C'est votre domaine ? N'hésitez-plus !</p>
                </div>

                <div class="col s4 center">
                    <i class="material-icons large">code</i>
                    <h3>Dév. Web</h3>
                    <p>Vous vous passionnez pour les langages du Web ? le HTML, CSS, JavaScript & PHP sont vos langues maternelles ? Ça tombe bien nous aussi !</p>
                </div>

                <div class="col s4 center">
                    <i class="material-icons large">code</i>
                    <h3>Responsable SEO</h3>
                    <p>Vous trouvez toujours les mots justes ? Vous connaissez le Web et les moteurs de recherche comme votre poche ? Rejoignez-nous !</p>
                </div>

                <div class="col s4 center">
                    <i class="material-icons large">code</i>
                    <h3>Dir. artistiques</h3>
                    <p>Vous avez le don de la création, et n'êtes jamais à cours d'idées ? Vous cherchez toujours de nouveaux moyens d'émerveiller le monde ?</p>
                </div>

                <div class="col s4 center">
                    <i class="material-icons large">code</i>
                    <h3>Dir. artistiques</h3>
                    <p>Vous avez le don de la création, et n'êtes jamais à cours d'idées ? Vous cherchez toujours de nouveaux moyens d'émerveiller le monde ?</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import axios from "axios";

export default {
    methods: {
        ...mapGetters([
            "getToken"
        ]),
        ...mapActions([
            "axiosErrorHandler"
        ])
    },
    created() {
        axios.get("/api/v1/projects", {
            headers: {
                "Authorization": `Bearer ${this.getToken()}`
            }
        }).then(response => {
            
        }).catch(this.axiosErrorHandler);
    }
};
</script>

<style scoped>
.logo {
    height: 25vh;
    width: 25vh;
}
</style>
