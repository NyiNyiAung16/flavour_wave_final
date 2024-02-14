<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import ShowLogistics from "../../Components/Department/LogisticsDepartment/ShowLogistics.vue";
import DriversInfo from "./DriversInfo.vue";
import createDeliver from "@/Components/Department/LogisticsDepartment/createDeliver.vue";
import CreateDriver from "@/Components/Department/LogisticsDepartment/CreateDriver.vue";
import Preorders from "@/Components/customer/Preorders.vue";
import Urgent from "@/Components/customer/Urgent.vue";
import InProcess from "./InProcess.vue";

defineProps({
    drivers: {
        type: Array,
    },
    logistics: {
        type: Array,
    },
    preorders: {
        type: Array,
    },
    inprocess: {
        type: Array,
    },
    user: {
        type: Object,
    },
});

const toggle = ref("default");
</script>

<template>
    <Head title="LogisticsDepartment" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-5">
                <h2
                    class="sideBar"
                    :class="{ 'active-sideBar': toggle === 'default' }"
                    @click="toggle = 'default'"
                >
                    Delivered Orders
                </h2>
                <h2
                    class="sideBar"
                    :class="{ 'active-sideBar': toggle === 'orders' }"
                    @click="toggle = 'orders'"
                >
                    New Orders
                </h2>
                <h2
                    class="sideBar"
                    :class="{ 'active-sideBar': toggle === 'inprocess' }"
                    @click="toggle = 'inprocess'"
                >
                    In Process
                </h2>
                <h2
                    class="sideBar"
                    :class="{ 'active-sideBar': toggle === 'drivers' }"
                    @click="toggle = 'drivers'"
                >
                    Drivers Info
                </h2>
                <h2
                    class="sideBar"
                    :class="{ 'active-sideBar': toggle === 'createDeliver' }"
                    @click="toggle = 'createDeliver'"
                >
                    Create Deliver
                </h2>
                <h2
                    class="sideBar"
                    :class="{ 'active-sideBar': toggle === 'createDriver' }"
                    @click="toggle = 'createDriver'"
                >
                    Create Driver
                </h2>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="sm:rounded-lg">
                    <div v-if="toggle === 'default'">
                        <ShowLogistics :logistics="logistics" />
                    </div>
                    <div v-if="toggle === 'orders'">
                        <Preorders :preorders="preorders" :user="user" />
                    </div>

                    <div v-if="toggle === 'inprocess'">
                        <InProcess :inprocess="inprocess" />
                    </div>
                    <div v-if="toggle === 'drivers'">
                        <DriversInfo :drivers="drivers" />
                    </div>
                    <div v-if="toggle === 'createDeliver'">
                        <createDeliver :drivers="drivers" />
                    </div>
                    <div v-if="toggle === 'createDriver'">
                        <CreateDriver />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
