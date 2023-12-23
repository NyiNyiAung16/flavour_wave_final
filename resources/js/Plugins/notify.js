import { useToast } from 'vue-toastification'
import { usePage,router } from '@inertiajs/vue3'

const toast = useToast();

export const notify = () => {
    router.on('finish',()=>{
        const notification = usePage().props.message;
        if(notification?.type && notification?.content){
            toast(notification.content,{
                type:notification.type,
                timeout:2000
            });
        }
    });
}