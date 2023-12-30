<script setup>
import { ref } from 'vue';
import ProductDetail from './ProductDetail.vue';
import Form from './Form.vue'
import Products from './Products.vue';

const props = defineProps({
    factories:{
        type:Array
    },
    products:{
        type:Array
    },
    toggle:{
        type:String
    }
});

const passDataToForm = ref({});

const getDataFromDetail = (factory) => {
    passDataToForm.value = factory;
}

</script>


<template>
    <div v-if="factories">
        <div v-if="toggle === 'index'">   
            <Products :products="products"/>
        </div>
       <div v-if="toggle === 'show'">
            <ProductDetail :factories="factories" @pass-data="getDataFromDetail"/>
       </div>
        <div v-if="toggle === 'form'">
            <Form :getData="passDataToForm"/>
        </div>
    </div>
</template>


<style lang="scss" scoped>

</style>