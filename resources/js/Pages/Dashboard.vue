<template>
    <Head title="Dashboard" />

    <div class="min-h-screen bg-[#0f172a] p-4 sm:p-8 overflow-x-hidden relative font-sans text-white">
        <div class="absolute top-0 left-20 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="w-full max-w-7xl mx-auto relative z-10">
            <div class="mb-8">
                <Navbar />
            </div>

            <div class="mb-8 border-b border-white/5 pb-4">
                <h1 class="text-3xl font-bold text-white mb-1">Hola, {{ userName }}</h1>
                <p class="text-gray-400 text-sm">Aquí tienes el resumen de tu jornada.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 flex flex-col gap-6">
                    
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 flex flex-col items-center justify-center">
                            <span class="text-3xl font-bold text-white mb-1">{{ eventosHoyCount }}</span>
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">Eventos Hoy</span>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 flex flex-col items-center justify-center">
                            <span class="text-3xl font-bold text-white mb-1">{{ tareasHoy ? tareasHoy.length : 0 }}</span>
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">Tareas Hoy</span>
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

                    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 flex-1 flex flex-col">
                        
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-white">Tareas Pendientes</h3>
                            
                            <div class="flex bg-black/40 p-1 rounded-xl border border-white/5">
                                <button @click="diaSeleccionado = 'hoy'" 
                                    :class="['px-5 py-1.5 text-xs font-semibold rounded-lg transition-all', diaSeleccionado === 'hoy' ? 'bg-indigo-500/30 text-indigo-300 shadow-[0_0_10px_rgba(99,102,241,0.2)]' : 'text-gray-500 hover:text-gray-300']">
                                    Hoy
                                </button>
                                <button @click="diaSeleccionado = 'manana'" 
                                    :class="['px-5 py-1.5 text-xs font-semibold rounded-lg transition-all', diaSeleccionado === 'manana' ? 'bg-indigo-500/30 text-indigo-300 shadow-[0_0_10px_rgba(99,102,241,0.2)]' : 'text-gray-500 hover:text-gray-300']">
                                    Mañana
                                </button>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div v-if="tareasAMostrar.length === 0" class="col-span-full py-10 text-center text-gray-500 text-sm bg-black/10 rounded-2xl border border-white/5">
                                No tienes tareas programadas para {{ diaSeleccionado === 'hoy' ? 'hoy' : 'mañana' }}. ¡Todo al día! 🎉
                            </div>

                            <div v-for="tarea in tareasAMostrar" :key="tarea.id" 
                                :class="['relative bg-black/30 border rounded-2xl p-5 transition-all flex flex-col justify-between group overflow-hidden shadow-lg', 
                                esUrgente(tarea.fecha_vencimiento, diaSeleccionado) 
                                    ? 'border-red-500/40 bg-gradient-to-br from-red-500/10 to-transparent' 
                                    : 'border-white/10 hover:border-indigo-500/50 hover:bg-white/5']">
                                
                                <div v-if="esUrgente(tarea.fecha_vencimiento, diaSeleccionado)" class="absolute top-4 right-4 flex items-center gap-2">
                                    <span class="text-[10px] font-bold text-red-400 uppercase tracking-wider">¡Urgente!</span>
                                    <div class="w-2 h-2 bg-red-500 rounded-full animate-ping"></div>
                                </div>

                                <div class="mb-5">
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-400 mb-2 block">{{ tarea.categoria }}</span>
                                    
                                    <h4 class="text-base font-bold text-white leading-snug mb-3 group-hover:text-indigo-200 transition-colors pr-16">{{ tarea.titulo }}</h4>
                                    
                                    <div v-if="tarea.fecha_vencimiento" class="inline-flex items-center gap-1.5 bg-indigo-500/20 border border-indigo-500/30 text-indigo-300 px-3 py-1.5 rounded-lg text-xs font-semibold shadow-[0_0_10px_rgba(99,102,241,0.1)]">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        Vence: {{ formatearHora(tarea.fecha_vencimiento) }}
                                    </div>
                                </div>
                                
                                <div class="flex flex-col gap-3 mt-auto pt-4 border-t border-white/5">
                                    <div class="grid grid-cols-2 gap-2">
                                        <button @click="actualizarEstadoTarea(tarea.id, 'no_realizado')" 
                                            class="w-full py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 hover:border-red-500/40 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            No realizado
                                        </button>
                                        
                                        <button @click="actualizarEstadoTarea(tarea.id, 'realizado')" 
                                            class="w-full py-2 bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 border border-emerald-500/20 hover:border-emerald-500/40 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5 shadow-[0_0_10px_rgba(16,185,129,0.1)]">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            Realizado
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 lg:col-span-1">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-white">Próximos Eventos</h3>
                        <Link href="/calendario" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300">Ver todo</Link>
                    </div>

                    <div v-if="proximosEventos.length === 0" class="text-sm text-gray-500 text-center py-10">
                        No tienes más eventos programados para hoy.
                    </div>

                    <div class="relative border-l border-white/10 ml-3 space-y-8 pb-4">
                        <div v-for="evento in proximosEventos" :key="evento.id" class="relative pl-6 group cursor-pointer">
                            <div class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full shadow-[0_0_8px_rgba(99,102,241,0.6)] group-hover:scale-125 transition-transform" :style="{ backgroundColor: evento.color || '#6366f1' }"></div>
                            
                            <div class="flex flex-col gap-1">
                                <span class="text-xs font-bold text-indigo-300">{{ formatearHora(evento.fecha_inicio) }} - {{ formatearHora(evento.fecha_fin) }}</span>
                                <span class="text-sm font-bold text-white group-hover:text-indigo-200 transition-colors">{{ evento.titulo }}</span>
                                <div v-if="evento.descripcion" class="flex items-center gap-1.5 text-xs text-gray-400 mt-1 line-clamp-1">
                                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                                    <span>{{ evento.descripcion }}</span>
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
import { ref, computed } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';

const props = defineProps({
    userName: String,
    eventosHoyCount: Number,
    horasBloqueadas: Number,
    proximosEventos: Array,
    tareasHoy: { type: Array, default: () => [] },
    tareasManana: { type: Array, default: () => [] },
});

const diaSeleccionado = ref('hoy');

const tareasAMostrar = computed(() => {
    return diaSeleccionado.value === 'hoy' ? props.tareasHoy : props.tareasManana;
});

// Función de urgencia 
const esUrgente = (fechaString, dia) => {
    if (dia !== 'hoy' || !fechaString) return false;
    
    const ahora = new Date();
    const fechaVencimiento = new Date(fechaString);

    const diferenciaHoras = (fechaVencimiento - ahora) / (1000 * 60 * 60);
    
    // urgente si vence en menos de 2 horas y aún no ha pasado
    return diferenciaHoras > 0 && diferenciaHoras <= 2;
};

const actualizarEstadoTarea = (tareaId, nuevoEstado) => {
    router.put(`/tareas/${tareaId}`, { estado: nuevoEstado }, {
        preserveScroll: true,
        onSuccess: () => { console.log('Tarea actualizada a:', nuevoEstado); }
    });
};

const formatearHora = (fechaString) => {
    if (!fechaString) return '';
    const fecha = new Date(fechaString);
    return fecha.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', hour12: true });
};
</script>