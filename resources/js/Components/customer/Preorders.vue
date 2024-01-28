<script setup>
import { ref } from 'vue';
import ConfrimModal from '@/Components/Modals/ConfrimModal.vue'
import CancelModal from '@/Components/Modals/CancelModal.vue'
import TableLayout from '@/Layouts/TableLayout.vue';

defineProps({
    preorders:{
        type:Array
    },
    user:{
        type:Object
    }
});

const headers = ref(['Preorder ID','Product Names','Latitude','Longitude','Quantity','Preorder-Date','Deliver Price','Total Price','Delivered Quantity','Status']);
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
    <TableLayout
        :headers="headers"
        :is-admin="$page.props.auth.user.isAdmin" 
        :is-department="$page.props.auth.user.department === 'SALE'"
    >
        <template #tbody>
            <tr class="border-b item" v-for="(preorder,index) in preorders" :key="preorder.id">
                <td class="py-4">{{index}}</td>
                <td class="py-4 text-center">{{preorder.id}}</td>
                <td class="py-4 flex flex-wrap gap-x-2">
                    <span v-for="product in preorder.products" :key="product.id">{{ product.name }},</span>
                </td>
                <td class="py-4 text-center">{{preorder.latitude}}</td>
                <td class="py-4 text-center">{{preorder.longitude}}</td>
                <td class="py-4 text-center">{{preorder.order_quantity}}</td>
                <td class="py-4 text-center">{{preorder.preorder_date}}</td>
                <td class="py-4 text-center">{{preorder.deliver_price}}$</td>
                <td class="py-4 text-center">{{preorder.total_price}}$</td>
                <td class="py-4 text-center">{{preorder.delivered_quantity}}</td>
                <td class="py-4">{{preorder.status}}</td>
                <td class="py-4 text-center" v-show="user.isAdmin && user.department === 'SALE'">
                    <button class="text-blue-500 hover:text-blue-600 hover:underline duration-200 font-semibold" @click="showModal(preorder.id)">confrim</button>
                    <button class="text-red-500 hover:text-red-600 hover:underline duration-200 font-semibold ms-2" @click="showCancelModal(preorder.id)">cancel</button>
                </td>
            </tr>
        </template>
    </TableLayout>
    <ConfrimModal :preorder_id="preorderID" :confrimation="confrimation" @hide-modal="confrimation = false"/>
    <CancelModal :preorder_id="preorderID" :cancelconfrimation="cancelconfrimation" @cancel-modal="cancelconfrimation = false"/>
</template>


<style scoped>

</style>