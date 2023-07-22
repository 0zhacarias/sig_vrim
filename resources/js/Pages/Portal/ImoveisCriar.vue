<template>
    <PortalLayout>
        <v-card elevation="0">
            <v-card tile class="text-h5 deep-purple darken-3  white--text ">
                <span class="text-uppercase" style="font-size: 20px">
                    {{ formTitle }}</span>
            </v-card>
            <v-card-text>
                <v-container>
                    <v-stepper flat v-model="e1">
                        <v-stepper-header>
                            <v-stepper-step class="text-uppercase" :complete="e1 > 1" step="1">Dados do
                                Imovel</v-stepper-step>

                            <!-- <v-divider></v-divider> -->

                            <v-stepper-step class="text-uppercase" step="2" :complete="e1 > 2">Localização do
                                Imóvel</v-stepper-step>
                            <v-stepper-step class="text-uppercase" step="3" :complete="e1 > 3">Fotos & Documentação do
                                Imóvel</v-stepper-step>
                            <v-stepper-step class="text-uppercase" step="4" :complete="e1 > 4">Finalização</v-stepper-step>
                        </v-stepper-header>
                        <v-row>
                            <v-col sm="1" md="2" lg="2"></v-col>
                            <v-col sm="10" md="8" lg="8" offset-sm="0">
                                <v-stepper-items flat>
                                    <v-stepper-content step="1">
                                        <v-card class="mb-12" flat>
                                            <v-card-text align="center" justify="center">
                                                <v-btn class="corVender" outlined align="center" v-model="vender"
                                                    @click="venderImoveis()">
                                                    Vender</v-btn>
                                                <v-btn outlined v-model="arrendar" class="corArrendamento"
                                                    @click="arrendarImoveis()">Arrendar</v-btn>


                                                <v-btn outlined v-model="proprietario" @click="proprietario()"
                                                    class="corProprietario"
                                                    v-if="this.getarrendar == true || this.getvender == true">
                                                    Proprietário</v-btn>
                                                <v-btn outlined v-model="colaborador" @click="colaborador()"
                                                    class="corColaborador"
                                                    v-if="this.getarrendar == true || this.getvender == true">Pambaleiro</v-btn>
                                            </v-card-text>

                                            <v-form ref="form" lazy-validation>
                                                <v-container v-if="this.getarrendar == true || this.getvender == true">
                                                    <!-- <v-card-text align="center" justify="center">
                                                        <v-btn outlined  v-model="proprietario" @click="proprietario()" class="corProprietario"> Proprietário</v-btn>
                                                        <v-btn outlined v-model="colaborador" @click="colaborador()" class="corColaborador">Pambaleiro</v-btn>
                                                    </v-card-text> -->

                                                    <v-row dense class="pt-10">
                                                        <span class="text-h5 "> Detalhes sobre o seu imóvel</span><br />
                                                        <span class="subtitle pb-10">Essas informações são importantes para
                                                            que seu anúncio
                                                            apareça corretamente nas buscas dos interessados.
                                                        </span>
                                                        <v-col cols="12" sm="6" md="6">
                                                            <v-autocomplete outlined dense label="Tipo de Imovel*" v-model="condominio.designacao
                                                                "></v-autocomplete>
                                                        </v-col>
                                                        <v-col cols="12"  sm="6" md="6">
                                                            <v-autocomplete outlined dense label="Tipologia*" v-model="condominio.designacao
                                                                "></v-autocomplete>
                                                        </v-col>


                                                    </v-row>

                                                    <v-divider></v-divider>
                                                    <v-row>
                                                        <v-col cols="12" sm="6" md="6">
                                                            <span class="text-h6">Número de quartos</span><br />
                                                            <span class="subtitle">Incluindo suítes</span>




                                                        </v-col>
                                                        <!-- <v-col cols="1">
                                                            <v-btn large outlined @click="decrement" color="indigo">
                                                                <v-icon>mdi-minus</v-icon>
                                                            </v-btn>
                                                        </v-col>
                                                        <v-col cols="1">
                                                            <v-text-field v-model="value" outlined dense
                                                                color="indigo"></v-text-field>
                                                        </v-col>
                                                        <v-col cols="1">
                                                            <v-btn large outlined @click="increment" color="indigo">
                                                                <v-icon>mdi-plus</v-icon>
                                                            </v-btn>
                                                        </v-col> -->

                                                        <v-col cols="12" sm="2" md="2" class="text-right">

                                                            <v-btn large outlined color="indigo" @click="decrementquarto">
                                                                <v-icon>mdi-minus</v-icon>
                                                            </v-btn>

                                                        </v-col>

                                                        <v-col cols="12" sm="2" md="2">
                                                            <v-text-field dense color="indigo" outlined
                                                                v-model="numeroQuarto"
                                                                class="no-padding-messages no-padding-details v-messages.theme--light pa-1">

                                                            </v-text-field>
                                                        </v-col>

                                                        <v-col cols="1" sm="2" md="1">
                                                            <v-btn outlined large color="indigo" @click="incrementquarto">
                                                                <v-icon>mdi-plus</v-icon>
                                                            </v-btn>
                                                        </v-col>


                                                        <!-- <v-card-text>
                                                            <v-row align="center" justify="center">
                                                                <v-col cols="12">
                                                                    <p class="text-center">
                                                                        Rounded
                                                                    </p>
                                                                </v-col>

                                                            </v-row>
                                                        </v-card-text> -->
                                                    </v-row>
                                                    <v-divider></v-divider>


                                                    <v-divider></v-divider>
                                                    <v-row><v-col cols="12" sm="6" md="6">
                                                            <span class="text-h6">Número de banheiros</span><br />
                                                            <span class="subtitle">Incluindo suítes</span>




                                                        </v-col>

                                                        <v-col cols="12" sm="2" md="2" class="text-right">

                                                            <v-btn large outlined color="indigo" @click="decrementbanheiro">
                                                                -
                                                            </v-btn>

                                                        </v-col>

                                                        <v-col cols="12" sm="2" md="2">
                                                            <v-text-field dense color="indigo" outlined
                                                                v-model="numeroBanheiro"
                                                                class="no-padding-messages no-padding-details v-messages.theme--light pa-1">

                                                            </v-text-field>
                                                        </v-col>

                                                        <v-col cols="1" sm="2" md="1">
                                                            <v-btn outlined large color="indigo" @click="incrementbanheiro">
                                                                +
                                                            </v-btn>
                                                        </v-col>

                                                        <!-- <v-card-text>
                                                            <v-row align="center" justify="center">
                                                                <v-col cols="12">
                                                                    <p class="text-center">
                                                                        Rounded
                                                                    </p>
                                                                </v-col>

                                                            </v-row>
                                                        </v-card-text> -->
                                                    </v-row>
                                                    <v-divider></v-divider>

                                                    <v-divider></v-divider>
                                                    <v-row><v-col cols="12" sm="6" md="6">
                                                            <span class="text-h6">Número de garagens</span><br />
                                                            <span class="subtitle">Vagas para Carros(Opcional)</span>




                                                        </v-col>

                                                        <v-col cols="12" sm="2" md="2" class="text-right">

                                                            <v-btn large outlined color="indigo" @click="decrementGaragem">
                                                                -
                                                            </v-btn>

                                                        </v-col>

                                                        <v-col cols="12" sm="2" md="2">
                                                            <v-text-field dense color="indigo" outlined
                                                                v-model="numeroGaragem"
                                                                class="no-padding-messages no-padding-details v-messages.theme--light pa-1">
                                                            </v-text-field>
                                                        </v-col>

                                                        <v-col cols="1" sm="2" md="1">
                                                            <v-btn outlined large color="indigo" @click="incrementGaragem">
                                                                +
                                                            </v-btn>
                                                        </v-col>

                                                        <!-- <v-card-text>
                                                            <v-row align="center" justify="center">
                                                                <v-col cols="12">
                                                                    <p class="text-center">
                                                                        Rounded
                                                                    </p>
                                                                </v-col>

                                                            </v-row>
                                                        </v-card-text> -->
                                                    </v-row>
                                                    <v-divider></v-divider>
                                                    <v-divider></v-divider>
                                                    <v-row><v-col cols="12" sm="6" md="6">
                                                            <span class="text-h6">Andar do imóvel</span><br />
                                                            <span class="subtitle">Opcional </span>




                                                        </v-col>

                                                        <v-col cols="12" sm="2" md="2" class="text-right">

                                                            <v-btn large outlined color="indigo"
                                                                @click="decrementnumeroAndar">
                                                                -
                                                            </v-btn>

                                                        </v-col>

                                                        <v-col cols="12" sm="2" md="2">
                                                            <v-text-field dense color="indigo" outlined
                                                                v-model="numeroAndar"
                                                                class="no-padding-messages no-padding-details v-messages.theme--light pa-1">
                                                            </v-text-field>
                                                        </v-col>

                                                        <v-col cols="1" sm="2" md="1">
                                                            <v-btn outlined large color="indigo"
                                                                @click="incrementnumeroAndar">
                                                                +
                                                            </v-btn>
                                                        </v-col>

                                                        <!-- <v-card-text>
                                                            <v-row align="center" justify="center">
                                                                <v-col cols="12">
                                                                    <p class="text-center">
                                                                        Rounded
                                                                    </p>
                                                                </v-col>

                                                            </v-row>
                                                        </v-card-text> -->
                                                    </v-row>
                                                    <v-divider></v-divider>
                                                    <v-divider></v-divider>
                                                    <v-row><v-col cols="12" sm="6" md="7">
                                                            <span class="text-h6">Quantos m²</span><br />
                                                            <span class="subtitle">Informe a área útil. Você pode informar
                                                                um tamanho aproximado e alterar depois.</span>




                                                        </v-col>

                                                        <!-- <v-col cols="12" sm="2" md="2" class="text-right">

                                                            <v-btn large outlined color="indigo" @click="decrementMetros">
                                                                -
                                                            </v-btn>

                                                        </v-col> -->

                                                        <v-col cols="12" sm="6" md="5">
                                                            <v-text-field dense color="indigo" outlined v-model="metros"
                                                                type="number"
                                                                class="no-padding-messages no-padding-details v-messages.theme--light pa-1">
                                                            </v-text-field>
                                                        </v-col>

                                                        <!-- <v-col cols="1" sm="2" md="1">
                                                            <v-btn outlined large color="indigo" @click="increMentmetros">
                                                                +
                                                            </v-btn>
                                                        </v-col> -->

                                                        <!-- <v-card-text>
                                                            <v-row align="center" justify="center">
                                                                <v-col cols="12">
                                                                    <p class="text-center">
                                                                        Rounded
                                                                    </p>
                                                                </v-col>

                                                            </v-row>
                                                        </v-card-text> -->
                                                    </v-row>
                                                    <v-divider></v-divider> <v-divider></v-divider>
                                                    <v-row>
                                                        <v-col cols="12" md="12">
                                                            <v-textarea v-model="condominio.designacao"
                                                                label="titulo do Anúcio*" outlined rows="2">

                                                            </v-textarea>
                                                        </v-col>
                                                    </v-row>
                                                    <v-divider></v-divider>
                                                    <v-divider></v-divider>
                                                    <v-row>
                                                        <v-col cols="12" md="12">
                                                            <v-text-field v-model="condominio.designacao" dense
                                                                label="Localização**" outlined type="gps">

                                                            </v-text-field>
                                                        </v-col>
                                                        <v-col cols="12" md="4">
                                                            <v-autocomplete v-model="condominio.designacao" dense
                                                                label="Provincia**" outlined>

                                                            </v-autocomplete>
                                                        </v-col>
                                                        <v-col cols="12" md="4">
                                                            <v-text-field v-model="condominio.designacao" label="Cidades*" dense
                                                                outlined>

                                                            </v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                    <!-- <v-col cols="12" md="6">
                                                    <v-file-input
                                                    outlined
                                                        dense
                                                        show-size
                                                        counter
                                                        label="Logotipo"
                                                        v-model="
                                                            condominio.logotipo
                                                        "
                                                    />
                                                </v-col> -->

                                                </v-container>
                                            </v-form>
                                        </v-card>
                                        <v-card-actions>
                                            <v-spacer />
                                            <v-btn color="primary" @click="continuar(2, 'form')">
                                                Continuar
                                            </v-btn>
                                        </v-card-actions>
                                    </v-stepper-content>
                                    <v-stepper-content step="2">
                                        <v-card flat>
                                            <v-form ref="form2" lazy-validation>
                                                <v-container>
                                                    <template>
                                                        <span class="text-h6">Quais os custos do imóvel?</span><br />
                                                        <span class="subtitle">Se não souber o valor exato, você pode
                                                            informar um aproximado e alterar depois.</span>
                                                    </template>
                                                    <v-row class="py-10">
                                                        <v-col cols="12" :md="this.getvender == false ? 6 : 4"
                                                            :lg="this.getvender == false ? 6 : 4">
                                                            <v-text-field v-model="condominio.preco" type="number" outlined
                                                                dense label="Valor de venda do Imovel*"></v-text-field>
                                                        </v-col>

                                                        <v-col cols="12" :md="this.getvender == false ? 6 : 4"
                                                            v-if="this.getvender == true">
                                                            <v-text-field outlined dense label="Quantidade de prestações*"
                                                                v-model="condominio.nif"></v-text-field>
                                                        </v-col>
                                                        <v-col cols="12" md="4" v-if="this.getarrendar == true">
                                                            <v-autocomplete outlined label="Tempo de arrendamento" dense
                                                                :items="tipo_regimes" item-value="id" item-text="designacao"
                                                                v-model="condominio.tipo_regime_id
                                                                    " />
                                                        </v-col>
                                                        <v-col cols="12" md="4" v-if="this.getregime == false">
                                                            <v-text-field dense outlined label="Telefone 1*" v-model="condominio.telefone1
                                                                "></v-text-field>
                                                        </v-col>


                                                        <v-col cols="8">
                                                            <span class="text-h6">Pagas Imposto Predial?</span>

                                                        </v-col>
                                                        <v-col cols="4">
                                                            <span>
                                                                <v-btn elevation="0" outlined rounded
                                                                    v-model="condominio.simImP" @click="simIP()"
                                                                    class="simImpostoPredial"> sim</v-btn>
                                                                <v-btn outlined rounded v-model="condominio.naoImP"
                                                                    @click="naoIP()"
                                                                    class="naocorImpostoPredial">não</v-btn>
                                                            </span>
                                                        </v-col>

                                                        <v-col cols="12" md="6" v-if="this.getImposto == true">
                                                            <v-text-field outlined dense
                                                                label="Valor pago do Imposto prediario*" v-model="condominio.localizacao
                                                                    "></v-text-field>
                                                        </v-col>

                                                        <!-- <v-col cols="12" md="6">
                                                    </v-col> -->
                                                        <!-- <v-col cols="12" md="6">
                                                        <v-autocomplete outlined label="Tipo de Cliente" dense
                                                            :items="tipo_clientes" item-value="id" item-text="designacao"
                                                            v-model="condominio.tipo_cliente_id
                                                                " />
                                                    </v-col> -->
                                                    </v-row>
                                                    <v-divider></v-divider>
                                                    <v-divider></v-divider>
                                                    <v-list subheader two-line flat>
                                                        <v-subheader>Você vai deixar no imóvel alguns desses
                                                            itens?</v-subheader>

                                                        <v-list-item-group v-model="settings" multiple>
                                                            <v-list-item>
                                                                <template v-slot:default="{ active, }">
                                                                    <v-list-item-content>
                                                                        <v-list-item-title>Sofá</v-list-item-title>
                                                                        <!-- <v-list-item-subtitle>Allownotifications</v-list-item-subtitle> -->
                                                                    </v-list-item-content>
                                                                    <v-list-item-action>
                                                                        <v-checkbox :input-value="active" v-model="s"
                                                                            style="background-color: #e9e5f5; border-radius: 10px;"
                                                                            color="primary"></v-checkbox>
                                                                    </v-list-item-action>


                                                                </template>
                                                            </v-list-item>

                                                            <v-list-item>
                                                                <template v-slot:default="{ active }">
                                                                    <v-list-item-content>
                                                                        <v-list-item-title>Mesa e cadeiras de
                                                                            jantar</v-list-item-title>
                                                                        <!-- <v-list-item-subtitle>Hangoutsmessage</v-list-item-subtitle> -->
                                                                    </v-list-item-content>
                                                                    <v-list-item-action>
                                                                        <v-checkbox :input-value="active"
                                                                            style="background-color: #e9e5f5; border-radius: 10px;"
                                                                            color="primary"></v-checkbox>
                                                                    </v-list-item-action>


                                                                </template>
                                                            </v-list-item>

                                                            <v-list-item>
                                                                <template v-slot:default="{ active }">
                                                                    <v-list-item-content>
                                                                        <v-list-item-title>Armários embutidos -
                                                                            dormitório</v-list-item-title>

                                                                    </v-list-item-content>
                                                                    <v-list-item-action>
                                                                        <v-checkbox :input-value="active"
                                                                            style="background-color: #e9e5f5; border-radius: 10px;"
                                                                            color="primary"></v-checkbox>
                                                                    </v-list-item-action>


                                                                </template>
                                                            </v-list-item>

                                                            <v-list-item>
                                                                <template v-slot:default="{ active }">
                                                                    <v-list-item-content>
                                                                        <v-list-item-title>Armário na
                                                                            cozinha</v-list-item-title>

                                                                    </v-list-item-content>
                                                                    <v-list-item-action>
                                                                        <v-checkbox :input-value="active"
                                                                            style="background-color: #e9e5f5; border-radius: 10px;"
                                                                            color="primary"></v-checkbox>
                                                                    </v-list-item-action>


                                                                </template>
                                                            </v-list-item>
                                                            <v-list-item>
                                                                <template v-slot:default="{ active }">
                                                                    <v-list-item-content>
                                                                        <v-list-item-title>piscina </v-list-item-title>

                                                                    </v-list-item-content>
                                                                    <v-list-item-action>
                                                                        <v-checkbox :input-value="active"
                                                                            style="background-color: #e9e5f5; border-radius: 10px;"
                                                                            color="primary"></v-checkbox>
                                                                    </v-list-item-action>


                                                                </template>
                                                            </v-list-item>
                                                        </v-list-item-group>
                                                    </v-list>
                                                    <v-card-actions>
                                                        <v-btn color="warning" @click="e1 = 1">Voltar</v-btn>

                                                        <v-spacer />
                                                        <v-btn color="primary" @click="continuar(3, 'form')">
                                                            Continuar
                                                        </v-btn>
                                                    </v-card-actions>
                                                </v-container>
                                            </v-form>
                                        </v-card>


                                    </v-stepper-content>
                                    <v-stepper-content step="3">
                                        <v-card flat>
                                            <v-form ref="form2" lazy-validation>
                                                <v-container>

                                                    <v-row dense class="py-10">
                                                        <v-col cols="12" sm="12">
                                                            <template>
                                                                <span class="text-h6">Fotos do Imóvel</span><br />
                                                                <span class="subtitle">Primeiro campo adicionar a foto
                                                                    principal e o segundo campo deve adicionar 10 fotos no
                                                                    máximo.</span>
                                                            </template>
                                                        </v-col>
                                                        <v-col cols="12" md="6" class="pb-10">
                                                            <template>
                                                                <v-file-input accept="image/*" label="Foto principal" chips
                                                                    counter multiple show-size
                                                                    truncate-length="15"></v-file-input>
                                                            </template>
                                                        </v-col>
                                                        <v-col cols="12" md="6">
                                                            <template>
                                                                <v-file-input accept="image/*"
                                                                    label="Fotos do Imóvel 10 fotos no máximo." chips close
                                                                    counter multiple show-size
                                                                    truncate-length="15"></v-file-input>
                                                            </template>
                                                        </v-col>


                                                        <template>
                                                            <span class="text-h6">Documentação do Imóvel </span><br />
                                                            <span class="subtitle">Ao divulgarmos esses dados iremos colocar
                                                                marca d'água no documento para proteger as
                                                                informações.</span>
                                                        </template>
                                                        <v-col cols="12" md="12">
                                                            <template>
                                                                <v-file-input accept="image/*"
                                                                    label="Crockis"></v-file-input>
                                                            </template>
                                                        </v-col>
                                                        <v-col cols="12" md="12">
                                                            <template>
                                                                <v-file-input accept="image/*"
                                                                    label="Localização"></v-file-input>
                                                            </template>

                                                        </v-col>
                                                        <v-col cols="12" md="12">
                                                            <template>
                                                                <v-file-input accept="image/*"
                                                                    label="Titulo de propriedade"></v-file-input>
                                                            </template>
                                                        </v-col>
                                                    </v-row>
                                                </v-container>
                                            </v-form>
                                        </v-card>

                                        <v-card-actions>
                                            <v-btn color="warning" @click="e1 = 2">Voltar</v-btn>

                                            <v-spacer />
                                            <v-btn color="primary" @click="continuar(4, 'form')">
                                                Continuar
                                            </v-btn>
                                        </v-card-actions>
                                    </v-stepper-content>
                                    <v-stepper-content step="4">
                                        <v-card flat>
                                            <v-form ref="form2" lazy-validation>
                                                <v-container>
                                                    <v-row dense>
                                                        <template>
                                                            <span class="text-h1">JÁ NÃO SEI O QUE COLOCAR MAIS AQUI </span><br />
                                                            <span class="subtitle">Ao divulgarmos esses dados iremos colocar
                                                                marca d'água no documento para proteger as
                                                                informações.</span>
                                                        </template>
                                                    </v-row>
                                                </v-container>
                                            </v-form>
                                        </v-card>

                                        <v-card-actions>
                                            <v-btn color="warning" @click="e1 = 3">Voltar</v-btn>

                                            <v-spacer />
                                            <v-btn class="bg-primary darken-4 white--text" @click="setNovoCondominio()">
                                                {{
                                                    editedIndex > -1
                                                    ? "Actualizar"
                                                    : "Guardar"
                                                }}
                                            </v-btn>
                                        </v-card-actions>
                                    </v-stepper-content>
                                </v-stepper-items>
                            </v-col>
                            <v-col sm="1" md="2" lg="2"></v-col>
                        </v-row>

                    </v-stepper>
                </v-container>
            </v-card-text>
        </v-card>
    </PortalLayout>
