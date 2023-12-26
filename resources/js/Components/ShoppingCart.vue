<template>
    <div class="relative" v-if="cartProducts">
        <button class="relative px-3 py-2 rounded-md modeLists" @click="showCart">
            <i class="fa-solid fa-shopping-cart"></i>
            <span class="absolute top-[-13px] right-[-10px] bg-red-500 rounded-md px-1">{{cartProducts.length}}</span>
        </button>
        <div class="z-20 hidden absolute top-11 right-[-70px] w-[340px] overflow-hidden bg-black px-3 py-2 rounded" ref="cart">
            <div class="flex justify-between">
                <p>Shopping Cart</p>
                <p>${{totalPrice}}</p>
            </div>
            <button class="bg-gray-500 hover:bg-gray-600 duration-150 w-full p-2 my-3 rounded"><i class="fa-solid fa-check mr-1"></i> <Link href="/checkout">CheckOut</Link></button>
            <ul class="listContainer mt-3 border-t pt-3 space-y-5 overflow-y-scroll w-full  max-h-[380px]">
                <li class="flex flex-col gap-4" v-for="product in cartProducts" :key="product.id">
                    <div class="flex gap-4 items-center">
                        <img :src="`/${product.imageUrl}`" width="75" class="h-[70px] object-cover rounded" alt="cartimg">
                        <p>{{product.productName}}</p>
                    </div>
                    <div class="flex gap-x-5 items-center text-black">
                        <button class="bg-slate-100 px-3 py-2 rounded-md" @click="increase(product.id)"><i class="fa-solid fa-plus"></i></button>
                        <p class="bg-slate-300 w-[30px] text-center rounded-lg">{{product.quantity}}</p>
                        <button class="bg-red-600 px-3 py-2 rounded-md text-white" @click="decrease(product.id)"><i class="fa-solid fa-minus"></i></button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { cartProducts, totalPrice, fetchCartDetails, increaseProduct, decreaseProduct } from '../composable/cartData'

const cart = ref(null);

onMounted(async()=>{
    await fetchCartDetails();
});

const showCart = () => {
    cart.value.classList.toggle('hidden');
};

const increase = (id) => {
    increaseProduct(id);
}

const decrease = (id) => {
    decreaseProduct(id);
}


</script>

<style scoped>

.listContainer {
  --sb-track-color: #232E33;
  --sb-thumb-color: #444;
  --sb-size: 6px;

  scrollbar-color: var(--sb-thumb-color) 
                   var(--sb-track-color);
}

.listContainer::-webkit-scrollbar {
  width: var(--sb-size) 
}

.listContainer::-webkit-scrollbar-track {
  background: var(--sb-track-color);
  border-radius: 10px;
}

.listContainer::-webkit-scrollbar-thumb {
  background: var(--sb-thumb-color);
  border-radius: 10px;
  
  }
</style>