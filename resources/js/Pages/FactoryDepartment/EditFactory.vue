<script setup>
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue'
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    product:{
        type:Object
    }
});

const form = useForm('edit',{
    name:props.product.name,
    description:props.product.description,
    image_url: '',
    unit_price:props.product.unit_price,
    quantity_per_box:props.product.quantity_per_box,
});

const Edit = () => {
    form.patch(route('product.patch',props.product.id),{
        onSuccess:()=>{
            form.reset();
        },
        onError:()=>{
            setTimeout(()=>{
                form.clearErrors();
            },2000)
        },
        preserveScroll:true
    });
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
                        <div class="space-y-4 max-w-5xl">
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
                            <div>
                                <label class="mb-1 text-gray-50 block" for="perBox">Quantity Per Box</label>
                                <input type="number" id="perBox" v-model="form.quantity_per_box" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:12">
                                <p class="text-sm text-red-500 my-1" v-if="form.errors.quantity_per_box">{{ form.errors.quantity_per_box }}</p>
                            </div>
                            <button type="submit" class="px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-150 rounded font-bold">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

