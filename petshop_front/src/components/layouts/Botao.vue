<template>
    <router-link :class="'btn waves-effect waves-light ' + cor + ' col ' + tamanho" :to="''+ url +''" :title="titulo">
        {{ acao }}
        <i :class="tipo_icone + ' fa-' + icone + ' ' + tamanho_icone"></i>
    </router-link>

</template>

<script>
export default {
    name: "Botao",
    props: [
        'cor',
        'url',
        'acao',
        'icone',
        'titulo',
        'tamanho',
        'tipo_icone',
        'tamanho_icone',
    ],
}
</script>

<style scoped>
.fa-*{
    display: inline-block;
    font-size: 1.8em;
    text-align: right;
    margin-right: 20px;
    border-radius: 10px;
    background: white;
    color: #674323;
    padding: 2px 5px 1px 5px;
    box-size: border-box;
    vertical-align: middle;
}
</style>
