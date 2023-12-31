<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    users:{
        type:Array
    }
});

</script>


<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th class="py-3">Username</th>
                    <th class="py-3">Email</th>
                    <th class="py-3 text-center">Image</th>
                    <th class="py-3 text-center">Department</th>
                    <th class="py-3 text-center">Created_at</th>
                    <th class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(user,index) in users" :key="user.id">
                    <td class="py-4">{{index}}</td>
                    <td class="py-4 w-[270px] px-2">{{ user.name }}</td>
                    <td class="py-4 w-[370px] px-2">{{user.email}}</td>
                    <td class="py-4">
                        <img :src="`/${user.image_url}`" class="mx-auto rounded" width="70" alt="userImg">
                    </td>
                    <td class="py-4 text-center">{{user.department}}</td>
                    <td class="py-4 text-center">{{ new Date(user.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <Link :href="`adminDepartment/users/${user.id}/edit`" class="text-blue-500 hover:text-blue-600 duration-150 font-bold underline">Edit</Link>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold underline" @click="deleteProduct(user.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

