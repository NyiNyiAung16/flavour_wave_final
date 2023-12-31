<script setup>
import { Link, router } from '@inertiajs/vue3';

defineProps({
    warehouses:{
        type:Array
    }
});

const deleteWarehouse = ( id ) => {
    router.delete(route('warehouse.destroy',id));
}

</script>


<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th class="py-3">Product Names</th>
                    <th class="py-3">Opening Balance</th>
                    <th class="py-3">Sales Issue</th>
                    <th class="py-3">Received</th>
                    <th class="py-3">Availability</th>
                    <th class="py-3">Sales Return</th>
                    <th class="py-3">Damage</th>
                    <th class="py-3">Closing Balance</th>
                    <th class="py-3">Created_at</th>
                    <th class="py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(warehouse,index) in warehouses" :key="warehouse.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4  flex gap-x-2">
                        {{ warehouse.product_name }}
                    </td>
                    <td class="py-4">{{warehouse.opening_balance}}</td>
                    <td class="py-4">{{warehouse.sales_issue}}</td>
                    <td class="py-4 text-center">{{warehouse.received}}</td>
                    <td class="py-4">{{warehouse.availability}}</td>
                    <td class="py-4 text-center">{{warehouse.sales_return}}</td>
                    <td class="py-4 text-center">{{warehouse.damage}}</td>
                    <td class="py-4">{{warehouse.closing_balance}}</td>
                    <td class="py-4">{{ new Date(warehouse.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <Link :href="`warehouseDepartment/${warehouse.id}/edit`" class="text-blue-500 hover:text-blue-600 duration-150 font-bold underline">Edit</Link>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold underline" @click="deleteWarehouse(warehouse.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

