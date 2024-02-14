<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import Show from "../../Components/Department/WarehouseDepartment/Show.vue";
import Products from "@/Components/Department/FactoryDepartment/Products.vue";
import Create from "@/Components/Department/WarehouseDepartment/Create.vue";
import AddDamageProduct from "@/Components/Department/WarehouseDepartment/AddDamageProduct.vue";
import SalesReturn from "@/Components/Department/WarehouseDepartment/SalesReturn.vue";
import ReceiveProduct from "@/Components/Department/WarehouseDepartment/ReceiveProduct.vue";
import SaleReturnList from "@/Components/Department/WarehouseDepartment/SaleReturnList.vue";

defineProps({
    warehouses: {
        type: Array,
    },
    products: {
        type: Array,
    },
    factoryProduct: {
        type: Array,
    },
    preorders: {
        type: Array,
    },
    sales_return: {
        type: Array,
    },
});
const toggle = ref("default");
</script>

<template>
    <Head title="WarehouseDepartment" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-5">
                <h2
                    class="sideBar"
                    :class="{ 'active-sideBar': toggle === 'default' }"
                    @click="toggle = 'default'"
                >
                    Products Details
                </h2>
                <h2
                    class="sideBar"
                    :class="{ 'active-sideBar': toggle === 'storeProducts' }"
                    @click="toggle = 'storeProducts'"
                >
                    Products
                </h2>
                <h2
                    class="sideBar"
                    :class="{ 'active-sideBar': toggle === 'addDamage' }"
                    @click="toggle = 'addDamage'"
                >
                    Damage Products
                </h2>
                <h2
                    class="sideBar"
                    :class="{ 'active-sideBar': toggle === 'saleReturn' }"
                    @click="toggle = 'saleReturn'"
                >
                    Add Sales Return
                </h2>
                <h2
                    class="sideBar"
                    :class="{ 'active-sideBar': toggle === 'saleReturnList' }"
                    @click="toggle = 'saleReturnList'"
                >
                    Sales Return List
                </h2>
                <h2
                    class="sideBar"
                    :class="{ 'active-sideBar': toggle === 'receive' }"
                    @click="toggle = 'receive'"
                >
                    Receive
                </h2>

                <h2
                    class="sideBar"
                    :class="{ 'active-sideBar': toggle === 'create' }"
                    @click="toggle = 'create'"
                >
                    Create Warehouse
                </h2>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3"
                    :class="{ 'overflow-x-scroll': toggle !== 'create' }"
                >
                    <div v-if="toggle === 'default'">
                        <Show :warehouses="warehouses" />
                    </div>
                    <div v-if="toggle === 'storeProducts'">
                        <Products :products="products" />
                    </div>
                    <div v-if="toggle === 'addDamage'">
                        <AddDamageProduct :warehouses="warehouses" />
                    </div>
                    <div v-if="toggle === 'saleReturn'">
                        <SalesReturn
                            :warehouses="warehouses"
                            :preorders="preorders"
                        />
                    </div>
                    <div v-if="toggle === 'saleReturnList'">
                        <SaleReturnList
                            :warehouses="warehouses"
                            :preorders="preorders"
                            :sales_return="sales_return"
                        />
                    </div>
                    <div v-if="toggle === 'receive'">
                        <ReceiveProduct :factoryProduct="factoryProduct" />
                    </div>
                    <div v-if="toggle === 'create'">
                        <Create />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
