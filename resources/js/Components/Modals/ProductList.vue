<!-- <script setup>
import BaseInput from "../BaseInput.vue";
import Modal from "../Modal.vue";

const props = defineProps({
    modalObj: {
        type: Array,
    },
    ProductListCancellation: {
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

// filter
</script>

<template>
    <Modal :show="ProductListCancellation" @close="closeModal">
        <div class="p-6">
            <h2 class="font-bold text-xl text-center my-2 text-white underline">
                Product List
            </h2>

            <p>{{ modalObj[0].name }}</p>
            <p>{{ modalObj[0].pivot.quantity }}</p>
            <div
                class="py-4 px-4"
                v-for="product in modalObj"
                :key="product.id"
            >
                <div class="" style="display: flex">
                    <p class="text-md my-2 text-white" style="width: 220px">
                        {{ product.name }}
                    </p>
                    <p class="text-white my-2 text-md">:</p>

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
</template> -->
