<script setup>
import { router } from '@inertiajs/vue3'
import { showEdit, confrim, errors } from '../../../composable/editIngredient'

defineProps({
    ingredients:{
        type:Array
    }
});

const deleteIngredient = (id) => {
    router.delete(route('ingredient.destroy',id));
}

const edit = (e,ingredient,index) => {
    showEdit(e,ingredient,index);
}

const confrimData = (index,ingredient) => {
    confrim(index,ingredient);
}

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
                    <th class="py-3 text-center">Purchased_Date</th>
                    <th class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(ingredient,index) in ingredients" :key="ingredient.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4  flex gap-x-2">
                        <span class="block text-center" :id="`name${index}`">{{ ingredient.name }}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorname${index}`" v-show="errors.name">{{ errors.name }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span class="block text-center" :id="`source${index}`">{{ingredient.source}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorsource${index}`" v-show="errors.source">{{ errors.source }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span class="block text-center" :id="`amount${index}`">{{ingredient.amount}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`erroramount${index}`" v-show="errors.amount">{{ errors.amount }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span class="block text-center" :id="`unitPrice${index}`" >{{ingredient.unit_price}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorprice${index}`" v-show="errors.unit_price">{{ errors.unit_price }}</p>
                    </td>
                    <td class="py-4 text-center">{{new Date(ingredient.purchased_date).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <button class=" text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" @click="edit($event,ingredient,index)" :id="`editBtn${index}`">Edit</button>
                        <button class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" @click="confrimData(index,ingredient)" :id="`confirmBtn${index}`">Confrim</button>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline" @click="deleteIngredient(ingredient.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

