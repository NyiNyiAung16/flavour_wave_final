<script setup>
import { ref,onMounted } from 'vue';
import Map from './Map.vue';
import { Head,useForm, router, usePage } from '@inertiajs/vue3';
import { fetchCartDetails, totalPrice, totalQuantity, productsId  } from '../composable/cartData'
import { useToast } from 'vue-toastification';

const props = defineProps({
    user_id:{
        type:Number
    }
});

const page = usePage();

onMounted(async()=>{
    await fetchCartDetails();
});

const pick = ref(true);
const location = ref(null);
const loc = ref(null);
const delPrice = ref(null);
const confrim = ref(false);

const getLocation = (val) => {
    location.value = val;
    pick.value = false;
    form.latitude = location.value.lat;
    form.longitude = location.value.lng;
};

const showDetail = () => {
    loc.value.textContent = `${location.value.lng},${location.value.lat}`;
    delPrice.value.textContent = '24$';
    confrim.value = true;
}

const removeDetail = () => {
    loc.value.textContent = '';
    delPrice.value.textContent = '';
    confrim.value = false;
};

const form = useForm({
    'order_quantity':totalQuantity.value,
    'latitude':0,
    'longitude':0,
    'user_id':0,
    'product_id':productsId.value,
    'date':'',
    'is_urgent':false,
    'truck_number':'',
    'capacity':0,
    'driver_nrc':''
});

if(props){
    form.user_id = props.user_id;
}

const makePreorder = () => {
    if(form.product_id && form.user_id){
        form.post('/preorders/create',{
            onSuccess:()=>{
                localStorage.removeItem('addToCarts');
                router.get(route('dashboard'));
            },
            onError:()=>{
                setTimeout(()=>{
                    page.props.errors = {}
                },2500)
            },
            preserveScroll:true
        });
    }else{
        useToast().error('Your network is not stable!!');
    }
}

</script>

<template>
    <Head title="Checkout" />
    <Map v-on:location="getLocation"/>
    <div class="max-w-6xl mx-auto mt-8">
        <div class="space-x-2">
            <button class="px-3 py-2 bg-slate-200 hover:bg-slate-300 duration-200 text-black rounded-md" :class="{'bg-slate-400 hover:bg-slate-400':pick}" :disabled=pick @click="showDetail">Pick Location</button>
            <button class="px-3 py-2 bg-slate-200 hover:bg-slate-300 duration-200 text-black rounded-md" :class="{'bg-slate-400 hover:bg-slate-400':pick}" :disabled=pick @click="removeDetail">Remove Location</button>
        </div>
        <div class="text-2xl font-semibold my-3">
            <p>Location : <span ref="loc"></span></p>
            <p>Delivery Price : <span ref="delPrice"></span></p>
        </div>
        <form @submit.prevent="makePreorder">
            <div class="text-xl text-white">
                <div class="mb-3">
                    <input type="checkbox" v-model="form.is_urgent" class="rounded focus:outline-none me-3" @click="confrim = true">
                    <span>Is Argent (or) Pick yourself!</span>
                </div>
                <div class="space-y-3 text-sm" v-show="form.is_urgent">
                    <div>
                        <label class="mb-1 text-slate-100 font-bold block" for="DriverNRC">Driver NRC</label>
                        <input type="text" v-model="form.driver_nrc" class="input w-full bg-stone-900 p-2 rounded-md outline-none border-none" placeholder="e.g 12/MABANA(N)/134567">
                        <p v-if="page.props.errors.driver_nrc" class="text-sm text-red-500 my-1">{{ page.props.errors.driver_nrc }}</p>
                    </div>
                    <div>
                        <label class="mb-1 text-slate-100 font-bold block" for="Truckno">Truck No</label>
                        <input type="text" v-model="form.truck_number" class="input w-full bg-stone-900 p-2 rounded-md outline-none" placeholder="e.g 12/MM/224">
                        <p v-if="page.props.errors.truck_number" class="text-sm text-red-500 my-1">{{ page.props.errors.truck_number }}</p>
                    </div>
                    <div>
                        <label class="mb-1 text-slate-100 font-bold block" for="Capacity">Capacity</label>
                        <input type="number" v-model="form.capacity" class="input w-full bg-stone-900 p-2 rounded-md outline-none" placeholder="e.g 100">
                        <p v-if="page.props.errors.capacity" class="text-sm text-red-500 my-1">{{ page.props.errors.capacity }}</p>
                    </div>
                    <div>
                        <input type="date" v-model="form.date" class="input bg-stone-800 rounded-md">
                        <p v-if="page.props.errors.date" class="text-sm text-red-500 my-1">{{ page.props.errors.date }}</p>
                    </div>
                </div>
            </div>
            <div class="max-w-6xl mx-auto text-xl font-bold border-t-2 mt-3 pt-3">
                <p>Total Quantity : {{totalQuantity}}</p>
                <p>Total Price : ${{totalPrice}}</p>
            </div>
            <button type="submit" class="px-3 py-2 rounded-md bg-slate-100 font-bold text-stone-800 mt-4" v-show="confrim">Confrim Pre-Order</button>
        </form>
    </div>
</template>


<style scoped>
.input{
    box-sizing: border-box;
    border: none;
    outline: none;
}
.input:focus{
    box-shadow: none;
    outline: 1px solid #f2f2f2;
}

</style>