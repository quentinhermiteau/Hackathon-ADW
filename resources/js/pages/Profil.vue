<template>
    <h1>Profil utilisateur</h1>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            token: 'eyJpdiI6ImQ3cWZUclhyT29UUStmc2NzQmVkQ1E9PSIsInZhbHVlIjoiOGo5ME0wWjZoamRIRTR4ekRtVWZlcjJ3aFlRNFJhQk11MWd4VkVPRCt6ck4xZWYySFJUSFQwZVcxYWZTdlwvYkFzUG1CRHh6MlwvcndcL3IzMjVOcjlZTG9ObVhFYkZyRnZLc094Zm5NUGVpd2FraEZ1V1hEaDUzeEN4ZDgreUFjeDByYnk3MFFWdUtcL3kzT1NxMFc5TzIybGxDQkhTdjJYM1ZEUG96TEJRTVg4OEJleHpyNkEyRmVsYXFDdEh5ZFFKUndwK0JoR21zRm5Cb0pKWUZYTnVJWURsblRWZFJBYkFuV09neGJ5OGZUam1hZ2tHVENsK3JqZVc0eW82NExTNHE2SmZFTjYyNjJycWEwYjE3d01DRWVXdmJiNVpXQzhRekhTTEFVa3JxVjdLMjFKbzBod1RNaUxlN0FhbFhpTFJIIiwibWFjIjoiZjMxNzZmZmRhYmMxYTcyMzAwM2ViOTY1ZDJjMTMyMjI0ODcwNDA4MDIwZTUzYmM1YjkwMjdmMzM1MGQ1YjlkNCJ9',
            user: {}
        }
    },
    created() {
        axios({method: 'GET', url: `/api/v1/users/${this.$route.params.id}`, headers: {'Authorization': `Bearer ${this.token}`}})
            .then(response => {
                this.user = response.data;
            }).catch(error => {
                console.error(error);
            })
    }
}
</script>