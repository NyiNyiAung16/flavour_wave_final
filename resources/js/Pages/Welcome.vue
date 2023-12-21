<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import Banner from '@/Components/Banner.vue';
import DeliciousSection from '@/Components/DeliciousSection.vue';
import PopularProducts from '@/Components/PopularProducts.vue';
import Footer from '@/Components/Footer.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    popularProducts:{
        type:Array
    }
});
</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-[80vh] min-w-full h-full banner">
        <div class="sticky top-0 w-full navbar">
            <Navbar :canLogin="canLogin" :can-register="canRegister"/>
        </div>
        <Banner/>
    </div>
    <div class="delicious py-7">
       <DeliciousSection/>
       <PopularProducts :products="popularProducts"/>
    </div>
    <div class="footer">
        <Footer/>
    </div>
</template>

<style scoped>
.move{
    display: block;
    /* animation: moving 5s infinite; */
}
@keyframes moving {
    from{
        transform: translateX(100px);
    }
    to{
        transform: translateX(-300px);
    }
}

</style>