</template>
<script>
import PortalLayout from "../../Templates/PortalLayout.vue";
export default {
    components: {
        PortalLayout,
    },
    data: () => ({
        qquarto: "1",
        value: 0,
        numeroQuarto: 0,
        numeroGaragem: 0,
        numeroBanheiro: 0,
        numeroAndar: 0,
        metros: 0,
        getarrendar: false,
        getvender: false,
        getImposto: false,
        tipo_regimes: [
            { id: 1, designacao: "GERAL" },
            { id: 2, designacao: "ESPECÍFICO" },
        ],
        tipo_clientes: [
            { id: 1, designacao: "SINGULAR" },
            { id: 2, designacao: "EMPRESA" },
        ],
        loading: null,
        condominio: {},
        items: [
            {
                text: "Início",
                disabled: false,
                href: "/home",
            },
            {
                text: "Listar Condomínios",
                disabled: true,
                href: "/",
            },
        ],
        e1: 1,
        steps: 3,
        editedIndex: -1,
        dialogAddCondominio: false,
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

        folders: [
            {
                subtitle: 'Jan 9, 2014',
                title: 'Photos',
                value: '1'
            },
            {
                subtitle: 'Jan 17, 2014',
                title: 'Recipes',
                value: '2'
            },
            {
                subtitle: 'Jan 28, 2014',
                title: 'Work',
                value: '3'
            },
        ],
    }),

    mounted() {
        this.loading = true;
        setTimeout(function () {
            this.loading = false;
        }, 4000);
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

        caracteristicas(item) {
            alert(item);
        },
        venderImoveis() {
            this.getarrendar = false;
            this.getregime = false;
            this.getvender = true;
            const corVender = document.querySelector(".corVender");
            const corArrendamente = document.querySelector(".corArrendamento");
            corVender.style.color = "white";
            corVender.style.background = "#4527A0";
            corArrendamente.style.color = "black";
            corArrendamente.style.background = "white"
            // alert(this.getvender)
        },
        arrendarImoveis() {
            this.getarrendar = true;
            this.getregime = true;
            this.getvender = false;
            // alert(this.getarrendar)
            const corVender = document.querySelector(".corVender");
            const corArrendamente = document.querySelector(".corArrendamento");
            corVender.style.color = "black";
            corVender.style.background = "white";
            corArrendamente.style.background = "#4527A0";
            corArrendamente.style.color = "white";

        },
        colaborador() {
            // this.getarrendar = true;
            // this.getregime = true;
            // this.getvender = false;
            // alert(this.getarrendar)
            const corColaborador = document.querySelector(".corColaborador");
            const corProprietario = document.querySelector(".corProprietario");
            corColaborador.style.color = "white";
            corColaborador.style.background = "#4527A0 ";
            corProprietario.style.background = "white";
            corProprietario.style.color = "black";

        },
        proprietario() {
            // this.getarrendar = true;
            // this.getregime = true;
            // this.getvender = false;
            // alert(this.getarrendar)
            const corProprietario = document.querySelector(".corProprietario");
            const corColaborador = document.querySelector(".corColaborador");
            corProprietario.style.color = "white";
            corProprietario.style.background = "#4527A0";
            corColaborador.style.background = "white";
            corColaborador.style.color = "black";

        },
        simIP() {
            this.getImposto = true;
            const simImpostoPredial = document.querySelector(".simImpostoPredial");
            const naocorImpostoPredial = document.querySelector(".naocorImpostoPredial");
            simImpostoPredial.style.color = "white";
            simImpostoPredial.style.background = "#D1C4E9";
            naocorImpostoPredial.style.background = "white";
            naocorImpostoPredial.style.color = "black";
        },
        naoIP() {
            this.getImposto = false;
            const naocorImpostoPredial = document.querySelector(".naocorImpostoPredial");
            const simImpostoPredial = document.querySelector(".simImpostoPredial");
            naocorImpostoPredial.style.color = "white";
            naocorImpostoPredial.style.background = "#D1C4E9";
            simImpostoPredial.style.background = "white";
            simImpostoPredial.style.color = "black";
        },


        setNovoCondominio() {
            // this.loading = true;

            alert(JSON.stringify(this.condominio)); // this.$inertia.post("/condominios", this.condominio, {});

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

        increaseValue() {
            var value = parseInt(document.getElementById("idquarto").value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById("idquarto").value = value;
        },

        decreaseValue() {
            var value = parseInt(document.getElementById("idquarto").value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? (value = 1) : "";
            if (value > 1) {
                value--;
            }
            document.getElementById("idquarto").value = value;
        },

        incrementquarto() {
            this.numeroQuarto++;
        },
        decrementquarto() {
            if (this.numeroQuarto > 0) {
                this.numeroQuarto--;
            }
        },
        incrementnumeroAndar() {
            this.numeroAndar++;
        },
        decrementnumeroAndar() {
            if (this.numeroAndar > 0) {
                this.numeroAndar--;
            }
        },
        incrementbanheiro() {
            this.numeroBanheiro++;
        },
        decrementbanheiro() {
            if (this.numeroBanheiro > 0) {
                this.numeroBanheiro--;
            }
        },
        decrementGaragem() {
            if (this.numeroGaragem > 0) {
                this.numeroGaragem--;
            }
        },
        incrementGaragem() {
            this.numeroGaragem++;
        },
        increMentmetros() {
            this.metros++;
        },
        decrementMetros() {
            if (this.metros > 0) {
                this.metros--;
            }
        }


    },
};
</script>
<style>
.no-padding-messages .v-messages.theme--light,
.no-padding-details .v-text-field__details {
    padding: 0 !important;
    margin: 0px 0 0 0 !important;

}

;
</style>
