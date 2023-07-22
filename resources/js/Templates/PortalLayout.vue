<template>
    <v-app>
        <!-- <div>
            <v-app-bar
                app
                class="app-header position-relative navbar-light header1"
                flat
            >
                <v-container class="py-0 fill-height">
                    <div class="logo">
                        <a href="/">
                            <v-avatar color="#00B0FF" size="56"
                                ><v-icon color="white">home</v-icon></v-avatar
                            >
                        </a>
                    </div>

                    <v-spacer></v-spacer>
                    <v-btn class="d-block d-md-none" text>
                        <v-app-bar-nav-icon />
                    </v-btn>
                    <v-btn
                        class="d-none d-lg-flex btn-custom-nm ml-5"
                        outlined
                        color="#00B0FF"white
                        href="/auth/login"white
                        elevation="0"
                    >
                        Login
                    </v-btn>

                    <v-btn
                        class="d-none d-lg-flex btn-custom-nm ml-5"
                        color="#00B0FF"
                        href="/condominio/create"
                        elevation="0"
                    >
                        Novo Condominio
                    </v-btn>
                </v-container>
            </v-app-bar>
        </div> -->

            <v-toolbar flat class="header1 elevation-0 py-0" color="deep-purple darken-3 ">
                <v-toolbar-title ><a href="/" style="text-decoration: none"><v-avatar size="40" color="deep-purple darken-3"><v-icon
                                color="white" large>home</v-icon></v-avatar>
                      <span class="white--text">  SIGIM</span>
                    </a>
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items class="hidden-xs-only">
                    <v-btn class="d-none d-lg-flex btn-custom-nm ml-5" color="#fff" href="/portal/listaImoveisArrendamentos" elevation="0"
                        text>
                        Arrendar
                    </v-btn>

                    <v-btn dense class="d-none d-lg-flex btn-custom-nm ml-5" color="#fff" href="/portal/listaImoveisCompras"
                        elevation="0" text>
                        Comprar
                    </v-btn>
                    <v-btn dense class="d-none d-lg-flex btn-custom-nm ml-5" color="#fff" href="/portal/imoveis"
                        elevation="0" text>
                        Anuciar
                    </v-btn>
                </v-toolbar-items>
                
                <v-toolbar-items class="hidden-xs-only">
                    <v-btn class="d-none d-lg-flex btn-custom-nm ml-5" color="#fff" href="/logar" elevation="0"
                        text>
                        Login
                    </v-btn>

                    <v-btn dense class="d-none d-lg-flex btn-custom-nm ml-5" color="#fff" href="/condominio/create"
                        elevation="0" text>
                        Cadastrar
                    </v-btn>
                </v-toolbar-items>
                <div class="hidden-sm-and-up">
                    <v-menu offset-y>
                        <template v-slot:activator="{ on }">
                            <v-app-bar-nav-icon v-on="on"></v-app-bar-nav-icon>
                        </template>
                        <v-list class="responsiveMenu">
            <v-list-item>
              <v-list-item-title><router-link to="/">Home</router-link></v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-title><router-link to="/about">About</router-link></v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-title><router-link to="/contact">Contact</router-link></v-list-item-title>
            </v-list-item>
          </v-list>
                    </v-menu>
                </div>
            </v-toolbar>

        
<v-main class=" grey lighten-5 scroll-y pb-0" fluid>
            <!-- <v-container> -->
                <slot align="center" justify="center" />
            <!-- </v-container> -->
        </v-main>
        <v-container>


            
            <v-footer padless>
                <v-card flat class="text-center">
                    <v-card-text>
                        <v-btn v-for="icon in icons" :key="icon" class="mx-4" icon>
                            <v-icon size="24px">{{ icon }}</v-icon>
                        </v-btn>
                    </v-card-text>
                    <v-card-text class="pt-0">Desde 2017 o pais enfrenta uma crise economica, em consequencia disso as
                        pessoas estão com grandes dificuldades em construirem casas, isso deve-se a muitos factores, onde
                        podemos descrever algumas: o custo elevado dos materiais, o alto indíce de pobreza, a desvalorização
                        do kwanza, etc.
                        Com o grande impacto do dólar que tem ao nosso poder de compra isso afeta muito nos preços para a
                        aquisição dos diversos materiais tais como, o Cimento, o ferro, os azulejos, e o pagamento da
                        empreiteira, para fazer o serviço de construção de uma casa ao seu gosto, e que quase sempre sai
                        mais caro que comprar uma casa a 100% ou a modelo de renda resolúvel.

                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-text>
                        {{ new Date().getFullYear() }}-
                        <strong>SIG-VIM
                            <span class="font-weight-light">(Sistema de Gestão de Venda e de Imóveis)</span>
                        </strong>
                    </v-card-text>
                </v-card>
            </v-footer>
        </v-container>
    </v-app>
</template>
<script>
// import { Link } from "@inertiajs/inertia-vue";

export default {
    data() {
        return {
            icons: [
                "fab fa-facebook",
                "fab fa-twitter",
                "fab fa-google-plus",
                "fab fa-linkedin",
                "fab fa-instagram",
            ],
            drawer: true,
            mini: true,
            totalNotificacoes: 0,
        };
    },

    // mounted() {
    //     console.log("portal layout");
    // },

    computed: {
        user() {
            return this.$page.props.auth.user;
        },
    },
    methods: {
        logout() {
            axios.post("/logout").then((response) => {
                window.location.reload();
            });
        },
    },
};
</script>
<style>
@import "vuetify/dist/vuetify.min.css";
/* @import "./assets/scss/_custom-variable.scss";
@import "./assets/scss/style.scss"; */
body{
    font-family:'Poppins-Regular';
}
</style>
