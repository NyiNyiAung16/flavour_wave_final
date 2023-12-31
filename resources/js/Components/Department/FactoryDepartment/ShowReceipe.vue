<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    receipes:{
        type:Array
    }
});

</script>


<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th class="py-3">Ingredient Name</th>
                    <th class="py-3 text-center">Product Name</th>
                    <th class="py-3 text-center">Amount Grams</th>
                    <th class="py-3 text-center">Created_at</th>
                    <th class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(receipe,index) in receipes" :key="receipe.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4  flex gap-x-2">{{ receipe.ingredient_name }}</td>
                    <td class="py-4 text-center">{{receipe.product_name}}</td>
                    <td class="py-4 text-center">{{receipe.amount_grams}}</td>
                    <td class="py-4 text-center">{{new Date(receipe.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <Link :href="`/factoryDepartment/ingredients/${receipe.id}/edit`" class=" text-blue-500 hover:text-blue-600 duration-150 font-bold underline">Edit</Link>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold underline" @click="deleteReceipe(receipe.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

