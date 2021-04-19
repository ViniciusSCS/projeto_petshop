<template>
    <site>
        <span slot="principal">
            <div class="container">
                <h2>Cadastrar Pet</h2>
                <div class="row">
                    <form class="col s12">
                        <div class="row">
                            <div class="input-field col s6">
                                <select class="browser-default">
                                    <option value="" disabled selected>Selecione...</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                                <label>Espécie</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="nome" type="text" class="validate">
                                <label for="nome">Nome</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="raca" type="text" class="validate">
                                <label for="raca">Raçao</label>
                            </div>
                            <div class="input-field col s6">
                                <label>Sexo</label>
                                <select class="browser-default">
                                      <option value="" disabled selected></option>
                                      <option value="Macho">Macho</option>
                                      <option value="Fêmea">Fêmea</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="idade" type="text" class="validate">
                                <label for="idade">Idade</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="peso" type="text" class="validate">
                                <label for="peso">Peso</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="user_id" type="text" class="validate">
                                <label for="user_id">Responsável</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </span>
    </site>

</template>

<script>
import Site from "../../template/Site";
export default {
    name: "Pets",
    components: {Site},
    data() {
        return {}
    },
}
</script>

<style scoped>

</style>
