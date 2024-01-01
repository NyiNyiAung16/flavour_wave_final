<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Products from '../../Components/Department/FactoryDepartment/Products.vue'
import ProductDetail from '../../Components/Department/FactoryDepartment/ProductDetail.vue'
import Form from '../../Components/Department/FactoryDepartment/Form.vue'
import ShowIngredients from '@/Components/Department/FactoryDepartment/ShowIngredients.vue';
import ShowReceipe from '@/Components/Department/FactoryDepartment/ShowReceipe.vue';

const props = defineProps({
    factories:{
        type:Array
    },
    products:{
        type:Array
    },
    ingredients:{
        type:Array
    },
    receipes:{
        type:Array
    }
});

const passDataToForm = ref({});

const getDataFromDetail = (factory) => {
    passDataToForm.value = factory;
}

const toggleChild = ref('index');

</script>

<template>
    <Head title="FactoryDeparment" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex gap-5">
                <p class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-lg leading-tight cursor-pointer" 
                   :class="{'underline':toggleChild === 'index'}" 
                   @click="toggleChild = 'index'"
                >Products</p>
                <p class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-lg leading-tight cursor-pointer" 
                   :class="{'underline':toggleChild === 'show'}" 
                   @click="toggleChild = 'show'"
                >Product Detail</p>
                <p class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-lg leading-tight cursor-pointer" 
                   :class="{'underline':toggleChild === 'ingredients'}" 
                   @click="toggleChild = 'ingredients'"
                >Show Ingredients</p>
                <p class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-lg leading-tight cursor-pointer" 
                   :class="{'underline':toggleChild === 'receipes'}" 
                   @click="toggleChild = 'receipes'"
                >Show Receipes</p>
                <p class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-lg leading-tight cursor-pointer"
                :class="{'underline':toggleChild === 'form'}" 
                @click="toggleChild = 'form'"
                >Create Record</p>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <div>
                        <div v-if="factories">
                            <div v-if="toggleChild === 'index'">   
                                <Products :products="products"/>
                            </div>
                            <div v-if="toggleChild === 'show'">
                                <ProductDetail :factories="factories" @pass-data="getDataFromDetail"/>
                            </div>
                            <div v-if="toggleChild === 'form'">
                                <Form :getData="passDataToForm"/>
                            </div>
                            <div v-if="toggleChild === 'ingredients'">
                                <ShowIngredients :ingredients="ingredients"/>
                            </div>
                            <div v-if="toggleChild === 'receipes'">
                                <ShowReceipe :receipes="receipes"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
