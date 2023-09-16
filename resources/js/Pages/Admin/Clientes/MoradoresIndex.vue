<template>
    <AdminLayout>
        <v-container>
            <section>
                <v-card>
                    <v-container>
                        <v-row>
                            <!-- <v-col cols="12" sm="2" md="4"> </v-col>
                            <v-col cols="12" sm="2" md="4"> </v-col> -->
                            <v-breadcrumbs
                                class="text-uppercase font-weight-bolder"
                                :items="items"
                            />
                            <v-spacer />
                            <div>
                                <!-- <v-btn class="mx-2" fab dark large color="purple">
                  <v-icon dark> mdi-plus </v-icon>
                </v-btn>

                <v-btn class="mx-2" fab dark large color="purple">
                  <v-icon dark> mdi-plus </v-icon>
                </v-btn>
                 -->
                            </div>
                            <!-- <v-divider class="mt-0" color="primary" /> -->
                        </v-row>
                    </v-container>
                </v-card>
                <v-divider></v-divider>
                <v-card>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="2" md="12">
                                <p v-for="index in 10" :key="index">
                                    Texto a ser exibido pela BD amanha! Texto a
                                    ser exibido pela BD amanha! Texto a ser
                                    exibido pela BD amanha!
                                </p>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card>

                <div class="text-right mt-4">
                    <v-btn
                        class="mx-2"
                        fab
                        dark
                        large
                        bottom
                        color="#4649FF"
                        @click="novo_registo()"
                        title="Reigstrar Novo Morador"
                    >
                        <v-icon dark> mdi-plus </v-icon>
                    </v-btn>
                </div>
                <!-- <v-btn
                    color="primary"
                    fab
                    large
                    dark
                    bottom
                    right
                    class="v-btn--example"
                >
                    <v-icon>mdi-plus</v-icon>
                </v-btn> -->
            </section>

            <v-dialog
                v-if="dialogNovoCadastro"
                v-model="dialogNovoCadastro"
                persistent
                max-width="900px"
            >
                <v-card>
                    <v-card-title class="text-h5 grey lighten-2">
                        <span class="text-h5"> {{ formTitle }}</span>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn dark text class="text-h5" @click="close()">
                                <v-icon color="red">close</v-icon>
                            </v-btn>
                        </v-toolbar-items>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-stepper flat v-model="e1">
                                <v-stepper-header>
                                    <v-stepper-step :complete="e1 > 1" step="1"
                                        >Dados Pessoais</v-stepper-step
                                    >

                                    <v-divider></v-divider>

                                    <v-stepper-step step="2"
                                        >Contrato</v-stepper-step
                                    >
                                </v-stepper-header>

                                <v-stepper-items flat>
                                    <v-stepper-content step="1">
                                        <v-card class="mb-12" flat>
                                            <v-form ref="form" lazy-validation>
                                                <v-container>
                                                    <v-row dense>
                                                        <v-col
                                                            cols="12"
                                                            md="12"
                                                        >
                                                            <v-text-field
                                                                label="Nome completo*"
                                                                :rules="[
                                                                    rules.required,
                                                                ]"
                                                                v-model="
                                                                    morador.nome_completo
                                                                "
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col cols="12" md="6">
                                                            <v-text-field
                                                                label="Nome do Pai"
                                                                v-model="
                                                                    morador.pai
                                                                "
                                                            ></v-text-field>
                                                        </v-col>

                                                        <v-col cols="12" md="6">
                                                            <v-text-field
                                                                label="Nome da Mãe"
                                                                v-model="
                                                                    morador.mae
                                                                "
                                                            ></v-text-field>
                                                        </v-col>

                                                        <v-col cols="12" md="6">
                                                            <v-text-field
                                                                label="Nº do documento"
                                                                v-model="
                                                                    morador.n_identificacao
                                                                "
                                                                :rules="[
                                                                    rules.required,
                                                                ]"
                                                                :error-messages="
                                                                    erros.n_identificacao
                                                                "
                                                            ></v-text-field>
                                                        </v-col>

                                                        <v-col cols="12" md="6">
                                                            <v-text-field
                                                                label="Data de emissão"
                                                                type="date"
                                                                v-model="
                                                                    morador.data_emissao
                                                                "
                                                            ></v-text-field>
                                                        </v-col>

                                                        <v-col cols="12" md="6">
                                                            <v-text-field
                                                                label="Data de validade"
                                                                type="date"
                                                                v-model="
                                                                    morador.data_validade
                                                                "
                                                            ></v-text-field>
                                                        </v-col>

                                                        <v-col cols="12" md="6">
                                                            <v-autocomplete
                                                                v-model="
                                                                    morador.genero_id
                                                                "
                                                                prepend-icon="assignment"
                                                                label="Generos*"
                                                                item-value="id"
                                                                item-text="designacao"
                                                                :items="generos"
                                                            ></v-autocomplete>
                                                        </v-col>
                                                    </v-row>
                                                </v-container>
                                            </v-form>
                                        </v-card>
                                        <v-card-actions>
                                            <v-spacer />
                                            <v-btn
                                                color="primary"
                                                @click="continuar(2, 'form')"
                                            >
                                                Continuar
                                            </v-btn>
                                        </v-card-actions>
                                    </v-stepper-content>

                                    <v-stepper-content step="2">
                                        <v-card flat>
                                            <v-form ref="form2" lazy-validation>
                                                <v-container>
                                                    <v-row dense>
                                                        <v-col cols="12" md="6">
                                                            <v-text-field
                                                                label="Data de validade"
                                                                type="date"
                                                                v-model="
                                                                    morador.data_validade
                                                                "
                                                            ></v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                </v-container>
                                            </v-form>
                                        </v-card>

                                        <v-card-actions>
                                            <v-btn
                                                color="warning"
                                                @click="e1 = 1"
                                                >Voltar</v-btn
                                            >

                                            <v-spacer />
                                            <v-btn
                                                class="bg-primary darken-4 white--text"
                                                @click="save"
                                            >
                                                {{
                                                    editedIndex > -1
                                                        ? "Actualizar"
                                                        : "Guardar"
                                                }}
                                            </v-btn>
                                        </v-card-actions>
                                    </v-stepper-content>
                                </v-stepper-items>
                            </v-stepper>
                        </v-container>
                    </v-card-text>
                </v-card>
            </v-dialog>
        </v-container>
    </AdminLayout>
