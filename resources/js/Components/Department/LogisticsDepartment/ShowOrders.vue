<script setup>


defineProps({
    preorders:{
        type:Array
    }
});


</script>

<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th class="py-3">Product Names</th>
                    <th class="py-3">Latitude</th>
                    <th class="py-3">Longitude</th>
                    <th class="py-3">Quantity</th>
                    <th class="py-3">Preorder-Date</th>
                    <th class="py-3">Deliver Price</th>
                    <th class="py-3">Total Price</th>
                    <th class="py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(preorder,index) in preorders" :key="preorder.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4  flex gap-x-2">
                        <span v-for="product in preorder.products" :key="product.id">{{ product.name }},</span>
                    </td>
                    <td class="py-4">{{preorder.latitude}}</td>
                    <td class="py-4">{{preorder.longitude}}</td>
                    <td class="py-4 text-center">{{preorder.order_quantity}}</td>
                    <td class="py-4">{{preorder.preorder_date}}</td>
                    <td class="py-4 text-center">{{preorder.deliver_price}}$</td>
                    <td class="py-4 text-center">{{preorder.total_price}}$</td>
                    <td class="py-4">{{preorder.status}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<style scoped>

</style>