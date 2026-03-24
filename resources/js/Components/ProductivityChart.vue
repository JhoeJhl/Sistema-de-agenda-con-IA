<template>
    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-xl flex flex-col h-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                Productividad Semanal
            </h3>
        </div>
        
        <div class="flex-1 w-full -ml-2">
            <apexchart 
                type="area" 
                height="100%" 
                :options="chartOptions" 
                :series="series"
            ></apexchart>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import VueApexCharts from 'vue3-apexcharts';
const apexchart = VueApexCharts;
const props = defineProps({
    data: Object
});
const series = ref([
    { name: 'Tareas Completadas', data: props.data.tareas_completadas },
    { name: 'Horas Invertidas', data: props.data.horas_invertidas }
]);
const chartOptions = ref({
    chart: { 
        type: 'area', 
        toolbar: { show: false }, 
        fontFamily: 'inherit',
        background: 'transparent' 
    },
    colors: ['#6366f1', '#10b981'], 
    fill: { 
        type: 'gradient', 
        gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.05, stops: [0, 100] } 
    },
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth', width: 3 }, 
    xaxis: { 
        categories: props.data.dias, 
        axisBorder: { show: false }, 
        axisTicks: { show: false },
        labels: { style: { colors: '#94a3b8' } } 
    },
    yaxis: { show: false }, 
    grid: { 
        borderColor: 'rgba(255,255,255,0.05)', 
        strokeDashArray: 4, 
        xaxis: { lines: { show: true } },   
        yaxis: { lines: { show: false } },
    },
    theme: { mode: 'dark' },
    tooltip: { theme: 'dark' },
    legend: { position: 'top', horizontalAlign: 'right', labels: { colors: '#cbd5e1' } }
});
</script>