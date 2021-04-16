<template>
    <button :class="'btn waves-effect waves-light ' + cor + ' ' + tamanho" :to="url">
        {{ acao }}
        <i class="material-icons right">{{ icone }}</i>
    </button>
</template>

<script>
export default {
    name: "Botao",
    props: [
        'cor',
        'url',
        'acao',
        'icone',
        'tamanho',
    ],
}
</script>

<style scoped>

</style>
