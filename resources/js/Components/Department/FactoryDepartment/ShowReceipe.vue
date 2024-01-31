<script setup>
import TableLayout from '@/Layouts/TableLayout.vue';
import Button from '@/Components/Button.vue';
import Body from '@/Components/Table/Body.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'
import { showEdit, confrim,errors } from '../../../composable/editReceipe'

defineProps({
    receipes:{
        type:Array
    }
});

const headers = ref(['Ingredient ID','Product ID','Amount Grams','Created_at'])

const deleteReceipe = (id) => {
    router.delete(route('receipe.destroy',id),{
        preserveScroll:true
    });
}

const edit = (e,receipe,index) => {
    showEdit(e,receipe,index);
};

const confrimData = (index,receipe) => {
    confrim(index,receipe);
}

</script>


<template>
    <TableLayout
        :headers="headers"
        :is-admin="$page.props.auth.user.isAdmin" 
        :is-department="$page.props.auth.user.department === 'FACTORY'"
    >
        <template #tbody>
                <tr class="border-b item" v-for="(receipe,index) in receipes" :key="receipe.id">
                    <td class="py-4">{{index}}</td>
                    <Body
                        :text-id="`ingredientID${index}`"
                        :error-id="`errorIngredientId${index}`"
                        :value="receipe.ingredient_id"
                        :error="errors.ingredient_id"
                    />
                    <Body
                        :text-id="`productID${index}`"
                        :error-id="`errorProductId${index}`"
                        :value="receipe.product_id"
                        :error="errors.product_id"
                    />
                    <Body
                        :text-id="`amountGrams${index}`"
                        :error-id="`errorGramsId${index}`"
                        :value="receipe.amount_grams"
                        :error="errors.amount_grams"
                    />
                    <td class="py-4 text-center">{{new Date(receipe.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <Button
                            type="button"
                            text="Edit"
                            :id="`editBtn${index}`"
                            class=" text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                            @click="edit($event,receipe,index)"
                        />
                        <Button
                            type="button"
                            text="Confrim"
                            :id="`confirmBtn${index}`"
                            class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                            @click="confrimData(index,receipe)"
                        />
                        <Button
                            type="button"
                            text="Delete"
                            class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline"
                            @click="deleteReceipe(receipe.id)"
                        />
                    </td>
                </tr>
        </template>
    </TableLayout>
</template>

