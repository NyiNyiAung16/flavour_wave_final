import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const errors = ref({});

const form = useForm({
    'product_id':0,
    'opening_balance':0,
    'sales_issue':0,
    'received':0,
    'availability':0,
    'sales_return':0,
    'damage':0,
    'closing_balance':0
});

function getElements(index){
    const productid = document.querySelector(`#productid${index}`);
    const opening = document.querySelector(`#opening${index}`);
    const salesIss = document.querySelector(`#salesIss${index}`);
    const received = document.querySelector(`#received${index}`);
    const avail = document.querySelector(`#avail${index}`);
    const salesRe = document.querySelector(`#salesRe${index}`);
    const damage = document.querySelector(`#damage${index}`);
    const closing = document.querySelector(`#closing${index}`);
    const confirmBtn = document.querySelector(`#confirmBtn${index}`);
    const editBtn = document.querySelector(`#editBtn${index}`);
    const errorid = document.querySelector(`#errorid${index}`);
    const errorop = document.querySelector(`#errorop${index}`);
    const errorsal = document.querySelector(`#errorsal${index}`);
    const errorrec = document.querySelector(`#errorrec${index}`);
    const errorava = document.querySelector(`#errorava${index}`);
    const errorsalr = document.querySelector(`#errorsalr${index}`);
    const errordam = document.querySelector(`#errordam${index}`);
    const errorclo = document.querySelector(`#errorclo${index}`);
    return { confirmBtn,editBtn,productid,opening,salesIss,received,avail,salesRe,damage,closing,errorid,errorop,errorsal,errorrec,errorava,errorsalr,errordam,errorclo };
}


const showEdit = (e,warehouse,index) => {
    const {  confirmBtn,productid,opening,salesIss,received,avail,salesRe,damage,closing,errorid,errorop,errorsal,errorrec,errorava,errorsalr,errordam,errorclo } = getElements(index);
    e.target.classList.add('hidden');
    confirmBtn.classList.toggle('hidden');
    errorid.classList.toggle('hidden');
    errorop.classList.toggle('hidden');
    errorsal.classList.toggle('hidden');
    errorrec.classList.toggle('hidden');
    errorava.classList.toggle('hidden');
    errorsalr.classList.toggle('hidden');
    errordam.classList.toggle('hidden');
    errorclo.classList.toggle('hidden');

    form.product_id = warehouse.product_id;
    form.opening_balance = warehouse.opening_balance;
    form.sales_issue = warehouse.sales_issue;
    form.received = warehouse.received;
    form.availability = warehouse.availability;
    form.sales_return = warehouse.sales_return;
    form.damage = warehouse.damage;
    form.closing_balance = warehouse.closing_balance;

    const product_id = `<input type="number" value="${form.product_id}" class="input"/>`;
    const opening_balance = `<input type="number" value="${form.opening_balance}" class="input"/>`;
    const sales_issue = `<input type="number" value="${form.sales_issue}" class="input"/>`;
    const warehouse_received = `<input type="number" value="${form.received}" class="input"/>`;
    const availability = `<input type="number" value="${form.availability}" class="input"/>`;
    const sales_return = `<input type="number" value="${form.sales_return}" class="input"/>`;
    const warehouse_damage = `<input type="number" value="${form.damage}" class="input"/>`;
    const closing_balance = `<input type="number" value="${form.closing_balance}" class="input"/>`;

    productid.innerHTML = product_id;
    opening.innerHTML = opening_balance;
    salesIss.innerHTML = sales_issue;
    received.innerHTML = warehouse_received;
    avail.innerHTML = availability;
    salesRe.innerHTML = sales_return;
    damage.innerHTML = warehouse_damage;
    closing.innerHTML = closing_balance;

    productid.children[0].focus();

};


const confrim = (index,warehouse) => {
    const {  confirmBtn,editBtn,productid,opening,salesIss,received,avail,salesRe,damage,closing,errorid,errorop,errorsal,errorrec,errorava,errorsalr,errordam,errorclo } = getElements(index);
    form.product_id = productid.children[0].value;
    form.opening_balance = opening.children[0].value;
    form.sales_issue = salesIss.children[0].value;
    form.received = received.children[0].value;
    form.availability = avail.children[0].value;
    form.sales_return = salesRe.children[0].value;
    form.damage = damage.children[0].value;
    form.closing_balance = closing.children[0].value;
    //form patch
    form.patch(route('warehouse.patch',warehouse.id),{
        onSuccess:()=>{
            productid.innerHTML = form.product_id;
            opening.innerHTML = form.opening_balance;
            salesIss.innerHTML = form.sales_issue;
            received.innerHTML = form.received;
            avail.innerHTML = form.availability;
            salesRe.innerHTML = form.sales_return;
            damage.innerHTML = form.damage;
            closing.innerHTML = form.closing_balance;
            //toggle
            confirmBtn.classList.toggle('hidden');
            editBtn.classList.toggle('hidden');
            errorid.classList.toggle('hidden');
            errorop.classList.toggle('hidden');
            errorsal.classList.toggle('hidden');
            errorrec.classList.toggle('hidden');
            errorava.classList.toggle('hidden');
            errorsalr.classList.toggle('hidden');
            errordam.classList.toggle('hidden');
            errorclo.classList.toggle('hidden');
        },
        onError:()=>{
            errors.value = form.errors;
            if(form.errors.product_id){
                productid.children[0].style.outline = '1px solid red';
            }else if(form.errors.opening_balance){
                opening.children[0].style.outline = '1px solid red';
            }else if(form.errors.sales_issue){
                salesIss.children[0].style.outline = '1px solid red';
            }else if(form.errors.received){
                received.children[0].style.outline = '1px solid red';
            }else if(form.errors.availability){
                avail.children[0].style.outline = '1px solid red';
            }else if(form.errors.sales_return){
                salesRe.children[0].style.outline = '1px solid red';
            }else if(form.errors.damage){
                damage.children[0].style.outline = '1px solid red';
            }else if(form.errors.closing_balance){
                closing.children[0].style.outline = '1px solid red';
            }
            setTimeout(()=>{
                errors.value = {};
                productid.children[0].style.outline = 'none';
                opening.children[0].style.outline = 'none'; 
                salesIss.children[0].style.outline = 'none'; 
                received.children[0].style.outline = 'none'; 
                avail.children[0].style.outline = 'none'; 
                salesRe.children[0].style.outline = 'none'; 
                damage.children[0].style.outline = 'none'; 
                closing.children[0].style.outline = 'none'; 
            },2000);    
        },
        preserveScroll:true 
    });
}


export { showEdit, confrim, errors };