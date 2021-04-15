<template>
    <site>

    </site>
</template>

<script>
import Site from "../../template/Site";

export default {
    name: "Home",
    components: {Site},
    data() {
        return {
            pets: [],
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
}
</script>

<style scoped>

</style>
