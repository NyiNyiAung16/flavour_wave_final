<template>
    <Head title="Products"/>
    <DefaultLayout>
        <div class="delicious">
            <h3 class="text-3xl text-center font-bold underline mb-6">Our Great Products</h3>
            <div class="flex flex-wrap gap-y-5 justify-around">
                <div class="overflow-hidden relative p-2 sm:m-0 w-[310px] h-[420px] sm:max-h-[520px] border border-neutral-500 flex flex-col items-center justify-around rounded-md" v-for="product in products" :key="product.id">
                    <div class="absolute top-0 left-0 z-20 bg-white text-black w-[80px] h-[30px] m-1 rounded-2xl flex items-center justify-center">
                        <span>${{ product.unit_price }}</span>
                    </div>
                    <img :src="`/${product.image_url}`" alt="cardimg" width="300" class="h-[220px] object-cover scale-90 hover:scale-95 duration-200">
                    <div class="border-t">
                        <p class="text-lg font-bold mb-2">{{product.name}}</p>
                        <p>{{ product.description.substring(0,100) + '...' }}</p>
                    </div>
                    <div class="flex justify-between w-full">
                        <button class="text-white px-3 py-2 font-semibold bg-green-600 hover:bg-green-700 duration-150 rounded" :class="{'bg-green-900 hover:bg-green-900': enableDisabled(product.id)}" :disabled="enableDisabled(product.id)"><i class="fa-solid fa-cart-shopping"></i>Add to Cart</button>
                        <Link :href="route('products.show',product.id)" class="text-black px-3 py-2 font-semibold bg-slate-50 hover:bg-slate-200 duration-150 rounded"><i class="fa-solid fa-circle-info"></i>View Detail</Link>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted, ref} from 'vue';
import { Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

defineProps({
    'products':Array,
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

let cartProducts = ref([]);

onMounted(()=>{
    cartProducts.value = JSON.parse(localStorage.getItem('addToCarts'));
});


const enableDisabled = (id) => {
    if(cartProducts.value){
        if(cartProducts.value.find((p)=> p.id === id)){
            return true;
        }
    }else{
        return false;
    }
}

</script>

<style scoped>

</style>