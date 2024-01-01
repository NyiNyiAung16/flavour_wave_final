import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const errors = ref({});

const form = useForm({
    'product_id':0,
    'ingredient_id':0,
    'amount_grams':0
});

function getElements(index){
    const productID = document.querySelector(`#productID${index}`);
    const ingredientID = document.querySelector(`#ingredientID${index}`);
    const amountGrams = document.querySelector(`#amountGrams${index}`);
    const confirmBtn = document.querySelector(`#confirmBtn${index}`);
    const editBtn = document.querySelector(`#editBtn${index}`);
    const errorI = document.querySelector(`#errorIngredientId${index}`);
    const errorP = document.querySelector(`#errorProductId${index}`);
    const errorG = document.querySelector(`#errorGramsId${index}`);
    return { productID,ingredientID,amountGrams,confirmBtn,editBtn,errorG,errorI,errorP };
}


const showEdit = (e,receipe,index) => {
    const { productID,ingredientID,amountGrams,confirmBtn,errorG,errorI,errorP } = getElements(index);
    e.target.classList.add('hidden');
    confirmBtn.classList.toggle('hidden');
    errorG.classList.toggle('hidden');
    errorI.classList.toggle('hidden');
    errorP.classList.toggle('hidden');

    form.product_id = receipe.product_id;
    form.ingredient_id = receipe.ingredient_id;
    form.amount_grams = receipe.amount_grams;

    const product_id = `<input type="number" value="${form.product_id}" class="w-fit p-1 text-center text-white bg-transparent border-none outline-none" autofocus="true"/>`;
    const ingredient_id = `<input type="number" value="${form.ingredient_id}" class="w-fit p-1 text-white bg-transparent border-none outline-none" autofocus="true"/>`;
    const grams = `<input type="number" value="${form.amount_grams}" class="w-fit p-1 text-center text-white bg-transparent border-none outline-none" autofocus="true"/>`;

    productID.innerHTML = product_id;
    ingredientID.innerHTML = ingredient_id;
    amountGrams.innerHTML = grams;

};


const confrim = (index,receipe) => {
    const { productID,ingredientID,amountGrams,editBtn,confirmBtn,errorG,errorI,errorP } = getElements(index);
    form.product_id = productID.children[0].value;
    form.ingredient_id = ingredientID.children[0].value;
    form.amount_grams =amountGrams.children[0].value;
    form.patch(route('receipe.patch',receipe.id),{
        onSuccess:()=>{
            productID.innerHTML = form.product_id;
            ingredientID.innerHTML = form.ingredient_id;
            amountGrams.innerHTML = form.amount_grams;
            confirmBtn.classList.toggle('hidden');
            editBtn.classList.toggle('hidden');
            errorG.classList.toggle('hidden');
            errorI.classList.toggle('hidden');
            errorP.classList.toggle('hidden');
        },
        onError:()=>{
            errors.value = form.errors;
            setTimeout(()=>{
                errors.value = {}
            },2000);    
        },
        preserveScroll:true 
    });
}

export { showEdit, confrim, errors };