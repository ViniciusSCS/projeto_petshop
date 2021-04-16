<template>
    <span>
        <header>
            <nav-bar cor="deep-orange">
                <li v-if="usuario">{{ usuario.name }}</li>
                <li v-if="usuario"><a v-on:click="sair()">Sair</a></li>
            </nav-bar>
        </header>

        <main>
            <div class="container">
                <div class="row">
                    <botao acao="Cadastrar Pet" icone="add" url="/pet_cadastrar"></botao>
                </div>
                <div class="row">
                    <grid tamanho="12">
                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Espécie</th>
                                    <th>Raça</th>
                                    <th>Idade</th>
                                </tr>
                            </thead>

                            <tbody v-if="pets.length > 0">
                                <tr v-for="pet in pets" :key="pet.id">
                                    <td>{{ pet.nome }}</td>
                                    <td>{{ pet.especie.descricao }}</td>
                                    <td>{{ pet.raca }}</td>
                                    <td>{{ pet.idade }}</td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td></td>
                                    <td class="">Nenhum pet cadastrado</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </grid>
                </div>
            </div>
        </main>
    </span>

</template>

<script>
import NavBar from "../components/layouts/NavBar";
import Grid from "../components/layouts/Grid";
import Botao from "../components/layouts/Botao";

export default {
    name: "Site",
    components: {Botao, Grid, NavBar},
    data() {
        return {
            usuario: false,
            pets: [],
        }
    },
    created() {
        var self = this
        var aux = self.$store.getters.getUsuario
        if (aux) {
            self.usuario = self.$store.getters.getUsuario
            self.$http.get(self.$urlApi + 'pet/listar',
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
        } else {
            self.$router.push('/login')
        }
    },
    methods: {
        sair() {
            var self = this
            self.$store.commit('setUsuario', null)
            sessionStorage.clear()
            self.usuario = false
            self.$router.push('/login')
        },
    }
}
</script>

<style scoped>

</style>
