<template>
    <div>
        <select v-model="this.value" @change="changeValue()" class="form-select" aria-label="Default select example">
            <option value="all" :selected="this.value == 'all'">Все заметки</option>
            <option value="deleted" :selected="this.value == 'deleted'">Недавно удаленные</option>
        </select>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Filter',

    data() {
        return {
            value: localStorage.getItem('filter') || 'all',
        }
    },

    mounted() {
    },
    methods:{
        changeValue(){
            localStorage.setItem('filter',this.value)
            this.$parent.$parent.changeFilter(this.value)
        },
    }
}
</script>
