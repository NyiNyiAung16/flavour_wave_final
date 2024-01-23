<script setup>
import Body from '@/Components/Table/Body.vue'
import Button from '@/Components/Button.vue'
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
                    <Body
                        :text-id="`productid${index}`"
                        :error-id="`errorid${index}`"
                        :value="warehouse.product_id"
                        :error="errors.product_id"
                    />
                    <Body
                        :text-id="`opening${index}`"
                        :error-id="`errorop${index}`"
                        :value="warehouse.opening_balance"
                        :error="errors.opening_balance"
                    />
                    <Body
                        :text-id="`salesIss${index}`"
                        :error-id="`errorsal${index}`"
                        :value="warehouse.sales_issue"
                        :error="errors.sales_issue"
                    />
                    <Body
                        :text-id="`received${index}`"
                        :error-id="`errorrec${index}`"
                        :value="warehouse.received"
                        :error="errors.received"
                    />
                    <Body
                        :text-id="`avail${index}`"
                        :error-id="`errorava${index}`"
                        :value="warehouse.availability"
                        :error="errors.availability"
                    />
                    <Body
                        :text-id="`salesRe${index}`"
                        :error-id="`errorsalr${index}`"
                        :value="warehouse.sales_return"
                        :error="errors.sales_return"
                    />
                    <Body
                        :text-id="`damage${index}`"
                        :error-id="`errordam${index}`"
                        :value="warehouse.damage"
                        :error="errors.damage"
                    />
                    <Body
                        :text-id="`closing${index}`"
                        :error-id="`errorclo${index}`"
                        :value="warehouse.closing_balance"
                        :error="errors.closing_balance"
                    />
                    <td class="py-4 text-center">{{ new Date(warehouse.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <Button
                            type="button"
                            text="Edit"
                            :id="`editBtn${index}`"
                            class=" text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                            @click="edit($event,warehouse,index)"
                        />
                        <Button
                            type="button"
                            text="Confrim"
                            :id="`confirmBtn${index}`"
                            class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                            @click="confrimData(index,warehouse)"
                        />
                        <Button
                            type="button"
                            text="Delete"
                            class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline"
                            @click="deleteWarehouse(warehouse.id)"
                        />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

