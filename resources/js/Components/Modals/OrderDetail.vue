<script setup>
import Modal from "../Modal.vue";
import { formatPrice } from "../customer/helper";

const props = defineProps({
    preorder: {
        type: Object,
    },
    orderDetailCancellation: {
        type: Boolean,
    },
});

const emits = defineEmits(["hideModal"]);

const closeModal = () => {
    emits("hideModal");
};

const cancel = () => {
    closeModal();
};
</script>

<template>
    <Modal :show="orderDetailCancellation" @close="closeModal">
        <div class="p-6">
            <h2 class="font-bold text-xl text-center my-2 text-white underline">
                Pre-Order Details
            </h2>
            <div class="py-4 px-4">
                <!-- preorder id -->
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 220px">
                        Preorder_id
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ preorder.id }}
                    </p>
                </div>
                <!-- product name -->
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 220px">
                        Product Names & Quantity
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <div class="text-md my-2 ml-5 text-white">
                        <div
                            v-for="product in preorder.products"
                            :key="product.id"
                        >
                            <div v-if="product.pivot.quantity > 0">
                                {{ product.name }} : {{ product.pivot.quantity }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- location -->
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 220px">
                        Location
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        <p>{{ preorder.full_location }}</p>
                        (Latitide : {{ preorder.latitude }} , Longitude :
                        {{ preorder.longitude }})
                    </p>
                </div>
                <!-- quantity -->
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 220px">
                        Total Quantity
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ preorder.order_quantity }}
                    </p>
                </div>
                <!-- delivery price -->
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 220px">
                        Delivery Price
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ preorder.deliver_price }} $
                    </p>
                </div>
                <!-- total price -->
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 220px">
                        Total Product Price
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ formatPrice(preorder.total_price) }} $
                    </p>
                </div>
                <!-- delivered qty -->
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 220px">
                        Delivered Quantity
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ preorder.delivered_quantity }}
                    </p>
                </div>
                <!-- preorder date -->
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 220px">
                        Pre-Order Date
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ new Date(preorder.created_at).toLocaleDateString() }}
                    </p>
                </div>
                <!-- status -->
                <div style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 220px">
                        Status
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ preorder.status }}
                    </p>
                </div>
            </div>

            <div
                style="
                    display: flex;
                    width: 100%;
                    justify-content: end;
                    padding-right: 40px;
                "
            >
                <button
                    class="px-4 py-2 rounded text-gray-200 bg-red-500 hover:bg-red-600 duration-200 font-semibold ms-2"
                    @click="cancel"
                >
                    Close
                </button>
            </div>
        </div>
    </Modal>
</template>
