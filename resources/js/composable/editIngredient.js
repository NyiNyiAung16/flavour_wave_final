import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const errors = ref({});

const form = useForm({
    'name':'',
    'source':'',
    'amount':0,
    'unit_price':0
});

function getElements(index){
    const name = document.querySelector(`#name${index}`);
    const source = document.querySelector(`#source${index}`);
    const amount = document.querySelector(`#amount${index}`);
    const unitPrice = document.querySelector(`#unitPrice${index}`);
    const confirmBtn = document.querySelector(`#confirmBtn${index}`);
    const editBtn = document.querySelector(`#editBtn${index}`);
    const errorN = document.querySelector(`#errorname${index}`);
    const errorS = document.querySelector(`#errorsource${index}`);
    const errorA = document.querySelector(`#erroramount${index}`);
    const errorP = document.querySelector(`#errorprice${index}`);
    return { name,source,amount,unitPrice,confirmBtn,editBtn,errorA,errorN,errorP,errorS};
}


const showEdit = (e,ingredient,index) => {
    const { name,source,unitPrice,amount,confirmBtn,errorA,errorN,errorP,errorS} = getElements(index);
    e.target.classList.add('hidden');
    confirmBtn.classList.toggle('hidden');
    errorA.classList.toggle('hidden');
    errorN.classList.toggle('hidden');
    errorP.classList.toggle('hidden');
    errorS.classList.toggle('hidden');

    form.name = ingredient.name;
    form.source = ingredient.source;
    form.amount = ingredient.amount;
    form.unit_price = ingredient.unit_price;

    const ingredient_name = `<input type="text" value="${form.name}" class="w-fit p-1 text-white bg-transparent border-none outline-none" autofocus="true"/>`;
    const ingredient_source= `<input type="text" value="${form.source}" class="w-fit p-1 text-center text-white bg-transparent border-none outline-none" autofocus="true"/>`;
    const ingredient_amount = `<input type="number" value="${form.amount}" class="w-fit p-1 text-center text-white bg-transparent border-none outline-none" autofocus="true"/>`;
    const ingredient_unit_price = `<input type="number" value="${form.unit_price}" class="w-fit p-1 text-center text-white bg-transparent border-none outline-none" autofocus="true"/>`;

    name.innerHTML = ingredient_name;
    source.innerHTML = ingredient_source;
    unitPrice.innerHTML = ingredient_unit_price;
    amount.innerHTML = ingredient_amount;
};


const confrim = (index,ingredient) => {
    const { name,source,unitPrice,amount,confirmBtn,editBtn,errorA,errorN,errorP,errorS } = getElements(index);
    form.name = name.children[0].value;
    form.source = source.children[0].value;
    form.amount = amount.children[0].value;
    form.unit_price = unitPrice.children[0].value;
    form.patch(route('ingredient.patch',ingredient.id),{
        onSuccess:()=>{
            name.innerHTML = form.name;
            source.innerHTML = form.source;
            amount.innerHTML = form.amount;
            unitPrice.innerHTML = form.unit_price;
            confirmBtn.classList.toggle('hidden');
            editBtn.classList.toggle('hidden');
            errorA.classList.toggle('hidden');
            errorN.classList.toggle('hidden');
            errorP.classList.toggle('hidden');
            errorS.classList.toggle('hidden');
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