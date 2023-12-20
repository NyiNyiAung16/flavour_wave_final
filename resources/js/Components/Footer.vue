<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 w-full px-8 sm:px-16 md:px-20 gap-8 py-3">
        <div>
            <div class="flex items-center mb-1">
                <img src="/logo/logo1.png" alt="footerimg" width="60">
                <h3 class="text-3xl font-bold">Flavorwave</h3>
            </div>
            <p>Savor Exquisite Flavors! Indulge in Culinary Delights and Refreshing Beverages.</p>
            <div class="flex gap-2 mt-1">
                <a href="#">
                    <i class="fa-brands fa-facebook-f text-2xl fill-blue-700 icon facebook"></i>
                </a>
                <a href="#">
                    <i class="fa-brands fa-twitter text-2xl fill-blue-500 icon twitter"></i>
                </a>
                <a href="#">
                    <i class="fa-brands fa-instagram text-2xl fill-pink-500 instagram"></i>
                </a>
            </div>
        </div>
        <div>
            <h3 class="text-3xl font-bold">Pages</h3>
            <div class="flex flex-col gap-1">
                <Link href="/home" class="hover:text-green-400 duration-200">Home</Link>
                <Link href="/products" class="hover:text-green-400 duration-200">Products</Link>
                <Link href="/myorders" class="hover:text-green-400 duration-200">Myorders</Link>
            </div>
        </div>
        <div>
            <h3 class="text-3xl font-bold">Company</h3>
            <div class="flex flex-col gap-1">
                <Link href="/home" class="hover:text-green-400 duration-200">Terms and Conditions</Link>
                <Link href="/products" class="hover:text-green-400 duration-200">Privacy and Policy</Link>
            </div>
        </div>
        <div>
            <h3 class="text-3xl font-bold">Get in Touch</h3>
            <div class="flex flex-col gap-1">
                <p>Phone: +97976912537</p>
                <p>Email: flavorwave@contact.info.com</p>
                <p>Address: Yangon</p>
            </div>
        </div>
    </div>
    <div class="text-center py-5 text-xl">
        <p>Copyright &copy; <span ref="year">2000</span> Foodhut.</p>
        <p>Created and published with 💙 by Axionix</p>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref,onMounted } from 'vue';

const year = ref(null);
onMounted(()=>{
    const date = new Date().getFullYear();
    year.value.textContent = date;
})

</script>

<style scoped>
.icon{
    -webkit-text-stroke-color: #fff;
    -webkit-text-stroke-width: 2px;
    color: transparent;
    -webkit-background-clip: text;
}
.facebook{
    background-color: rgb(30, 87, 211);
}
.twitter{
    background-color: rgb(54, 105, 215);
}
.instagram{
    background-color: #f43f5e;
    color: transparent;
    -webkit-background-clip: text;
}
</style>