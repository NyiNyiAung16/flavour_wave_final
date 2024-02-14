<script setup>
import BaseSelect from "@/Components/BaseSelect.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import BaseInput from "@/Components/BaseInput.vue";
import { useToast } from "vue-toastification";

const props = defineProps({
    products: {
        type: Array,
    },
    ingredients: {
        type: Array,
    },
});

const ingredientsWithGrams = ref([]);
const gramsArray = ref([]);
import BaseSelect from '@/Components/BaseSelect.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import BaseInput from '@/Components/BaseInput.vue';
import { useToast } from 'vue-toastification';

const props = defineProps({
    products:{
        type:Array
    },
    ingredients:{
        type:Array
    }
});


const ingredientsWithGrams = ref([]);
const gramsArray = ref([]);

const form = useForm({
    product_id: 0,
    ingredient_id: [],
    amount_grams: [],
});

const productsOptions = computed(() => {
    return props.products.map((product) => {
        return { label: product.name, value: product.id };
    });
});

const toggleGrams = () => {
    gramsArray.value = [];
};
    product_id:0,
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

const createReceipe = () => {
    form.ingredient_id = ingredientsWithGrams.value.map((i) => i.id);
    form.amount_grams = gramsArray.value;
    form.post(route("receipe.store"), {
        onSuccess: () => {
            form.reset();
            ingredientsWithGrams.value = [];
            gramsArray.value = [];
            useToast().success("Create Receipe is successful.");
            ingredientsWithGrams.value = [];
            gramsArray.value = [];
            useToast().success('Create Receipe is successful.')
        },
        onError: () => {
            setTimeout(() => {
                form.clearErrors();
            }, 2000);
        },
    });
};
}

</script>


<template>
    <div class="py-8">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3"
            >
                <form @submit.prevent="createReceipe">
                    <h3 class="text-2xl text-center font-semibold mb-3">
                        Create Receipe
                    </h3>
                    <div class="space-y-4 max-w-5xl mx-auto">
                        <div>
                            <base-select
                                label="Product Name"
                                v-model="form.product_id"
                                :options="productsOptions"
                                :error="form.errors.product_id"
                                default-name="Product Name"
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
                                    v-model="gramsArray[ingredient.id]"
                                    :error="form.errors.amount_grams"
                                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                                />
                            </div>
                        </div>
                        <div>
                            <PrimaryButton>Create</PrimaryButton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</template>

