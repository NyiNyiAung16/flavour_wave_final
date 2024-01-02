<script setup>
import { ref } from 'vue';
import ConfrimModal from '@/Components/Modals/ConfrimModal.vue'
import CancelModal from '@/Components/Modals/CancelModal.vue'

defineProps({
    preorders:{
        type:Array
    },
    user:{
        type:Object
    }
});

const confrimation = ref(false);
const cancelconfrimation = ref(false);
const preorderID = ref(null);

const showModal = (id) => {
    confrimation.value = true;
    preorderID.value = id;
}

const showCancelModal = (id) => {
    cancelconfrimation.value = true;
    preorderID.value = id;
}

</script>

<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th class="py-3">Product Names</th>
                    <th class="py-3">Latitude</th>
                    <th class="py-3">Longitude</th>
                    <th class="py-3">Quantity</th>
                    <th class="py-3">Preorder-Date</th>
                    <th class="py-3">Deliver Price</th>
                    <th class="py-3">Total Price</th>
                    <th class="py-3">Status</th>
                    <th class="py-3 text-center" v-show="user.isAdmin && user.department === 'SALE'">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(preorder,index) in preorders" :key="preorder.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4  flex gap-x-2">
                        <span v-for="product in preorder.products" :key="product.id">{{ product.name }},</span>
                    </td>
                    <td class="py-4">{{preorder.latitude}}</td>
                    <td class="py-4">{{preorder.longitude}}</td>
                    <td class="py-4 text-center">{{preorder.order_quantity}}</td>
                    <td class="py-4">{{preorder.preorder_date}}</td>
                    <td class="py-4 text-center">{{preorder.deliver_price}}$</td>
                    <td class="py-4 text-center">{{preorder.total_price}}$</td>
                    <td class="py-4">{{preorder.status}}</td>
                    <td class="py-4 text-center" v-show="user.isAdmin && user.department === 'SALE'">
                        <button class="text-blue-500 hover:text-blue-600 hover:underline duration-200 font-semibold" @click="showModal(preorder.id)">confrim</button>
                        <button class="text-red-500 hover:text-red-600 hover:underline duration-200 font-semibold ms-2" @click="showCancelModal(preorder.id)">cancel</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <ConfrimModal :preorder_id="preorderID" :confrimation="confrimation" @hide-modal="confrimation = false"/>
        <CancelModal :preorder_id="preorderID" :cancelconfrimation="cancelconfrimation" @cancel-modal="cancelconfrimation = false"/>
    </div>
</template>


<style scoped>

</style>