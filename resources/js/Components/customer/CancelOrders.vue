<script setup>
import TableLayout from '@/Layouts/TableLayout.vue';
import { ref } from 'vue';

defineProps({
    cancelOrders:{
        type:Array,
        default:[]
    }
});

const headers = ref(['Product ID','Cancel_Reason','Preorder Date','Status']);

</script>


<template>
    <div>
        <TableLayout
            :headers="headers"
            :is-admin="$page.props.auth.user.isAdmin" 
            :is-department="$page.props.auth.user.department?.name === 'SALE'"
        >
            <template #tbody>
                <tr class="border-b item" v-for="(order,index) in cancelOrders" :key="order.id">
                    <td class="py-4 text-center">{{ index }}</td>
                    <td class="py-4 text-center">{{order.id}}</td>
                    <td class="py-4 text-center">{{order.cancel_reason}}</td>
                    <td class="py-4 text-center">{{new Date(order.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 text-center text-red-500">{{order.status}}</td>
                </tr>
            </template>
        </TableLayout>
    </div>
</template>

