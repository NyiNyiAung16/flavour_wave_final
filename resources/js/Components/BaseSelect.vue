<script setup>

defineProps({
    label:{
        type:String,
        default:''
    },
    modelValue:{
        type:[String,Number,Array],
        required:true,
        default:''
    },
    options:{
        type:Array,
        required:true
    },
    error:{
        type:String,
        default:''
    },
    defaultName:{
        type:String,
        default:"Department"
    }
});

</script>


<template>
    <label v-if="label">{{ label }}</label>
    <select 
        v-bind="$attrs"
        :value="modelValue"
        @change="$emit('update:modelValue',$event.target.value)"
    >
    
        <option value="default" disabled selected>Choose a {{ defaultName }}</option>
        <option
            v-for="(option,index) in options" :key="index"
            :value="parseInt(option.value)"
            class="py-2"
        >
        {{ option.label }}
        </option>

    </select>
    <p class="text-sm text-red-500 my-1" v-if="error">{{ error }}</p>
</template>

