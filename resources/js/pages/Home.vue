<template>
    <h1>Page d'accueil</h1>
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
            // console.log(response);
        }).catch(this.axiosErrorHandler);
    }
};
</script>
