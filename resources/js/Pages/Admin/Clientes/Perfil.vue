<template>
    <v-app>
        <template>
            <v-container v-if="editarform" class="w-75 justify-space-around">
                <v-subheader class="text-h5 text-bold mt-10 ">Meus Dados</v-subheader>
                <validation-observer ref="observer" v-slot="{ invalid }">
                    <form @submit.prevent="submit">
                        <v-row class="m-2">
                            <v-col cols="12">

                                <validation-provider v-slot="{ errors }" name="Name" rules="required|max:10">
                                    <v-text-field dense v-model="cliente.name" outlined :counter="10" :error-messages="errors"
                                        label="Nome Completo" required></v-text-field>
                                </validation-provider>
                            </v-col>
                            
                            <v-col cols="6"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field disabled dense v-model="cliente.email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="6"> <validation-provider v-slot="{ errors }" name="Numero do telefone" :rules="{
                                required: true,
                                digits: 12,
                                regex: '^(244)\\d{9}$'
                            }">
                                    <v-text-field dense v-model="cliente.telefone" outlined :counter="12" :error-messages="errors"
                                        label="Numero do telefone" required></v-text-field>
                                </validation-provider></v-col>
                           
                            <v-col cols="6"> <validation-provider v-slot="{ errors }" name="tipo de documentação" rules="required|email">
                                    <!-- <v-text-field dense v-model="tipo_documentacao" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field> -->

                                        <v-select dense v-model="tipo_documentacao" outlined :items="items" :error-messages="errors"
                                        label="tipo de documentação" data-vv-name="tipo de documentação" required></v-select>
                                </validation-provider>
                            </v-col>
                            <v-col cols="6"> <validation-provider v-slot="{ errors }" name="BI" rules="required|bi">
                                    <v-text-field dense v-model="cliente.bi" outlined :error-messages="errors" label="Bilhete de identidade"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>

                                                     
                            <!-- <v-col cols="4"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field dense v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col> -->
                            <v-col cols="12"><v-divider></v-divider>
                                Dados Profissionais
                                <v-divider></v-divider></v-col>
                            
                            <v-col :cols="associado==true? 2:6"> <validation-provider v-slot="{ errors }" name="Tipo corretor" rules="required|tipoCorretor">
                                <v-select dense v-model="tipo_corrector" outlined  @change="escolherTipoCorretor()" :items="tipoCorretor" :error-messages="errors"
                                        label="Tipo de usuário" data-vv-name="Tipo de usuário" required></v-select>
                                </validation-provider>
                            </v-col>
                            <v-col :cols="associado==true? 2:3" v-if="associado==true"> <validation-provider v-slot="{ errors }" name="Código do Corretor" rules="required|codigoCorretor">
                                    <v-text-field  dense v-model="cliente.codigo_profissional" outlined :error-messages="errors" label="Código do corretor"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>

                            <v-col cols="4" v-if="associado==true"> <validation-provider v-slot="{ errors }" name="Nome da Imobiliaria" rules="required|nomeImobiliaria">
                                <v-select dense v-model="nome_imobiliaria" outlined :items="items" :error-messages="errors"
                                        label="Nome da Imóbiliaria" data-vv-name="Nome da Imóbiliaria" required></v-select>
                                </validation-provider>
                            </v-col>

                            <v-col :cols="associado==true? 4:6"> <validation-provider v-slot="{ errors }" name="Zona de actuaçao" rules="required|zonaAtuacao">
                                    <v-select dense v-model="zona_actuacao" :items="items" outlined :error-messages="errors" label="Zona de actuaçao"
                                        required></v-select>
                                </validation-provider>
                            </v-col>
                  <!--           <v-col cols="6"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field dense v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="6"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field dense v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field dense v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field dense v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" name="select" rules="required">
                                    <v-select dense v-model="select" outlined :items="items" :error-messages="errors"
                                        label="Select" data-vv-name="select" required></v-select>
                                </validation-provider></v-col> -->
                            <!-- <v-col cols="4"> <validation-provider v-slot="{ errors }" rules="required" name="checkbox">
                                    <v-checkbox v-model="checkbox" :error-messages="errors" value="1" label="Option"
                                        type="checkbox" required></v-checkbox>
                                </validation-provider></v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" rules="required" name="checkbox">
                                    <v-checkbox v-model="checkbox" :error-messages="errors" value="1" label="Option"
                                        type="checkbox" required></v-checkbox>
                                </validation-provider></v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" rules="required" name="checkbox">
                                    <v-checkbox v-model="checkbox" :error-messages="errors" value="1" label="Option"
                                        type="checkbox" required></v-checkbox>
                                </validation-provider></v-col> -->
                            <v-col cols="12"> <v-btn class="mr-4" type="submit" :disabled="invalid">
                                    submit
                                </v-btn>
                                <v-btn @click="clear">
                                    clear
                                </v-btn></v-col>




                        </v-row>
                    </form>
                </validation-observer>
            </v-container>
        </template>
    </v-app>
</template>

<script>
// import { extend,setInteractionMode } from 'vee-validate';
import { required, digits, email, max, regex } from 'vee-validate/dist/rules'
import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
setInteractionMode('eager')

extend('digits', {
    ...digits,
    message: '{_field_} precisa de  {length} digitos contando com o 244. ({_value_})',
})

extend('required', {
    ...required,
    message: '{_field_} O campo não pode estar vazio',
})

extend('max', {
    ...max,
    message: '{_field_} may not be greater than {length} characters',
})

extend('regex', {
    ...regex,
    message: '{_field_} {_value_} Não compre com as restrições (244990987634)',
})

extend('email', {
    ...email,
    message: 'Email invalido',
})

export default {
    props: ["cliente", 'startingImage', 'autoSlideInterval', 'showProgressBar', 'msg'],
    components: {
        ValidationProvider,
        ValidationObserver,
    },
    data: () => ({
        name: '',
        phoneNumber: '',
        email: '',
        select: null,
        tipoCorretor: [
            'Proprietario',
            'Corrector',
            'Pambaleiro',
            'Cliente',
        ],
        checkbox: null,
        editarform:true,
        associado:false,
    }),

    methods: {
        submit() {
            this.$refs.observer.validate()
        },
        escolherTipoCorretor(){
if(this.tipo_corrector=='Corrector'){
    this.associado=true
    // alert(this.tipo_corrector=='Associado');
}else{

    this.associado=false         
}
        },
        clear() {
            this.name = ''
            this.phoneNumber = ''
            this.email = ''
            this.select = null
            this.checkbox = null
            this.$refs.observer.reset()
        },
    },
}
</script>
<style>
/* @import "vuetify/dist/vuetify.min.css"; */
</style>