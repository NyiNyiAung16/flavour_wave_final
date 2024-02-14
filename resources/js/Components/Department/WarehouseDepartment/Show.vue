<script setup>
import Body from "@/Components/Table/Body.vue";
import { ref, computed } from "vue";
import { errors } from "../../../composable/editWarehouse";
import TableLayout from "@/Layouts/TableLayout.vue";
import { filteredByName } from "@/composable/search";

const props = defineProps({
    warehouses: {
        type: Array,
    },
});

const headers = ref([
    "Product ID",
    "Opening Balance",
    "Sales Issue",
    "Received",
    "Availability",
    "Sales Return",
    "Damage",
]);
const search = ref("");

const filteredWarehouses = computed(() => {
    return filteredByName(search.value, props.warehouses);
});

// const deleteWarehouse = (id) => {
//     router.delete(route("warehouse.destroy", id));
// };

// const edit = (e, warehouse, index) => {
//     showEdit(e, warehouse, index);
// };

// const confrimData = (index, warehouse) => {
//     confrim(index, warehouse);
// };
</script>

<template>
    <div v-if="warehouses.length > 0">
        <div class="flex justify-between items-center">
            <Search
                @searching="(val) => (search = val)"
                :howToSearch="'Product Name'"
                class="w-3/4"
            />
            <Sorting
                :items="filteredWarehouses"
                sort-by="product_name"
                @sorted="(val) => (warehouses = val)"
                class="w-[370px]"
            />
        </div>
        <div class="sm:rounded-lg">
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin"
                :is-department="
                    $page.props.auth.user.department.name === 'WAREHOUSE'
                "
                v-if="filteredWarehouses.length > 0"
            >
                <template #tbody>
                    <tr
                        class="border-b item"
                        v-for="(warehouse, index) in filteredWarehouses"
                        :key="warehouse.id"
                    >
                        <td class="py-4 text-center">{{ index + 1 }}</td>
                        <Body
                            :text-id="`productid${index}`"
                            :error-id="`errorid${index}`"
                            :value="warehouse.product_name"
                            :error="errors.product_id"
                        />
                        <Body
                            :text-id="`opening${index}`"
                            :error-id="`errorop${index}`"
                            :value="warehouse.opening_balance"
                            :error="errors.opening_balance"
                        />
                        <Body
                            :text-id="`salesIss${index}`"
                            :error-id="`errorsal${index}`"
                            :value="warehouse.sales_issue"
                            :error="errors.sales_issue"
                        />
                        <Body
                            :text-id="`received${index}`"
                            :error-id="`errorrec${index}`"
                            :value="warehouse.received"
                            :error="errors.received"
                        />
                        <Body
                            :text-id="`avail${index}`"
                            :error-id="`errorava${index}`"
                            :value="warehouse.availability"
                            :error="errors.availability"
                        />
                        <Body
                            :text-id="`salesRe${index}`"
                            :error-id="`errorsalr${index}`"
                            :value="warehouse.sales_return"
                            :error="errors.sales_return"
                        />
                        <Body
                            :text-id="`damage${index}`"
                            :error-id="`errordam${index}`"
                            :value="warehouse.damage"
                            :error="errors.damage"
                        />
                        <!-- <td class="py-4 space-x-3 text-center">
                                <Button
                                    type="button"
                                    text="Edit"
                                    :id="`editBtn${index}`"
                                    class="text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                                    @click="edit($event, warehouse, index)"
                                />
                                <Button
                                    type="button"
                                    text="Confrim"
                                    :id="`confirmBtn${index}`"
                                    class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                                    @click="confrimData(index, warehouse)"
                                />
                                <Button
                                    type="button"
                                    text="Delete"
                                    class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline"
                                    @click="deleteWarehouse(warehouse.id)"
                                />
                            </td> -->
                    </tr>
                </template>
            </TableLayout>
            <template v-else>
                <NoResults />
            </template>
        </div>
    </div>
    <div v-else>
        <p>Don't have any warehouses!</p>
    </div>
</template>
