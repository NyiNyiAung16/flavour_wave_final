<script setup>
import NavLink from '@/Components/NavLink.vue'
import BaseInput from '@/Components/BaseInput.vue';
import BaseSelect from '@/Components/BaseSelect.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm,router } from '@inertiajs/vue3'
import { useToast } from 'vue-toastification';

const props = defineProps({
    user:{
        type:Object
    },
    departments:{
        type:Array,
        required:true
    }
})

const form = useForm({
    name:props.user.name,
    email:props.user.email,
    department_id:props.user.department.id
});

const departmentOptions = ref([]);

props.departments.forEach((d)=>{
    departmentOptions.value.push({ label: d.name , value:d.id });
})

const EditUser = () => {
    if(form.department_id === 'default'){
        form.department_id = ''
    }
    form.patch(route('user.patch',props.user.id),{
        onSuccess:() => {
            form.reset();
            router.get(route('adminDepartment.index'));
            useToast().success('Edit User is successful.');
        },
        onError:() => {
            setTimeout(()=>{
                form.clearErrors();
            },2000)
        }
    });
    if(form.department_id === ''){
        form.department_id = 'default';
    }
}

</script>


<template>
    <Head title="AdminDepartment" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-5">
                <NavLink 
                    v-show="$page.props.auth.user.isAdmin && $page.props.auth.user.department.name === 'ADMIN'" 
                    :href="route('adminDepartment.index')" 
                    :active="route().current('adminDepartment.index')"
                >
                    Dashboard
                </NavLink>
                <p class="sideBar active-sideBar"
                >
                    Edit User
                </p>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <form class="max-w-3xl mx-auto py-2" @submit.prevent="EditUser">
                        <h3 class="text-2xl font-semibold text-center mb-3">Edit User</h3>
                        <div class="space-y-4">
                            <div>
                                <BaseInput
                                    type="text"
                                    label="Username"
                                    v-model="form.name"
                                    :error="form.errors.name"
                                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                                    placeholder="eg:Alex"
                                />
                            </div>
                            <div>
                                <BaseInput
                                    type="email"
                                    label="Email"
                                    v-model="form.email"
                                    :error="form.errors.email"
                                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                                    placeholder="eg:alex@gmail.com"
                                />
                            </div>
                            <div>
                                <BaseSelect
                                    label="Department"
                                    v-model="form.department_id"
                                    :options="departmentOptions"
                                    :error="form.errors.department"
                                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                                />
                            </div>
                            <div>
                                <PrimaryButton>Update</PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

 
