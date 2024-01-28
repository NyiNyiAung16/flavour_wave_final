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

    const ingredient_name = `<input type="text" value="${form.name}" class="input"/>`;
    const ingredient_source= `<input type="text" value="${form.source}" class="input"/>`;
    const ingredient_amount = `<input type="number" value="${form.amount}" class="input"/>`;
    const ingredient_unit_price = `<input type="number" value="${form.unit_price}" class="input"/>`;

    name.innerHTML = ingredient_name;
    source.innerHTML = ingredient_source;
    unitPrice.innerHTML = ingredient_unit_price;
    amount.innerHTML = ingredient_amount;

    name.children[0].focus();
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
            if(form.errors.name){
                name.children[0].style.outline = '1px solid red';
            }else if(form.errors.amount){
                amount.children[0].style.outline = '1px solid red';
            }else if(form.errors.source){
                source.children[0].style.outline = '1px solid red';
            }else if(form.errors.unit_price){
                unitPrice.children[0].style.outline = '1px solid red';
            }
            setTimeout(()=>{
                errors.value = {};
                name.children[0].style.outline = 'none';
                amount.children[0].style.outline = 'none';
                source.children[0].style.outline = 'none';
                unitPrice.children[0].style.outline = 'none';
            },2000);    
        },
        preserveScroll:true 
    });
}

export { showEdit, confrim, errors };   