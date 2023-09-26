<template>
    <v-app>
        <v-container class="w-80 justify-space-around my-13 py-10">
            <v-subheader class="text-h4 text-bold ">Minhas solicitações</v-subheader> <v-row>

                <v-col v-for="item in minha_compra_arrendamentos" :key="item.id" cols="12" sm="6" md="4"
                    :lg="minha_compra_arrendamentos.length <= 2 ? 6 : 4">
                    <v-hover v-slot="{ hover }">

                        <v-card :loading="!loading" class=" elevation-10 pa-2 ma-3 border" :elevation="hover ? 10 : 0">
                            <!-- <v-img height="150" src="/img/pexels-dids-2969915.jpg"></v-img> -->
                            <v-img height="180" gradient="to bottom, rgba(0,0,0,.4), rgba(0,0,0,.2)" :src="'/storage/' +
                                item.foto_principal"></v-img>
                            <v-card-title>¨{{ item.designacao }}</v-card-title>

                            <v-card-text>
                                <!-- <v-row align="center" class="mx-0">
                                        <v-rating :value="4.5" color="amber" dense half-increments readonly
                                            size="14"></v-rating>
                                    </v-row> -->

                                <div>{{ item.descricao }}
                                </div>
                            </v-card-text>

                            <v-divider class="mx-1 my-0 py-0"></v-divider>

                            <!-- <v-scard-title v-text="item.descricao"></v-scard-title> -->

                            <v-card-actions class="pa-0 ma-0">
                                <v-chip-group v-model="selection" active-class="deep-purple accent-4 white--text" column>
                                    <v-chip><span class="mdi mdi-seat-individual-suite" title="Dormitório">{{ item.suite
                                    }}</span></v-chip>
                                    <v-chip><span class="mdi mdi-car" title="Garagem">{{ item.numero_garagem
                                    }}</span></v-chip>
                                    <v-chip><span class="mdi mdi-chart-areaspline-variant" title="Superficie ">{{
                                        item.metros
                                    }}<sup>2</sup></span></v-chip>

                                    <v-chip title="Cozinha"><span class="mdi mdi-countertop"></span>{{ item.cozinha
                                    }}</v-chip>
                                    <v-chip title="Quarto de Banho">
                                        <span class="mdi mdi-shower-head"></span>{{
                                            item.numero_banheiro }}</v-chip>
                                    <v-chip v-for="(actidade) in item.actividade_imoveis" :key="actidade.id"
                                        v-if="actidade.tempo_arrendar > 0">

                                        <span class="mdi mdi-timer-lock-outline" title="Arrendamento"></span>{{
                                            actidade.tempo_arrendar }} </v-chip>
                                    <v-chip title="estado do imóvel" :color="getcor(item.estado_imoveis_id)"
                                        class="white--text text-bold">
                                        <span v-if="item.estado_imoveis_id == 1" class="mdi mdi-archive-lock-open "></span>
                                        <span v-if="item.estado_imoveis_id == 2" class="mdi mdi-archive-remove"></span>
                                        <span v-if="item.estado_imoveis_id == 3" class="mdi mdi-archive-cog "></span>
                                        <span v-if="item.estado_imoveis_id == 4" class="mdi mdi-archive-eye"></span>
                                        <span v-if="item.estado_imoveis_id == 5" class="mdi mdi-archive-refresh"></span>

                                        {{ item.estado_imoveis.designacao }}</v-chip>
                                </v-chip-group>
                            </v-card-actions>
                            <v-card-actions class="justify-end m-0 p-0">
                                <v-btn icon :disabled="item.estado_imoveis_id !== 5 || user.tipo_user.id == 1"
                                    color="green" outlined rounded title="Gostei do Imóvel" @click="gostarImovel(item.id)"
                                    v-model="validar_gostar.valiado">
                                    <v-icon>
                                        mdi mdi-thumb-up
                                    </v-icon>
                                </v-btn>
                                <v-btn icon :disabled="item.estado_imoveis_id !== 5 || user.tipo_user.id == 1 " color="red" outlined rounded
                                    title="Não gostei do Imóvel" @click="naogostarImovel(item.id)"
                                    v-model="validar_gostar.naoValiado">
                                    <v-icon>
                                        mdi mdi-thumb-down
                                    </v-icon>
                                </v-btn>
                                <v-btn icon v-if="user.tipo_user.id == 1  && item.estado_imoveis_id ==4 " color="red" outlined rounded
                                    title="Nao Aprovar a visita do imóvel" @click="naoValidarVisita(item.id)"
                                    v-model="validar_processo.aprovaVisita">
                                    <v-icon>
                                        mdi mdi-hand-back-left-off-outline

                                    </v-icon>
                                </v-btn>
                                <v-btn icon v-if="user.tipo_user.id == 1 && item.estado_imoveis_id ==4" color="indigo" outlined rounded
                                    title="Aprovar a visita do imóvel" @click="validaVisita(item.id)"
                                    v-model="validar_processo.naoAprovarVisita">
                                    <v-icon>
                                        mdi mdi-handshake
                                    </v-icon>
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-hover>
                </v-col>
            </v-row>
            <div class="text-center">
                <v-snackbar v-model="snackbar" :multi-line="multiLine" :timeout="8000" outlined
                    color="deep-purple accent-4">
                    {{ textvalidado }}
                    <v-btn color="indigo" text @click="snackbar = false">
                        Close
                    </v-btn>
                </v-snackbar>
            </div>
            <div class="text-center">
                <v-snackbar v-model="snackbarNaovalidado" :multi-line="multiLine" :timeout="8000" outlined
                    color="deep-purple accent-4">
                    {{ textnaovalidado }}
                    <v-btn color="indigo" text @click="snackbarNaovalidado = false">
                        Close
                    </v-btn>
                </v-snackbar>
            </div>
        </v-container>
    </v-app>
