<template>
    <site>
        <span slot="principal">
            <div class="container">
                <h2>Cadastrar Pet</h2>
                <div class="row">
                    <div class="row">
                        <div class="input-field col s6">
                            <label>Espécie</label>
                            <select class="browser-default" v-model="especie">
                                <option value="" disabled selected></option>
                                <option value="1">Cachorro</option>
                                <option value="2">Gato</option>
                                <option value="3" v-model="especie">Pássaro</option>
                            </select>
                        </div>
                        <div class="input-field col s6">
                            <input id="nome" type="text" class="validate" v-model="nome">
                            <label for="nome">Nome</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="raca" type="text" class="validate" v-model="raca">
                            <label for="raca">Raça</label>
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
                           icone="send"
                           tamanho="col s4"
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
    data() {
        return {
            "nome": '',
            "especie": '',
            "raca": '',
            "sexo": '',
            "data_nascimento": '',
            "peso": '',
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
        }
    }
}
</script>

<style scoped>

</style>
