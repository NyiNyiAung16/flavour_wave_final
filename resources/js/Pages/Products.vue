<template>
    <Head title="Products"/>
    <div>
        <div class="min-h-[80vh] min-w-full h-full banner">
            <Navbar :canLogin="canLogin" :can-register="canRegister"/>
            <Banner/>
        </div>
        <div class="delicious py-7">
            <h3 class="text-3xl text-center font-bold underline mb-6">Our Great Products</h3>
            <div class="flex flex-wrap gap-y-5 justify-around">
                <div class="overflow-hidden relative p-2 sm:m-0 w-[310px] h-[420px] sm:max-h-[520px] border border-neutral-500 flex flex-col items-center justify-around rounded-md" v-for="product in products" :key="product.id">
                    <div class="absolute top-0 left-0 z-20 bg-white text-black w-[80px] h-[30px] m-1 rounded-2xl flex items-center justify-center">
                        <span>${{ product.unit_price }}</span>
                    </div>
                    <img :src="`/${product.image_url}`" alt="cardimg" width="300" class="h-[220px] object-cover scale-90 hover:scale-95 duration-200">
                    <div class="border-t">
                        <p class="text-lg font-bold mb-2">{{product.name}}</p>
                        <p>{{ product.description.substring(0,100) + '...' }}</p>
                    </div>
                    <div class="flex justify-between w-full">
                        <button class="text-white px-3 py-2 font-semibold bg-green-600 hover:bg-green-700 duration-150 rounded"><i class="fa-solid fa-cart-shopping"></i>Add to Cart</button>
                        <button class="text-black px-3 py-2 font-semibold bg-slate-50 hover:bg-slate-200 duration-150 rounded"><i class="fa-solid fa-circle-info"></i>View Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Banner from '@/Components/Banner.vue';
import Navbar from '@/Components/Navbar.vue';
import { Head } from '@inertiajs/vue3';


defineProps({
    'products':Array,
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

</script>

<style scoped>

</style>