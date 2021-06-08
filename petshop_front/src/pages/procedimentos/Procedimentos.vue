<template>
    <site>
        <span slot="principal">
            <div class="container">
                <h2>Cadastrar Procedimento</h2>
                <div class="row">
                    <div class="row">
                        <div class="row">
                            <div class="input-field col s6">
                                <label>PET</label>
                                <select class="browser-default" v-model="pet" @change="pets_select()">
                                    <option value="" disabled selected></option>
                                    <option v-for="pet in pets" v-bind:value="pet.id">{{ pet.nome }}</option>
                                </select>
                            </div>
                            <div class="input-field col s6">
                                <label>
                                    <input name="banho_tosa" type="radio" value="0"/>
                                    <span>Banho</span>
                                </label>
                            </div>
                            <div class="input-field col s6">
                                <label>
                                    <input name="banho_tosa" type="radio" value="1"/>
                                    <span>Tosa</span>
                                </label>
                            </div>
                            <div class="input-field col s6">
                                <label>
                                    <input name="banho_tosa" type="radio" value="2"/>
                                    <span>Banho & Tosa</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <label>Vacina</label>
                                <select class="browser-default">
                                    <option value="" disabled selected></option>
                                    <option v-for="vacina in vacinas" v-bind:value="vacina.id">
                                        {{ vacina.nome }}
                                    </option>
                                </select>
                            </div>
                            <div class="input-field col s6">
                                <label>Browser Select</label>
                                <select class="browser-default">
                                    <option value="" disabled selected></option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <label>CASTRADO</label>
                                <div class="row"></div>
                                <div class="input-field col s3">
                                    <label>
                                        <input name="castrado" type="radio" value="1" v-model="castrado"/>
                                        <span>Sim</span>
                                    </label>
                                </div>
                                <div class="input-field col s3">
                                    <label>
                                        <input name="castrado" type="radio" value="0" v-model="castrado"/>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                            <div class="input-field col s6">
                                <label>CIRURGIA</label>
                                <div class="row"></div>
                                <div class="input-field col s3">
                                    <label>
                                        <input name="cirurgia" type="radio" value="1" v-model="cirurgia"/>
                                        <span>Sim</span>
                                    </label>
                                </div>
                                <div class="input-field col s3">
                                    <label>
                                        <input name="cirurgia" type="radio" value="0" v-model="cirurgia"/>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6" v-if="castrado == true">
                                <input id="data_castracao" type="date" class="validate" v-model="data_castracao">
                                <label for="data_castracao">Data da Castração</label>
                            </div>
                            <div class="input-field col s6" v-if="cirurgia == true">
                                <input id="descricao_cirurgica" type="text" class="validate"
                                       v-model="descricao_cirurgica">
                                <label for="descricao_cirurgica">Qual Cirurgia?</label>
                            </div>
                        </div>
                        <botao acao="salvar"
                               icone="send"
                               tamanho="col s4"
                               v-on:click.native="salvar()">
                        </botao>
                    </div>
                </div>
            </div>

        </span>
    </site>
</template>

<script>
import Site from "../../template/Site";
import Botao from "../../components/layouts/Botao";

export default {
    name: "Procedimentos",
    components: {Botao, Site},
    mounted: function () {
        this.pets_select()
    },
    data() {
        return {
            pet: '',
            data_castracao: '',
            descricao_cirurgica: '',

            cirurgia: false,
            castrado: false,
            pets: [],
            vacinas: [
                {id: 1, nome: 'VACINA 1'},
                {id: 2, nome: 'VACINA 2'},
                {id: 3, nome: 'VACINA 3'},
            ]
        }
    },
    methods: {
        salvar() {
            var self = this

            console.log('SALVAR', self.pet)
        },
        pets_select: function () {
            var self = this

            self.$http.get(self.$urlApi + 'pet/select',
                {"headers": {"authorization": "Bearer " + self.$store.getters.getToken}})
                .then(function (response) {
                    if (response.data.status) {
                        self.pets = response.data.pets
                    } else
                        sweetAlert(response.data.erro)
                })
                .catch(e => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'ERRO, tente novamente mais tarde!',
                    })
                })
        },
        vacinas_select: function () {
            var self = this

            self.$http.get(self.$urlApi + 'vacina/select',
                {"headers": {"authorization": "Bearer " + self.$store.getters.getToken}})
                .then(function (response) {
                    if (response.data.status) {
                        self.pets = response.data.pets
                    } else
                        sweetAlert(response.data.erro)
                })
                .catch(e => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'ERRO, tente novamente mais tarde!',
                    })
                })
        }
    }
}
</script>

<style scoped>

</style>
