import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const errors = ref({});

const form = useForm({
   'name':'',
   'vehicle_number':'',
   'isFree':false
});

function getElements(index){
    const name = document.querySelector(`#name${index}`);
    const vehicle_number = document.querySelector(`#vehicle_number${index}`);
    const isFree = document.querySelector(`#isFree${index}`);
    const confirmBtn = document.querySelector(`#confirmBtn${index}`);
    const editBtn = document.querySelector(`#editBtn${index}`);
    const errorN = document.querySelector(`#errorname${index}`);
    const errorV = document.querySelector(`#errornumber${index}`);
    const errorF = document.querySelector(`#errorisFree${index}`);
    return { name,vehicle_number,isFree,confirmBtn,editBtn,errorF,errorN,errorV};
}


const showEdit = (e,driver,index) => {
    const { name,vehicle_number,isFree,confirmBtn,errorF,errorN,errorV } = getElements(index);
    e.target.classList.add('hidden');
    confirmBtn.classList.toggle('hidden');
    errorN.classList.toggle('hidden');
    errorV.classList.toggle('hidden');
    errorF.classList.toggle('hidden');

    form.name = driver.name;
    form.vehicle_number = driver.vehicle_number;
    form.isFree = driver.isFree ? true : false;

    const driver_name = `<input type="text" value="${form.name}" class="input"/>`;
    const driver_vehicle_number= `<input type="text" value="${form.vehicle_number}" class="input"/>`;
    const driver_isFree = `<input type="checkbox" ${form.isFree ? 'checked' : ''} class="input"/>`;

    name.innerHTML = driver_name;
    vehicle_number.innerHTML = driver_vehicle_number;
    isFree.innerHTML = driver_isFree;

    name.children[0].focus();
};


const confrim = (index,driver) => {
    const { name,vehicle_number,isFree,confirmBtn,editBtn,errorF,errorN,errorV } = getElements(index);
    form.name = name.children[0].value;
    form.vehicle_number = vehicle_number.children[0].value;
    form.isFree = isFree.children[0].checked;
    form.patch(route('driver.patch',driver.id),{
        onSuccess:()=>{
            name.innerHTML = form.name;
            vehicle_number.innerHTML = form.vehicle_number;
            isFree.innerHTML = form.isFree ? 'Free' : 'Busy';
            confirmBtn.classList.toggle('hidden');
            editBtn.classList.toggle('hidden');
            errorF.classList.toggle('hidden');
            errorN.classList.toggle('hidden');
            errorV.classList.toggle('hidden');
        },
        onError:()=>{
            errors.value = form.errors;
            if(form.errors.name){
                name.children[0].style.outline = '1px solid red';
            }else if(form.errors.vehicle_number){
                vehicle_number.children[0].style.outline = '1px solid red';
            }else if(form.errors.isFree){
                isFree.children[0].style.outline = '1px solid red';
            }
            setTimeout(()=>{
                errors.value = {};
                name.children[0].style.outline = 'none';
                vehicle_number.children[0].style.outline = 'none';
                isFree.children[0].style.outline = 'none';
            },2000);    
        },
        preserveScroll:true 
    });
}

export { showEdit, confrim, errors };   