<script setup>

defineProps({
    label:{
        type:String,
        default:''
    },
    modelValue:{
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
    <label v-if="label" class="mb-1 text-gray-50 block">{{ label }}</label>
    <input
        v-bind="$attrs" 
        :value="modelValue"
        @input="$emit('update:ModelValue',$event.target.value)"
    >
    <p class="text-sm text-red-500 my-1" v-if="error">{{ error }}</p>
</template>

