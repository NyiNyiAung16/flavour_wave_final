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

    const driver_name = `<input type="text" value="${form.name}" class="w-fit p-1 text-center text-white bg-transparent border-none outline-none" autofocus="true"/>`;
    const driver_vehicle_number= `<input type="text" value="${form.vehicle_number}" class="w-fit p-1 text-center text-white bg-transparent border-none outline-none" autofocus="true"/>`;
    const driver_isFree = `<input type="checkbox" value="${form.isFree}" class="w-fit p-1 text-center bg-gray-200 rounded border-none outline-none" autofocus="true"/>`;

    name.innerHTML = driver_name;
    vehicle_number.innerHTML = driver_vehicle_number;
    isFree.innerHTML = driver_isFree;
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
            isFree.innerHTML = form.isFree;
            confirmBtn.classList.toggle('hidden');
            editBtn.classList.toggle('hidden');
            errorF.classList.toggle('hidden');
            errorN.classList.toggle('hidden');
            errorV.classList.toggle('hidden');
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