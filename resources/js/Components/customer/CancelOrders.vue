<script setup>
import TableLayout from '@/Layouts/TableLayout.vue';
import { ref, computed } from 'vue';
import { filteredById } from '@/composable/search';

const props = defineProps({
    cancelOrders:{
        type:Array,
        default:[]
    }
});

const headers = ref(['Preorder ID','Cancel_Reason','Preorder Date','Status']);
const search = ref('');

const filteredCancelOrders = computed(()=>{
    return filteredById(search.value,props.cancelOrders)
});

</script>


<template>
    <div v-if="cancelOrders.length > 0">
        <div class="flex justify-between items-center">
            <Search 
                @searching="(val) => search = val" 
                :howToSearch="'preorder Id'" 
                class="w-3/4"
            />
            <Sorting 
                :items="filteredCancelOrders" 
                sort-by="id" 
                @sorted="(val) => cancelOrders = val"
                class="w-[370px]"
            />
        </div>
        <div class="sm:rounded-lg" :class="{'overflow-x-scroll': filteredCancelOrders.length > 0}">
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin" 
                :is-department="$page.props.auth.user.department?.name === 'SALE'"
                v-if="filteredCancelOrders.length > 0"
            >
                <template #tbody>
                    <tr class="border-b item" v-for="(order,index) in filteredCancelOrders" :key="order.id">
                        <td class="py-4 text-center">{{ index }}</td>
                        <td class="py-4 text-center">{{order.id}}</td>
                        <td class="py-4 ">{{order.cancel_reason}}</td>
                        <td class="py-4 text-center">{{new Date(order.created_at).toLocaleDateString()}}</td>
                        <td class="py-4 text-center text-red-500">{{order.status}}</td>
                    </tr>
                </template>
            </TableLayout>
            <template v-else>
                <NoResults/>
            </template>
        </div>
    </div>
    <div v-else>
        <p>Don't have any cancel orders!</p>
    </div>
</template>

