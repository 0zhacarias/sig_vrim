<template>
    <PortalLayout>
        <v-container>
            <template class="ma-10" color="grey">
                <v-card-text class="text-h4">
                    <template>
                        <v-carousel cycle height="500" hide-delimiter-background show-arrows="hover">
                            <v-carousel-item v-for="(slide, i) in slides" :key="i">
                                <v-sheet :color="colors[i]" height="100%">
                                    <div class="d-flex fill-height justify-center align-center">
                                        <div class="text-h2">
                                            {{ slide }} Slide
                                        </div>
                                    </div>
                                </v-sheet>
                            </v-carousel-item>
                        </v-carousel>
                    </template>
                </v-card-text>

            </template>
            <v-row>
                <v-col md="8" offset-md="2">
                    <template>
                        <v-card-text class="text-h5 ">
                            <v-card-title> Casas de Condomínio à Vend/MA/Casas de Condomínio à venda em Paço do
                                Lumiar/Pindaí/Avenida Doihara</v-card-title>
                            <v-card-text class="my-0 py-0">Localização:sdsad</v-card-text>
                            <v-card-title class="my-0 py-0">Valor:144</v-card-title>

                            <v-chip-group v-model="selection" active-class="deep-purple accent-4 white--text" column>
                                <v-chip><span class="mdi mdi-chart-areaspline-variant">m<sup>2</sup></span></v-chip>
                                <v-chip><span class="mdi mdi-seat-individual-suite">{{ }}</span>Suíte</v-chip>
                                <v-chip><span class="mdi mdi-car">{{ }}</span>Garagem</v-chip>

                                <v-chip><span class="mdi mdi-faucet-variant"></span> Banheiros</v-chip>

                                <v-chip>
                                    <span class="mdi mdi-bed-double"></span>{{
}}</v-chip>
                                <v-chip>
                                    <span class="mdi mdi-timer-lock-outline" title="data do contrato"></span>{{
}} </v-chip>
                            </v-chip-group>
                            <v-divider></v-divider>
                        </v-card-text>

                    </template>
                    <template>
                        <v-card-title class="deep-purple lighten-5"> Descição do Imovel</v-card-title>
                        <v-card-subtitle>
                            <p>Arrendamento / Quarto / Cozinha Equipada / Leiria</p>
                            <p class="text-uppercase">Descrição do imóvel:</p>
                            Principais características:
                            <v-row>

                                <v-col cols="12" sm="4" md="4">
                                    <span class="text-caption">Área de serviço</span><br/>
                                    <span class="text-caption">Churrasqueira</span><br/>
                                    <span class="text-caption">Elevador</span><br/>
                                    <span class="text-caption">Interfone</span>
                                </v-col>
                                <v-col sm="4" md="4">
                                    <span class="text-caption">Piscina</span><br/>
                                    <span class="text-caption">Quadra poliesportiva</span><br/>
                                    <span class="text-caption">Sauna</span><br/>
                                    <span class="text-caption">Varanda gourmet</span><br/>
                                    <!-- <p>Interfone</p> -->
                                </v-col>
                                <v-col sm="4" md="4">
                                        <span class="text-caption">Piscina</span><span class="mdi mdi-check-circle-outline"></span><br/>
                                        <span class="text-caption">Quadra poliesportiva</span><span class="mdi mdi-check-circle-outline"></span><br/>
                                        <span class="text-caption">Cozinha equipada </span><span class="mdi mdi-check-circle-outline"></span><br/>
                                        <span class="text-caption">Despesas incluídas (água, luz, gás e internet) </span><span class="mdi mdi-check-circle-outline"></span>
                                    <!-- <p>Interfone</p> -->
                                </v-col>

                            </v-row>
                            <v-divider></v-divider>
                            <p>A prioridade são as pessoas!</p>

                            <p class="text-justify subtitle-1">
                                O seu voto de CONFIANÇA é o nosso compromisso.
                                Pautamo-nos pela objetividade e TRANSPARÊNCIA em todas as fases do processo,
                                proporcionando-lhe a
                                SEGURANÇA que merece.
                                Não há pessoas iguais, casas iguais nem negócios iguais.
                                Adaptamo-nos às suas necessidades.
                                INFORMAÇÃO e ACOMPANHAMENTO são as palavras-chave para a sua tomada de decisão.
                                Primamos por um serviço de qualidade e pela SATISFAÇÃO dos nossos clientes.
                            </p>

                            Notas:
                            <p class="text-justify">
                                *Se for consultor imobiliário, este imóvel está disponível para partilha de negócio.
                                Apresente aos
                                seus
                                clientes compradores e agende a sua visita.
                            </p >
                            *Para maior facilidade na identificação deste imóvel refira, por favor, o respetivo ID.
                        </v-card-subtitle>

                    </template>
                </v-col>
            </v-row>

        </v-container>
    </PortalLayout>
</template>
<script>
import PortalLayout from "../../Templates/PortalLayout.vue";
export default {
    components: {
        PortalLayout,
    },
    data: () => ({

        colors: [
            'indigo',
            'warning',
            'pink darken-2',
            'red lighten-1',
            'deep-purple accent-4',
        ],
        slides: [
            'First',
            'Second',
            'Third',
            'Fourth',
            'Fifth',
        ],
    }),

    mounted() {

    },
    computed: {
        user() {
            return this.$page.props.auth.user;
        },

    },

    created() {
        this.paginacao()
    },

    watch: {
        steps(val) {
            if (this.e1 > val) {
                this.e1 = val;
            }
        },
    },

    methods: {
        say() {
            this.dialogN = true
        },
        findimoveis(id) {
            window.location.href = "/portal/imovel-selecionado/" + btoa(btoa(btoa(id)));
            // alert(id);
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



        filtrarTicket() {
            axios
                .get("/tickets/filtrar-ticket", {
                    params: this.query,
                })
                .then((response) => {
                    this.dadostickets = response.data.ticket.data;
                    this.mensagem_lida = response.data.ticket.resposta_count;
                    this.empresas = response.data.empresas;
                    // this.resposta_nao = response.data.resposta_nao;
                    this.funcionario_tecnicos =
                        response.data.tecnicos_projectos;
                    this.funcionario_operadores =
                        response.data.funcionario_operadores;
                    this.modulos_projectos = response.data.modulos_projectos;
                    this.last_page = response.data.ticket.last_page;
                    this.totalTicket = response.data.ticket.total;
                })
                .catch((error) => {
                    //toastr.warning('Houve uma falha ao carregar os dados!...');
                });
        },
    },
};
</script>
<style scoped>
.custom-autocomplete .v-input__control {
    background-color: #ff0000;
    /* Substitua pelo código de cor desejado */
    color: #ffffff;
    /* Substitua pelo código de cor desejado */
}
</style>