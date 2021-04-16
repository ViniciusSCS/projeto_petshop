<template>
    <span>
        <header>
            <nav-bar cor="deep-orange">
                <li v-if="usuario">{{ usuario.name }}</li>
                <li v-if="usuario"><a v-on:click="sair()">Sair</a></li>
            </nav-bar>
        </header>

        <main>
            <slot name="principal"/>
        </main>
    </span>

</template>

<script>
import NavBar from "../components/layouts/NavBar";

export default {
    name: "Site",
    components: {NavBar},
    data() {
        return {
            usuario: false,
        }
    },
    created() {
        var self = this
        var aux = self.$store.getters.getUsuario
        if (aux) {
            self.usuario = self.$store.getters.getUsuario
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
