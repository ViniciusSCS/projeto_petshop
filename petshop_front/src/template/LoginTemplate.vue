<template>
    <span>
        <header>
            <nav-bar cor="deep-orange">
                <li v-if="usuario"><router-link to="/perfil">{{ usuario.name }}</router-link></li>
                <li v-if="usuario"><a v-on:click="sair()">Sair</a></li>
            </nav-bar>
        </header>
        <main>
            <div class="container">
                <div class="row">
                    <grid tamanho="4">
                        <slot name="principal"/>
                    </grid>
                </div>
            </div>
        </main>
    </span>

</template>

<script>
import NavBar from "../components/layouts/NavBar";

export default {
    name: "LoginTemplate",
    components: {NavBar}
}
</script>

<style scoped>

</style>
