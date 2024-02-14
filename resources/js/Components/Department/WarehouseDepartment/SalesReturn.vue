<script setup>
import BaseInput from "@/Components/BaseInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { defineProps } from "vue";

const props = defineProps({
    warehouses: {
        type: Array,
    },
    preorders: {
        type: Array,
    },
});

const form = useForm({
    preorder_id: 0,
    return_item: {},
});

let errors = ref({});
let orderqty = ref({});
let preorderObj = ref({});

const addReturn = (quantity, productID) => {
    form.return_item[productID] = quantity[productID];
};

watch(
    () => form.preorder_id,
    (newPreorderId, oldPreorderId) => {
        if (newPreorderId && newPreorderId !== oldPreorderId) {
            const selectedPreorder = props.preorders.find(
                (p) => p.id == newPreorderId
            );
            form.return_item = {};
            preorderObj.value = selectedPreorder;
            if (selectedPreorder) {
                errors.value.preorder_id = "";
            } else {
                errors.value.preorder_id = "Invalid Preorder ID.";
            }
        }
    }
);

const SaleReturnFun = () => {
    setTimeout(() => {
        errors.value = {};
    }, 2000);

    form.post(route("warehouse.saleReturn"), {
        // need to update
        onSuccess: () => {
            errors.value = {};
            form.reset();
        },
        onError: () => {
            setTimeout(() => {
                form.clearErrors();
            }, 2000);
            form.return_item = {};
        },
        preserveScroll: true,
    });
};

// warehouse.saleReturn
</script>

<template>
    <div class="py-3">
        <form
            @submit.prevent="SaleReturnFun"
            class="space-y-4 max-w-4xl mx-auto"
        >
            <h3 class="text-2xl font-bold text-center">Sale Return</h3>
            <div>
                <BaseInput
                    type="number"
                    label="Preorder ID"
                    v-model="form.preorder_id"
                    :error="errors.preorder_id"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>

            <div v-if="form.preorder_id > 0 && !errors.preorder_id">
                <div
                    v-for="product in preorderObj.products"
                    :key="product.id"
                    class="flex items-center py-1"
                >
                    <p style="width: 400px">{{ product.name }}</p>
                    <BaseInput
                        key="product.id"
                        type="number"
                        :error="errors.productId"
                        v-model="orderqty[product.id]"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                        @change="addReturn(orderqty, product.id)"
                    />
                </div>
            </div>

            <div>
                <PrimaryButton>Create</PrimaryButton>
            </div>
        </form>
    </div>
</template>
