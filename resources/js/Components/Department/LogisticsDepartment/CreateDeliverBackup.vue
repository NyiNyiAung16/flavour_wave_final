<script setup>
import BaseInput from "@/Components/BaseInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    preorders: {
        type: Array,
        default: [],
    },
    drivers: {
        type: Array,
        default: [],
    },
});

const form = useForm({
    preorder_id: 0,
    driver_id: 0,
    quantity: 0,
    item_quantity: {},
});

let orderqty = ref({});
let errors = ref({});
const modalData = ref(null);
watch(
    () => form.preorder_id,
    async (newPreorderId, oldPreorderId) => {
        if (newPreorderId && newPreorderId !== oldPreorderId) {
            try {
                const response = await fetchPreorderData(newPreorderId);
                modalData.value = response.products;
                errors.value.preorder_id = "";
            } catch (error) {
                console.error("Error fetching preorder data:", error);
                errors.value.preorder_id = "Your order is Invalid!";
            }
        }
    }
);

watch(
    () => form.driver_id,
    (newDriverId, oldDriverId) => {
        if (newDriverId && newDriverId !== oldDriverId) {
            const driver = props.drivers.find((d) => d.id == newDriverId);
            if (driver) {
                if (driver.isFree === false || driver.isFree === 0) {
                    errors.value.driver_id = "This driver is busy.";
                } else {
                    errors.value.driver_id = "";
                }
            } else {
                errors.value.driver_id = "Invalid driver ID.";
            }
        }
    }
);

const fetchPreorderData = async (preorderId) => {
    try {
        const response = await fetch(`/logisticsDepartment/${preorderId}`);
        if (!response.ok) {
            throw new Error(
                `Failed to fetch preorder data: ${response.statusText}`
            );
        }
        const responseData = await response.json(); // Parse JSON data
        return responseData;
    } catch (error) {
        throw new Error(`Invalid preorder Id: ${error.message}`);
    }
};

const createDeliver = () => {
    for (const key in form.item_quantity) {
        if (form.item_quantity.hasOwnProperty(key)) {
            const value = form.item_quantity[key];
            form.quantity = Number(form.quantity) + Number(value);
        }
    }

    setTimeout(() => {
        errors.value = {};
    }, 2000);

    if (errors.value.preorder_id) return;
    if (errors.value.quantity) return;

    form.post(route("deliver.store"), {
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            setTimeout(() => {
                form.clearErrors();
            }, 2000);
            form.quantity = 0;
        },
        preserveScroll: true,
    });
};
const addItemQty = (quantity, productID, maxQty) => {
    if (quantity[productID] > maxQty) {
        errors.value.productId = "Insufficient quantity";
        return;
    }
    errors.value.productId = "";
    form.item_quantity[productID] = quantity[productID];
};
</script>

<template>
    <div class="py-3">
        <form
            @submit.prevent="createDeliver"
            class="space-y-4 max-w-4xl mx-auto"
        >
            <h3 class="text-2xl font-bold text-center">Create Deliver</h3>
            <div>
                <BaseInput
                    type="number"
                    label="Preorder ID"
                    v-model="form.preorder_id"
                    :error="errors.preorder_id"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <BaseInput
                    type="number"
                    label="Driver ID"
                    v-model="form.driver_id"
                    :error="errors.driver_id"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>

            <div
                v-if="
                    form.driver_id > 0 &&
                    form.preorder_id > 0 &&
                    !errors.driver_id &&
                    !errors.preorder_id
                "
            >
                <div
                    v-for="product in modalData"
                    :key="product.id"
                    class="flex items-center py-1"
                >
                    <p style="width: 400px">{{ product.name }}</p>
                    <BaseInput
                        type="number"
                        v-model="orderqty[product.id]"
                        :error="errors.productId"
                        @change="
                            addItemQty(
                                orderqty,
                                product.id,
                                product.pivot.quantity
                            )
                        "
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
            </div>

            <div>
                <PrimaryButton>Create</PrimaryButton>
            </div>
        </form>
    </div>
</template>
