<template>
  <v-app>
        
      <v-subheader>Meu Prefil</v-subheader>
      <v-row>

      </v-row>
    </v-app>
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
<style>
@import "vuetify/dist/vuetify.min.css";
</style>