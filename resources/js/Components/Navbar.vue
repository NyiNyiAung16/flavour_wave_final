<template>
    <div class="flex justify-between items-center px-10 py-3 container">
        <div class="flex items-center">
            <img src="/logo/png/logo2.png" alt="logo" width="70" class="mb-2">
            <Link href="/" class="text-3xl  font-bold">
                <span class="text-orange-500">Flavor</span><span class="text-green-400">wave</span>
            </Link>
        </div>
        <div class="flex gap-4 items-center text-white">
            <Link href="/" class="font-semibold hover:text-slate-200" :class="{active:$page.url == '/'}">Home</Link>
            <Link href="/about" class="font-semibold hover:text-slate-200" :class="{active:$page.url == '/about'}">About</Link>
            <Link href="/products" class="font-semibold hover:text-slate-200" :class="{active:$page.url == '/products'}">Products</Link>
            <div v-if="canLogin">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="font-semibold hover:text-slate-200"
                    >Dashboard
                </Link>
        
                <template v-else>
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
                </template>
            </div>
            <button class="relative px-3 py-2 rounded-xl mode" ref="mode">
                <!-- <i class="fa-regular fa-sun"></i> -->
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

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
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

<style scoped>
</style>