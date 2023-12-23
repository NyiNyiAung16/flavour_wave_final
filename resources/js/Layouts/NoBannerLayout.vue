<script setup>
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import { ref } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});

const hover = ref(false);

</script>


<template>
    <div class="banner">
        <div class="sticky top-0 w-full navbar">
            <Navbar :canLogin="canLogin" :can-register="canRegister"/>
        </div>
    </div>
    <div class="delicious">
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


<style  scoped>
.animateSpin{
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from{ transform: rotate(0);}
    to{ transform: rotate(360deg);}
}
</style>