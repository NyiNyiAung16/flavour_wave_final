<script setup>
import TableLayout from "@/Layouts/TableLayout.vue";
import Button from "@/Components/Button.vue";
import Body from "@/Components/Table/Body.vue";
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import { showEdit, confrim, errors } from "../../../composable/editIngredient";
import { filteredByName } from "@/composable/search";

const props = defineProps({
    ingredients: {
        type: Array,
    },
});

const headers = ref([
    "Ingredient Name",
    "Source",
    "Amount",
    "Unit Price",
    "Purchased_Date",
    "Action",
]);

const search = ref("");

const filteredIngredients = computed(() => {
    return filteredByName(search.value, props.ingredients);
});

const deleteIngredient = (id) => {
    router.delete(route("ingredient.destroy", id), {
        preserveScroll: true,
    });
};

const edit = (e, ingredient, index) => {
    showEdit(e, ingredient, index);
};

const confrimData = (index, ingredient) => {
    confrim(index, ingredient);
};
</script>

<template>
    <div v-if="ingredients.length > 0">
        <div class="flex justify-between items-center">
            <Search
                @searching="(val) => (search = val)"
                :howToSearch="'ingredient name'"
                class="w-3/4"
            />
            <Sorting
                :items="filteredIngredients"
                sort-by="name"
                @sorted="(val) => (ingredients = val)"
            />
        </div>
        <div
            class="sm:rounded-lg"
            :class="{ 'overflow-x-scroll': filteredIngredients.length > 0 }"
        >
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin"
                :is-department="
                    $page.props.auth.user.department.name === 'FACTORY'
                "
                v-if="filteredIngredients.length > 0"
            >
                <template #tbody>
                    <tr
                        class="border-b item px-5"
                        v-for="(ingredient, index) in filteredIngredients"
                        :key="ingredient.id"
                    >
                        <td class="py-4 text-center">{{ index + 1 }}</td>
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
                        <td class="py-4 text-center">
                            {{
                                new Date(
                                    ingredient.purchased_date
                                ).toLocaleDateString()
                            }}
                        </td>
                        <td class="py-4 space-x-3 text-center">
                            <Button
                                type="button"
                                text="Edit"
                                :id="`editBtn${index}`"
                                class="text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                                @click="edit($event, ingredient, index)"
                            />
                            <Button
                                type="button"
                                text="Confrim"
                                :id="`confirmBtn${index}`"
                                class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                                @click="confrimData(index, ingredient)"
                            />
                            <Button
                                type="button"
                                text="Delete"
                                class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline"
                                @click="deleteIngredient(ingredient.id)"
                            />
                        </td>
                    </tr>
                </template>
            </TableLayout>
            <template v-else>
                <NoResults />
            </template>
        </div>
    </div>
    <div v-else>
        <p>Don't have any ingredients!</p>
    </div>
</template>
