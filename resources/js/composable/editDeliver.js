import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const errors = ref({});

const form = useForm({
   'preorder_id':0,
   'driver_id':0,
   'quantity':0
});

function getElements(index){
    const preorderID = document.querySelector(`#preorderID${index}`);
    const driverID = document.querySelector(`#driverID${index}`);
    const quantity = document.querySelector(`#quantity${index}`);
    const confirmBtn = document.querySelector(`#confirmBtn${index}`);
    const editBtn = document.querySelector(`#editBtn${index}`);
    const errorP = document.querySelector(`#errorp${index}`);
    const errorD = document.querySelector(`#errord${index}`);
    const errorQ = document.querySelector(`#errorq${index}`);
    return { preorderID,driverID,quantity,confirmBtn,editBtn,errorD,errorP,errorQ };
}


const showEdit = (e,logistic,index) => {
    const { preorderID,driverID,quantity,confirmBtn,errorD,errorP,errorQ } = getElements(index);
    e.target.classList.add('hidden');
    confirmBtn.classList.toggle('hidden');
    errorP.classList.toggle('hidden');
    errorD.classList.toggle('hidden');
    errorQ.classList.toggle('hidden');

    form.preorder_id = logistic.preorder_id;
    form.driver_id = logistic.driver_id;
    form.quantity = logistic.quantity;

    const logistic_preorder_id = `<input type="number" value="${form.preorder_id}" class="input"/>`;
    const logistic_driver_id= `<input type="number" value="${form.driver_id}" class="input"/>`;
    const logistic_quantity = `<input type="number" value="${form.quantity}" class="input"/>`;

    preorderID.innerHTML = logistic_preorder_id;
    driverID.innerHTML = logistic_driver_id;
    quantity.innerHTML = logistic_quantity;

    preorderID.children[0].focus();
};


const confrim = (index,logistic) => {
    const { preorderID,driverID,quantity,confirmBtn,editBtn,errorD,errorP,errorQ } = getElements(index);
    form.preorder_id = preorderID.children[0].value;
    form.driver_id = driverID.children[0].value;
    form.quantity = quantity.children[0].value;
    form.patch(route('logistic.patch',logistic.id),{
        onSuccess:()=>{
            preorderID.innerHTML = form.preorder_id;
            driverID.innerHTML = form.driver_id;
            quantity.innerHTML = form.quantity;
            confirmBtn.classList.toggle('hidden');
            editBtn.classList.toggle('hidden');
            errorP.classList.toggle('hidden');
            errorD.classList.toggle('hidden');
            errorQ.classList.toggle('hidden');
        },
        onError:()=>{
            errors.value = form.errors;
            if(form.errors.preorder_id){
                preorderID.children[0].style.outline = '1px solid red';
            }else if(form.errors.driver_id){
                driverID.children[0].style.outline = '1px solid red';
            }else if(form.errors.quantity){
                quantity.children[0].style.outline = '1px solid red';
            }
            setTimeout(()=>{
                errors.value = {};
                preorderID.children[0].style.outline = 'none';
                driverID.children[0].style.outline = 'none';
                quantity.children[0].style.outline = 'none';
            },2000);    
        },
        preserveScroll:true 
    });
}

export { showEdit, confrim, errors };   