<template>
    <!-- delicious section -->
    <h3 class="text-center text-3xl font-semibold mb-5">Our Delicious Products</h3>
    <marquee class="text-xl font-semibold">
        <div class="flex justify-around items-center">
            <div class="flex flex-col items-center">
                <img :src="`/storage/product-images/3.jpg`" class="rounded-full w-[50px] h-[50px] object-cover" alt="deliciousproductimg">
                <i>Mango Tango Delight</i>
            </div>
            <div class="flex flex-col items-center">
                <img :src="`/storage/product-images/4.jpg`" class="rounded-full w-[50px] h-[50px] object-cover" alt="deliciousproductimg">
                <i>Rangoon Rosewater Elixir</i>
            </div>
            <div class="flex flex-col items-center">
                <img :src="`/storage/product-images/8.jpg`" class="rounded-full w-[50px] h-[50px] object-cover" alt="deliciousproductimg">
                <i>Jasmine Serenade Soda</i>
            </div>
        </div>
    </marquee>
    <marquee class="text-xl font-semibold mt-5" direction="right">
        <div class="flex justify-around items-center">
            <div class="flex flex-col items-center">
                <img :src="`/storage/product-images/9.jpg`" class="rounded-full w-[50px] h-[50px] object-cover" alt="deliciousproductimg">
                <i>Papaya Paradise Punch</i>
            </div>
            <div class="flex flex-col items-center">
                <img :src="`/storage/product-images/13.jpg`" class="rounded-full w-[50px] h-[50px] object-cover" alt="deliciousproductimg">
                <i>Starfruit Sparkling Sorbet</i>
            </div>
            <div class="flex flex-col items-center">
                <img :src="`/storage/product-images/18.jpg`" class="rounded-full w-[50px] h-[50px] object-cover" alt="deliciousproductimg">
                <i>Pineapple Pizzazz Quencher</i>
            </div>
        </div>
    </marquee>
    <!-- delicious taste -->
    <h3 class="text-center text-3xl font-semibold mb-4 mt-5">Delicious Taste</h3>
    <div class="max-w-5xl mx-auto flex gap-10 mt-6">
        <img src="/photo/taste.jpg" alt="tasteimg" width="300" class="rounded taste">
        <div>
            <h3 class="text-3xl font-semibold">Boots up your day with Our <br/> Beverages!</h3>
            <p class="mt-1">Indulge in exquisite flavors and tantalizing delights at our culinary haven. Savor every bite, sip, and moment in a symphony of taste and ambiance. Welcome to a world of culinary bliss!</p>
            <Link href="/products" class="inline-block bg-green-600 hover:bg-green-700 text-white rounded-3xl text-xl px-2 py-3 hover:rounded duration-200 mt-5"><i class="fa-solid fa-martini-glass-citrus me-1"></i>View our products</Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<style scoped>
.taste{
    box-shadow: 3px 3px 6px #222;
}
</style>