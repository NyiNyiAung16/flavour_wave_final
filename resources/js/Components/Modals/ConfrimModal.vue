<script setup>
import Modal from '../Modal.vue'
import { router } from '@inertiajs/vue3'


const props = defineProps({
    preorder_id:{
        type:Number
    },
    confrimation:{
        type:Boolean
    }
});

const emits = defineEmits(['hideModal']);

const confrimed = () => {
    router.post(route('preorder.confrim',props.preorder_id),{},{
        onSuccess:() => closeModal()
    });
}

const closeModal = () => {
    emits('hideModal');
}

const cancel = () => {
    closeModal();
}

</script>


<template>
    <Modal :show="confrimation" @close="closeModal">
        <div class="p-6">
            <h2 class="font-bold text-xl my-2 text-white">Are you sure you want to confrim this preorder?</h2>
            <button class="px-2 py-1 rounded text-gray-200 bg-blue-500 hover:bg-blue-600 duration-200 font-semibold" @click="confrimed">confrim</button>
            <button class="px-2 py-1 rounded text-gray-200 bg-red-500 hover:bg-red-600 duration-200 font-semibold ms-2" @click="cancel">cancel</button>
        </div>
    </Modal>
</template>

