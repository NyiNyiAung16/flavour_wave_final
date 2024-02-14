<script setup>
import { ref } from 'vue';

const emits = defineEmits(['sorted']);

const props = defineProps({
    sortBy:{
        type:String,
        default:'name'
    },
    items:{
        type:Array,
        default:[]
    }
});

const direction = ref('asc');
const directionForTime = ref('asc');
const shallowItems = ref([...props.items]);


const sorting = (sortBy) => {
    switch(sortBy){
        case 'name' || 'product_name':
            shallowItems.value = shallowItems.value.sort((a,b) => {
                if(direction.value === 'asc'){
                    return a[sortBy].localeCompare(b[sortBy]);
                }else{
                    return b[sortBy].localeCompare(a[sortBy]);
                }
            });
        break;
        case 'created_at':
            if(directionForTime.value === 'asc'){
                directionForTime.value = 'desc';
            }else{
                directionForTime.value = 'asc';
            }
            shallowItems.value = sortByTimeOrId(shallowItems.value,sortBy);
        break;
        default:
            shallowItems.value = sortByTimeOrId(shallowItems.value,sortBy);
        break;
    }

    if(direction.value === 'asc' && sortBy !== 'created_at'){
        direction.value = 'desc' 
    }else{
        direction.value = 'asc';
    }
    console.log(shallowItems.value)
    emits('sorted',shallowItems.value);
}


function sortByTimeOrId(items,sortBy){
    return items.sort((a,b) => {
        if(direction.value === 'asc'){
            return b[sortBy] < a[sortBy] ? -1 : 1 ;
        }else{
            return a[sortBy] < b[sortBy] ? -1 : 1 ;
        }
    });
}


</script>


<template>
    <div class="flex gap-5 items-center font-medium">
        <p>Sort By 
            <span class="cursor-pointer inline-block font-bold capitalize"  @click="sorting(sortBy)">{{ sortBy }}</span>
            <i 
                class="fa-solid ms-1 fa-angle-up transition-transform duration-700" 
                :class="{'rotate-180':direction === 'asc','rotate-270':direction === 'desc'}"
            ></i>       
        </p>
        <p>Sort By 
            <span class="cursor-pointer inline-block font-bold" @click="sorting('created_at')">Created_At</span>
            <i 
                class="fa-solid ms-1 fa-angle-up transition-transform duration-700" 
                :class="{'rotate-180':directionForTime === 'asc','rotate-270':directionForTime === 'desc'}"
            ></i>       
        </p>
    </div>
</template>

