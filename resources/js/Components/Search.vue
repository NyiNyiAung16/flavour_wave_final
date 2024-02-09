<script setup>
import { ref } from 'vue';

defineProps({
    howToSearch:{
        type:String
    }
})

defineEmits(['searching']);

const search = ref('');

</script>


<template>
    <div>
        <div class="max-w-sm flex gap-3 items-center bg-slate-400 pe-3 my-3 rounded">
            <input 
                type="text" 
                v-model="search"
                class="w-full text-black rounded-s border-none" 
                :placeholder="`search by ${howToSearch}...`"
                @keydown.enter="$emit('searching',search)"
            >
            <i class="fa-solid fa-search"></i>
        </div>
    </div>
</template>
