<script setup>
import { ref, computed, onMounted } from "vue";
import TableLayout from "@/Layouts/TableLayout.vue";
import { filteredById } from "@/composable/search";

const props = defineProps({
    saleReturnProduct: {
        type: Array,
    },
    sales_return: {
        type: Array,
    },
});

const headers = ref(["Preorder ID", "Product Name", "Imported Quantity"]);
const search = ref("");
const saleReturns = computed(() => {
    return filteredById(search.value, organizeData(props.sales_return));
});

function organizeData(originalData) {
    const organizedData = [];

    originalData.forEach((item) => {
        const foundPreorder = organizedData.find(
            (order) => order.preorder_id === item.preorder_id
        );

        const productInfo = {
            product_id: item.product_id,
            product_name: item.product.name,
            return_qty: item.return_qty,
        };

        if (foundPreorder) {
            foundPreorder.products.push(productInfo);
        } else {
            organizedData.push({
                preorder_id: item.preorder_id,
                products: [productInfo],
            });
        }
    });
    return organizedData;
}
</script>

<template>
    <div v-if="sales_return.length > 0">
        <div class="flex justify-between items-center">
            <Search
                @searching="(val) => (search = val)"
                :howToSearch="'Id'"
                class="w-3/4"
            />
            <Sorting
                :items="saleReturns"
                sort-by="id"
                @sorted="(val) => (saleReturnProduct = val)"
                class="w-[370px]"
            />
        </div>
        <div
            class="sm:rounded-lg"
            :class="{ 'overflow-x-scroll': saleReturns?.length > 0 }"
        >
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin"
                :is-department="
                    $page.props.auth.user.department.name === 'WAREHOUSE'
                "
                v-if="saleReturns.length > 0"
            >
                <template #tbody>
                    <tr
                        class="border-b item"
                        v-for="(returnSale, index) in saleReturns"
                        :key="returnSale.id"
                    >
                        <td class="py-4 text-center">{{ index + 1 }}</td>
                        <td class="py-4 text-center">
                            {{ returnSale.preorder_id }}
                        </td>
                        <td class="py-4 text-center">
                            <ul>
                                <li
                                    v-for="product in returnSale.products"
                                    :key="product.product_id"
                                >
                                    {{ product.product_name }}
                                </li>
                            </ul>
                        </td>
                        <td class="py-4 text-center">
                            <ul>
                                <li
                                    v-for="product in returnSale.products"
                                    :key="product.product_id"
                                >
                                    {{ product.return_qty }}
                                </li>
                            </ul>
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
        <p>No Import from saleReturn Department</p>
    </div>
</template>
