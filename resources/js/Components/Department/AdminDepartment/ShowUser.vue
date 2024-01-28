<script setup>
import TableLayout from '@/Layouts/TableLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    users:{
        type:Array
    }
});

const headers = ref(['Username','Email','Department','Created_at']);

const deleteProduct = (id) => {
    router.delete(route('user.destroy',id));
}


</script>


<template>
    <TableLayout
        :headers="headers"
        :is-admin="$page.props.auth.user.isAdmin" 
        :is-department="$page.props.auth.user.department === 'ADMIN'"
    >
        <template #tbody>
                <tr class="border-b item" v-for="(user,index) in users" :key="user.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4 text-center w-[270px] px-2">{{ user.name }}</td>
                    <td class="py-4 text-center w-[370px] px-2">{{user.email}}</td>
                    <td class="py-4 text-center">{{user.department}}</td>
                    <td class="py-4 text-center">{{ new Date(user.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <Link :href="`/adminDepartment/users/${user.id}/edit`" class="text-blue-500 hover:text-blue-600 duration-150 font-bold underline">Edit</Link>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold underline" @click="deleteProduct(user.id)">Delete</button>
                    </td>
                </tr>
        </template>
    </TableLayout>
</template>

