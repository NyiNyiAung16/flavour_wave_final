<script setup>
import NavLink from "@/Components/NavLink.vue";
import BaseSelect from "@/Components/BaseSelect.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { useForm, router } from "@inertiajs/vue3";
import { computed, ref, onMounted, defineProps } from "vue";
import BaseInput from "@/Components/BaseInput.vue";
import { useToast } from "vue-toastification";
import { errors } from "@/composable/editProductDetail";

const props = defineProps({
    product_id: {
        type: Number,
        required: true,
    },
    receipe: {
        type: Object,
    },
    products: {
        type: Array,
    },
    ingredients: {
        type: Array,
    },
});

onMounted(() => {
    ingredientsWithGrams.value = props.receipe.map((receipe) => {
        return {
            id: receipe.ingredient.id,
            name: receipe.ingredient.name,
        };
    });
});

const ingredientsWithGrams = ref([]);
const gramsArray = ref([]);

const form = useForm({
    product_id: props.product_id,
    ingredient_id: [],
    amount_grams: {},
});

const productsOptions = computed(() => {
    return props.products.map((product) => {
        return { label: product.name, value: product.id };
    });
});

const toggleGrams = () => {
    gramsArray.value = [];
};
const gramData = ref({});

const add = (ingredient_id, gramsAmount) => {
    errors.value.amount_grams = "";
    form.amount_grams[ingredient_id] = gramsAmount;
};

const editReceipe = () => {
    form.ingredient_id = ingredientsWithGrams.value.map((i) => i.id);

    // Build the correct amount_grams array
    form.amount_grams = {};
    ingredientsWithGrams.value.forEach((ingredient) => {
        const ingredientId = ingredient.id;
        form.amount_grams[ingredientId] = gramData.value[ingredientId];
    });

    form.patch(route("receipe.patch", props.receipe[0].id), {
        onSuccess: () => {
            router.get(route("factoryDepartment.index"));
            useToast().success("Edit Receipe is successful");
        },
        onError: () => {
            setTimeout(() => {
                form.errors = {};
            }, 2000);
        },
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Edit Receipe" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-3">
                <NavLink
                    v-show="
                        $page.props.auth.user.isAdmin &&
                        $page.props.auth.user.department.name === 'FACTORY'
                    "
                    :href="route('factoryDepartment.index')"
                    :active="route().current('factoryDepartment.index')"
                >
                    Dashboard
                </NavLink>
                <p class="sideBar active-sideBar">Edit Receipe</p>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3"
                >
                    <form @submit.prevent="editReceipe">
                        <h3 class="text-2xl text-center font-semibold mb-3">
                            Edit Receipe
                        </h3>
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
                                    <option selected disabled>
                                        Choose ingredients for products
                                    </option>
                                    <option
                                        v-for="ingredient in ingredients"
                                        :key="ingredient.id"
                                        :value="{
                                            id: ingredient.id,
                                            name: ingredient.name,
                                        }"
                                        class="my-2 p-1 rounded-sm"
                                    >
                                        {{ ingredient.name }}
                                    </option>
                                </select>
                                <p
                                    class="text-sm text-red-500 my-1"
                                    v-if="form.ingredient_id.error"
                                >
                                    {{ form.ingredient_id.error }}
                                </p>
                            </div>
                            <div>
                                <div
                                    v-for="ingredient in ingredientsWithGrams"
                                    :key="ingredient.id"
                                    class="flex items-center py-1 gap-3"
                                >
                                    <p class="w-[400px] text-lg">
                                        {{ ingredient.name }}
                                        <span class="inline-block text-md"
                                            >( grams )</span
                                        >
                                    </p>
                                    <BaseInput
                                        type="number"
                                        v-model="gramData[ingredient.id]"
                                        :error="form.errors.amount_grams"
                                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                                        @change="add(ingredient.id, gramData)"
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
