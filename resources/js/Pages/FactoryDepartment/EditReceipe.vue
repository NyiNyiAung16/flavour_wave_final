<script setup>
import NavLink from '@/Components/NavLink.vue'
import BaseSelect from '@/Components/BaseSelect.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue'
import { useForm, router, Head } from '@inertiajs/vue3';
import { computed, ref, onMounted } from 'vue';
import BaseInput from '@/Components/BaseInput.vue';
import { useToast } from 'vue-toastification';

const props = defineProps({
    product_id:{
        type:Number,
        required:true
    },
    receipe:{
        type:Object
    },
    products:{
        type:Array
    },
    ingredients:{
        type:Array
    }
});

onMounted(()=>{
    ingredientsWithGrams.value = props.receipe.map(receipe => {
        return {
            id:receipe.ingredient.id,
            name:receipe.ingredient.name
        }
    });

    function filterData(data) {
        const result = {};
        data.forEach((item) => {
            const { ingredient_id, amount_grams } = item;
            result[ingredient_id] = amount_grams;
        });
        return result;
    }
    gramsArray.value = filterData(props.receipe);
})

const ingredientsWithGrams = ref([]);
const gramsArray = ref([]);

const form = useForm({
    product_id:props.product_id,
    ingredient_id:[],
    amount_grams:[]
});

const productsOptions = computed(()=>{
    return props.products.map((product) => {
        return { label: product.name, value: product.id };
    })
});


const toggleGrams = () => {
    gramsArray.value = [];
}

const editReceipe = () => {
    form.ingredient_id = ingredientsWithGrams.value.map(i => i.id);
    form.amount_grams = gramsArray.value;
    console.log(form)
    form.patch(route('receipe.patch'),{
        onSuccess:()=>{
            router.get(route('factoryDepartment.index'));
            useToast().success('Edit Receipe is successful')
        },  
        onError:()=>{
            if(form.product_id === 'default' || form.product_id === 0) form.errors.product_id = 'You need to choose at least one product.'
            setTimeout(()=>{
                form.errors = {};
            },2000);    
        },
        preserveScroll:true 
    });
}

</script>


<template>
    <Head title="Edit Receipe" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-3">
                <NavLink 
                    v-show="$page.props.auth.user.isAdmin && $page.props.auth.user.department.name === 'FACTORY'" 
                    :href="route('factoryDepartment.index')" 
                    :active="route().current('factoryDepartment.index')"
                >
                    Dashboard
                </NavLink>
                <p class="sideBar active-sideBar" 
                >Edit Receipe</p>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <form @submit.prevent="editReceipe">
                        <h3 class="text-2xl text-center font-semibold mb-3">Edit Receipe</h3>
                        <div class="space-y-4 max-w-5xl mx-auto">
                            <div>
                                <base-select
                                    label="Product Name"
                                    v-model="form.product_id"
                                    :options="productsOptions"
                                    :error="form.errors.product_id"
                                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                                />
                            </div>
                            <div>
                                <label>Ingredient Names</label>
                                <select 
                                    v-model="ingredientsWithGrams"
                                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                                    multiple
                                    @change="toggleGrams"
                                >
                                    <option selected disabled> Choose ingredients for products </option>
                                    <option
                                        v-for="ingredient in ingredients" :key="ingredient.id"
                                        :value="{id:ingredient.id,name:ingredient.name}"
                                        class="my-2 p-1 rounded-sm"
                                    >
                                    {{ ingredient.name }}
                                    </option>
                                </select>
                                <p class="text-sm text-red-500 my-1" v-if="form.ingredient_id.error">{{ form.ingredient_id.error }}</p>
                            </div>
                            <div>
                                <div 
                                    v-for="ingredient in ingredientsWithGrams"
                                    :key="ingredient.id"
                                    class="flex items-center py-1 gap-3"
                                >
                                    <p class="w-[400px] text-lg">{{ ingredient.name }} <span class="inline-block text-md">( grams )</span></p>
                                    <BaseInput
                                        type="number"
                                        v-model="gramsArray[ingredient.id]"
                                        :error="form.errors.amount_grams"
                                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                                    />
                                </div>
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

