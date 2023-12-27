<script setup>
import { StripeCheckout } from '@vue-stripe/vue-stripe'
import { ref } from 'vue'

const checkoutRef = ref(null);
const publishedKey = ref('pk_test_51OOdGoKv4fHIgqajVf876dLbd4h6BpPKHMl19sUHtunVtbElyInXQU5ZDTsOb5YZRPSsARDkCt3nTED4S6rFYsXd00x7DqYThc');

</script>


<template>
    <stripe-checkout
        ref="checkoutRef"
        mode="payment"
        :pk="publishedKey"
    />
</template>


<style scoped>

</style>