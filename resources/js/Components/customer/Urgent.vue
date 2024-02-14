<script setup>
import { ref, computed } from "vue";
import ConfrimModal from "@/Components/Modals/ConfrimModal.vue";
import CancelModal from "@/Components/Modals/CancelModal.vue";
import TableLayout from "@/Layouts/TableLayout.vue";
import UrgentOrderModal from "../Modals/UrgentOrderModal.vue";
import { formatPrice } from "./helper";
import { filteredById } from "@/composable/search";

const props = defineProps({
    urgents: {
        type: Array,
    },
    user: {
        type: Array,
    },
});

const headers = ref([
    "Preorder ID",
    "Product Names",
    "Quantity",
    "Total Price",
    "Preorder Date",
    "Details",
    "Status",
]);

if (props.user && props.user.name === "SALE") {
    headers.value.push("Action");
}
const confrimation = ref(false);
const cancelconfrimation = ref(false);
const preorderID = ref(null);
const search = ref("");

const filteredUrgentOrders = computed(() => {
    return filteredById(search.value, props.urgents);
});
const urgentObj = ref(null);
const urgentConfrimation = ref(false);

const showModal = (id) => {
    confrimation.value = true;
    preorderID.value = id;
};

const showCancelModal = (id) => {
    cancelconfrimation.value = true;
    preorderID.value = id;
};

const showUrgentOrderModal = (urgent) => {
    urgentConfrimation.value = true;
    urgentObj.value = urgent;
};
</script>

<template>
    <div v-if="urgents.length > 0">
        <div class="flex justify-between items-center">
            <Search
                @searching="(val) => (search = val)"
                :howToSearch="'Id'"
                class="w-3/4"
            />
            <Sorting
                :items="filteredUrgentOrders"
                sort-by="id"
                @sorted="(val) => (urgents = val)"
                class="w-[370px]"
            />
        </div>
        <div
            class="sm:rounded-lg"
            :class="{ 'overflow-x-scroll': filteredUrgentOrders.length > 0 }"
        >
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin"
                :is-department="
                    $page.props.auth.user.department?.name === 'SALE'
                "
                v-if="filteredUrgentOrders.length > 0"
            >
                <template #tbody>
                    <tr
                        class="border-b item"
                        v-for="(urgent, index) in filteredUrgentOrders"
                        :key="urgent.id"
                    >
                        <td class="py-4 px-2 text-center w-[80px]">
                            {{ index + 1 }}
                        </td>
                        <td class="py-4 px-2 text-center w-[110px]">
                            {{ urgent.id }}
                        </td>
                        <td class="py-3 text-center" style="width: 300px">
                            <span
                                v-for="product in urgent.products"
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
                            {{ urgent.order_quantity }}
                        </td>
                        <td class="py-4 px-2 text-center">
                            {{ formatPrice(urgent.total_price) }}$
                        </td>
                        <td class="py-4 px-2 text-center">
                            {{
                                new Date(urgent.created_at).toLocaleDateString()
                            }}
                        </td>
                        <td class="py-4 px-2 text-center">
                            <button
                                class="text-blue-500 hover:text-blue-600 hover:underline duration-200 font-semibold"
                                @click="showUrgentOrderModal(urgent)"
                            >
                                See Details
                            </button>
                        </td>
                        <td
                            class="py-4 px-2 text-center"
                            :class="{
                                'text-yellow-400': urgent.status === 'pending',
                                'text-blue-400': urgent.status === 'order',
                                'text-green-500': urgent.status === 'deliver',
                                'text-red-500': urgent.status === 'cancel',
                            }"
                        >
                            {{ urgent.status }}
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
                                @click="showModal(urgent.id)"
                            >
                                confrim
                            </button>
                            <button
                                class="text-red-500 hover:text-red-600 hover:underline duration-200 font-semibold ms-2"
                                @click="showCancelModal(urgent.id)"
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
        <p>Don't have any urgent orders!</p>
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
    <UrgentOrderModal
        :urgent="urgentObj"
        :urgentConfrimation="urgentConfrimation"
        @hide-modal="urgentConfrimation = false"
    />
</template>
