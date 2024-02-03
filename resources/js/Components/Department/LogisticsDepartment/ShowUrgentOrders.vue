<script setup>
import TableLayout from '@/Layouts/TableLayout.vue';
import { ref } from 'vue';

defineProps({
    urgents:{
        type:Array
    }
});

const headers = ref(['Product Names','Quantity','Driver NRC','Truck Number','Truck Capacity','Pickup Date','Total Price','Status']);


</script>


<template>
    <TableLayout
        :headers="headers"
        :is-admin="$page.props.auth.user.isAdmin" 
        :is-department="$page.props.auth.user.department === 'LOGISTIC'"
    >
        <template #tbody>
                <tr class="border-b item" v-for="(urgent,index) in urgents" :key="urgent.id">
                    <td class="py-4 px-2">{{index}}</td>
                    <td class="py-4 px-2 flex gap-x-2 flex-wrap">
                        <span v-for="product in urgent.products" :key="product.id">{{ product.name }},</span>
                    </td>
                    <td class="py-4 px-2 text-center">{{urgent.order_quantity}}</td>
                    <td class="py-4 px-2">{{urgent.driver_nrc}}</td>
                    <td class="py-4 px-2 text-center">{{urgent.truck_number}}</td>
                    <td class="py-4 px-2 text-center">{{urgent.capacity}}</td>
                    <td class="py-4 px-2">{{urgent.date}}</td>
                    <td class="py-4 px-2">{{urgent.total_price}}$</td>
                    <td class="py-4 px-2"
                    :class="{'text-blue-400':urgent.status === 'order','text-green-500':urgent.status === 'deliver','text-red-500':urgent.status === 'cancel'}"
                    >{{urgent.status}}</td>
                </tr>
        </template>
    </TableLayout>
</template>



