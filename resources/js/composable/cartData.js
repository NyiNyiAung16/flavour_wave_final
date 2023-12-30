import { ref } from "vue";
import { usePage, router } from "@inertiajs/vue3";

const page = usePage();

const totalPrice = ref(0);
const totalQuantity = ref(0);
const cartProducts = ref([]);
const productsId = ref([]);


const addToCarts= (e,product,userID) =>{
    if(!page.props.auth.user) {
        router.get(route('login'));
    }else{
        e.target.classList.remove('bg-green-600');
        e.target.classList.remove('hover:bg-green-700');
        e.target.classList.add('bg-green-800');
        e.target.setAttribute('disabled',true);
        
        let array = JSON.parse(localStorage.getItem(`addToCarts${userID}`)) ?? [];
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
        localStorage.setItem(`addToCarts${userID}`,JSON.stringify(array));
        cartProducts.value = array;
    }
}

function total(product){
    if(product){
        totalPrice.value = 0;
        totalQuantity.value = 0;
        productsId.value = [];
        product.forEach(p => {
            totalPrice.value+= p.quantity_price;
            totalQuantity.value+= p.quantity;
            productsId.value.push(p.id);
        });
    }
};

const fetchCartProducts = async(userID) => {
    cartProducts.value = await JSON.parse(localStorage.getItem(`addToCarts${userID}`));
}

const fetchCartDetails = async(userID)=>{
    await fetchCartProducts(userID);
    total(cartProducts.value);
}

const increaseProduct = (id,userID) => {
    const  product = cartProducts.value.find((p)=>p.id === id);
    ++product.quantity;
    product.quantity_price = product.quantity_price + product.base_price;
    localStorage.setItem(`addToCarts${userID}`,JSON.stringify(cartProducts.value));
    total(cartProducts.value);
}

const decreaseProduct = (id,userID) => {
    const  product = cartProducts.value.find((p)=>p.id === id);
    if(product.quantity > 0){
        --product.quantity;
        product.quantity_price = product.quantity_price - product.base_price;
        localStorage.setItem(`addToCarts${userID}`,JSON.stringify(cartProducts.value));
    }
    total(cartProducts.value);
};

const removeProduct = (id,userID) => {
    cartProducts.value = cartProducts.value.filter((p)=>{
        return p.id !== id;
    });
    localStorage.setItem(`addToCarts${userID}`,JSON.stringify(cartProducts.value));
}

export { fetchCartDetails, increaseProduct, decreaseProduct, removeProduct, addToCarts, fetchCartProducts, cartProducts,totalPrice,totalQuantity,productsId };
