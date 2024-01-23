<script setup>
import Body from '@/Components/Table/Body.vue'
import Button from '@/Components/Button.vue'
import { router } from '@inertiajs/vue3'
import { showEdit, confrim, errors } from '../../../composable/editDeliver'

defineProps({
    logistics:{
        type:Array
    }
});

const deleteLogistic = (id) => {
    router.delete(route('logistic.destroy',id));
}

const edit = (e,logistic,index) => {
    showEdit(e,logistic,index);
}

const confrimData = (index,logistic) => {
    confrim(index,logistic);
}

</script>


<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th class="py-3 text-center">Preorder ID</th>
                    <th class="py-3 text-center">Driver ID</th>
                    <th class="py-3 text-center">Quantity</th>
                    <th class="py-3 text-center">Status</th>
                    <th class="py-3 text-center">Deliver Date</th>
                    <th class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(logistic,index) in logistics" :key="logistic.id">
                    <td class="py-4">{{index}}</td>
                    <Body
                        :text-id="`preorderID${index}`"
                        :error-id="`errorp${index}`"
                        :value="logistic.preorder_id"
                        :error="errors.preorder_id"
                    />
                    <Body
                        :text-id="`driverID${index}`"
                        :error-id="`errord${index}`"
                        :value="logistic.driver_id"
                        :error="errors.driver_id"
                    />
                    <Body
                        :text-id="`quantity${index}`"
                        :error-id="`errorq${index}`"
                        :value="logistic.quantity"
                        :error="errors.quantity"
                    />
                    <td class="py-4 text-center">{{logistic.status}}</td>
                    <td class="py-4 text-center">{{new Date(logistic.created_at).toLocaleDateString()}}</td>
                    <td class="py-4 space-x-3 text-center">
                        <Button
                            type="button"
                            text="Edit"
                            :id="`editBtn${index}`"
                            class=" text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                            @click="edit($event,logistic,index)"
                        />
                        <Button
                            type="button"
                            text="Confrim"
                            :id="`confirmBtn${index}`"
                            class="hidden text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline"
                            @click="confrimData(index,logistic)"
                        />
                        <Button
                            type="button"
                            text="Delete"
                            class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline"
                            @click="deleteLogistic(logistic.id)"
                        />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

