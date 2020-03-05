<template>
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h1>Les Agents du Web</h1>
                <h6>By 148</h6>
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
