<script setup>
import BaseInput from '@/Components/BaseInput.vue';
import Button from '@/Components/Button.vue';
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
            </div>
            <div class="space-y-4" v-show="!form.getData">
                <div>
                    <base-input
                        type="number"
                        label="Quantity Per Box"
                        v-model="form.quantity_per_box"
                        :error="form.errors.quantity_per_box"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <div>
                    <base-input
                        type="number"
                        label="Expected Quantity"
                        v-model="form.expected"
                        :error="form.errors.expected"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <div>
                    <base-input
                        type="number"
                        label="Actual Quantity"
                        v-model="form.actual"
                        :error="form.errors.actual"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <div class="flex gap-3 items-center">
                    <input type="checkbox" class="rounded-sm bg-gray-700 border-none">
                    <span>Store to Warehouse?</span>
                </div>
                <div>
                    <Button
                        type="submit"
                        text="Create"
                        class="px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-150 rounded font-bold"
                    />
                </div>
            </div>
        </div>
    </form>
</template>

