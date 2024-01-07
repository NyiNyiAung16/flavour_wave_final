<script setup>
import { ref } from 'vue';
import ConfrimModal from '@/Components/Modals/ConfrimModal.vue'
import CancelModal from '@/Components/Modals/CancelModal.vue'

defineProps({
    urgents:{
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
                    <th class="py-3 w-1/6">Product Names</th>
                    <th class="py-3 text-center">Quantity</th>
                    <th class="py-3 text-center">Driver NRC</th>
                    <th class="py-3 text-center">Truck Number</th>
                    <th class="py-3 text-center">Truck Capacity</th>
                    <th class="py-3 text-center">Pickup Date</th>
                    <th class="py-3 text-center">Total Price</th>
                    <th class="py-3 text-center">Status</th>
                    <th class="py-3 text-center" v-show="user.isAdmin && user.department === 'SALE'">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(urgent,index) in urgents" :key="urgent.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4 flex gap-x-2 flex-wrap">
                        <span v-for="product in urgent.products" :key="product.id">{{ product.name }},</span>
                    </td>
                    <td class="py-4 text-center">{{urgent.order_quantity}}</td>
                    <td class="py-4 text-center">{{urgent.driver_nrc}}</td>
                    <td class="py-4 text-center">{{urgent.truck_number}}</td>
                    <td class="py-4 text-center">{{urgent.capacity}}</td>
                    <td class="py-4 text-center">{{urgent.date}}</td>
                    <td class="py-4 text-center">{{urgent.total_price}}$</td>
                    <td class="py-4 text-center">{{urgent.status}}</td>
                    <td class="py-4 text-center" v-show="user.isAdmin && user.department === 'SALE'">
                        <button class="text-blue-500 hover:text-blue-600 hover:underline duration-200 font-semibold" @click="showModal(urgent.id)">confrim</button>
                        <button class="text-red-500 hover:text-red-600 hover:underline duration-200 font-semibold ms-2" @click="showCancelModal(urgent.id)">cancel</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <ConfrimModal :preorder_id="preorderID" :confrimation="confrimation" @hide-modal="confrimation = false"/>
        <CancelModal :preorder_id="preorderID" :cancelconfrimation="cancelconfrimation" @cancel-modal="cancelconfrimation = false"/>
    </div>
</template>



