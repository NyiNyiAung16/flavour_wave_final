<script setup>
import OrderDetail from "@/Components/Modals/OrderDetail.vue";
import { formatPrice } from "@/Components/customer/helper";
import TableLayout from "@/Layouts/TableLayout.vue";
import { computed, ref } from "vue";

defineProps({
    preorders: {
        type: Array,
    },
});

const headers = ref([
    "Preorder ID",
    "Product Names",
    "Total Quantity",
    "Total Price",
    "Preorder Date",
    "Status",
    "Details",
]);

const preorderObj = ref(null);
const orderDetailCancellation = ref(false);

const showOrderDetails = (preorder) => {
    orderDetailCancellation.value = true;
    preorderObj.value = preorder;
};
</script>

<template>
    <TableLayout
        :headers="headers"
        :is-admin="$page.props.auth.user.isAdmin"
        :is-department="$page.props.auth.user.department === 'LOGISTIC'"
    >
        <template #tbody>
            <tr
                class="border-b item"
                v-for="(preorder, index) in preorders"
                :key="preorder.id"
            >
                <td class="py-4 px-2">{{ index + 1 }}</td>
                <td class="py-4 px-2 text-center">{{ preorder.id }}</td>

                <td class="py-3 text-center" style="width: 400px">
                    <span
                        v-for="product in preorder.products"
                        :key="product.id"
                    >
                        {{
                            product.name.length > 15
                                ? product.name.slice(0, 10) + "..."
                                : product.name
                        }},
                    </span>
                </td>
                <td class="py-4 px-2 text-center">
                    {{ preorder.order_quantity }}
                </td>
                <td class="py-4 px-2 text-center">
                    {{ formatPrice(preorder.total_price) }} $
                </td>
                <td class="py-4 text-center">
                    {{ new Date(preorder.created_at).toLocaleDateString() }}
                </td>
                <td
                    class="py-4 px-2 text-center"
                    :class="{
                        'text-yellow-400': preorder.status === 'pending',
                        'text-blue-400': preorder.status === 'order',
                        'text-green-500': preorder.status === 'deliver',
                        'text-red-500': preorder.status === 'cancel',
                        'text-teal-500': preorder.status === 'processing',
                    }"
                >
                    {{ preorder.status }}
                </td>
                <td class="py-4 px-2 text-center">
                    <button
                        class="text-blue-500 hover:text-blue-600 hover:underline duration-200 font-semibold"
                        @click="showOrderDetails(preorder)"
                    >
                        See Details
                    </button>
                </td>
            </tr>
        </template>
    </TableLayout>
    <OrderDetail
        :preorder="preorderObj"
        :orderDetailCancellation="orderDetailCancellation"
        @hide-modal="orderDetailCancellation = false"
    />
</template>

<style scoped></style>
