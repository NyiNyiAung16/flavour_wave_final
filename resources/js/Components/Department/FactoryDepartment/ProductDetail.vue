<script setup>
import Body from '@/Components/Table/Body.vue'
import Button from '@/Components/Button.vue'
import { router } from '@inertiajs/vue3';
import { showEdit, confrim, errors } from '../../../composable/editProductDetail'

const props = defineProps({
    factories:{
        type:Array
    }
});

const deleteFactory = ( id ) => {
    router.delete(route('factory.destroy',id));
}

const edit = (e,factory,index) => {
    showEdit(e,factory,index);
}

const confrimData = (index,factory) => {
    confrim(index,factory);
}


</script>


<template>
    <table class="w-full">
        <thead>
            <tr class="text-left border-b head">
                <th class="py-3 pe-2">No.</th>
                <th class="py-3 text-center">Product ID</th>
                <th class="py-3 text-center">Expected</th>
                <th class="py-3 text-center">Actual</th>
                <th class="py-3 text-center">Store To Warehouse</th>
                <th class="py-3 text-center">Created_at</th>
                <th class="py-3 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b item" v-for="(factory,index) in factories" :key="factory.id">
                <td class="py-4">{{index}}</td>
                <Body
                    :text-id="`productID${index}`"
                    :error-id="`errorid${index}`"
                    :value="factory.product_id"
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
                <td class="py-4 text-center">{{factory.isStore}}</td>
                <td class="py-4 text-center">{{new Date(factory.created_at).toLocaleDateString()}}</td>
                <td class="py-4 space-x-3 text-center">
                    <Button
                        type="button"
                        text="Edit"
                        :id="`editBtn${index}`"
                        class=" text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                        @click="edit($event,factory,index)"
                    />
                    <Button
                        type="button"
                        text="Confrim"
                        :id="`confirmBtn${index}`"
                        class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                        @click="confrimData(index,factory)"
                    />
                    <Button
                        type="button"
                        text="Delete"
                        class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline"
                        @click="deleteFactory(factory.id)"
                    />
                </td>
            </tr>
        </tbody>
    </table>
</template>

