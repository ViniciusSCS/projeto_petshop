<template>
    <site>
        <span slot="principal">
            <pets-listar/>
        </span>
    </site>
</template>

<script>
import Site from "../../template/Site";
import PetsListar from "../pets/PetsListar";
import Pets from "../pets/Pets";

export default {
    name: "Home",
    components: {Pets, PetsListar, Site},
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
