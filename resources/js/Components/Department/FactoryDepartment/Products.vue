<script setup>
import TableLayout from "@/Layouts/TableLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    products: {
        type: Array,
    },
});

const deleteProduct = (id) => {
    router.delete(route("product.destroy", id), {
        preserveScroll: true,
    });
};

const headers = ref([
    "Product ID",
    "Name",
    "Description",
    // "Image",
    "Price",
    "Quantity Per Box",
]);
</script>

<template>
    <TableLayout
        :headers="headers"
        :is-admin="$page.props.auth.user.isAdmin"
        :is-department="$page.props.auth.user.department.name === 'FACTORY'"
    >
        <template #tbody>
            <tr
                class="border-b item"
                v-for="(product, index) in products"
                :key="product.id"
            >
                <td class="py-4">{{ index + 1 }}</td>
                <td class="py-4 text-center">{{ product.id }}</td>
                <td class="py-4 text-center w-[270px] px-2">
                    {{ product.name }}
                </td>
                <td class="py-4 w-[370px] px-2 text-center">
                    {{ product.description?.substring(0, 70) + "..." }}
                </td>
                <!-- <td class="py-4">
                    <img
                        :src="`/${product.image_url}`"
                        class="mx-auto rounded"
                        width="70"
                        alt="productimg"
                    />
                </td> -->
                <td class="py-4 text-center">{{ product.unit_price }}$</td>
                <td class="py-4 text-center">{{ product.quantity_per_box }}</td>

                <td
                    class="py-4 space-x-3 text-center"
                    v-if="
                        $page.props.auth.user.isAdmin &&
                        $page.props.auth.user.department.name === 'FACTORY'
                    "
                >
                    <Link
                        :href="route('product.edit', product.id)"
                        class="text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                        >Edit</Link
                    >
                    <button
                        class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline"
                        @click="deleteProduct(product.id)"
                    >
                        Delete
                    </button>
                </td>
            </tr>
        </template>
    </TableLayout>
</template>
