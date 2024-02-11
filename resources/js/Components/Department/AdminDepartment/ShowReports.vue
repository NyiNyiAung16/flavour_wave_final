<script setup>
import TableLayout from '@/Layouts/TableLayout.vue';
import { ref, computed } from 'vue';
import { filteredById } from '@/composable/search';

const props = defineProps({
    reports:{
        type:Array,
        default:[]
    }
});

const headers = ref(['Id','Report','Created_at']);
const search = ref('');

const filteredReports = computed(()=>{
    return filteredById(search.value,props.reports)
});



</script>


<template>
    <div  v-if="reports.length > 0">
        <div class="flex justify-between items-center">
            <Search 
                @searching="(val) => search = val" 
                :howToSearch="'Id'" 
                class="w-3/4"
            />
            <Sorting 
                :items="filteredReports" 
                sort-by="id" 
                @sorted="(val) => reports = val"
                class="w-[370px]"
            />
        </div>
        <div class="sm:rounded-lg" :class="{'overflow-x-scroll': filteredReports.length > 0}">
            <TableLayout
                :headers="headers"
                :is-admin="$page.props.auth.user.isAdmin" 
                :is-department="$page.props.auth.user.department.name === 'ADMIN'"
                v-if="filteredReports.length > 0"
            >
                <template #tbody>
                    <tr class="border-b item" v-for="(report,index) in filteredReports" :key="report.created_at">
                        <td class="py-4 text-center">{{ index }}</td>
                        <td class="py-4 text-center">{{ report.id }}</td>
                        <td class="py-4">{{ report.body }}</td>
                        <td class="py-4 text-center">{{ new Date(report.created_at).toLocaleDateString() }}</td>
                        <td class="py-4 space-x-3 text-center">
                            <button class=" text-blue-500 hover:text-blue-600 duration-150 font-bold hover:underline" @click="editReport(report.id)">Edit</button>
                            <button class="text-red-500 hover:text-red-600 duration-150 font-bold hover:underline" @click="deleteReport(report.id)">Delete</button>
                        </td>
                    </tr>
                </template>
            </TableLayout>
            <template v-else>
                <NoResults/>
            </template>
        </div>
    </div>
    <div v-else>
        <p>Don't have any reports!</p>
    </div>
</template>

