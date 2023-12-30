<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';

defineProps({
    user:{
        type:Object
    }
});

const toggle = ref(true);

</script>


<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex gap-5">
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer" 
                :class="{'underline':toggle === true}"
                @click="toggle = true"
                >
                    Preorders
                </h2>
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-xl leading-tight cursor-pointer"
                :class="{'underline':toggle === false}"
                @click="toggle = false"
                >
                    Urgents Orders
                </h2>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

