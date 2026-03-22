<template>
    <Head title="Dashboard" />

    <div class="min-h-screen bg-[#0f172a] p-4 sm:p-8 overflow-x-hidden relative font-sans text-white">
        <div class="absolute top-0 left-20 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="w-full max-w-7xl mx-auto relative z-10">
            <div class="mb-8">
                <Navbar />
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Hola, {{ userName }}</h1>
                    <p class="text-gray-400 text-sm">Aquí tienes el resumen de tu jornada.</p>
                </div>
                <div class="flex items-center gap-3">
                    <Link href="/calendario" class="bg-white/5 hover:bg-white/10 border border-white/10 text-white px-5 py-2.5 rounded-xl font-medium transition-colors text-sm">
                        + Nuevo Evento
                    </Link>
                    <Link href="/calendario" class="bg-teal-400 hover:bg-teal-500 text-slate-900 px-5 py-2.5 rounded-xl font-semibold transition-colors shadow-[0_0_15px_rgba(45,212,191,0.3)] text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        Ir al Calendario
                    </Link>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 flex flex-col gap-6">
                    
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 flex flex-col items-center justify-center">
                            <span class="text-3xl font-bold text-white mb-1">{{ eventosHoyCount }}</span>
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">Eventos Hoy</span>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 flex flex-col items-center justify-center">
                            <span class="text-3xl font-bold text-white mb-1">{{ tareasMock.length }}</span>
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">Tareas Pendientes</span>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 flex flex-col items-center justify-center">
                            <span class="text-3xl font-bold text-white mb-1">{{ horasBloqueadas }}</span>
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">Horas Bloqueadas</span>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 flex flex-col items-center justify-center">
                            <span class="text-3xl font-bold text-white mb-1">12</span>
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">Racha (Días)</span>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-indigo-900/40 to-purple-900/20 border border-indigo-500/20 rounded-2xl p-6 relative overflow-hidden">
                        <div class="absolute right-[-20px] top-[-20px] opacity-10 pointer-events-none">
                            <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 7.5l-10-5v2.5l10 5 10-5V4.5l-10 5zm0 5l-10-5v2.5l10 5 10-5v-2.5l-10 5z"/></svg>
                        </div>
                        
                        <div class="flex items-center gap-2 mb-3 relative z-10">
                            <span class="text-amber-400 text-lg">✨</span>
                            <h3 class="font-semibold text-white">Análisis de tu Asistente</h3>
                        </div>
                        <p class="text-gray-300 text-sm leading-relaxed relative z-10 w-11/12">
                            Hoy tienes una agenda enfocada en desarrollo y estudios. Te sugiero repasar la lógica de los controladores en Laravel antes de tu sesión de programación de la tarde. Tienes un hueco libre de 2 horas a las 15:00, ideal para avanzar con tus prácticas de Python.
                        </p>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 flex-1">
                        <h3 class="text-lg font-semibold text-white mb-5">Tareas Pendientes</h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div v-for="tarea in tareasMock" :key="tarea.id" class="bg-black/20 border border-white/5 rounded-2xl p-5 hover:border-indigo-500/30 transition-colors flex flex-col justify-between group cursor-pointer">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-200 mb-1 line-clamp-2 group-hover:text-indigo-300 transition-colors">{{ tarea.titulo }}</h4>
                                    <p class="text-xs text-gray-500">{{ tarea.categoria }}</p>
                                </div>
                                <div class="flex justify-between items-center mt-6">
                                    <span :class="['text-[10px] px-2 py-1 rounded-full border', 
                                        tarea.prioridad === 'Alta' ? 'bg-red-500/10 text-red-400 border-red-500/20' : 'bg-blue-500/10 text-blue-400 border-blue-500/20']">
                                        {{ tarea.prioridad }}
                                    </span>
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-600 group-hover:border-indigo-400 transition-colors"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 lg:col-span-1">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-white">Próximos Eventos</h3>
                        <Link href="/calendario" class="text-xs text-indigo-400 hover:text-indigo-300">Ver todo</Link>
                    </div>

                    <div v-if="proximosEventos.length === 0" class="text-sm text-gray-500 text-center py-10">
                        No tienes más eventos programados para hoy.
                    </div>

                    <div class="relative border-l border-white/10 ml-3 space-y-8 pb-4">
                        <div v-for="evento in proximosEventos" :key="evento.id" class="relative pl-6">
                            <div class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full shadow-[0_0_8px_rgba(99,102,241,0.6)]" :style="{ backgroundColor: evento.color || '#6366f1' }"></div>
                            
                            <div class="flex flex-col gap-1">
                                <span class="text-xs font-semibold text-indigo-300">{{ formatearHora(evento.fecha_inicio) }} - {{ formatearHora(evento.fecha_fin) }}</span>
                                <span class="text-sm font-medium text-white">{{ evento.titulo }}</span>
                                <div v-if="evento.descripcion" class="flex items-center gap-1.5 text-xs text-gray-500 mt-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                                    <span class="truncate">{{ evento.descripcion }}</span>
                                </div>
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
import Navbar from '@/Components/Navbar.vue';

// Recibimos los datos de Laravel
const props = defineProps({
    userName: String,
    eventosHoyCount: Number,
    horasBloqueadas: Number,
    proximosEventos: Array,
});

// Función para convertir "2026-03-22 10:00:00" a "10:00 AM"
const formatearHora = (fechaString) => {
    if (!fechaString) return '';
    const fecha = new Date(fechaString);
    return fecha.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
};

// Datos estáticos para las tareas mientras creas su tabla en la base de datos
const tareasMock = [
    { id: 1, titulo: 'Revisar documentación de n8n para automatizaciones', categoria: 'Investigación', prioridad: 'Media' },
    { id: 2, titulo: 'Terminar maquetación de vistas en Vuejs', categoria: 'Agenda AI', prioridad: 'Alta' },
    { id: 3, titulo: 'Práctica diaria de vocabulario en Inglés', categoria: 'Desarrollo Personal', prioridad: 'Media' }
];
</script>