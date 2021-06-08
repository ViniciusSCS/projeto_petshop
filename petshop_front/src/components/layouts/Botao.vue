<template>
    <button :class="'btn waves-effect waves-light ' + cor + ' ' + tamanho" :to="url" :type="tipo">
        {{ acao }}
        <i :class="tipo_icone + ' fa-' + icone + ' ' + tamanho_icone"></i>
    </button>
</template>

<script>
export default {
    name: "Botao",
    props: [
        'cor',
        'url',
        'tipo',
        'acao',
        'icone',
        'tamanho',
        'tipo_icone',
        'tamanho_icone'
    ],
}
</script>

<style scoped>

</style>
