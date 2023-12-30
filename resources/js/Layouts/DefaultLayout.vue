<script setup>
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import Banner from '@/Components/Banner.vue';
import { ref } from 'vue'

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    user_id:{
        type:Number
    }
});

const hover = ref(false);

</script>


<template>
    <div class="min-h-[80vh] min-w-full h-full banner">
        <div class="z-20 sticky top-0 w-full navbar">
            <Navbar :canLogin="canLogin" :can-register="canRegister" :user_id="user_id"/>
        </div>
        <Banner/>
    </div>
    <div class="delicious py-5">
        <slot/>
        <p class="text-center text-xl font-semibold py-10">
            <i class="fa-solid fa-fan me-3" :class="{animateSpin:hover}" @mouseenter="hover = true" @mouseout="hover = false"></i>
                Very Thank You For Shopping With Us
            <i class="fa-solid fa-fan ms-3" :class="{animateSpin:hover}" @mouseenter="hover = true" @mouseout="hover = false"></i>
        </p>
    </div>
    <div class="footer">
        <Footer/>
    </div>
</template>


<style scoped>

</style>