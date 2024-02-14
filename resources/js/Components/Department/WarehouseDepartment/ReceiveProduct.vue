<script setup>
import { ref, computed, onMounted } from "vue";
import TableLayout from "@/Layouts/TableLayout.vue";
import { filteredById } from "@/composable/search";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    factoryProduct: {
        type: Array,
    },
});

const headers = ref([
    "Product ID",
    "Product Name",
    "Imported Quantity",
    "Produced Date",
    "Action",
]);
const search = ref("");
const filteredOrders = computed(() => {
    return filteredById(search.value, props.factoryProduct);
});

function formatDateString(dateString) {
    const dateObject = new Date(dateString);
    const day = dateObject.getDate();
    const month = dateObject.getMonth() + 1; // Month is zero-based, so add 1
    const year = dateObject.getFullYear();
    const formattedDate = `${year}-${month < 10 ? "0" : ""}${month}-${
        day < 10 ? "0" : ""
    }${day}`;
    return formattedDate;
}

const form = useForm({
    id: "",
    productID: "",
    quantity: "",
});
const addToWarehouse = (id, product_id, quantity) => {
    form.id = id;
    form.productID = product_id;
    form.quantity = quantity;

    form.patch(route("warehouse.updateAvailability"), {
        onSuccess: (response) => {
            form.reset();
        },
        onError: (error) => {
            console.error("Error:", error);
            setTimeout(() => {
                form.clearErrors();
            }, 2000);
        },
        preserveScroll: true,
    });
};
</script>

<template>
    <div v-if="factoryProduct.length > 0">
        <div class="flex justify-between items-center">
            <Search
                @searching="(val) => (search = val)"
                :howToSearch="'Id'"
                class="w-3/4"
            />
            <Sorting
                :items="filteredOrders"
                sort-by="id"
                @sorted="(val) => (factoryProduct = val)"
                class="w-[370px]"
            />
        </div>
        <div
            class="sm:rounded-lg"
            :class="{ 'overflow-x-scroll': filteredOrders?.length > 0 }"
        >
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin"
                :is-department="
                    $page.props.auth.user.department?.name === 'WAREHOUSE'
                "
                v-if="filteredOrders?.length > 0"
            >
                <template #tbody>
                    <tr
                        class="border-b item"
                        v-for="(factory, index) in factoryProduct"
                        :key="factory.product.id"
                    >
                        <template v-if="!factory.stored">
                            <td class="py-4 px-2 text-center">
                                {{ index + 1 }}
                            </td>
                            <td class="py-4 px-2 text-center">
                                {{ factory.product.id }}
                            </td>

                            <td class="py-4 px-2 text-center">
                                {{ factory.product.name }}
                            </td>

                            <td class="py-4 px-2 text-center">
                                {{ factory.actual }}
                            </td>
                            <td class="py-4 text-center">
                                {{ formatDateString(factory.created_at) }}
                            </td>
                            <td
                                class="py-4 px-2 text-center"
                                v-show="
                                    $page.props.auth.user.isAdmin &&
                                    $page.props.auth.user.department?.name ===
                                        'WAREHOUSE'
                                "
                            >
                                <button
                                    class="text-blue-500 hover:text-blue-600 hover:underline duration-200 font-semibold"
                                    @click="
                                        addToWarehouse(
                                            factory.id,
                                            factory.product_id,
                                            factory.actual
                                        )
                                    "
                                >
                                    confrim
                                </button>
                                <button
                                    class="text-red-500 hover:text-red-600 hover:underline duration-200 font-semibold ms-2"
                                    @click="Cancel(factory.product_id)"
                                >
                                    cancel
                                </button>
                            </td>
                        </template>
                    </tr>
                </template>
            </TableLayout>
            <template v-else>
                <NoResults />
            </template>
        </div>
    </div>
    <div v-else>
        <p>No Import from Factory Department</p>
    </div>
</template>
