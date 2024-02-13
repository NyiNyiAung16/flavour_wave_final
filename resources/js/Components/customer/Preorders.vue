<script setup>
import { ref, computed } from "vue";
import ConfrimModal from "@/Components/Modals/ConfrimModal.vue";
import CancelModal from "@/Components/Modals/CancelModal.vue";
import TableLayout from "@/Layouts/TableLayout.vue";
import OrderDetail from "../Modals/OrderDetail.vue";
import { filteredById } from "@/composable/search";
import { formatPrice } from "./helper";

const props = defineProps({
    preorders: {
        type: Array,
    },
});

const headers = ref([
    "Preorder ID",
    "Product Names",
    "Location",
    "Total Quantity",
    "Total Price",
    "Preorder Date",
    "Details",
]);

const confrimation = ref(false);
const cancelconfrimation = ref(false);
const preorderID = ref(null);
const search = ref("");

const filteredOrders = computed(() => {
    return filteredById(search.value, props.preorders);
});
const preorderObj = ref(null);
const orderDetailCancellation = ref(false);

const showModal = (id) => {
    confrimation.value = true;
    preorderID.value = id;
};

const showOrderDetails = (preorder) => {
    orderDetailCancellation.value = true;
    preorderObj.value = preorder;
};

const showCancelModal = (id) => {
    cancelconfrimation.value = true;
    preorderID.value = id;
};
</script>

<template>
    <div v-if="preorders.length > 0">
        <div class="flex justify-between items-center">
            <Search
                @searching="(val) => (search = val)"
                :howToSearch="'Id'"
                class="w-3/4"
            />
            <Sorting
                :items="filteredOrders"
                sort-by="id"
                @sorted="(val) => (preorders = val)"
                class="w-[370px]"
            />
        </div>
        <div
            class="sm:rounded-lg"
            :class="{ 'overflow-x-scroll': filteredOrders.length > 0 }"
        >
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin"
                :is-department="
                    $page.props.auth.user.department?.name === 'SALE'
                "
                v-if="filteredOrders.length > 0"
            >
                <template #tbody>
                    <tr
                        class="border-b item"
                        v-for="(preorder, index) in preorders"
                        :key="preorder.id"
                    >
                        <td class="py-4 px-2">{{ index + 1 }}</td>
                        <td class="py-4 px-2 text-center">{{ preorder.id }}</td>
                        <td class="py-3 text-center" style="width: 300px">
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
                        <td class="py-4 px-2 text-center" style="width: 200px">
                            {{ preorder.full_location }}
                        </td>
                        <td class="py-4 px-2 text-center">
                            {{ preorder.order_quantity }}
                        </td>
                        <td class="py-4 px-2 text-center">
                            {{ formatPrice(preorder.total_price) }} $
                        </td>
                        <td class="py-4 text-center">
                            {{
                                new Date(
                                    preorder.created_at
                                ).toLocaleDateString()
                            }}
                        </td>
                        <td class="py-4 px-2 text-center">
                            <button
                                class="text-blue-500 hover:text-blue-600 hover:underline duration-200 font-semibold"
                                @click="showOrderDetails(preorder)"
                            >
                                See Details
                            </button>
                        </td>
                        <td
                            class="py-4 px-2 text-center"
                            :class="{
                                'text-yellow-400':
                                    preorder.status === 'pending',
                                'text-blue-400': preorder.status === 'order',
                                'text-green-500': preorder.status === 'deliver',
                                'text-red-500': preorder.status === 'cancel',
                                'text-teal-500':
                                    preorder.status === 'processing',
                            }"
                            v-show="
                                !$page.props.auth.user.isAdmin &&
                                $page.props.auth.user.department?.name !==
                                    'SALE'
                            "
                        >
                            {{ preorder.status }}
                        </td>

                        <td
                            class="py-4 px-2 text-center"
                            v-show="
                                $page.props.auth.user.isAdmin &&
                                $page.props.auth.user.department?.name ===
                                    'SALE'
                            "
                        >
                            <button
                                class="text-blue-500 hover:text-blue-600 hover:underline duration-200 font-semibold"
                                @click="showModal(preorder.id)"
                            >
                                confrim
                            </button>
                            <button
                                class="text-red-500 hover:text-red-600 hover:underline duration-200 font-semibold ms-2"
                                @click="showCancelModal(preorder.id)"
                            >
                                cancel
                            </button>
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
        <p>Don't have any orders!</p>
    </div>
    <ConfrimModal
        :preorder_id="preorderID"
        :confrimation="confrimation"
        @hide-modal="confrimation = false"
    />
    <CancelModal
        :preorder_id="preorderID"
        :cancelconfrimation="cancelconfrimation"
        @cancel-modal="cancelconfrimation = false"
    />
    <OrderDetail
        :preorder="preorderObj"
        :orderDetailCancellation="orderDetailCancellation"
        @hide-modal="orderDetailCancellation = false"
    />
</template>