</template>

<script>
import AdminLayout from "../../../Templates/AdminLayout";
export default {

    props: ["minha_compra_arrendamentos"],
    components: {
        AdminLayout
    },
    data: () => ({
        loading: null,
        snackbar: false,
        textnaovalidado: `Descontinuidade do processo da negociação do Imóvel`,
        textvalidado: `Confirmaste a continuação da negociação do Imóvel Confirmaste a continuação da negociação do Imóvel`,
        snackbarNaovalidado: false,
        validar_processo: {},
        validar_gostar: {},
        dadoscarregado: [],
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
        this.getcor(estado_imoveis_id)
        this.getImoveisprocesso()
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
        getcor(estado_imoveis_id) {
            if (estado_imoveis_id == 1) {
                return 'green'
            } else if (estado_imoveis_id == 2) {
                return 'deep-orange darken-4'
            } else if (estado_imoveis_id == 3) {
                return 'blue-grey darken-4'
            } else if (estado_imoveis_id == 4) {
                return 'yellow darken-3'
            } else if (estado_imoveis_id == 5) {
                return 'deep-purple darken-2'
            } else if (estado_imoveis_id == 6) {
                return 'red darken-4'
            } else if (estado_imoveis_id == 7) {
                return 'red darken-4'
            } else if (estado_imoveis_id == 8) {
                return 'amber accent-4'
            }
        },
        getImoveisprocesso() {
            this.loading = true;
            this.validar_processo.imovel_id = item
            axios
                .get("/carregar-imoveis-processo")
                .then((response) => {
                    this.dadoscarregado = response.data;
                    this.snackbar = true;
                    alert(JSON.stringify(response.data));
                })
                .catch(() => {
                    alert(JSON.stringify(response.data));
                });
        },
        gostarImovel(item) {
            this.loading = true;
            this.validar_gostar.imovel_id = item
            // alert(JSON.stringify( this.validar_processo));
            axios
                .post("/gostar-imovel", this.validar_gostar)
                .then((response) => {
                    this.loading = true;
                    this.snackbar = true;
                    alert(JSON.stringify(response.data));
                })
                .catch(() => {
                    alert(JSON.stringify(response.data));
                    //   console.log('Falha ao registar os dados na base de dados!...')
                });
        },
        naogostarImovel(item) {
            this.loading = true;
            this.validar_gostar.imovel_id = item
            axios
                .post("/nao-gostar-imovel", this.validar_gostar)
                .then((response) => {
                    this.loading = true;
                    this.snackbarNaovalidado = true;
                })
                .catch(() => {
                    // alert(JSON.stringify(response.data));
                    //   console.log('Falha ao registar os dados na base de dados!...')
                });
            location.reload();
        },
        validaVisita(item) {
            this.loading = true;
            this.validar_processo.imovel_id = item
            // alert(JSON.stringify( this.validar_processo));
            axios
                .post("/validar-processo", this.validar_processo)
                .then((response) => {
                    this.loading = true;
                    this.snackbar = true;
                    alert(JSON.stringify(response.data));
                })
                .catch(() => {
                    alert(JSON.stringify(response.data));
                    //   console.log('Falha ao registar os dados na base de dados!...')
                });
        },
        naoValidarVisita(item) {
            this.loading = true;
            this.validar_processo.imovel_id = item
            axios
                .post("/nao-validar-processo", this.validar_processo)
                .then((response) => {
                    this.loading = true;
                    this.snackbarNaovalidado = true;
                })
                .catch(() => {
                    // alert(JSON.stringify(response.data));
                    //   console.log('Falha ao registar os dados na base de dados!...')
                });
            location.reload();
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