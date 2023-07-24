<template>
    <AdminLayout>

  <v-container>
<v-row>
    col
</v-row>
  </v-container>

                        

    </AdminLayout>
</template>

<script>
import AdminLayout from "../../../Templates/AdminLayout";
import Perfil from "../Clientes/Perfil";
import PerfilCliente from "../Clientes/PerfilCliente";
export default {
    props: ["generos"],
    components: {
        AdminLayout,
        Perfil,
        PerfilCliente,
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
        linhaSelecionado: null,
        meudados:1,
        meusAnucios:2, 
        meusProceso:3,
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
        initialize() { },

        novo_registo() {
            this.dialogNovoCadastro = true;
        },
meuPerfil(){
    alert(1);
},
selectItem(item) {
      this.linhaSelecionado = item;
    //   alert(item)
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
.item-selected {
  background-color: #885cda;
}
</style>
