<script setup>

defineProps({
    name:{
        type:String,
        default:''
    }
});

</script>


<template>
    <div>
        <p class="text-white w-full text-xl font-semibold p-2 mb-3 mx-3" v-if="name">{{ name }}</p>
        <p class="text-white w-full text-xl font-semibold p-2 mb-3 mx-3" v-else> Customer </p>
        <div class="w-full h-[2px] bg-slate-900 mb-3"></div>
    </div>
</template>


<style scoped>

</style>