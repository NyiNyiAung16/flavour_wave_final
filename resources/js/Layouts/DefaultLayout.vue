<script setup>
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import Banner from '@/Components/Banner.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});

</script>


<template>
    <div class="min-h-[80vh] min-w-full h-full banner">
        <div class="sticky top-0 w-full navbar">
            <Navbar :canLogin="canLogin" :can-register="canRegister"/>
        </div>
        <Banner/>
    </div>
    <div class="delicious py-5">
        <slot/>
    </div>
    <div class="footer">
        <Footer/>
    </div>
</template>


<style  scoped>

</style>