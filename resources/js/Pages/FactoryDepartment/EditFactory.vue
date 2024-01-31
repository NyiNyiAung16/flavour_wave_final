<script setup>
import NavLink from '@/Components/NavLink.vue'
import BaseInput from '@/Components/BaseInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue'
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    product:{
        type:Object
    }
});


const form = useForm('edit',{
    _method:'patch',
    name:props.product.name,
    description:props.product.description,
    image_url: '',
    unit_price:props.product.unit_price,
    quantity_per_box:props.product.quantity_per_box,
});

const Edit = () => {
    form.post(route('product.patch',props.product.id),{
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
            <div class="flex flex-col gap-3">
                <NavLink 
                    v-show="$page.props.auth.user.isAdmin && $page.props.auth.user.department.name === 'FACTORY'" 
                    :href="route('factoryDepartment.index')" 
                    :active="route().current('factoryDepartment.index')"
                >
                    Dashboard
                </NavLink>
                <p class="sideBar active-sideBar" 
                >Edit Product</p>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <form @submit.prevent="Edit">
                        <h3 class="text-2xl text-center font-semibold mb-3">Edit Product</h3>
                        <div class="space-y-4 max-w-5xl mx-auto">
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
                                <base-input
                                    type="number"
                                    label="Quantity Per Box"
                                    v-model="form.quantity_per_box"
                                    :error="form.errors.quantity_per_box"
                                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                                />
                            </div>
                            <div>
                                <PrimaryButton>Update</PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

