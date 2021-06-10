<template>
    <site>
        <span slot="principal">
            <div class="container">
                <h2>Cadastrar Pet</h2>
                <div class="row">
                    <div class="row">
                        <div class="input-field col s6">
                            <label>Espécie</label>
                            <select class="browser-default" v-model="especie" @change="racas_select()">
                                <option value="" disabled selected></option>
                                <option v-for="especie in especies" :key="especie.id" v-bind:value="especie.id" >{{especie.descricao}}</option>
                            </select>
                        </div>
                        <div class="input-field col s6">
                            <input id="nome" type="text" class="validate" v-model="nome">
                            <label for="nome">Nome</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <select class="browser-default" v-model="raca">
                                  <option value="" disabled selected></option>
                                  <option v-for="raca in racas" :key="raca.id" v-bind:value="raca.id" >{{raca.descricao}}</option>
                            </select>
                            <label>Raça</label>
                        </div>
                        <div class="input-field col s6">
                            <label>Sexo</label>
                            <select class="browser-default" v-model="sexo">
                                  <option value="" disabled selected></option>
                                  <option value="Macho">Macho</option>
                                  <option value="Fêmea">Fêmea</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="data_nascimento" type="date" class="validate" v-model="data_nascimento">
                            <label for="data_nascimento">Data de Nascimento</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="peso" type="text" class="validate" v-model="peso">
                            <label for="peso">Peso</label>
                        </div>
                    </div>
                    <botao acao="salvar"
                           tipo_icone="fas"
                           icone="save"
                           tamanho="s3"
                           v-on:click.native="salvar()">
                    </botao>
                </div>
            </div>
        </span>
    </site>

</template>

<script>
import Site from "../../template/Site";
import Botao from "../../components/layouts/Botao";

export default {
    name: "Pets",
    components: {Botao, Site},
    mounted: function () {
        this.editar()
        this.especies_select()
    },
    created() {
        var self = this
        var aux = self.$store.getters.getPetsEditar
        console.log('Animal Selecionado', aux)
    },
    data() {
        return {
            nome: '',
            raca: '',
            sexo: '',
            peso: '',
            especie: '',
            data_nascimento: '',

            especies: [],
            racas: [],
        }
    },
    methods: {
        salvar() {
            var self = this

            self.$http.post(self.$urlApi + 'pet/cadastro', {
                nome: self.nome,
                raca: self.raca,
                especie: self.especie,
                sexo: self.sexo,
                peso: self.peso,
                data_nascimento: self.data_nascimento,
                usuario: self.$store.getters.getUsuario
            }, {"headers": {"authorization": "Bearer " + self.$store.getters.getToken}})
                .then(function (response) {

                    if (response.data.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Pet cadastrado com sucesso!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        self.nome = ''
                        self.raca = ''
                        self.especie = ''
                        self.sexo = ''
                        self.peso = ''
                        self.data_nascimento = ''
                        self.$store.commit('setPets', response.data)
                        self.$router.push('/')
                    } else if (response.data.status == false && response.data.validacao) {
                        var erros = '';
                        for (var e of Object.values(response.data.erros)) {
                            erros += e + ' ';
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Erro: ' + erros,
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Erro ao cadastrar pet!',
                        })
                    }
                }).catch(function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'ERRO, tente novamente mais tarde!',
                })
            })
        },

        editar(){
            var self = this

            console.log('EDITAR')
        },

        especies_select: function () {
            var self = this

            self.$http.get(self.$urlApi + 'especie/select',
                {"headers": {"authorization": "Bearer " + self.$store.getters.getToken}})
                .then(function (response) {
                    if (response.data.status) {
                        self.especies = response.data.especies
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

        racas_select: function () {
            var self = this

            self.$http.get(self.$urlApi + 'raca/select/' + self.especie,
                {"headers": {"authorization": "Bearer " + self.$store.getters.getToken}})
                .then(function (response) {
                    if (response.data.status) {
                        self.racas = response.data.racas
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
