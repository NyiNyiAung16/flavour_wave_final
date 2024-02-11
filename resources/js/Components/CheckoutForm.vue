<script setup>
import BaseInput from "@/Components/BaseInput.vue";
import Button from "@/Components/Button.vue";
import { Head, useForm, router, usePage } from "@inertiajs/vue3";
import {
    fetchCartDetails,
    totalPrice,
    totalQuantity,
    productsId,
    order_items,
} from "../composable/cartData";
import Map from "./Map.vue";
import { ref, onMounted } from "vue";
import { useToast } from "vue-toastification";
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";
import "flatpickr/dist/themes/dark.css";
import { calculateDistance } from "@/composable/getDistance";

const pick = ref(true);
const location = ref(null);
const companyLocation = ref(null);
const loc = ref(null);
const delPrice = ref(null);
const confrim = ref(false);
const date = ref(null);
const distance = ref(0);

const page = usePage();

onMounted(async () => {
    await fetchCartDetails(page.props.auth.user.id);
    flatpickr(date.value, {
        dateFormat: "d-m-Y",
        minDate: "today",
    });
});

const getCompanyLocation = (val) => {
    companyLocation.value = val;
};

const getLocation = (val) => {
    location.value = val;
    pick.value = false;
    const res = calculateDistance(
        companyLocation.value.lat,
        companyLocation.value.lng,
        location.value.lat,
        location.value.lng
    );
    distance.value = parseInt(res);
};

const showDetail = () => {
    loc.value.textContent = `${location.value.lng},${location.value.lat}`;
    delPrice.value.textContent = distance.value;
    confrim.value = true;
    form.latitude = location.value.lat;
    form.longitude = location.value.lng;
    form.deliver_price = distance.value;
};

const removeDetail = () => {
    loc.value.textContent = "";
    delPrice.value.textContent = 0;
    confrim.value = false;
};

const form = useForm({
    order_quantity: totalQuantity.value,
    latitude: 0,
    longitude: 0,
    deliver_price: 0,
    total_price: totalPrice.value,
    user_id: page.props.auth.user.id,
    product_id: productsId.value,
    order_items: order_items.value, // is it right here?
    date: "",
    is_urgent: false,
    truck_number: "",
    capacity: 0,
    driver_nrc: "",
});

const makePreorder = () => {
    if (form.product_id && form.user_id) {
        form.post("/preorders/create", {
            onSuccess: () => {
                localStorage.removeItem(`addToCarts${page.props.auth.user.id}`);
                router.get(route("dashboard"));
                useToast().success("create preorder is successful.", {
                    timeout: 2000,
                });
            },
            onError: () => {
                setTimeout(() => {
                    page.props.errors = {};
                }, 2500);
            },
            preserveScroll: true,
        });
    } else {
        useToast().error("Your network is not stable!!");
    }
};
</script>

<template>
    <Head title="Checkout" />
    <Map v-on:location="getLocation" @companyLocation="getCompanyLocation" />
    <div class="max-w-6xl mx-auto mt-8">
        <div class="space-x-2">
            <button
                class="px-3 py-2 bg-slate-200 hover:bg-slate-300 duration-200 text-black rounded-md"
                :class="{ 'bg-slate-400 hover:bg-slate-400': pick }"
                :disabled="pick"
                @click="showDetail"
            >
                Pick Location
            </button>
            <button
                class="px-3 py-2 bg-slate-200 hover:bg-slate-300 duration-200 text-black rounded-md"
                :class="{ 'bg-slate-400 hover:bg-slate-400': pick }"
                :disabled="pick"
                @click="removeDetail"
            >
                Remove Location
            </button>
        </div>
        <div class="text-2xl font-semibold my-3">
            <p>Location : <span ref="loc"></span></p>
            <p>Delivery Price : <span ref="delPrice"></span>$</p>
        </div>
        <form @submit.prevent="makePreorder">
            <div class="text-xl text-white">
                <div class="mb-3">
                    <input
                        type="checkbox"
                        v-model="form.is_urgent"
                        class="rounded focus:outline-none me-3"
                        @click="confrim = true"
                    />
                    <span>Is Argent (or) Pick yourself!</span>
                </div>
                <div class="space-y-3 text-sm" v-show="form.is_urgent">
                    <div>
                        <BaseInput
                            type="text"
                            label="Driver NRC"
                            v-model="form.driver_nrc"
                            :error="form.errors.driver_nrc"
                            placeholder="e.g 12/MABANA(N)/134567"
                            class="w-full bg-stone-900 p-2 rounded-md outline-none border-none"
                        />
                    </div>
                    <div>
                        <BaseInput
                            type="text"
                            label="Truck No"
                            v-model="form.truck_number"
                            :error="form.errors.truck_number"
                            placeholder="e.g 12/MM/224"
                            class="w-full bg-stone-900 p-2 rounded-md outline-none"
                        />
                    </div>
                    <div>
                        <BaseInput
                            type="number"
                            label="Capacity"
                            v-model="form.capacity"
                            :error="form.errors.capacity"
                            placeholder="e.g 100"
                            class="w-full bg-stone-900 p-2 rounded-md outline-none"
                        />
                    </div>
                    <div>
                        <input
                            ref="date"
                            v-model="form.date"
                            class="bg-stone-800 rounded-md"
                            placeholder="Select a date"
                        />
                        <p
                            v-if="page.props.errors.date"
                            class="text-sm text-red-500 my-1"
                        >
                            {{ page.props.errors.date }}
                        </p>
                    </div>
                </div>
            </div>
            <div
                class="max-w-6xl mx-auto text-xl font-bold border-t-2 mt-3 pt-3"
            >
                <p>Total Quantity : {{ totalQuantity }}</p>
                <p>Total Price : ${{ totalPrice }}</p>
            </div>
            <div>
                <Button
                    type="submit"
                    text="Confrim Pre-Order"
                    class="px-3 py-2 rounded-md bg-slate-100 font-bold text-stone-800 mt-4"
                />
            </div>
        </form>
    </div>
</template>

<style scoped>
.input {
    box-sizing: border-box;
    border: none;
    outline: none;
}
.input:focus {
    box-shadow: none;
    outline: 1px solid #f2f2f2;
}
</style>
