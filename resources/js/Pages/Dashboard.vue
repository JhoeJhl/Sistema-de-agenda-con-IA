<template>

    <Head title="Dashboard" />

    <div class="min-h-screen bg-[#0f172a] p-4 sm:p-8 overflow-hidden relative font-sans">

        <div class="absolute top-0 left-10 w-96 h-96 bg-indigo-600/20 rounded-full blur-[120px] pointer-events-none">
        </div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-cyan-600/20 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto relative z-10">

            <header class="mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white tracking-tight">Hola, Joel</h1>
                    <p class="text-gray-400 mt-1">Aquí tienes el resumen de tu jornada.</p>
                </div>
                <button
                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-medium transition-colors shadow-lg shadow-indigo-500/30">
                    + Nuevo Evento
                </button>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 space-y-6">

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div v-for="stat in stats" :key="stat.label"
                            class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-4 text-center">
                            <p class="text-3xl font-bold text-white">{{ stat.value }}</p>
                            <p class="text-xs text-gray-400 mt-1 uppercase tracking-wider">{{ stat.label }}</p>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-indigo-900/40 to-purple-900/40 backdrop-blur-xl border border-indigo-500/30 rounded-3xl p-6 shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-20">
                            <svg class="w-24 h-24 text-indigo-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-indigo-200 mb-3 flex items-center gap-2">
                            <span>✨</span> Análisis de tu Asistente
                        </h2>
                        <p class="text-gray-300 leading-relaxed text-lg">
                            Hoy tienes una agenda enfocada en desarrollo y estudios. Te sugiero repasar la lógica de los
                            controladores en Laravel antes de tu sesión de programación de la tarde. Tienes un hueco
                            libre de 2 horas a las 15:00, ideal para avanzar con tus prácticas de Python.
                        </p>
                    </div>

                    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-6">
                        <h2 class="text-xl font-semibold text-white mb-4">Tareas Pendientes</h2>
                        <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-6">
                            <h2 class="text-xl font-semibold text-white mb-4">Tareas Pendientes</h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                <div v-for="tarea in tareas" :key="tarea.id"
                                    class="group flex flex-col justify-between p-5 bg-white/5 hover:bg-white/10 border border-white/10 rounded-2xl transition-all duration-300 cursor-pointer hover:-translate-y-1 hover:shadow-lg hover:shadow-indigo-500/10">

                                    <div>
                                        <h3
                                            class="text-gray-200 font-medium leading-tight mb-1 group-hover:text-indigo-300 transition-colors">
                                            {{ tarea.titulo }}
                                        </h3>
                                        <p class="text-xs text-gray-500">{{ tarea.proyecto }}</p>
                                    </div>

                                    <div class="mt-6 flex items-center justify-between">
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full border"
                                            :class="tarea.prioridad === 'Alta' ? 'bg-red-500/10 text-red-400 border-red-500/20' : 'bg-blue-500/10 text-blue-400 border-blue-500/20'">
                                            {{ tarea.prioridad }}
                                        </span>

                                        <div
                                            class="w-6 h-6 rounded-full border-2 border-gray-500 group-hover:border-indigo-400 group-hover:bg-indigo-500/20 transition-all flex items-center justify-center">
                                            <svg class="w-3.5 h-3.5 text-indigo-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">

                    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-6 h-full">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-semibold text-white">Próximos Eventos</h2>
                            <button class="text-indigo-400 text-sm hover:text-indigo-300">Ver calendario</button>
                        </div>

                        <div class="relative border-l border-white/10 ml-3 space-y-8 pb-4">
                            <div v-for="evento in eventos" :key="evento.id" class="relative pl-6">
                                <div
                                    class="absolute -left-1.5 top-1.5 w-3 h-3 bg-indigo-500 rounded-full shadow-[0_0_10px_rgba(99,102,241,0.8)]">
                                </div>

                                <p class="text-sm text-indigo-300 font-medium mb-1">{{ evento.hora }}</p>
                                <h3 class="text-gray-100 font-medium text-base">{{ evento.titulo }}</h3>
                                <p class="text-sm text-gray-400 mt-1 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ evento.ubicacion }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';

// En el futuro, estos datos vendrán como props desde el DashboardController de Laravel.
// Por ahora usamos datos simulados para maquetar la interfaz.

const stats = [
    { label: 'Eventos Hoy', value: '3' },
    { label: 'Tareas Pendientes', value: '5' },
    { label: 'Horas Bloqueadas', value: '4.5' },
    { label: 'Racha (Días)', value: '12' },
];

const tareas = [
    { id: 1, titulo: 'Revisar documentación de n8n para automatizaciones', proyecto: 'Investigación', prioridad: 'Media' },
    { id: 2, titulo: 'Terminar maquetación de vistas en Vuejs', proyecto: 'Agenda AI', prioridad: 'Alta' },
    { id: 3, titulo: 'Práctica diaria de vocabulario en Inglés', proyecto: 'Desarrollo Personal', prioridad: 'Media' },
];

const eventos = [
    { id: 1, hora: '10:00 AM - 12:00 PM', titulo: 'Clase de Telecomunicaciones (Semestre 7)', ubicacion: 'Universidad' },
    { id: 2, hora: '01:30 PM - 02:30 PM', titulo: 'Revisión de avances del proyecto web', ubicacion: 'Google Meet' },
    { id: 3, hora: '05:00 PM - 07:00 PM', titulo: 'Sesión de código: Integración de IA', ubicacion: 'Casa' },
];
</script>