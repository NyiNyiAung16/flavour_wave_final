<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    getData:{
        type:Object
    }
});

const form = useForm({
    name:'',
    description:'',
    image_url:null,
    unit_price:0,
    quantity_per_box:0,
    expected:0,
    actual:0
});

const CreateFactory = () => {
    form.post(route('factory.store'),{
        onSuccess:()=>{
            form.reset();
        },
        onError:()=>{
            setTimeout(() => {
                form.clearErrors();
            }, 2000);
        }
    });
    console.log(form)
}

const getImage = (e) => {
    form.image_url = e.target.files[0];
}

</script>


<template>
    <form @submit.prevent="CreateFactory" enctype="multipart/form-data">
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
            <div class="space-y-4" v-show="!form.getData">
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
                    <input type="checkbox" class="rounded-sm bg-gray-700 border-none">
                    <span>Store to Warehouse?</span>
                </div>
                <button type="submit" class="px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-150 rounded font-bold">Create</button>
            </div>
        </div>
    </form>
</template>

