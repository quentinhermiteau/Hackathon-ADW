<template>
    <div>
        <ul class="sidenav" id="menu">
            <li v-if="isLogged">
                <a href="" @click.prevent="logout" class="black-text">Déconnexion</a>
            </li>

            <li v-if="isLogged"> 
                <router-link to="/profil" class="black-text">Profil</router-link>
            </li> 

            <li v-if="isLogged"> 
                <router-link to="/agents" class="black-text">Agents</router-link>
            </li> 

            <li v-if="isLogged"> 
                <router-link to="/projets" class="black-text">Projets</router-link>
            </li> 

            <li v-else>
                <router-link to="/connexion" class="black-text">Connexion</router-link>
            </li>
        </ul>

        <header>
            <div class="fixed-navbar">
                <nav class="transparent">
                    <a href="" class="brand-logo red-text">ADW</a>
                    <a href="" @click.prevent class="sidenav-trigger right" data-target="menu">
                        <i class="material-icons black-text">menu</i>
                    </a>
                    
                    <ul class="right hide-on-med-and-down">
                        <li v-if="isLogged">
                            <a href="" @click.prevent="logout" class="black-text">Déconnexion</a>
                        </li>

                        <li v-if="isLogged"> 
                            <router-link to="/profil" class="black-text">Profil</router-link>
                        </li> 

                        <li v-if="isLogged"> 
                            <router-link to="/agents" class="black-text">Agents</router-link>
                        </li> 

                        <li v-if="isLogged"> 
                            <router-link to="/projets" class="black-text">Projets</router-link>
                        </li> 

                        <li v-else>
                            <router-link to="/connexion" class="black-text">Connexion</router-link>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import M from "materialize-css";
import { mapGetters, mapActions } from "vuex";

export default {
    data() {
        return {
            menu: [
                {
                    path: "/"
                }
            ]
        };
    },
    methods: {
        ...mapGetters([
            "getToken"
        ]),
        ...mapActions([
            "setToken"
        ]),
        logout() {
            this.setToken(null); 
            this.$router.push("/connexion");
        }
    },
    computed: {
        isLogged() {
            return !!this.getToken();
        }
    },
    mounted() {
        M.AutoInit();

        const elems = document.querySelectorAll('.tooltipped');
        M.Tooltip.init(elems, {});

        M.Sidenav.init(document.querySelectorAll(".sidenav"), {
            edge: "right",
            draggable: true
        });
    }
};
</script>

<style>
    .actions {
        white-space: nowrap;
    }

    .cursors {
        cursor: pointer;
    }
</style>
