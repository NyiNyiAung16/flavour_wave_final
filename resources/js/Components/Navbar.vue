<template>
    <div class="flex justify-between items-center px-10 py-2 container">
        <div class="flex items-center">
            <img src="/logo/png/logo1.png" alt="logo" width="60" class="mb-2">
            <Link href="/" class="text-3xl  font-bold">
                <span class="text-orange-500">Flavor</span><span class="text-green-400">wave</span>
            </Link>
        </div>
        <div class="flex gap-4 items-center text-white">
            <Link href="/" class="font-semibold hover:text-slate-200" :class="{active:$page.url == '/'}">Home</Link>
            <Link href="/about" class="font-semibold hover:text-slate-200" :class="{active:$page.url == '/about'}">About</Link>
            <Link href="/products" class="font-semibold hover:text-slate-200" :class="{active:$page.url == '/products'}">Products</Link>
            <div>
                <div v-if="$page.props.auth.user">
                    <Link
                        v-if="$page.props.auth.user && !$page.props.auth.user.isAdmin"
                        :href="route('dashboard')"
                        class="font-semibold hover:text-slate-200"
                        >Dashboard
                    </Link>
                    <Link
                        v-if="$page.props.auth.user && $page.props.auth.user.isAdmin && $page.props.auth.user.department === 'ADMIN'"
                        :href="route('adminDepartment.index')"
                        class="font-semibold hover:text-slate-200"
                        >Dashboard
                    </Link>
                    
                    <Link
                        v-if="$page.props.auth.user && $page.props.auth.user.isAdmin && $page.props.auth.user.department === 'FACTORY'"
                        :href="route('factoryDepartment.index')"
                        class="font-semibold hover:text-slate-200"
                        >Dashboard
                    </Link>
                    <Link
                        v-if="$page.props.auth.user && $page.props.auth.user.isAdmin && $page.props.auth.user.department === 'WAREHOUSE'"
                        :href="route('warehouseDepartment.index')"
                        class="font-semibold hover:text-slate-200"
                        >Dashboard
                    </Link>
                    <Link
                        v-if="$page.props.auth.user && $page.props.auth.user.isAdmin && $page.props.auth.user.department === 'LOGISTIC'"
                        :href="route('logisticDepartment.index')"
                        class="font-semibold hover:text-slate-200"
                        >Dashboard
                    </Link>
                    <Link
                        v-if="$page.props.auth.user && $page.props.auth.user.isAdmin && $page.props.auth.user.department === 'SALE'"
                        :href="route('saleDepartment.index')"
                        class="font-semibold hover:text-slate-200"
                        >Dashboard
                    </Link>
                </div>
                
        
                <div v-else>
                    <Link
                        :href="route('login')"
                        class="font-semibold hover:text-slate-200"
                        >Log in</Link
                    >
        
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="ms-4 font-semibold hover:text-slate-200"
                        >Register</Link
                    >
                </div>
            </div>
            <div v-if="$page.props.auth.user">
                <ShoppingCart :user_id="user_id"/>
            </div>
            <button class="relative px-3 py-2 rounded-xl mode" ref="mode">
                <i class="fa-regular fa-moon" ref="icon"></i>
                <ul class="hidden absolute text-start w-[120px] rounded right-0 mt-3 space-y-1 modeLists" ref="lists">
                    <li class="duration-150 rounded px-2 py-1" @click="light">Light</li>
                    <li class="duration-150 rounded px-2 py-1" @click="dark">Dark</li>
                    <li class="duration-150 rounded px-2 py-1" @click="light">System</li>
                </ul>
            </button>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { ref } from 'vue';
import ShoppingCart from './ShoppingCart.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    user_id:{
        type:Number
    }
});

const mode = ref(null);
const lists = ref(null);
const icon = ref(null);

onMounted(()=>{
    mode.value.addEventListener('click',()=>{
        lists.value.classList.toggle('hidden');
    });
});

const light = () => {
    icon.value.classList.remove('fa-moon');
    icon.value.classList.add('fa-sun');
    document.documentElement.style.setProperty('--banner','#e7b318');
    document.documentElement.style.setProperty('--delicious','#f4f4f4');
    document.documentElement.style.setProperty('--text','#000');
    document.documentElement.style.setProperty('--active','yellow');
    document.documentElement.style.setProperty('--mode','#df9f20');
    document.documentElement.style.setProperty('--hover-mode','#dfaf20');
}

const dark = () => {
    icon.value.classList.remove('fa-sun');
    icon.value.classList.add('fa-moon');
    document.documentElement.style.setProperty('--banner','#555');
    document.documentElement.style.setProperty('--delicious','#000');
    document.documentElement.style.setProperty('--text','#fff');
    document.documentElement.style.setProperty('--active','rgb(45, 229, 85)');
    document.documentElement.style.setProperty('--mode','#666');
    document.documentElement.style.setProperty('--hover-mode','#777');
}

</script>
