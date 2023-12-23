<template>
    <div class="grid grid-cols-12 mt-8">
        <div class="col-span-2"></div>
        <div class="col-span-5">
            <h2 class="text-3xl font-medium">Savor Exquisite Flavors! Indulge in Culinary Delights and Refreshing Beverages that</h2>
            <Link href="/products" class="inline-block bg-green-600 hover:bg-green-700 text-white rounded-3xl text-xl px-2 py-3 hover:rounded duration-200 mt-5"><i class="fa-solid fa-martini-glass-citrus me-1"></i>View our products</Link>
            <div class="mt-3">
                <p>Reviews</p>
                <div class="flex gap-1 mt-1">
                    <img src="/profile/default.png" alt="img" width="40">
                    <img src="/profile/default.png" alt="img" width="40">
                    <img src="/profile/default.png" alt="img" width="40">
                </div>
                <div class="mt-1">
                    <i class="fa-solid fa-star text-yellow-400"></i>
                    <i class="fa-solid fa-star text-yellow-400"></i>
                    <i class="fa-solid fa-star text-yellow-400"></i>
                    <i class="fa-solid fa-star text-yellow-400"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>
        </div>
        <div class="col-span-3">
            <img src="/photo/banner.jpg" alt="bannerimg" class="rounded">
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';


</script>

<style scoped>

</style>