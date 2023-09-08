<template>
    <v-app>
        <!-- <v-subheader>Meus Anúcios</v-subheader> -->
        <v-container  class="w-90 justify-space-around">
        <v-row>
            <v-subheader class="text-h5 text-bold mt-10 ">Meus Anuncios</v-subheader>
            <v-col v-for="item in meus_anuncios" :key="item.id" cols="12" sm="6" md="3" :lg="meus_anuncios.length <= 3 ? 6 : 3">
                <v-hover v-slot="{ hover }">

                    <v-card :loading="!loading" class=" elevation-10 pa-2 ma-3 border" :elevation="hover ? 10 : 0">
                        <!-- <v-img height="150" src="/img/pexels-dids-2969915.jpg"></v-img> -->
                        <v-img height="200"  gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.2)" :src="'/storage/' +
                                                    item.foto_principal" ></v-img>
                        <v-card-title v-text="item.designacao"></v-card-title>

                        <v-card-text>
                            <!-- <v-row align="center" class="mx-0">
                                        <v-rating :value="4.5" color="amber" dense half-increments readonly
                                            size="14"></v-rating>
                                    </v-row> -->

                                    <div>{{item.descricao}}
                            </div>
                        </v-card-text>

                        <v-divider class="mx-1"></v-divider>

                        <!-- <v-card-title v-text="item.designacao"></v-card-title> -->

                        <v-card-actions class="pa-0 ma-0">
                            <v-chip-group v-model="selection"
                                                        active-class="deep-purple accent-4 white--text" column>
                                                        <v-chip><span class="mdi mdi-seat-individual-suite"
                                                                title="Dormitório">{{ item.suite }}</span></v-chip>
                                                        <v-chip><span class="mdi mdi-car"
                                                                title="Garagem">{{ item.numero_garagem }}</span></v-chip>
                                                        <v-chip><span class="mdi mdi-chart-areaspline-variant"
                                                                title="Superficie ">{{ item.metros
                                                                }}<sup>2</sup></span></v-chip>

                                                        <v-chip title="Cozinha"><span
                                                                class="mdi mdi-countertop"></span>{{ item.cozinha }}</v-chip>
                                                        <v-chip title="Quarto de Banho">
                                                            <span class="mdi mdi-shower-head"></span>{{
                                                                item.numero_banheiro }}</v-chip>
                                                        <v-chip v-for="(actidade) in item.actividade_imoveis"
                                                            :key="actidade.id" v-if="actidade.tempo_arrendar > 0">

                                                            <span class="mdi mdi-timer-lock-outline"
                                                                title="Arrendamento"></span>{{
                                                                    actidade.tempo_arrendar }} </v-chip>
                                                        <v-chip title="estado do imóvel">
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

                                                            {{ item.estado_imoveis.designacao }}</v-chip>
                                                    </v-chip-group>
                        </v-card-actions>

                        <v-card-actions class="justify-end">
                            <v-btn icon color="deep-purple lighten-2" outlined rounded  title="Gostei do Imóvel">
                                <v-icon>
                                    mdi mdi-pencil-outline
                                </v-icon>
                            </v-btn>
                            <v-btn icon color="red" outlined rounded  title="Gostei do Imóvel">
                                <v-icon>
                                    mdi mdi-delete-outline
                                </v-icon>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-hover>
            </v-col>
        </v-row>
    </v-container>
    </v-app>
</template>

<script>
import AdminLayout from "../../../Templates/AdminLayout";
export default {

    props: ["meus_anuncios"],
    components: {
        AdminLayout
    },
    data: () => ({
        loading: null,
        condominio: {},
        clientes: [
            {
                id: 1,
                title: "Casa 1",
                subtitle: "Localização 1",
                src: "/img/pexels-dids-2969915.jpg",
            },
            {
                id: 2,
                title: "Residencial T4",
                subtitle: "Localização 2",
                src: "https://cdn.quasar.dev/img/parallax2.jpg",
            },
            {
                id: 3,
                title: "Resincia em contrução 3",
                subtitle: "LOCALIZAÇÃO 3",
                src: "https://cdn.quasar.dev/img/parallax2.jpg",
            },
            {
                id: 4,
                title: "CLIENTE 3",
                subtitle: "LOCALIZAÇÃO 3",
                // description:
                //     "Aliquam albucius mei ei, debitis torquatos et pro, eos natum scribentur no. Putant verear constituto te qui. Adolescens persequeris vim ei. Vel nullam reprimique te.",
                src: "https://cdn.quasar.dev/img/parallax2.jpg",
            },
        ],
    }),


    mounted() {
        this.loading = true;
        setTimeout(function () {
            this.loading = false;
        }, 2000);
        // alert(this.condominios);
    },
    computed: {
        user() {
            return this.$page.props.auth.user;
        },
        formTitle() {
            return this.editedIndex === -1 ? "Novo Condomínio" : "Editar ";
        },
    },

    created() {
        setTimeout(() => {
            this.overlay = false;
        }, 2000);
    },

    watch: {
        steps(val) {
            if (this.e1 > val) {
                this.e1 = val;
            }
        },
    },

    methods: {
        setNovoCondominio() {
            // this.loading = true;

            this.$inertia.post("/condominios", this.condominio, {});

            // axios
            //     .post(this.base_url + "/condominios", this.condominio)
            //     .then((response) => {
            //         this.loading = false;
            //         alert(JSON.stringify(response.data));
            //         //   this.resposta = response.data
            //     })
            //     .catch(() => {
            //         alert(JSON.stringify(response.data));

            //         //   console.log('Falha ao registar os dados na base de dados!...')
            //     });
        },
        showDialogAddCondominio() {
            this.dialogAddCondominio = true;
        },
        continuar(stepe, form) {
            if (this.$refs[form].validate()) {
                this.e1 = stepe;
            }
        },
        continuar2(stepe, form) {
            if (this.$refs[form].validate()) {
                this.e1 = stepe;
            }
        },

        validate() {
            this.$refs.form.validate();
            this.$refs.form2.validate();
        },

        close() {
            this.morador = {};
            this.dialogAddCondominio = false;
            this.$nextTick(() => {
                this.morador = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
            setTimeout(() => {
                this.overlay = false;
            }, 2000);
        },
    },
};
</script>
<style>
@import "vuetify/dist/vuetify.min.css";
</style>