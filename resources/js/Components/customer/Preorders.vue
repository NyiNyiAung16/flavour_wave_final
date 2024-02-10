<script setup>
import { ref, computed } from 'vue';
import ConfrimModal from '@/Components/Modals/ConfrimModal.vue'
import CancelModal from '@/Components/Modals/CancelModal.vue'
import TableLayout from '@/Layouts/TableLayout.vue';
import { filteredById } from '@/composable/search'

const props = defineProps({
    preorders:{
        type:Array
    }
});

const headers = ref(['Id','Product Names','Location','Latitude','Longitude','Quantity','Preorder-Date','Deliver Price','Total Price','Delivered Quantity','Preorder Date','Status']);
const confrimation = ref(false);
const cancelconfrimation = ref(false);
const preorderID = ref(null);
const search = ref('');

const filteredOrders = computed(()=>{
    return filteredById(search.value,props.preorders);
});

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
    <div class="flex justify-between items-center">
        <Search 
            @searching="(val) => search = val" 
            :howToSearch="'Id'" 
            class="w-3/4"
        />
        <Sorting 
            :items="filteredOrders" 
            sort-by="id" 
            @sorted="(val) => preorders = val"
            class="w-[370px]"
        />
    </div>
    <div class="sm:rounded-lg" :class="{'overflow-x-scroll':filteredOrders.length > 0}">
        <TableLayout
            :headers="headers"
            :is-admin="$page.props.auth.user.isAdmin" 
            :is-department="$page.props.auth.user.department?.name === 'SALE'"
            v-if="filteredOrders.length > 0"
        >
            <template #tbody>
                <tr class="border-b item" v-for="(preorder,index) in filteredOrders" :key="preorder.id">
                    <td class="py-4 px-2 text-center">{{index}}</td>
                    <td class="py-4 px-2 text-center">{{preorder.id}}</td>
                    <td class="py-4 px-2 flex flex-wrap gap-x-2">
                        <span v-for="product in preorder.products" :key="product.id">{{ product.name }},</span>
                    </td>
                    <td class="py-4 px-2 text-center">{{preorder.full_location}}</td>
                    <td class="py-4 px-2 text-center">{{preorder.latitude}}</td>
                    <td class="py-4 px-2 text-center">{{preorder.longitude}}</td>
                    <td class="py-4 px-2 text-center">{{preorder.order_quantity}}</td>
                    <td class="py-4 px-2 text-center">{{preorder.preorder_date}}</td>
                    <td class="py-4 px-2 text-center">{{preorder.deliver_price}}$</td>
                    <td class="py-4 px-2 text-center">{{preorder.total_price}}$</td>
                    <td class="py-4 px-2 text-center">{{preorder.delivered_quantity}}</td>
                    <td class="py-4 text-center">{{new Date(preorder.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 px-2" 
                    :class="{'text-yellow-400':preorder.status === 'pending','text-blue-400':preorder.status === 'order','text-green-500':preorder.status === 'deliver','text-red-500':preorder.status === 'cancel'}"
                    >{{preorder.status}}</td>
                    <td class="py-4 px-2 text-center" v-show="$page.props.auth.user.isAdmin && $page.props.auth.user.department?.name === 'SALE'">
                        <button class="text-blue-500 hover:text-blue-600 hover:underline duration-200 font-semibold" @click="showModal(preorder.id)">confrim</button>
                        <button class="text-red-500 hover:text-red-600 hover:underline duration-200 font-semibold ms-2" @click="showCancelModal(preorder.id)">cancel</button>
                    </td>
                </tr>
            </template>
        </TableLayout>
        <template v-else>
            <p>Nothing to Search orders!!</p>
        </template>
    </div>
    <ConfrimModal :preorder_id="preorderID" :confrimation="confrimation" @hide-modal="confrimation = false"/>
    <CancelModal :preorder_id="preorderID" :cancelconfrimation="cancelconfrimation" @cancel-modal="cancelconfrimation = false"/>
</template>

