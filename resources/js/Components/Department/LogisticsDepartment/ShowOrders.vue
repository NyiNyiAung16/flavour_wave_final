<script setup>
import TableLayout from '@/Layouts/TableLayout.vue';
import { ref } from 'vue';



defineProps({
    preorders:{
        type:Array
    }
});

const headers = ref(['Product Names','Latitude','Longitude','Quantity','Preorder-Date','Deliver Price','Total Price','Status']);


</script>

<template>
    <TableLayout
        :headers="headers"
        :is-admin="$page.props.auth.user.isAdmin" 
        :is-department="$page.props.auth.user.department === 'LOGISTIC'"
    >
        <template #tbody>
                <tr class="border-b item" v-for="(preorder,index) in preorders" :key="preorder.id">
                    <td class="py-4 px-2">{{index}}</td>
                    <td class="py-4 px-2 flex gap-x-2 flex-wrap">
                        <span v-for="product in preorder.products" :key="product.id">{{ product.name }},</span>
                    </td>
                    <td class="py-4 px-2">{{preorder.latitude}}</td>
                    <td class="py-4 px-2">{{preorder.longitude}}</td>
                    <td class="py-4 px-2 text-center">{{preorder.order_quantity}}</td>
                    <td class="py-4 px-2">{{preorder.preorder_date}}</td>
                    <td class="py-4 px-2 text-center">{{preorder.deliver_price}}$</td>
                    <td class="py-4 px-2 text-center">{{preorder.total_price}}$</td>
                    <td class="py-4 px-2"
                    :class="{'text-blue-400':preorder.status === 'order','text-green-500':preorder.status === 'deliver','text-red-500':preorder.status === 'cancel'}"
                    >{{preorder.status}}</td>
                </tr>
        </template>
    </TableLayout>
</template>


<style scoped>

</style>