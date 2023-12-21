<script setup>
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import SimilarProducts from '@/Components/SimilarProducts.vue';
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import addToCarts from './../../composable/addToCarts'

defineProps({
    product:{
        type:Object
    },
    products:{
        type:Array
    },
    receipes:{
        type:Array
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const hover = ref(false);
const toggle = ref(true);

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
};

let addCart = (e,product) => {
    e.target.classList.remove('bg-green-600');
    e.target.classList.remove('hover:bg-green-700');
    e.target.classList.add('bg-green-800');
    e.target.setAttribute('disabled',true);
    addToCarts(product);
}



</script>

<template>
    <Head title="Detail" />
    <div class="bg-black">
        <div class="max-h-[200px]">
            <div style="background-color: #444;" class="sticky top-0 w-full">
                <Navbar :canLogin="canLogin" :can-register="canRegister"/>
            </div>
            <div class="w-full px-10 h-[100px] text-white flex items-center detailNav">
                <p class="text-2xl font-semibold">Product Detail / {{ product.name }}</p>
            </div>
        </div>
        <div class="py-6">
            <div class="max-w-4xl mx-auto text-white flex justify-between items-center">
                <img :src="`/${product.image_url}`" width="300" class="rounded h-full" alt="detailimg">
                <div class="w-3/5">
                    <h3 class="text-5xl font-semibold space-x-1 mb-3">{{ product.name }}</h3>
                    <p class="text-3xl font-semibold mb-3">$ <span class="text-red-600">{{ product.unit_price }}</span> </p>
                    <p>{{ product.description.substring(0,100) + '...' }}</p>
                    <button class="mt-3 text-white px-4 py-3 font-semibold bg-green-600 hover:bg-green-700 rounded-3xl hover:rounded duration-200" @click="addCart($event,product)" :class="{'bg-green-900 hover:bg-green-900' :enableDisabled(product.id)}" :disabled="enableDisabled(product.id)"><i class="fa-solid fa-cart-shopping"></i>Add to Cart</button>
                </div>
            </div>
            <div class="text-white max-w-6xl mx-auto mt-7">
                <div class="list p-1 gap-2 rounded text-sm">
                    <p class="cursor-pointer p-2 rounded" :class="{'bg-black':toggle === true}" @click="toggle = true">Description</p>
                    <p class="cursor-pointer p-2 rounded" :class="{'bg-black':toggle === false}" @click="toggle = false">Ingredients</p>
                </div>
                <p class="mt-6" v-if="toggle">{{ product.description }}</p>
                <div v-else>
                    <table class="w-full mt-7">
                        <thead>
                            <tr class="text-left border-b head">
                                <th class="py-3">No.</th>
                                <th class="py-3">Name</th>
                                <th class="py-3">Weight</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b item" v-for="(receipe,index) in receipes" :key="receipe.id">
                                <td class="py-4">{{index}}</td>
                                <td class="py-4 capitalize">{{receipe.ingredient.name}}</td>
                                <td class="py-4">{{receipe.amount_grams}}g</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="text-center my-5 text-gray-300">Ingredient Lists</p>
                </div>
            </div>
            <div>
                <SimilarProducts :products="products"/>
            </div>
            <p class="text-white text-center text-xl font-semibold mt-10">
                <i class="fa-solid fa-fan me-3" :class="{animateSpin:hover}" @mouseenter="hover = true" @mouseout="hover = false"></i>
                    Very Thank You For Shopping With Us
                <i class="fa-solid fa-fan ms-3" :class="{animateSpin:hover}" @mouseenter="hover = true" @mouseout="hover = false"></i>
            </p>
        </div>
        <div style="background-color: #333;" class="text-white mt-10">
            <Footer/>
        </div>
    </div>
</template>


<style scoped>
.detailNav{
    background: linear-gradient(rgba(0,0,0,.5),rgba(0,0,0,.5)) , url('/photo/banner2.jpg');
    background-repeat: no-repeat;
    background-position: center;
}
.list{
    display: inline-flex;
    background-color: #444;
}
.head{
    border-color: #888;
    color: #888;
}
.item{
    border-color: #888;
}

.animateSpin{
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from{ transform: rotate(0);}
    to{ transform: rotate(360deg);}
}
</style>