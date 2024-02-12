<script setup>
import TableLayout from '@/Layouts/TableLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { filteredByName } from '@/composable/search'

const props = defineProps({
    users:{
        type:Array
    }
});

const headers = ref(['Username','Email','Department','Created_at']);
const search = ref('');

const filteredUsers = computed(()=>{
    return filteredByName(search.value,props.users)
});


const deleteProduct = (id) => {
    router.delete(route('user.destroy',id));
}


</script>


<template>
    <div v-if="users.length > 0">
        <div class="flex justify-between items-center">
            <Search 
                @searching="(val) => search = val" 
                :howToSearch="'username'" 
                class="w-3/4"
            />
            <Sorting 
                :items="filteredUsers" 
                sort-by="name" 
                @sorted="(val) => users = val"
                class="w-[370px]"
            />
        </div>
        <div class="sm:rounded-lg" :class="{'overflow-x-scroll': filteredUsers.length > 0}">
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin" 
                :is-department="$page.props.auth.user.department.name === 'ADMIN'"
                v-if="filteredUsers.length > 0"
            >
                <template #tbody>
                        <tr class="border-b item" v-for="(user,index) in filteredUsers" :key="user.id">
                            <td class="py-4 text-center">{{index}}</td>
                            <td class="py-4 text-center w-[270px] px-2">{{ user.name }}</td>
                            <td class="py-4 text-center w-[370px] px-2">{{user.email}}</td>
                            <td class="py-4 text-center">{{user.department.name}}</td>
                            <td class="py-4 text-center">{{ new Date(user.created_at).toLocaleDateString()}}</td>
                            <td class="py-4 space-x-3 text-center">
                                <Link :href="`/adminDepartment/users/${user.id}/edit`" class="text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline">Edit</Link>
                                <button class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline" @click="deleteProduct(user.id)">Delete</button>
                            </td>
                        </tr>
                </template>
            </TableLayout>
            <template v-else>
                <NoResults/>
            </template>
        </div>
    </div>
    <div v-else>
        <p>Don't have any users!</p>
    </div>
</template>

