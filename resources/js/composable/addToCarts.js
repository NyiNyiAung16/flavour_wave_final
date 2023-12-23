import { usePage, router } from "@inertiajs/vue3";

const page = usePage();

export default function addToCarts(e,product) {
    if(!page.auth) {
        router.get(route('login'));
    }else{
        e.target.classList.remove('bg-green-600');
        e.target.classList.remove('hover:bg-green-700');
        e.target.classList.add('bg-green-800');
        e.target.setAttribute('disabled',true);
        
        let array = JSON.parse(localStorage.getItem('addToCarts')) ?? [];
        let data = {
            id:product.id,
            productName:product.name,
            imageUrl:product.image_url,
            base_price:product.unit_price,
            quantity_price:product.unit_price,
            quantity:1
        };
        if(!array.includes(data)){
            array.push(data);
        }
        localStorage.setItem('addToCarts',JSON.stringify(array));
    }

}