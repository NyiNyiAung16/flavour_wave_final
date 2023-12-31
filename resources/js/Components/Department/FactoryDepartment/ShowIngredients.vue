<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    ingredients:{
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
                    <th class="py-3">Name</th>
                    <th class="py-3 text-center">Source</th>
                    <th class="py-3 text-center">Amount</th>
                    <th class="py-3 text-center">Unit Price</th>
                    <th class="py-3">Purchased_Date</th>
                    <th class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(ingredient,index) in ingredients" :key="ingredient.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4  flex gap-x-2">{{ ingredient.name }}</td>
                    <td class="py-4 text-center">{{ingredient.source}}</td>
                    <td class="py-4 text-center">{{ingredient.amount}}</td>
                    <td class="py-4 text-center">{{ingredient.unit_price}}</td>
                    <td class="py-4 text-center">{{new Date(ingredient.purchased_date).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <Link :href="`/factoryDepartment/ingredients/${ingredient.id}/edit`" class=" text-blue-500 hover:text-blue-600 duration-150 font-bold underline">Edit</Link>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold underline" @click="deleteIngredient(ingredient.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

