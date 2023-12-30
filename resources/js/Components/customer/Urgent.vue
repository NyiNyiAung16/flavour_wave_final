<script setup>

defineProps({
    urgents:{
        type:Array
    }
});

</script>


<template>
    <div v-if="urgents">
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th class="py-3 w-[350px]">Product Names</th>
                    <th class="py-3">Quantity</th>
                    <th class="py-3">Driver NRC</th>
                    <th class="py-3">Truck Number</th>
                    <th class="py-3">Truck Capacity</th>
                    <th class="py-3">Pickup Date</th>
                    <th class="py-3">Total Price</th>
                    <th class="py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(urgent,index) in urgents" :key="urgent.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4 flex gap-x-2 flex-wrap">
                        <span v-for="product in urgent.products" :key="product.id">{{ product.name }},</span>
                    </td>
                    <td class="py-4 text-center">{{urgent.order_quantity}}</td>
                    <td class="py-4">{{urgent.driver_nrc}}</td>
                    <td class="py-4 text-center">{{urgent.truck_number}}</td>
                    <td class="py-4 text-center">{{urgent.capacity}}</td>
                    <td class="py-4">{{urgent.date}}</td>
                    <td class="py-4">{{urgent.total_price}}$</td>
                    <td class="py-4">{{urgent.status}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        You don't have any urgent orders.
    </div>
</template>



