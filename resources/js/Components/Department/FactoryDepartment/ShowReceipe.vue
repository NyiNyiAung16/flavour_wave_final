<script setup>
import TableLayout from "@/Layouts/TableLayout.vue";
import { ref, computed, defineProps } from "vue";
import { filteredByName } from "@/composable/search";
import Search from "@/Components/Search.vue";
import Sorting from "@/Components/Sorting.vue";
import { Link, router } from "@inertiajs/vue3";
import Button from "@/Components/Button.vue";
import { onMounted } from "vue";

const props = defineProps({
    receipes: {
        type: Array,
    },
});

const headers = ref([
    "Product Name",
    "Ingredients' Names",
    "Created_at",
    "Action",
]);
const search = ref("");
const shallowReceipes = ref([]);

onMounted(async () => {
    shallowReceipes.value = await filterDataByProduct(props.receipes);
});

const filteredReceipes = computed(() => {
    return filteredByName(search.value, shallowReceipes.value, "product_name");
});

function filterDataByProduct(data) {
    const result = {};
    data.forEach((item) => {
        const {
            id,
            product_id,
            product_name,
            ingredient_id,
            ingredient_name,
            amount_grams,
            created_at,
        } = item;

        if (!result[product_id]) {
            result[product_id] = {
                id: id,
                product_id: product_id,
                product_name: product_name,
                created_at: created_at,
                ingredients: [],
            };
        }

        // Check if the ingredient is already present for this product
        const existingIngredient = result[product_id].ingredients.find(
            (ingredient) => ingredient.ingredient_id === ingredient_id
        );

        if (!existingIngredient) {
            result[product_id].ingredients.push({
                ingredient_id: ingredient_id,
                ingredient_name: ingredient_name,
                amount_grams: amount_grams,
            });
        }
    });
    return Object.values(result);
}

const deleteReceipe = (id) => {
    router.delete(route("receipe.destroy", id), {
        preserveScroll: true,
    });
};
</script>

<template>
    <div v-if="receipes.length > 0">
        <div class="flex justify-between items-center">
            <Search
                @searching="(val) => (search = val)"
                :howToSearch="'Product Name'"
                class="w-3/4"
            />
            <Sorting
                :items="filteredReceipes"
                sort-by="product_name"
                @sorted="(val) => (shallowReceipes = val)"
                class="w-[390px]"
            />
        </div>
        <div
            class="sm:rounded-lg"
            :class="{ 'overflow-x-scroll': filteredReceipes.length > 0 }"
        >
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin"
                :is-department="
                    $page.props.auth.user.department.name === 'FACTORY'
                "
                v-if="filteredReceipes.length > 0"
            >
                <template #tbody>
                    <tr
                        class="border-b item"
                        v-for="(receipe, index) in filteredReceipes"
                        :key="receipe.id"
                    >
                        <td class="py-4 text-center">{{ index + 1 }}</td>
                        <td class="py-4 text-center">
                            {{ receipe.product_name }}
                        </td>
                        <td class="py-4 text-center">
                            <ul>
                                <li
                                    v-for="ingredient in receipe.ingredients"
                                    :key="ingredient.ingredient_id"
                                >
                                    {{ ingredient.ingredient_name }} -
                                    {{ ingredient.amount_grams }} grams
                                </li>
                            </ul>
                        </td>
                        <td class="py-4 text-center">
                            {{
                                new Date(
                                    receipe.created_at
                                ).toLocaleDateString()
                            }}
                        </td>
                        <td class="py-4 space-x-3 text-center">
                            <Link
                                :href="
                                    route('receipe.edit', receipe.product_id)
                                "
                                class="text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                            >
                                Edit
                            </Link>
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
            <template v-else>
                <NoResults />
            </template>
        </div>
    </div>
    <div v-else>
        <p>Don't have any receipes!</p>
    </div>
</template>
