<script setup>
import { Link, router } from '@inertiajs/vue3';

defineProps({
    'products':{
        type:Array
    }
});

const deleteProduct = ( id ) => {
    router.delete(route('product.destroy',id));
}

</script>


<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th class="py-3">Product Names</th>
                    <th class="py-3">Description</th>
                    <th class="py-3 text-center">Image</th>
                    <th class="py-3 text-center">Price</th>
                    <th class="py-3 text-center">Quantity Per Box</th>
                    <th class="py-3 text-center">Created_at</th>
                    <th class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(product,index) in products" :key="product.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4 w-[270px] px-2">{{ product.name }}</td>
                    <td class="py-4 w-[370px] px-2">{{product.description.substring(0,70) + '...'}}</td>
                    <td class="py-4">
                        <img :src="`/${product.image_url}`" class="mx-auto" width="70" alt="productimg">
                    </td>
                    <td class="py-4 text-center">{{product.unit_price}}$</td>
                    <td class="py-4 text-center">{{product.quantity_per_box}}</td>
                    <td class="py-4 text-center">{{ new Date(product.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <Link :href="`factoryDepartment/products/${product.id}/edit`" class="text-blue-500 hover:text-blue-600 duration-150 font-bold underline">Edit</Link>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold underline" @click="deleteProduct(product.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

