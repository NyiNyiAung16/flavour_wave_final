<script setup>
import { router } from '@inertiajs/vue3'
import { showEdit, confrim,errors } from '../../../composable/editReceipe'

defineProps({
    receipes:{
        type:Array
    }
});


const deleteReceipe = (id) => {
    router.delete(route('receipe.destroy',id));
}

const edit = (e,receipe,index) => {
    showEdit(e,receipe,index);
};

const confrimData = (index,receipe) => {
    confrim(index,receipe);
}

</script>


<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th class="py-3 text-center">Ingredient ID</th>
                    <th class="py-3 text-center">Product ID</th>
                    <th class="py-3 text-center">Amount Grams</th>
                    <th class="py-3 text-center">Created_at</th>
                    <th class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(receipe,index) in receipes" :key="receipe.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4 text-center bg-transparent" >
                        <span :id="`ingredientID${index}`" class="block text-center">{{ receipe.ingredient_id }}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorIngredientId${index}`" v-show="errors.ingredient_id">{{ errors.ingredient_id }}</p>
                    </td>

                    <td class="py-4 text-center bg-transparent" >
                        <span :id="`productID${index}`" class="block text-center">{{receipe.product_id}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorProductId${index}`" v-show="errors.product_id">{{ errors.product_id }}</p>
                    </td>

                    <td class="py-4 text-center bg-transparent" >
                        <span :id="`amountGrams${index}`" class="block">{{receipe.amount_grams}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorGramsId${index}`" v-show="errors.amount_grams">{{ errors.amount_grams }}</p>
                    </td>

                    <td class="py-4 text-center">{{new Date(receipe.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <button class=" text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" @click="edit($event,receipe,index)" :id="`editBtn${index}`">Edit</button>
                        <button class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" @click="confrimData(index,receipe)" :id="`confirmBtn${index}`">Confrim</button>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline" @click="deleteReceipe(receipe.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

