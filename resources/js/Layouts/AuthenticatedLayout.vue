<script setup>
import { ref,onMounted } from 'vue';
import DepartmentName from '@/Components/DepartmentName.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';

let departmentName = ref('');

onMounted(()=>{
    if(route().current('adminDepartment.index')){
        departmentName.value = 'Admin Department';
    }else if(route().current('factoryDepartment.index')){
        departmentName.value = 'Factory Department';
    }else if(route().current('warehouseDepartment.index')){
        departmentName.value = 'Warehouse Department';
    }else if(route().current('logisticsDepartment.index')){
        departmentName.value = 'Logistics Department';
    }else if(route().current('saleDepartment.index')){
        departmentName.value = 'Sales Department';
    }
})



</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Page Heading -->
            <div class="grid grid-cols-12">
                <header class="header col-span-2 bg-white dark:bg-gray-800 shadow relative" v-if="$slots.header">
                    <div class="w-full py-3">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center mx-3">
                            <Link :href="route('welcome')" class="flex gap-2 items-end">
                                <ApplicationLogo
                                    class="block h-12 w-auto fill-current text-gray-800 dark:text-gray-200"
                                />
                                <p class="text-2xl">
                                    <span class="text-orange-500">Flavor</span><span class="text-green-400">wave</span>
                                </p>
                            </Link>
                        </div>
                        <!-- Navigation Links -->
                        <div class="hidden sm:flex flex-col mt-5 mb-4">
                            <div v-if="$page.url == '/profile/me'" class="flex flex-col px-3">
                                <NavLink v-show="!$page.props.auth.user.isAdmin" :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>
                                <NavLink v-show="$page.props.auth.user.isAdmin && $page.props.auth.user.department === 'ADMIN'" :href="route('adminDepartment.index')" :active="route().current('adminDepartment.index')">
                                    Dashboard
                                </NavLink>
                                <NavLink v-show="$page.props.auth.user.isAdmin && $page.props.auth.user.department === 'FACTORY'" :href="route('factoryDepartment.index')" :active="route().current('factoryDepartment.index')">
                                    Dashboard
                                </NavLink>
                                <NavLink v-show="$page.props.auth.user.isAdmin && $page.props.auth.user.department === 'WAREHOUSE'" :href="route('warehouseDepartment.index')" :active="route().current('warehouseDepartment.index')">
                                    Dashboard
                                </NavLink>
                                <NavLink v-show="$page.props.auth.user.isAdmin && $page.props.auth.user.department === 'LOGISTIC'" :href="route('logisticsDepartment.index')" :active="route().current('logisticsDepartment.index')">
                                    Dashboard
                                </NavLink>
                                <NavLink v-show="$page.props.auth.user.isAdmin && $page.props.auth.user.department === 'SALE'" :href="route('saleDepartment.index')" :active="route().current('saleDepartment.index')">
                                    Dashboard
                                </NavLink>
                            </div>
                            <DepartmentName :name="departmentName" />
                        </div>
                        <div class="px-3">
                            <slot name="header" />
                        </div>
                        <div class="px-3 absolute bottom-0 py-2 flex flex-col gap-3" v-if="$page.url != '/profile/me'">
                            <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                            <DropdownLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </DropdownLink>
                        </div>
                    </div>
                </header>
    
                <!-- Page Content -->
                <main class="col-span-10">
                    <div class="flex justify-between p-2">
                        <NavLink :href="route('welcome')" :active="route().current('welcome')" v-if="$page.url != '/profile/me'">
                            <i class="fa-solid fa-arrow-up-from-bracket icon"></i>
                        </NavLink>
                        <div>
                            <p class="text-white sideBar text-sm">{{ $page.props.auth.user.name }} / {{ $page.props.auth.user.email }}</p>
                        </div>
                    </div>
                    <div class="w-full h-[2px] bg-slate-800"></div>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>

<style scoped>

.header{
    height: 100vh;
    border-radius: 0 0 5px 0;
}
.icon{
    font-size: 1.3rem;
    transform: rotate(-90deg);
}
</style>
