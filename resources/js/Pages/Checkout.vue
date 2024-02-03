<script setup>
import { onMounted } from 'vue';
import NoBannerLayout from '../Layouts/NoBannerLayout.vue'
import CheckoutForm from '../Components/CheckoutForm.vue'
import { cartProducts,fetchCartProducts,increaseProduct, decreaseProduct, removeProduct } from '../composable/cartData'
import { usePage } from '@inertiajs/vue3'

const page = usePage();

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});

const userId = page.props.auth.user.id;

onMounted(async()=>{
    await fetchCartProducts(userId);
})


const increase = (id) => {
    increaseProduct(id,userId);
}

const decrease = (id) => {
    decreaseProduct(id,userId);
};

const deleteProduct = (id) => {
    removeProduct(id,userId);
}

</script>


<template>
    <NoBannerLayout :canLogin="canLogin" :can-register="canRegister">
        <div class="py-10">
            <div class="max-w-7xl mx-auto bg-neutral-600 p-3 rounded">
                <h3 class="text-2xl font-semibold border-b py-4">Pre-order Summary</h3>
                <div class="w-full border-b pb-5 overflow-hidden">
                    <div class="checkoutMain overflow-y-scroll w-full max-h-[380px]">
                        <ul class="max-w-5xl mx-auto mt-3 pt-3 space-y-5 ">
                            <li class="list flex justify-between items-center gap-4 rounded p-3" v-for="product in cartProducts" :key="product.id">
                                <div class="flex gap-4 items-center">
                                    <img :src="`/${product.imageUrl}`" width="100" class="h-[90px] object-cover rounded" alt="cartimg">
                                    <div>
                                        <p class="text-2xl font-semibold">{{product.productName}}</p>
                                        <p>$ <span class="text-lg font-bold">{{ product.quantity_price }}</span> </p>
                                    </div>
                                </div>
                                <div class="flex gap-x-5 items-center text-black">
                                    <button class="bg-slate-100 px-3 py-2 rounded-md" @click="increase(product.id)"><i class="fa-solid fa-plus"></i></button>
                                    <p class="bg-slate-300 w-[30px] text-center rounded-lg">{{product.quantity}}</p>
                                    <button class="bg-red-700 px-3 py-2 rounded-md text-white" @click="decrease(product.id)"><i class="fa-solid fa-minus"></i></button>
                                    <button class="bg-red-700 ms-2 px-3 py-2 rounded-md text-white" @click="deleteProduct(product.id)"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <CheckoutForm />
            </div>
        </div>
    </NoBannerLayout>
</template>


<style scoped>
.list{
    background-color: #333;
}
.checkoutMain {
  --sb-track-color: transparent;
  --sb-thumb-color: #333;
  --sb-size: 6px;

  scrollbar-color: var(--sb-thumb-color) 
                   var(--sb-track-color);
}

.checkoutMain::-webkit-scrollbar {
  width: var(--sb-size) 
}

.checkoutMain::-webkit-scrollbar-track {
  background: var(--sb-track-color);
  border-radius: 10px;
}

.checkoutMain::-webkit-scrollbar-thumb {
  background: var(--sb-thumb-color);
  border-radius: 10px;
}
</style>