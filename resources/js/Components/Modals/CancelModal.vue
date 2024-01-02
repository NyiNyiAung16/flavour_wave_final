<script setup>
import { ref, watch,nextTick } from 'vue';
import Modal from '../Modal.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    preorder_id:{
        type:Number
    },
    cancelconfrimation:{
        type:Boolean
    }
});

const emits = defineEmits(['cancelModal']);

const cancelInput = ref(null);

watch(
    ()=>props.cancelconfrimation,
    ()=>{
        if(props.cancelconfrimation){
            nextTick(()=>cancelInput.value.focus());
        }
    }
);

const form = useForm({
    'cancel_reason':''
});

const confrimedCancel = () => {
    form.patch(route('preorder.patch',props.preorder_id),{
        onSuccess:()=>closeCancelModal(),
        onError: () => {
            cancelInput.value.focus(),
            setTimeout(() => {
                form.clearErrors();
            }, 2000);
        },
        onFinish: () => form.reset(),
    });
}

const closeCancelModal = () => {
    emits('cancelModal');
}

const cancel = () => {
    closeCancelModal();
}

</script>


<template>
    <Modal :show="cancelconfrimation" @close="closeCancelModal">
        <div class="p-5">
            <header>
                <h2 class="font-bold text-xl mb-3 text-white">Are you sure you want to cancel this preorder? If so, can you write the reason about the preorder.</h2>
            </header>
            <div>
                <textarea v-model="form.cancel_reason" ref="cancelInput" rows="3" class="w-full bg-gray-900 mb-2 text-white resize-none p-2 rounded border-none outline-none"></textarea>
                <p class="text-sm my-1 text-red-500" v-if="form.errors.cancel_reason">{{ form.errors.cancel_reason }}</p>
                <button class="px-2 py-1 rounded text-gray-200 bg-blue-500 hover:bg-blue-600 duration-200 font-semibold" @click="confrimedCancel">confrim</button>
                <button class="px-2 py-1 rounded text-gray-200 bg-red-500 hover:bg-red-600 duration-200 font-semibold ms-2" @click="cancel">cancel</button>
            </div>
        </div>
    </Modal>
</template>

