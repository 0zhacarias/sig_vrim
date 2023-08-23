<template>
    <v-app>

        <v-subheader class="text-h5 text-bold mt-10 ">Meus Dados</v-subheader>
        <template>
            <v-container class="w-75 justify-space-around">
                <validation-observer ref="observer" v-slot="{ invalid }">
                    <form @submit.prevent="submit">
                        <v-row class="m-2">
                            <v-col cols="6">

                                <validation-provider v-slot="{ errors }" name="Name" rules="required|max:10">
                                    <v-text-field v-model="name" outlined :counter="10" :error-messages="errors"
                                        label="Name" required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="6"> <validation-provider v-slot="{ errors }" name="Numero do telefone" :rules="{
                                required: true,
                                digits: 12,
                                regex: '^(244)\\d{9}$'
                            }">
                                    <v-text-field v-model="phoneNumber" outlined :counter="7" :error-messages="errors"
                                        label="Phone Number" required></v-text-field>
                                </validation-provider></v-col>
                            <v-col cols="6"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="6"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="6"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="6"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" name="email" rules="required|email">
                                    <v-text-field v-model="email" outlined :error-messages="errors" label="E-mail"
                                        required></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" name="select" rules="required">
                                    <v-select v-model="select" outlined :items="items" :error-messages="errors"
                                        label="Select" data-vv-name="select" required></v-select>
                                </validation-provider></v-col>
                            <v-col cols="4"> <validation-provider v-slot="{ errors }" rules="required" name="checkbox">
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
                                </validation-provider></v-col>
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
    message: 'Email must be valid',
})

export default {
    components: {
        ValidationProvider,
        ValidationObserver,
    },
    data: () => ({
        name: '',
        phoneNumber: '',
        email: '',
        select: null,
        items: [
            'Item 1',
            'Item 2',
            'Item 3',
            'Item 4',
        ],
        checkbox: null,
    }),

    methods: {
        submit() {
            this.$refs.observer.validate()
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