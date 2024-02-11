<script setup>
import Modal from "../Modal.vue";
import { formatPrice } from "../customer/helper";

const props = defineProps({
    urgent: {
        type: Object,
    },
    urgentConfrimation: {
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
    <Modal :show="urgentConfrimation" @close="closeModal">
        <div class="p-6">
            <h2 class="font-bold text-xl text-center my-2 text-white underline">
                Urgent Pre-Order Details
            </h2>

            <div class="py-4 px-4">
                <!-- preorder id -->
                <div style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 200px">
                        Preorder_id
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ urgent.id }}
                    </p>
                </div>
                <!-- product name -->
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 200px">
                        Product Names
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <div class="text-md my-2 ml-5 text-white">
                        <div
                            v-for="product in urgent.products"
                            :key="product.id"
                        >
                            {{ product.name }},
                        </div>
                    </div>
                </div>
                <!-- quantity -->
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 200px">
                        Quantity
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ urgent.order_quantity }}
                    </p>
                </div>
                <!-- delivery price -->
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 200px">
                        Delivery Price
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ urgent.deliver_price }} $
                    </p>
                </div>
                <!-- total price -->
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 200px">
                        Total Product Price
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ formatPrice(urgent.total_price) }} $
                    </p>
                </div>
                <!-- preorder date -->
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 200px">
                        Pre-Order Date
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ new Date(urgent.created_at).toLocaleDateString() }}
                    </p>
                </div>
                <!-- driver NRC -->
                <div style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 200px">
                        Driver NRC
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ urgent.driver_nrc }}
                    </p>
                </div>
                <!-- truck number -->
                <div style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 200px">
                        Truck Number
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ urgent.truck_number }}
                    </p>
                </div>
                <!-- capacity -->
                <div style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 200px">
                        Truck Capacity
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ urgent.capacity }}
                    </p>
                </div>
                <!-- status -->
                <div style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 200px">
                        Urgent Date
                    </p>
                    <p class="text-white my-2 text-md">:</p>
                    <p class="text-md my-2 ml-5 text-white">
                        {{ urgent.date }}
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
