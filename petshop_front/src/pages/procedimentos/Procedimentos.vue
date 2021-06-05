<template>
    <site>
        <span slot="principal">
            <div class="container">
                <h2>Cadastrar Procedimento</h2>
                <div class="row">
                    <div class="row">
                        <form class="col s12">
                            <div class="row">
                                <div class="input-field col s6">
                                    <label>PET</label>
                                    <select class="browser-default">
                                        <option value="" disabled selected></option>
                                        <option value="1">Pet 1</option>
                                        <option value="2">Pet 2</option>
                                        <option value="3">Pet 3</option>
                                    </select>
                                </div>
                                <div class="input-field col s6">
                                    <label>
                                        <input name="group1" type="radio" value="1"/>
                                        <span>Banho</span>
                                    </label>
                                </div>
                                <div class="input-field col s6">
                                    <label>
                                        <input name="group1" type="radio" value="1"/>
                                        <span>Tosa</span>
                                    </label>
                                </div>
                                <div class="input-field col s6">
                                    <label>
                                        <input name="group1" type="radio" value="1"/>
                                        <span>Banho & Tosa</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label>Browser Select</label>
                                    <select class="browser-default">
                                        <option value="" disabled selected></option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
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
                                    <label>
                                        <input name="group1" type="radio" value="1"/>
                                        <span>Castrado</span>
                                    </label>
                                </div>
                                <div class="input-field col s6">
                                    <label>
                                        <input name="group1" type="radio" value="1" checked/>
                                        <span>Não Castrado</span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </span>
    </site>
</template>

<script>
import Site from "../../template/Site";

export default {
    name: "Procedimentos",
    components: {Site},
}
</script>

<style scoped>

</style>
