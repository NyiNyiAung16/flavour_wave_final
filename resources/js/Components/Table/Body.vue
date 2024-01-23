<script setup>

defineProps({
    textId:{
        type:String,
        required:true
    },
    errorId:{
        type:String,
        required:true
    },
    value:{
        type:[String,Number],
        required:true,
        default:''
    },
    error:{
        type:String,
        default:''
    }
});

</script>


<template>
    <td class="py-4 text-center">
        <span :id="textId" class="block text-center">{{ value }}</span>
        <p class="text-sm hidden text-red-500 my-1" :id="errorId" v-show="error">{{ error }}</p>
    </td>
</template>

