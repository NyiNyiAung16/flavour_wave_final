<script setup>
import { router } from '@inertiajs/vue3';
import { showEdit, confrim, errors } from '../../../composable/editWarehouse'

defineProps({
    warehouses:{
        type:Array
    }
});

const deleteWarehouse = ( id ) => {
    router.delete(route('warehouse.destroy',id));
}

const edit = (e,warehouse,index) => {
    showEdit(e,warehouse,index);
}

const confrimData = (index,warehouse) => {
    confrim(index,warehouse);
}

</script>


<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 text-center pe-2">No.</th>
                    <th class="py-3 text-center">Product ID</th>
                    <th class="py-3 text-center">Opening Balance</th>
                    <th class="py-3 text-center">Sales Issue</th>
                    <th class="py-3 text-center">Received</th>
                    <th class="py-3 text-center">Availability</th>
                    <th class="py-3 text-center">Sales Return</th>
                    <th class="py-3 text-center">Damage</th>
                    <th class="py-3 text-center">Closing Balance</th>
                    <th class="py-3 text-center">Created_at</th>
                    <th class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(warehouse,index) in warehouses" :key="warehouse.id">
                    <td class="py-4 text-center">{{index}}</td>
                    <td class="py-4 text-center">
                        <span :id="`productid${index}`" class="block text-center">{{ warehouse.product_id }}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorid${index}`" v-show="errors.product_id">{{ errors.product_id }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span :id="`opening${index}`" class="block text-center">{{warehouse.opening_balance}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorop${index}`" v-show="errors.opening_balance">{{ errors.opening_balance }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span :id="`salesIss${index}`" class="block text-center">{{warehouse.sales_issue}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorsal${index}`" v-show="errors.sales_issue">{{ errors.sales_issue }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span :id="`received${index}`" class="block text-center">{{warehouse.received}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorrec${index}`" v-show="errors.received">{{ errors.received }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span :id="`avail${index}`" class="block text-center">{{warehouse.availability}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorava${index}`" v-show="errors.availability">{{ errors.availability }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span :id="`salesRe${index}`" class="block text-center">{{warehouse.sales_return}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorsalr${index}`" v-show="errors.sales_return">{{ errors.sales_return }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span :id="`damage${index}`" class="block text-center">{{warehouse.damage}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errordam${index}`" v-show="errors.damage">{{ errors.damage }}</p>
                    </td>
                    <td class="py-4 text-center">
                        <span :id="`closing${index}`" class="block text-center">{{warehouse.closing_balance}}</span>
                        <p class="text-sm hidden text-red-500 my-1" :id="`errorclo${index}`" v-show="errors.closing_balance">{{ errors.closing_balance }}</p>
                    </td>
                    <td class="py-4 text-center">{{ new Date(warehouse.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <button class=" text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" @click="edit($event,warehouse,index)" :id="`editBtn${index}`">Edit</button>
                        <button class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" @click="confrimData(index,warehouse)" :id="`confirmBtn${index}`">Confrim</button>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline" @click="deleteWarehouse(warehouse.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

