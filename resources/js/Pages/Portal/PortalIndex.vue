<template>
    <PortalLayout>

        <template class="pb-0 ">

            <v-toolbar-title class="deep-purple darken-3 elevation-0"
                :style="'border-radius: 0px 0px 0px 350px; height:450px'">
                <!-- <v-card-title>
                 <span class="headline">Título do Card</span> 
                </v-card-title> -->
                <v-row class="p-0">
                    <v-col cols="12" sm="2" md="4" :style="' white-space:nowrap; padding:0; '">

                        <!-- <v-card-text>
                            <v-img gradient="to top right, rgba(255,115,201,.1), rgba(25,32,72,.7)"
                                :style="'white-space:nowrap; padding:0;max-width: 100%;height:55vh; position:relative;top:50px;left:-5px; ; border-radius: 0 80px 0px 60px;'"
                                src="/img/jason-briscoe.jpg" >
                                </v-img>
                            <div class="bottom-gradient"></div>
                        </v-card-text> -->
                    </v-col>
                    <v-col cols="12" sm="10" md="8" class="container--fluid">
                        <v-card elevation="0" color="transparent" class="white--text"
                            :style="'justify-content: center; padding-top:5rem; font-size:0.4rem'">
                            <h1>
                                <p class="text-bold text-justify">No Kubico tem.</p>
                            </h1>
                            <h2> O imóvel que deseja e o que procuras está aqui</h2>

                            <p class="text-h4 pt-3 text-justify">compra, arrenda ou vende o seu imóvel residencial.</p>
                            <v-row class="px-5">
                                <v-col cols="6" sm="" md="6" align="center">
                                    <v-btn :disabled="loading" class="ma-1" color="white" text>
                                        Comprar
                                    </v-btn>
                                </v-col>
                                <v-col cols="6" md="6" align="center">
                                    <v-btn :disabled="loading" class="ma-1" color="white" plain>
                                        Arrendar
                                    </v-btn>
                                </v-col>
                                <v-col cols="6" md="6" class="opens-sans mb-n8">
                                    <v-autocomplete dense item-text="designacao" item-value="id" prepend-icon=""
                                        label="Localização" clearable full-width hover solo>
                                    </v-autocomplete>
                                </v-col>
                                <v-col cols="4" md="4" class="opens-sans mb-n8">
                                    <v-autocomplete dense clearable item-text="designacao" item-value="id" prepend-icon=""
                                        label="Estado" full-width solo>
                                    </v-autocomplete>
                                </v-col>
                                <v-col cols="2" md="2">
                                    <v-btn dense :disabled="loading" d-none d-lg-flex btn-custom-nm ml-5>
                                        pesquisar
                                    </v-btn>
                                </v-col>
                            </v-row>

                        </v-card>




                    </v-col>

                </v-row>
            </v-toolbar-title>
        </template>
        <!-- Lançamentos mais recentes -->
        <template>
            <v-container>
                <v-row no-gutters justify="pt-15" :style="'justify-content: center;'" class="pt-14">
                    <v-toolbar-title class="deep-purple darken-3">

                        <v-card-title class="Centralizar-linha">Lançamentos mais recentes</v-card-title>
                    </v-toolbar-title>
                    <v-col v-for="item in novos_imoveis" :key="item.id" cols="12" sm="12" md="" class="mx-1"
                        :lg="novos_imoveis.length <= 3 ? 6 : 4" :style="'max-width: min-content;'">
                        <v-hover v-slot="{ hover }">

                            <v-card :loading="loading" class="mx-5 my-12 elevation-10" max-width="320"
                                @click.stop="findImoveis(item.id)" :elevation="hover ? 10 : 0">
                                <v-img height="150" :src="'/storage/' + item.foto_principal"></v-img>

                                <v-card-title>{{ item.title }}</v-card-title>
                                <v-card-subtitle class="text--subtitle">{{ item.designacao }}</v-card-subtitle>

                                <v-card-text>
                                    <v-row align="center" class="mx-0">
                                        <v-rating :value="4.5" color="amber" dense half-increments readonly
                                            size="14"></v-rating>
                                    </v-row>

                                    <!-- <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus
                                        patio seating.
                                    </div> -->
                                </v-card-text>

                                <v-divider class="mx-4"></v-divider>

                                <v-card-text>
                                    <v-chip-group v-model="selection"
                                                        active-class="deep-purple accent-4 white--text" column>
                                                        <v-chip><span class="mdi mdi-seat-individual-suite"
                                                                title="Dormitório">{{ item.suite }}</span></v-chip>
                                                        <v-chip><span class="mdi mdi-car" title="Garagem">{{
                                                            item.numero_garagem }}</span></v-chip>
                                                        <v-chip><span class="mdi mdi-chart-areaspline-variant"
                                                                title="Superficie ">{{ item.metros
                                                                }}<sup>2</sup></span></v-chip>

                                                        <v-chip title="Cozinha"><span class="mdi mdi-countertop"></span>{{
                                                            item.cozinha }}</v-chip>
                                                        <v-chip title="Quarto de Banho">
                                                            <span class="mdi mdi-shower-head"></span>{{
                                                                item.numero_banheiro }}</v-chip>
                                                        <v-chip v-for="(actidade) in item.actividade_imoveis"
                                                            :key="actidade.id" v-if="actidade.tempo_arrendar > 0">

                                                            <span class="mdi mdi-timer-lock-outline" 
                                                                title="Arrendamento"  ></span >{{
                                                                    actidade.tempo_arrendar }} </v-chip>
                                                        <v-chip color="deep-purple" title="estado do imovel" class="white--text">
                                                            <span v-if="item.estado_imoveis_id == 1"
                                                                class="mdi mdi-archive-lock-open "></span>
                                                            <span v-if="item.estado_imoveis_id == 2"
                                                                class="mdi mdi-archive-remove"></span>
                                                            <span v-if="item.estado_imoveis_id == 3"
                                                                class="mdi mdi-archive-cog "></span>
                                                            <span v-if="item.estado_imoveis_id == 4"
                                                                class="mdi mdi-archive-eye"></span>
                                                            <span v-if="item.estado_imoveis_id == 5"
                                                                class="mdi mdi-archive-refresh"></span>

                                                            {{ item.estado_imoveis.designacao }} </v-chip>
                                                    </v-chip-group>
                                </v-card-text>

                                <!-- <v-card-actions>
                                    <v-btn color="deep-purple lighten-2" text>

                                    </v-btn>
                                </v-card-actions> -->
                            </v-card>
                        </v-hover>
                    </v-col>
                    <v-row class="mb-10" justify="end">
                    <v-col cols="7">

                    </v-col>
                    <v-spacer />
                    <v-col cols="5">
                        <v-pagination @input="paginacao(page)" v-model="page" :length="last_page" circle></v-pagination>
                    </v-col>
                </v-row>
            </v-col>
                </v-row>
            </v-container>
        </template>

        <!-- Lançamentos próximos a você -->
        <template>
            <v-toolbar-title class="deep-purple darken-3 elevation-0">

                <v-card-title class="Centralizar-linha ">Lançamentos próximos a você</v-card-title>
            </v-toolbar-title>
            <v-container>
                <v-row no-gutters justify="pt-15" :style="'justify-content: center;'" class="pt-14">
                    <v-col v-for="item in mais_proximos" :key="item.id" cols="12" sm="12" md="" class="mx-1"
                        :lg="mais_proximos.length <= 3 ? 6 : 4" :style="'max-width: min-content;'">
                        <v-hover v-slot="{ hover }">

                            <v-card :loading="loading" class="mx-5 my-12 elevation-10" max-width="320"
                                @click.stop="findImoveis(item.id)" :elevation="hover ? 10 : 0">
                                <v-img height="150" :src="'/storage/' + item.foto_principal"></v-img>

                                <v-card-title>{{ item.designacao }}</v-card-title>
                                <v-card-subtitle class="text--subtitle">{{ item.subtitle }}</v-card-subtitle>

                                <v-card-text>
                                    <v-row align="center" class="mx-0">
                                        <v-rating :value="4.5" color="amber" dense half-increments readonly
                                            size="14"></v-rating>
                                    </v-row>

                                    <!-- <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus
                                        patio seating.
                                    </div> -->
                                </v-card-text>

                                <v-divider class="mx-4"></v-divider>

                                <v-card-text>
                                    <v-chip-group v-model="selection"
                                                        active-class="deep-purple accent-4 white--text" column>
                                                        <v-chip><span class="mdi mdi-seat-individual-suite"
                                                                title="Dormitório">{{ item.suite }}</span></v-chip>
                                                        <v-chip><span class="mdi mdi-car" title="Garagem">{{
                                                            item.numero_garagem }}</span></v-chip>
                                                        <v-chip><span class="mdi mdi-chart-areaspline-variant"
                                                                title="Superficie ">{{ item.metros
                                                                }}<sup>2</sup></span></v-chip>

                                                        <v-chip title="Cozinha"><span class="mdi mdi-countertop"></span>{{
                                                            item.cozinha }}</v-chip>
                                                        <v-chip title="Quarto de Banho">
                                                            <span class="mdi mdi-shower-head"></span>{{
                                                                item.numero_banheiro }}</v-chip>
                                                        <v-chip v-for="(actidade) in item.actividade_imoveis"
                                                            :key="actidade.id" v-if="actidade.tempo_arrendar > 0">

                                                            <span class="mdi mdi-timer-lock-outline" 
                                                                title="Arrendamento"  ></span >{{
                                                                    actidade.tempo_arrendar }} </v-chip>
                                                        <v-chip color="deep-purple" title="estado do imovel" class="white--text">
                                                            <span v-if="item.estado_imoveis_id == 1"
                                                                class="mdi mdi-archive-lock-open "></span>
                                                            <span v-if="item.estado_imoveis_id == 2"
                                                                class="mdi mdi-archive-remove"></span>
                                                            <span v-if="item.estado_imoveis_id == 3"
                                                                class="mdi mdi-archive-cog "></span>
                                                            <span v-if="item.estado_imoveis_id == 4"
                                                                class="mdi mdi-archive-eye"></span>
                                                            <span v-if="item.estado_imoveis_id == 5"
                                                                class="mdi mdi-archive-refresh"></span>

                                                            {{ item.estado_imoveis.designacao }} </v-chip>
                                                    </v-chip-group>
                                </v-card-text>

                                <!-- <v-card-actions>
                                    <v-btn color="deep-purple lighten-2" text>

                                    </v-btn>
                                </v-card-actions> -->
                            </v-card>
                        </v-hover>
                    </v-col>
                    <v-row class="mb-10" justify="end">
                    <v-col cols="7">

                    </v-col>
                    <v-spacer />
                    <v-col cols="5">
                        <v-pagination @input="paginacao(page)" v-model="page" :length="last_page_proximo" circle></v-pagination>
                    </v-col>
                </v-row>
            
                </v-row>
            </v-container>
        </template>

        <template>
            <v-toolbar-title class="deep-purple darken-3 elevation-0">

                <v-card-title class="Centralizar-linha ">Imoveis em zonas Urbanas</v-card-title>
            </v-toolbar-title>
            <v-container>
                <v-row no-gutters justify="pa-0" :style="'justify-content: center;'">
                    <!-- <v-card-title class="Centralizar-linha ">Imoveis em zonas Urbanas</v-card-title> -->
                    <v-col cols="12" sm="12" md="4" class="mx-3" :style="'flex-basis: min-content;'">
                        <v-hover v-slot="{ hover }">

                            <v-card :loading="loading" class="mx-auto my-12 elevation-10" max-width="350"
                                :elevation="hover ? 10 : 0">
                                <template slot="progress">
                                    <v-progress-linear color="deep-purple" height="10" indeterminate></v-progress-linear>
                                </template>

                                <v-img height="150" src="/img/Aaa.png"></v-img>

                                <v-card-title>T2</v-card-title>

                                <v-card-text>
                                    <v-row align="center" class="mx-0">
                                        <v-rating :value="4.1" color="amber" dense half-increments readonly
                                            size="14"></v-rating>
                                    </v-row>

                                    <!-- <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus
                                        patio seating.
                                    </div> -->
                                </v-card-text>

                                <v-divider class="mx-4"></v-divider>

                                <v-card-title>Apenas para Benguela</v-card-title>

                                <v-card-text>
                                    <v-chip-group v-model="selection" active-class="deep-purple accent-4 white--text"
                                        column>
                                        <v-chip text-color="white" color="indigo">5</v-chip>

                                        <v-chip>7</v-chip>

                                        <v-chip>8</v-chip>

                                    </v-chip-group>
                                </v-card-text>
                                <!-- 
                                <v-card-actions>
                                    <v-btn color="deep-purple lighten-2" text>

                                    </v-btn>
                                </v-card-actions> -->
                            </v-card>
                        </v-hover>

                        <span align="center">
                            <h1>Municipios</h1>
                            <p>Luanda</p>
                            <p>Benguela</p>
                            <p>Lubito</p>
                            <p>Benfica</p>
                            <p>Mutamba</p>
                            <p>Caxito</p>
                            <p>Vila de Viana</p>
                            <p>Talatona</p>
                        </span>

                    </v-col>

                    <v-col cols="12" sm="12" md="4" class="mx-3" :style="'flex-basis: min-content;'">
                        <v-hover v-slot="{ hover }">

                            <v-card :loading="loading" class="mx-auto my-12 elevation-10" max-width="350"
                                :elevation="hover ? 10 : 0">
                                <template slot="progress">
                                    <v-progress-linear color="deep-purple" height="10" indeterminate></v-progress-linear>
                                </template>

                                <v-img height="150" src="/img/Casas_edit.jpeg"></v-img>

                                <v-card-title>T1</v-card-title>

                                <v-card-text>
                                    <v-row align="center" class="mx-0">
                                        <v-rating :value="4.1" color="amber" dense half-increments readonly
                                            size="14"></v-rating>
                                    </v-row>

                                    <!-- <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus
                                        patio seating.
                                    </div> -->
                                </v-card-text>

                                <v-divider class="mx-4"></v-divider>

                                <v-card-title>Apenas para Benguela</v-card-title>

                                <v-card-text>
                                    <v-chip-group v-model="selection" active-class="deep-purple accent-4 white--text"
                                        column>
                                        <v-chip>5</v-chip>

                                        <v-chip>7</v-chip>

                                        <v-chip>8</v-chip>

                                    </v-chip-group>
                                </v-card-text>
                                <!-- 
                                <v-card-actions>
                                    <v-btn color="deep-purple lighten-2" text>

                                    </v-btn>
                                </v-card-actions> -->
                            </v-card>
                        </v-hover>
                        <span align="center">
                            <h3>Municipios</h3>
                            <p>Luanda</p>
                            <p>Benguela</p>
                            <p>Lubito</p>
                            <p>Benfica</p>
                            <p>Mutamba</p>
                            <p>Caxito</p>
                            <p>Vila de Viana</p>
                            <p>Talatona</p>
                        </span>
                    </v-col>

                    <v-col cols="12" sm="12" md="4" class="mx-3" :style="'flex-basis: min-content;'">
                        <v-hover v-slot="{ hover }">

                            <v-card :loading="loading" class="mx-auto my-12 elevation-10" max-width="350"
                                :elevation="hover ? 10 : 0">
                                <template slot="progress">
                                    <v-progress-linear color="deep-purple" height="10" indeterminate></v-progress-linear>
                                </template>

                                <v-img height="150" src="/img/Casas_edit.jpeg"></v-img>

                                <v-card-title>T4</v-card-title>

                                <v-card-text>
                                    <v-row align="center" class="mx-0">
                                        <v-rating :value="4.1" color="amber" dense half-increments readonly
                                            size="14"></v-rating>
                                    </v-row>

                                    <!-- <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus
                                        patio seating.
                                    </div> -->
                                </v-card-text>

                                <v-divider class="mx-4"></v-divider>

                                <v-card-title>Apenas Para Benguela</v-card-title>

                                <v-card-text>
                                    <v-chip-group v-model="selection" active-class="deep-purple accent-4 white--text"
                                        column>
                                        <v-chip>5</v-chip>

                                        <v-chip>7</v-chip>

                                        <v-chip>8</v-chip>

                                    </v-chip-group>
                                </v-card-text>
                                <!-- 
                                <v-card-actions>
                                    <v-btn color="deep-purple lighten-2" text>

                                    </v-btn>
                                </v-card-actions> -->
                            </v-card>
                        </v-hover>
                        <span align="center">
                            <h3>Municipios</h3>
                            <p>Luanda</p>
                            <p>Benguela</p>
                            <p>Lubito</p>
                            <p>Benfica</p>
                            <p>Mutamba</p>
                            <p>Caxito</p>
                            <p>Vila de Viana</p>
                            <p>Talatona</p>
                        </span>
                    </v-col>
                </v-row>
                <v-divider></v-divider>
            </v-container>

        </template>

        <!-- Contactos
        <v-template>
            <v-container  >
                <div class="staticHero">
                    <v-img src="../assets/images/img14.jpg">
                        <v-row align="end" class="lightbox white--text pa-2 fill-height">
                            <v-col>
                                <v-container>
                                    <div class="headline">Contactos</div>
                                </v-container>
                            </v-col>
                        </v-row>
                    </v-img>
                </div>
                <div >
                    <v-container class="w-50 justify-content-around" >
                        <v-card class="elevation-2  ma-3"  >
                            <v-form ref="form" v-model="valid" lazy-validation >
                            <v-text-field v-model="name" outlined :counter="10" :rules="nameRules" label="Nome Completo"
                                required></v-text-field>
                            <v-text-field v-model="email" outlined :rules="emailRules" label="Email" required></v-text-field>
                            <v-textarea v-model="message" outlined  :rules="messageRules" label="Mensagem por enviar"
                                required></v-textarea>
                            <v-btn :disabled="!valid" color="primary" class="mr-4" @click="validate">Enviar Mensagem</v-btn>
                            <v-btn outlined color="error" class="mr-4" @click="reset">Limpar Formulário</v-btn>
                        </v-form>
                        </v-card>
                        
                    </v-container>
                </div>
                 <div class="googlemap">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16705.802661855836!2d-0.14290489950731525!3d51.50711704027593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon!5e0!3m2!1sen!2suk!4v1577041400110!5m2!1sen!2suk"
                        width="100%" height="450"></iframe>
                </div> 
            </v-container>
        </v-template> -->
    </PortalLayout>
