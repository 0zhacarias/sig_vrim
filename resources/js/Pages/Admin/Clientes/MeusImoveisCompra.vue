<template>
    <v-app>
        <v-subheader>Meus Imoveis solicitados</v-subheader>
        <v-row>
            <v-col v-for="item in clientes" :key="item.id" cols="12" sm="6" md="4" :lg="clientes.length <= 3 ? 6 : 4">
                <v-hover v-slot="{ hover }">

                    <v-card :loading="!loading" class=" elevation-10 pa-2 ma-3 border" :elevation="hover ? 10 : 0">
                        <!-- <v-img height="150" src="/img/pexels-dids-2969915.jpg"></v-img> -->
                        <v-img height="200"  gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.2)" :src="item.src" ></v-img>
                        <v-card-title>¨{{ item.title }}</v-card-title>

                        <v-card-text>
                            <!-- <v-row align="center" class="mx-0">
                                        <v-rating :value="4.5" color="amber" dense half-increments readonly
                                            size="14"></v-rating>
                                    </v-row> -->

                                    <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus
                                patio seating.
                            </div>
                        </v-card-text>

                        <v-divider class="mx-1"></v-divider>

                        <v-card-title v-text="item.subtitle"></v-card-title>

                        <v-card-text>
                            <v-chip-group v-model="selection" active-class="deep-purple accent-4 white--text" column>
                                <v-chip><span class="mdi mdi-car"></span>5</v-chip>

                                <v-chip><span class="mdi mdi-faucet-variant"></span>7</v-chip>

                                <v-chip>
                                    <span class="mdi mdi-bed-double"></span>8</v-chip>
                            </v-chip-group>
                        </v-card-text>

                        <v-card-actions class="justify-end">
                            <v-btn icon color="deep-purple lighten-2" outlined rounded  title="Gostei do Imóvel">
                                <v-icon>
                                    mdi mdi-thumb-up-outline
                                </v-icon>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-hover>
            </v-col>
        </v-row>
    </v-app>
</template>

<script>
import AdminLayout from "../../../Templates/AdminLayout";
export default {

    props: ["condominios"],
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