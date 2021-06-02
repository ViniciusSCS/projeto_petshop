<template>
    <ul class="pagination">
        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
        <li :class="{active: source.current_page == page}" v-for="page in pages">
            <a href="#" @click="navigate($event, page)">{{ page }}</a>
        </li>
        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
    </ul>
</template>

<script>
import lodash from 'lodash'

export default {
    name: "paginacao",
    props: [
        'source',
    ],
    data() {
        return {
            pages: [],
        }
    },
    methods: {
        navigate(ev, page){
            ev.preventDefault()
            this.store.dispatch('navigate', page)
        }
    },
    watch: {
        source() {
            this.pages = lodash.range(1, this.source.last_page + 1)
            console.log('AQUI', this.pages);
        }
    }

}
</script>

<style scoped>

</style>
