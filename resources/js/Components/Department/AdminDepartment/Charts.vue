<script setup>



const options = {
    chart: {
        id: 'vuechart-example'
    },
    xaxis: {
        categories: ['OB', 'SI', 'R', 'A', 'SR', 'D', 'CB']
    },
    stroke: {
        curve: 'smooth',
    }
};

const series = [{
    name: 'daily-total-price',
    data: [22, 40, 45, 50, 49, 60, 70]
}];

const donutoptions = {
    series: [44, 55, 13, 33],
    labels: ['Apple', 'Mango', 'Orange', 'Watermelon'],
    chart:{
        type:'donut'
    }
}


</script>


<template>
    <div class="flex gap-x-4 flex-wrap">
        <div>
            <h2 class="text-xl font-semibold text-gray-100">Sales Department</h2>
            <apexchart class="text-black" width="500" type="area" :options="options" :series="series"></apexchart>
        </div>
        <!-- <apexchart class="text-black" width="500" type="bar" :options="options" :series="series"></apexchart>
        <apexchart class="text-black" width="500" type="line" :options="options" :series="series"></apexchart>
        <apexchart class="text-black" width="300" :options="donutoptions"></apexchart> -->
    </div>
</template>
