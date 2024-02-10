<script setup>
import TableLayout from '@/Layouts/TableLayout.vue';
import { filteredById } from '@/composable/search';
import { ref, computed } from 'vue';

const props = defineProps({
    preorders:{
        type:Array
    }
});

const headers = ref(['Id','Product Names','Latitude','Longitude','Quantity','Preorder-Date','Deliver Price','Total Price','Status']);
const search = ref('');

const filteredConfirmOrders = computed(()=>{
    return filteredById(search.value,props.preorders)
});


</script>

<template>
    <div v-if="preorders.length > 0">
        <div class="flex justify-between items-center">
            <Search 
                @searching="(val) => search = val" 
                :howToSearch="'Id'" 
                class="w-3/4"
            />
            <Sorting 
                :items="filteredConfirmOrders" 
                sort-by="id" 
                @sorted="(val) => preorders = val"
                class="w-[370px]"
            />
        </div>
        <div class="sm:rounded-lg" :class="{'overflow-x-scroll': filteredConfirmOrders.length > 0}">
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin" 
                :is-department="$page.props.auth.user.department === 'LOGISTIC'"
                v-if="filteredConfirmOrders.length > 0"
            >
                <template #tbody>
                        <tr class="border-b item" v-for="(preorder,index) in filteredConfirmOrders" :key="preorder.id">
                            <td class="py-4 px-2 text-center">{{index}}</td>
                            <td class="py-4 px-2 text-center">{{preorder.id}}</td>
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
            <template v-else>
                <NoResults/>
            </template>
        </div>
    </div>
    <div v-else>
        <p>Don't have any confrimed orders!</p>
    </div>
</template>


<style scoped>

</style>