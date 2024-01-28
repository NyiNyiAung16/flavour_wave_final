import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const errors = ref({});

const form = useForm({
    'product_id':0,
    'expected':0,
    'actual':0
});

function getElements(index){
    const productID = document.querySelector(`#productID${index}`);
    const expected = document.querySelector(`#expected${index}`);
    const actual = document.querySelector(`#actual${index}`);
    const confirmBtn = document.querySelector(`#confirmBtn${index}`);
    const editBtn = document.querySelector(`#editBtn${index}`);
    const errorI = document.querySelector(`#errorid${index}`);
    const errorE = document.querySelector(`#errorexpected${index}`);
    const errorA = document.querySelector(`#erroractual${index}`);
    return { productID,expected,actual,confirmBtn,editBtn,errorA,errorE,errorI};
}


const showEdit = (e,factory,index) => {
    const { productID,expected,actual,confirmBtn,errorA,errorE,errorI } = getElements(index);
    e.target.classList.add('hidden');
    confirmBtn.classList.toggle('hidden');
    errorA.classList.toggle('hidden');
    errorI.classList.toggle('hidden');
    errorE.classList.toggle('hidden');

    form.product_id = factory.product_id;
    form.expected = factory.expected;
    form.actual = factory.actual;

    const factory_product_id = `<input type="number" value="${form.product_id}" class="input"/>`;
    const factory_expected= `<input type="number" value="${form.expected}" class="input"/>`;
    const factory_actual = `<input type="number" value="${form.actual}" class="input"/>`;

    productID.innerHTML = factory_product_id;
    expected.innerHTML = factory_expected;
    actual.innerHTML = factory_actual;
    productID.children[0].focus();
};


const confrim = (index,factory) => {
    const { productID,expected,actual,confirmBtn,editBtn,errorA,errorE,errorI } = getElements(index);
    form.product_id = productID.children[0].value;
    form.expected = expected.children[0].value;
    form.actual = actual.children[0].value;
    form.patch(route('factory.patch',factory.id),{
        onSuccess:()=>{
            productID.innerHTML = form.product_id;
            expected.innerHTML = form.expected;
            actual.innerHTML = form.actual;
            confirmBtn.classList.toggle('hidden');
            editBtn.classList.toggle('hidden');
            errorA.classList.toggle('hidden');
            errorI.classList.toggle('hidden');
            errorE.classList.toggle('hidden');
        },
        onError:()=>{
            errors.value = form.errors;
            if(form.errors.product_id){
                productID.children[0].style.outline = '1px solid red';
            }else if(form.errors.expected){
                expected.children[0].style.outline = '1px solid red';
            }else if(form.errors.actual){
                actual.children[0].style.outline = '1px solid red';
            }
            setTimeout(()=>{
                errors.value = {};
                productID.children[0].style.outline = 'none';
                expected.children[0].style.outline = 'none';
                actual.children[0].style.outline = 'none';
            },2000);    
        },
        preserveScroll:true 
    });
}

export { showEdit, confrim, errors };   