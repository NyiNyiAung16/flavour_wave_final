<script setup>
import TableLayout from "@/Layouts/TableLayout.vue";
import Body from "@/Components/Table/Body.vue";
import Button from "@/Components/Button.vue";
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import {
    showEdit,
    confrim,
    errors,
} from "../../../composable/editProductDetail";
import { filteredById } from "@/composable/search";

const props = defineProps({
    factories: {
        type: Array,
        required: true,
    },
});

const headers = ref([
    "Product Name",
    "Expected",
    "Actual",
    "Store To Warehouse",
    "Created_at",
    "Action",
]);

const search = ref("");

const filteredFactories = computed(() => {
    return filteredById(search.value, props.factories);
});

const deleteFactory = (id) => {
    router.delete(route("factory.destroy", id), {
        preserveScroll: true,
    });
};

const edit = (e, factory, index) => {
    showEdit(e, factory, index);
};

const confrimData = (index, factory) => {
    confrim(index, factory);
};
</script>

<template>
    <div v-if="factories.length > 0">
        <div class="flex justify-between items-center">
            <Search
                @searching="(val) => (search = val)"
                :howToSearch="'product ID'"
                class="w-3/4"
            />
            <Sorting
                :items="filteredFactories"
                sort-by="product_id"
                @sorted="(val) => (factories = val)"
                class="w-[370px]"
            />
        </div>
        <div
            class="sm:rounded-lg"
            :class="{ 'overflow-x-scroll': filteredFactories.length > 0 }"
        >
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin"
                :is-department="
                    $page.props.auth.user.department.name === 'FACTORY'
                "
                v-if="filteredFactories.length > 0"
            >
                <template #tbody>
                    <tr
                        class="border-b item"
                        v-for="(factory, index) in filteredFactories"
                        :key="factory.id"
                    >
                        <td class="py-4 text-center">{{ index + 1 }}</td>
                        <Body
                            :text-id="`productID${index}`"
                            :error-id="`errorid${index}`"
                            :value="factory.product_name"
                            :error="errors.product_id"
                        />
                        <Body
                            :text-id="`expected${index}`"
                            :error-id="`errorexpected${index}`"
                            :value="factory.expected"
                            :error="errors.expected"
                        />
                        <Body
                            :text-id="`actual${index}`"
                            :error-id="`erroractual${index}`"
                            :value="factory.actual"
                            :error="errors.actual"
                        />
                        <td class="py-4 text-center">{{ factory.isStore }}</td>
                        <td class="py-4 text-center">
                            {{
                                new Date(
                                    factory.created_at
                                ).toLocaleDateString()
                            }}
                        </td>
                        <td class="py-4 space-x-3 text-center">
                            <Button
                                type="button"
                                text="Edit"
                                :id="`editBtn${index}`"
                                class="text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                                @click="edit($event, factory, index)"
                            />
                            <Button
                                type="button"
                                text="Confrim"
                                :id="`confirmBtn${index}`"
                                class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                                @click="confrimData(index, factory)"
                            />
                            <Button
                                type="button"
                                text="Delete"
                                class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline"
                                @click="deleteFactory(factory.id)"
                            />
                        </td>
                    </tr>
                </template>
            </TableLayout>
            <template v-else>
                <NoResults />
            </template>
        </div>
    </div>
    <div v-else>
        <p>Don't have any products details!</p>
    </div>
</template>