</template>

<script>
import AdminLayout from "../../Templates/AdminLayout";
import PortalLayout from "../../Templates/PortalLayout";
export default {
    props: ['startingImage', 'autoSlideInterval', 'showProgressBar'],

    components: {
        AdminLayout,
        PortalLayout,
    },
    data: () => ({
        page:1,
        pageProximo:1,
        last_page:1,
        last_page_proximo:1,
        total_imoveis_proximos:1,
        total_tmoveis:0,
        novos_imoveis:[],
        mais_proximos:[],
        valid: true,
        name: "",
        nameRules: [
            (v) => !!v || "Name is required",
            (v) =>
                (v && v.length <= 10) || "Name must be less than 10 characters",
        ],
        email: "",
        emailRules: [
            (v) => !!v || "Email é obrigatório!",
            (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
        ],
        message: "",
        messageRules: [
            (v) => !!v || "Mensagem é obrigatório!",
            (v) => (v && v.length >= 10) || "Deve conter mais de 10 caracteres",
        ],

        items: [
            // {
            //     src: "https://cdn.quasar.dev/img/quasar.jpg",
            //     title: "Criatividade",
            // },
            // {
            //     src: "https://cdn.quasar.dev/img/parallax1.jpg",
            //     title: "Rapidez",
            // },
            // {
            //     src: "https://cdn.quasar.dev/img/parallax2.jpg",
            //     title: "Profissionalismo",
            // },
        ],
        show: false,
        clientes: [{
            id: 1,
            title: "Loft Contemporaneo",
            subtitle: "Loft contemporâneo com estilo industrial, localizado em um bairro revitalizado. ",
            src: "https://cdn.quasar.dev/img/parallax2.jpg",
        },
        {
            id: 2,
            title: "casa colonial T4",
            subtitle: "Elegante casa colonial, cercada por um exuberante jardim paisagístico. ",
            ssrc: "https://cdn.quasar.dev/img/parallax2.jpg",
        },
        {
            id: 3,
            title: "Apartamento T3",
            subtitle: "Apartamento compacto e bem projetado, perfeito para solteiros ou casais",
            src: "https://cdn.quasar.dev/img/parallax2.jpg",
        },
        {
            id: 4,
            title: "Casa T3",
            subtitle: "Casa moderna e sustentável, equipada com painéis solares e sistema de captação de água da chuva",   // description:
            //     "Aliquam albucius mei ei, debitis torquatos et pro, eos natum scribentur no. Putant verear constituto te qui. Adolescens persequeris vim ei. Vel nullam reprimique te.",
            src: "https://cdn.quasar.dev/img/parallax2.jpg",
        },
        {
            id: 5,
            title: "Vivenda V2",
            subtitle: "Loft contemporâneo com estilo industrial, localizado em um bairro revitalizado. Possui uma área aberta com tijolos expostos, ",
            src: "https://cdn.quasar.dev/img/parallax2.jpg",
        },
        {
            id: 5,
            title: "Apartamento V3",
            subtitle: "Elegante casa colonial, cercada por um exuberante jardim paisagístico. ",
            src: "https://cdn.quasar.dev/img/parallax2.jpg",
        },
        ],
        cidades: [{
            id: 1,
            title: "CLIENTE 1",
            subtitle: "Localização 1",
            src: "https://cdn.quasar.dev/img/parallax2.jpg",
        },
        {
            id: 2,
            title: "CLIENTE 2",
            subtitle: "Localização 2",
            src: "https://cdn.quasar.dev/img/parallax2.jpg",
        },
        {
            id: 3,
            title: "CLIENTE 3",
            subtitle: "LOCALIZAÇÃO 3",
            src: "https://cdn.quasar.dev/img/parallax2.jpg",
        },

        ],
    }),

    mounted() { },
    created(){
        this.paginacao()
        this.paginacaoImovelProximo()

    },
    methods: {
        findImoveis(id) {
            window.location.href = "/portal/imovel-selecionado/" + btoa(btoa(btoa(id)));
            // alert(id);
        },
        validate() {
            if (this.$refs.form.validate()) {
                this.snackbar = true;
            }
        },
        reset() {
            this.$refs.form.reset();
        },
        paginacao(page = 1) {
            axios
                .get("/portal/imoveisPaginacao?page=" + page, {
                })
                .then((response) => {
                    // alert(JSON.stringify(response.data.data))
                    this.novos_imoveis = response.data.novos_imoveis.data;
                    this.last_page = response.data.novos_imoveis.last_page;
                    this.total_imoveis = response.data.novos_imoveis.total;
                })
                .catch((error) => {
                    console.log(error);
                });
    },
        paginacaoImovelProximo(pageProximo = 1) {
            axios
                .get("/portal/imoveisProximoPginacao?page=" + pageProximo, {
                })
                .then((response) => {
                    // alert(JSON.stringify(response.data.data))
                   
                    this.mais_proximos = response.data.mais_proximos.data;
                    this.last_page_proximo = response.data.mais_proximos.last_page;
                    this.total_imoveis_proximos = response.data.mais_proximos.total;

                })
                .catch((error) => {
                    console.log(error);
                });
    },
},
    computed: {
        user() {
            return this.$page.props.auth.user;
        },
        col() {
            switch (this.$vuetify.breakpoint.name) {
                case "xs":
                    return 12;
                case "sm":
                    return 6;
                case "md":
                    return 3;
                case "lg":
                    return 3;
                case "xl":
                    return 3;
            }
        },

    },
};
</script>

<style>

table {
    font-weight: bolder;
}

.container {
    position: relative;
}

/* .center {
  position: relative;
  top: -150px;
  width: 100%;
  text-align: center;
  font-size: 18px;
} */
.borda-white {
    border: 2px solid rgb(255, 255, 255)
}

.imoveisListado {
    background-image: linear-gradient(to bottom right, #0077c2, #0093ff);
    margin: 0;

}

.Centralizar-linha {
    /* display: flex; */
    align-items: center;
    justify-content: center;
    color: aliceblue;
    font-size: 2rem;
    /* max-width: max-content; */

}

v-card {
    max-width: 700px;
}

/* div.container6 p {
  margin: 0 } */
.circulo {
    border-bottom-right-radius: 10px;
    /* background-image:linear-gradient(to bottom right, #0077c2, #0093ff) */
}

;</style>
