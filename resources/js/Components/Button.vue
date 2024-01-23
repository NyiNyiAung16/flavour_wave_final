<script setup>

defineProps({
    text:{
        type:String,
        required:true,
        default:''
    }
})

</script>


<template>
    <button 
        v-bind="$attrs"
        v-if="text"
    >{{ text }}</button>
</template>

