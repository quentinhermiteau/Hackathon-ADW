<template>
    <div>
        <div class="row">
            <div class="col s12 center">
                <img src="../../images/logo.svg" class="logo">
            </div>
        </div>

        <div class="hero">
            <img src="https://i.imgur.com/gZceQ3V.gif">

            <div class="text">
                <p class="flow-text">Les Agents du Web</p>
                <p class="flow-text">Évoluer tous ensemble</p>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col s12 center">
                    <h1 class="flow-text"><span class="teal-text">VOS PRESTATIONS EN</span> <span class="red-text">FREELANCE</span></h1>
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
                    <h2 class="flow-text"><span class="teal-text">NOUS</span> <span class="red-text">RECHERCHONS</span>...</h2>
                </div>
            </div>

            <div class="row">
                <div class="col s4 center">
                    <i class="material-icons large">person_pin</i>
                    <h3 class="flow-text">Chef de projet</h3>
                    <p>Gestion de projet, management d'équipes, création de planning, mais également plaisir de travailler ensemble. C'est votre domaine ? N'hésitez-plus !</p>
                </div>

                <div class="col s4 center">
                    <i class="material-icons large">code</i>
                    <h3 class="flow-text">Dév. Web</h3>
                    <p>Vous vous passionnez pour les langages du Web ? le HTML, CSS, JavaScript & PHP sont vos langues maternelles ? Ça tombe bien nous aussi !</p>
                </div>

                <div class="col s4 center">
                    <i class="material-icons large">code</i>
                    <h3 class="flow-text">Responsable SEO</h3>
                    <p>Vous trouvez toujours les mots justes ? Vous connaissez le Web et les moteurs de recherche comme votre poche ? Rejoignez-nous !</p>
                </div>

            </div>

            <div class="row">
                <div class="col s4 center">
                    <i class="material-icons large">art_track</i>
                    <h3 class="flow-text">Dir. artistiques</h3>
                    <p>Vous avez le don de la création, et n'êtes jamais à cours d'idées ? Vous cherchez toujours de nouveaux moyens d'émerveiller le monde ?</p>
                </div>

                <div class="col s4 center">
                    <i class="material-icons large">directions_run</i>
                    <h3 class="flow-text">Motion Designer</h3>
                    <p>Vous avez l'animation et le montage dans le sang ? Vous maîtrisez After Effects, Premiere Pro et l'animation 2D/3D ? Alors inscrivez-vous !</p>
                </div>

                <div class="col s4 center">
                    <i class="material-icons large">format_paint</i>
                    <h3 class="flow-text">Web Designer</h3>
                    <p>Le design de plateformes Web user-friendly est votre priorité absolue ? Vous êtes curieux et assoiffé de connaissances ? On vous attends !</p>
                </div>
            </div>

            <div class="row">
                <div class="col s12 center">
                    <router-link to="/inscription"><button class="btn waves-effect waves-light green">rejoignez-nous !</button></router-link>
                </div>
            </div>

            <div class="row"></div>

            <div class="row">
                <div class="col s12 center">
                    <h2 class="flow-text"><span class="teal-text">NOS</span> <span class="red-text">AGENTS</span> <span class="teal-text">RACONTENT</span></h2>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m8 offset-m2 l6 offset-l3">
                    <transition :name="transitionName" mode="out-in">
                        <div class="card large" :key="testimonialIndex">
                            <div class="card-image">
                                <img :src="testimonialImage" style="height: 300px; object-fit: cover;" alt="Un collaborateur">
                                <span class="card-title">{{ testimonialName }}</span>
                            </div>
                            <div class="card-content">
                                <p>{{ testimonialText }}</p>
                            </div>
                            <div class="card-action">
                                <a href="" @click.prevent="previous">précédent</a>
                                <a href="" @click.prevent="next">suivant</a>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import axios from "axios";
import testimonialImage1 from "../../images/testimonial-image-1.jpg";
import testimonialImage2 from "../../images/testimonial-image-2.jpg";
import testimonialImage3 from "../../images/testimonial-image-3.jpg";

export default {
    data() {
        return {
            transitionName: "slide-next",
            testimonialIndex: 0,
            testimonials: [
                {
                    image: testimonialImage1,
                    name: "Nicole Lesage",
                    text: "Une aventure extraordinaire ! Je ne peux que trop vous conseiller de vous lancer. J'ai appris à travailler d'avantage en cohésion et en équipe, je suis très fier du résultat du projet. Mon réseau s'en trouve également enrichi !"
                },
                {
                    image: testimonialImage2,
                    name: "Jay Lang",
                    text: "Une aventure extraordinaire ! Je ne peux que trop vous conseiller de vous lancer. J'ai appris à travailler d'avantage en cohésion et en équipe, je suis très fier du résultat du projet. Mon réseau s'en trouve également enrichi !"
                },
                {
                    image: testimonialImage3,
                    name: "Clémence Gousse",
                    text: "Une aventure extraordinaire ! Je ne peux que trop vous conseiller de vous lancer. J'ai appris à travailler d'avantage en cohésion et en équipe, je suis très fier du résultat du projet. Mon réseau s'en trouve également enrichi !"
                }
            ]
        };
    },
    methods: {
        ...mapGetters([
            "getToken"
        ]),
        ...mapActions([
            "axiosErrorHandler"
        ]),
        next() {
            this.transitionName = "slide-next";
            this.testimonialIndex++;

            if (!this.testimonials[this.testimonialIndex]) {
                this.testimonialIndex = 0;
            }
        },
        previous() {
            this.transitionName = "slide-previous";
            this.testimonialIndex--;

            if (this.testimonialIndex < 0) {
                this.testimonialIndex = this.testimonials.length - 1;
            }
        }
    },
    computed: {
        testimonialImage() {
            return this.testimonials[this.testimonialIndex].image;
        },
        testimonialText() {
            return this.testimonials[this.testimonialIndex].text;
        },
        testimonialName() {
            return this.testimonials[this.testimonialIndex].name;
        }
    }
};
</script>

<style lang="scss" scoped>
.logo {
    height: 25vh;
    width: 25vh;
}

.slide-next-enter {
    transform: translateX(-25%);
    opacity: 0;
}

.slide-next-enter-to {
    transform: translateX(0);
    opacity: 1;
}

.slide-next-leave {
    transform: translateX(0);
    opacity: 1;
}

.slide-next-leave-to {
    transform: translateX(25%);
    opacity: 0
}

.slide-next-enter-active, .slide-next-leave-active {
    transition: all 0.25s ease-in-out;
}

.slide-previous-enter {
    transform: translateX(25%);
    opacity: 0;
}

.slide-previous-enter-to {
    transform: translateX(0);
    opacity: 1;
}

.slide-previous-leave {
    transform: translateX(0);
    opacity: 1;
}

.slide-previous-leave-to {
    transform: translateX(-25%);
    opacity: 0;
}

.slide-previous-enter-active, .slide-previous-leave-active {
    transition: all 0.25s ease-in-out;
}

.card-title {
    width: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0));
}

.hero {
    margin: 0 auto;
    width: 90vw;
    height: 500px;
    position: relative;

    img {
        object-fit: cover;
        height: 100%;
        width: 100%;
    }

    .text {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;

        p:first-child {
            font-weight: bolder;
        }
    }
}
</style>
