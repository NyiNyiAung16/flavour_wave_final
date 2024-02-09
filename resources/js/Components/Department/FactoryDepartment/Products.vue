<script setup>
import TableLayout from '@/Layouts/TableLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { filteredByName } from '@/composable/search';

const props = defineProps({
    'products':{
        type:Array
    }
});
const emits = defineEmits(['set-products']);

const headers = ref(['Product ID','Name','Description','Image','Price','Quantity Per Box','Created_at']);
const search = ref('');

const filteredProducts = computed(()=>{
    return filteredByName(search.value,props.products);
});

const deleteProduct = ( id ) => {
    router.delete(route('product.destroy',id),{
        preserveScroll:true
    });
}




</script>


<template>
    <div class="flex justify-between items-center">
        <Search 
            @searching="(val) => search = val" 
            :howToSearch="'product name'" 
            class="w-3/4"
        />
        <Sorting 
            :items="filteredProducts" 
            sort-by="name" 
            @sorted="(val) => products = val"
            class="w-[370px]"
        />
    </div>
    <div class="sm:rounded-lg" :class="{'overflow-x-scroll':filteredProducts.length > 0}">
        <TableLayout 
            :headers="headers"
            :is-admin="$page.props.auth.user.isAdmin" 
            :is-department="$page.props.auth.user.department.name === 'FACTORY'"
            v-if="filteredProducts.length > 0"
        >
            <template #tbody>
                <tr class="border-b item" v-for="(product,index) in filteredProducts" :key="product.id">
                    <td class="py-4 text-center">{{index}}</td>
                    <td class="py-4 text-center">{{product.id}}</td>
                    <td class="py-4 text-center w-[270px] px-2">{{ product.name }}</td>
                    <td class="py-4 w-[370px] px-2">{{product.description?.substring(0,70) + '...'}}</td>
                    <td class="py-4">
                        <img :src="`/${product.image_url}`" class="mx-auto rounded" width="70" alt="productimg">
                    </td>
                    <td class="py-4 text-center">{{product.unit_price}}$</td>
                    <td class="py-4 text-center">{{product.quantity_per_box}}</td>
                    <td class="py-4 text-center">{{ new Date(product.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center" v-if="$page.props.auth.user.isAdmin && $page.props.auth.user.department.name === 'FACTORY'">
                        <Link :href="route('product.edit',product.id)" class="text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline">Edit</Link>
                        <button class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline" @click="deleteProduct(product.id)">Delete</button>
                    </td>
                </tr>
            </template>
        </TableLayout>
        <template v-else>
            <p>Nothing to Search Products!!</p>
        </template>
    </div>
</template>

