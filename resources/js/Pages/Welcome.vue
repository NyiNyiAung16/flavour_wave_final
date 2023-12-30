<script setup>
import { Head } from '@inertiajs/vue3';
import DeliciousSection from '@/Components/DeliciousSection.vue';
import PopularProducts from '@/Components/PopularProducts.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    popularProducts:{
        type:Array
    },
    user_id:{
        type:Number
    }
});
</script>

<template>
    <Head title="Welcome" />
    <DefaultLayout :canLogin="canLogin" :can-register="canRegister" :user_id="user_id">
        <DeliciousSection/>
        <PopularProducts :products="popularProducts" :user_id="user_id"/>
    </DefaultLayout>
</template>
