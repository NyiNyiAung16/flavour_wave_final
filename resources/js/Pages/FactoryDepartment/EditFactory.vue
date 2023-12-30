<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue'
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    factory:{
        type:Object
    },
    product:{
        type:Object
    }
});

const isStore = ref(false);

const form = useForm('edit',{
    name:ref(''),
    description:ref(''),
    image_url:ref(''),
    unit_price:ref(0),
    quantity_per_box:ref(0),
    expected:ref(0),
    actual:ref(0)
});

if(props.factory){
    form.name = props.factory.product.name;
    form.description = props.factory.product.description;
    form.unit_price = props.factory.product.unit_price;
    form.quantity_per_box = props.factory.product.quantity_per_box;
    form.expected = props.factory.expected;
    form.actual = props.factory.actual;
    isStore.value = props.factory.product['inventory'] ? true : false;
}

if(props.product){
    form.name = props.product.name;
    form.description = props.product.description;
    form.unit_price = props.product.unit_price;
    form.quantity_per_box = props.product.quantity_per_box;
    form.expected = props.product.details.expected;
    form.actual = props.product.details.actual;
    isStore.value = props.product.inventory ? true : false;
};

const Edit = () => {
    form.put(route('factory.edit'),{
        onSuccess:()=>{
            form.reset();
        },
        onError:()=>{
            setTimeout(()=>{
                form.clearErrors();
            },2000)
        }
    });
    console.log(form)
}

const getImage = (e) => {
    form.image_url = e.target.files[0];
}

</script>


<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex gap-5">
                <p class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer underline" 
                >Edit Product Detail</p>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <form @submit.prevent="Edit">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="space-y-4">
                                <div>
                                    <label class="mb-1 text-gray-50 block" for="productName">Product Name</label>
                                    <input type="text" id="productName" v-model="form.name" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:Burmese Bliss">
                                    <p class="text-sm text-red-500 my-1" v-if="form.errors.name">{{ form.errors.name }}</p>
                                </div>
                                <div>
                                    <label class="mb-1 text-gray-50 block" for="description">Description</label>
                                    <textarea id="description" v-model="form.description" class="w-full bg-gray-700 border-none p-2 rounded outline-none resize-none" placeholder="eg:lorem ipsum..." rows="5"></textarea>
                                    <p class="text-sm text-red-500 my-1" v-if="form.errors.description">{{ form.errors.description }}</p>
                                </div>
                                <div>
                                    <label class="mb-1 text-gray-50 hover:text-gray-300 duration-150 block bg-gray-700 border-none p-2 rounded cursor-pointer" for="image">Choose an image</label>
                                    <input class="hidden" type="file" id="image" @change="getImage">
                                    <p class="text-sm text-red-500 my-1" v-if="form.errors.image_url">{{ form.errors.image_url }}</p>
                                </div>
                                <div>
                                    <label class="mb-1 text-gray-50 block" for="price">Price</label>
                                    <input type="number" id="price" v-model="form.unit_price" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:100">
                                    <p class="text-sm text-red-500 my-1" v-if="form.errors.unit_price">{{ form.errors.unit_price }}</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="mb-1 text-gray-50 block" for="perBox">Quantity Per Box</label>
                                    <input type="number" id="perBox" v-model="form.quantity_per_box" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:12">
                                    <p class="text-sm text-red-500 my-1" v-if="form.errors.quantity_per_box">{{ form.errors.quantity_per_box }}</p>
                                </div>
                                <div>
                                    <label class="mb-1 text-gray-50 block" for="expected">Expected Quantity</label>
                                    <input type="number" id="expected" v-model="form.expected" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:100">
                                    <p class="text-sm text-red-500 my-1" v-if="form.errors.expected">{{ form.errors.expected }}</p>
                                </div>
                                <div>
                                    <label class="mb-1 text-gray-50 block" for="actual">Actual Quantity</label>
                                    <input type="number" id="actual" v-model="form.actual" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:50">
                                    <p class="text-sm text-red-500 my-1" v-if="form.errors.actual">{{ form.errors.actual }}</p>
                                </div>
                                <div class="flex gap-3 items-center">
                                    <input type="checkbox" v-model="isStore" class="rounded-sm bg-gray-700 border-none">
                                    <span>Store to Warehouse?</span>
                                </div>
                                <button type="submit" class="px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-150 rounded font-bold">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

