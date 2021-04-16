<template>
    <span slot="principal">
        <div class="container">
            <div class="row">
                <router-link class="btn waves-effect waves-light blue" to="/pet/cadastro">
                    Cadastrar Pet
                </router-link>
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
    </span>

</template>

<script>
import Site from "../../template/Site";
import Grid from "../../components/layouts/Grid";
import Botao from "../../components/layouts/Botao";

export default {
    name: "PetsListar",
    components: {Botao, Grid, Site},
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
}
</script>

<style scoped>

</style>
