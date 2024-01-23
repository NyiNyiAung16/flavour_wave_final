<script setup>
import Button from '@/Components/Button.vue';
import Body from '@/Components/Table/Body.vue';
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
                    <Body
                        :text-id="`name${index}`"
                        :error-id="`errorname${index}`"
                        :value="ingredient.name"
                        :error="errors.name"
                    />
                    <Body
                        :text-id="`source${index}`"
                        :error-id="`errorsource${index}`"
                        :value="ingredient.source"
                        :error="errors.source"
                    />
                    <Body
                        :text-id="`amount${index}`"
                        :error-id="`erroramount${index}`"
                        :value="ingredient.amount"
                        :error="errors.amount"
                    />
                    <Body
                        :text-id="`unitPrice${index}`"
                        :error-id="`errorprice${index}`"
                        :value="ingredient.unit_price"
                        :error="errors.unit_price"
                    />
                    <td class="py-4 text-center">{{new Date(ingredient.purchased_date).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <Button
                            type="button"
                            text="Edit"
                            :id="`editBtn${index}`"
                            class=" text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                            @click="edit($event,ingredient,index)"
                        />
                        <Button
                            type="button"
                            text="Confrim"
                            :id="`confirmBtn${index}`"
                            class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                            @click="confrimData(index,ingredient)"
                        />
                        <Button
                            type="button"
                            text="Delete"
                            class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline"
                            @click="deleteIngredient(ingredient.id)"
                        />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

