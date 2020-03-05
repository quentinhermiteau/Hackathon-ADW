<template>
    <div>
        <ul class="sidenav" id="menu">
            <li v-if="isLogged"> 
                <router-link to="/" class="black-text sidenav-close">Accueil</router-link>
            </li> 

            <li v-if="isLogged"> 
                <router-link to="/profil" class="black-text sidenav-close">Profil</router-link>
            </li> 

            <!-- non-admin -->
            <li v-if="isLogged && !isAdmin"> 
                <router-link to="/agents" class="black-text sidenav-close">Agents</router-link>
            </li> 

            <!-- admin -->
            <li v-if="isLogged && isAdmin"> 
                <router-link to="/admin/agents" class="black-text sidenav-close">Agents</router-link>
            </li> 

            <!-- non-admin -->
            <li v-if="isLogged && !isAdmin"> 
                <router-link to="/projets" class="black-text sidenav-close">Projets</router-link>
            </li> 

            <!-- admin -->
            <li v-if="isLogged && isAdmin"> 
                <router-link to="/admin/projets" class="black-text sidenav-close">Projets</router-link>
            </li> 

            <li v-if="isLogged">
                <a href="" @click.prevent="logout" class="black-text sidenav-close">Déconnexion</a>
            </li>

            <li v-if="!isLogged">
                <router-link to="/connexion" class="black-text sidenav-close">Connexion</router-link>
            </li>

            <li v-if="!isLogged">
                <router-link to="/inscription" class="black-text sidenav-close">Inscription</router-link>
            </li>
        </ul>

        <header>
            <div class="navbar-fixed">
                <nav class="white">
                    <router-link to="/" class="brand-logo red-text">ADW</router-link>
                    <a href="" @click.prevent class="sidenav-trigger right" data-target="menu">
                        <i class="material-icons black-text">menu</i>
                    </a>
                    
                    <ul class="right hide-on-med-and-down">
                        <li v-if="isLogged"> 
                            <router-link to="/" class="black-text">Accueil</router-link>
                        </li> 

                        <li v-if="isLogged"> 
                            <router-link to="/profil" class="black-text">Profil</router-link>
                        </li> 

                        <!-- non-admin -->
                        <li v-if="isLogged && !isAdmin"> 
                            <router-link to="/agents" class="black-text">Agents</router-link>
                        </li> 

                        <!-- admin -->
                        <li v-if="isLogged && isAdmin"> 
                            <router-link to="/admin/agents" class="black-text">Agents</router-link>
                        </li> 

                        <!-- non-admin -->
                        <li v-if="isLogged && !isAdmin"> 
                            <router-link to="/projets" class="black-text">Projets</router-link>
                        </li>

                        <!-- admin -->
                        <li v-if="isLogged && isAdmin"> 
                            <router-link to="/admin/projets" class="black-text">Projets</router-link>
                        </li> 

                        <li v-if="isLogged">
                            <a href="" @click.prevent="logout" class="black-text">Déconnexion</a>
                        </li>

                        <li v-if="!isLogged">
                            <router-link to="/connexion" class="black-text">Connexion</router-link>
                        </li>

                        <li v-if="!isLogged">
                            <router-link to="/inscription" class="black-text">Inscription</router-link>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <transition name="fade" mode="out-in" appear>
                <router-view></router-view>
            </transition>
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
            "getToken",
            "getUser"
        ]),
        ...mapActions([
            "setToken",
            "setUser"
        ]),
        logout() {
            this.setToken(null); 
            this.setUser(null);
            this.$router.push("/connexion");

            M.toast({
                html: "Déconnexion réussie",
                classes: "green"
            });
        }
    },
    computed: {
        isLogged() {
            return !!this.getToken();
        },
        isAdmin() {
            const user = this.getUser();
            return user.role === "ADMIN";
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

.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}

.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>