</template>

<script>
import AdminLayout from "../../../Templates/AdminLayout";
export default {
    props: ["generos"],
    components: {
        AdminLayout,
    },
    data: () => ({
        items: [
            {
                text: "Início",
                disabled: false,
                href: "/home",
            },
            {
                text: "Listar Moradores",
                disabled: true,
                href: "/",
            },
        ],
        e1: 1,
        steps: 3,
        editedIndex: -1,
        dialogNovoCadastro: false,

        morador: {},

        erros: [],
        rules: {
            required: (value) => !!value || "Campos obrigatório.",
            max: (v) => v.length == 9 || "Tem que ter 9 caracteres",
            emailMatch: () => `The email and password you entered don't match`,
        },
        emailRules: [(v) => /.+@.+\..+/.test(v) || "E-mail deve ser válido"],

        telefoneRules: [
            (v) => !!v || "Campo telefone obrigatório.",
            (v) => (v && v.length == 9) || "Tem que ter 9 caracteres",
        ],

        documentoRules: [(v) => !!v || "Campo telefone obrigatório."],

        dateNascRules: [
            (v) => !!v || "Data é Obrigatório",
            (v) =>
                v < new Date().toISOString().substr(0, 10) ||
                "Data de Nascimento deve ser Menor que a Data Actual!",
            (v) =>
                new Date().getFullYear() - new Date(v).getFullYear() >= 18 ||
                "Idade informada é Inferior a 18",
        ],
    }),

    computed: {
        user() {
            return this.$page.props.auth.user;
        },
        formTitle() {
            return this.editedIndex === -1 ? "Novo Cadastro" : "Editar ";
        },
    },

    created() {
        // setTimeout(() => {
        //     this.overlay = false;
        // }, 2000);
    },

    watch: {
        steps(val) {
            if (this.e1 > val) {
                this.e1 = val;
            }
        },
    },

    methods: {
        initialize() {},

        novo_registo() {
            this.dialogNovoCadastro = true;
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
            this.dialogNovoCadastro = false;
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
