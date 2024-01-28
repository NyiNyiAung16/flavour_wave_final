<script setup>
import BaseInput from '@/Components/BaseInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
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
});

const CreateFactory = () => {
    form.post(route('factory.product.store'),{
        onSuccess:()=>{
            form.reset();
        },
        onError:()=>{
            setTimeout(() => {
                form.clearErrors();
            }, 2000);
        }
    });
}

const getImage = (e) => {
    form.image_url = e.target.files[0];
}

</script>


<template>
    <form @submit.prevent="CreateFactory" enctype="multipart/form-data" class="py-2">
        <h3 class="text-2xl font-bold text-center mb-3">Create Product</h3>
        <div class="max-w-3xl mx-auto space-y-4">
            <div>
                <base-input
                    type="text"
                    label="Product Name"
                    v-model="form.name"
                    :error="form.errors.name"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
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
                <base-input
                    type="number"
                    label="Price"
                    v-model="form.unit_price"
                    :error="form.errors.unit_price"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <PrimaryButton>Create</PrimaryButton>
            </div>
        </div>
    </form>
</template>

