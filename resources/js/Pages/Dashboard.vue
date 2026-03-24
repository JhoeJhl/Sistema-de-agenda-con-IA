<template>
    <Head title="Dashboard" />

    <div class="min-h-screen bg-[#0f172a] p-4 sm:p-8 overflow-x-hidden relative font-sans text-white">
        <div class="absolute top-0 left-20 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="w-full max-w-7xl mx-auto relative z-10">
            <div class="mb-8">
                <Navbar />
            </div>

            <div class="mb-8 border-b border-white/5 pb-4 flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Hola, {{ userName }}</h1>
                    <p class="text-gray-400 text-sm">Resumen inteligente de tu jornada.</p>
                </div>
                <button @click="isNewTaskModalOpen = true" class="bg-indigo-500 hover:bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-[0_0_15px_rgba(99,102,241,0.3)] flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Nueva Tarea
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 flex flex-col gap-6">

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 flex flex-col items-center justify-center backdrop-blur-sm">
                            <span class="text-3xl font-bold text-white mb-1">{{ eventosHoyCount }}</span>
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">Eventos Hoy</span>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 flex flex-col items-center justify-center backdrop-blur-sm">
                            <span class="text-3xl font-bold text-white mb-1">{{ tareasHoy ? tareasHoy.length : 0 }}</span>
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">Tareas Hoy</span>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 flex flex-col items-center justify-center backdrop-blur-sm">
                            <span class="text-3xl font-bold text-white mb-1">{{ horasBloqueadas }}</span>
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">Horas Focus</span>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 flex flex-col items-center justify-center backdrop-blur-sm">
                            <span class="text-3xl font-bold text-emerald-400 mb-1">12</span>
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">Racha (Días)</span>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-indigo-900/40 to-purple-900/20 border border-indigo-500/20 rounded-2xl p-6 relative overflow-hidden">
                        <div class="absolute right-[-20px] top-[-20px] opacity-10 pointer-events-none">
                            <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 7.5l-10-5v2.5l10 5 10-5V4.5l-10 5zm0 5l-10-5v2.5l10 5 10-5v-2.5l-10 5z" /></svg>
                        </div>
                        <div class="flex items-center gap-2 mb-3 relative z-10">
                            <span class="text-amber-400 text-lg">✨</span>
                            <h3 class="font-semibold text-white">Análisis de tu Asistente</h3>
                        </div>
                        <p class="text-gray-300 text-sm leading-relaxed relative z-10 w-11/12">
                            Tienes una jornada enfocada en tu productividad. Te sugiero revisar tus prioridades antes de empezar. Aprovecha tus espacios libres para avanzar con tareas pendientes.
                        </p>
                    </div>

                    <div class="h-[350px]">
                        <ProductivityChart v-if="estadisticasSemana" :data="estadisticasSemana" />
                        <div v-else class="h-full flex items-center justify-center bg-black/10 border border-white/5 rounded-2xl text-gray-500 text-sm">
                            Conecta el backend para ver las estadísticas...
                        </div>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 flex-1 flex flex-col shadow-xl">
                        <h3 class="text-xl font-bold text-white mb-5 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                            Tareas para Hoy
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div v-if="!tareasHoy || tareasHoy.length === 0" class="col-span-full py-8 text-center flex flex-col items-center justify-center bg-black/10 rounded-2xl border border-white/5">
                                <span class="text-3xl mb-2">🎉</span>
                                <p class="text-gray-400 text-sm">No tienes tareas pendientes para hoy. ¡Todo al día!</p>
                            </div>

                            <div v-for="tarea in tareasHoy" :key="tarea.id" :class="['relative bg-black/30 border rounded-2xl p-5 transition-all flex flex-col justify-between group shadow-lg', esUrgente(tarea.fecha_vencimiento) ? 'border-red-500/40 bg-gradient-to-br from-red-500/10 to-transparent' : 'border-white/10 hover:border-indigo-500/50 hover:bg-white/5']">
                                <div v-if="esUrgente(tarea.fecha_vencimiento)" class="absolute top-4 right-4 flex items-center gap-2">
                                    <span class="text-[10px] font-bold text-red-400 uppercase tracking-wider">¡Urgente!</span>
                                    <div class="w-2 h-2 bg-red-500 rounded-full animate-ping"></div>
                                </div>

                                <div class="mb-5">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-400">{{ tarea.categoria }}</span>
                                        <span v-if="tarea.prioridad === 'Alta'" class="text-[9px] font-bold uppercase bg-red-500/20 text-red-400 px-1.5 py-0.5 rounded border border-red-500/30">Alta</span>
                                    </div>
                                    <h4 class="text-base font-bold text-white leading-snug mb-3 pr-12">{{ tarea.titulo }}</h4>

                                    <div v-if="tarea.fecha_vencimiento" class="inline-flex items-center gap-1.5 bg-indigo-500/20 border border-indigo-500/30 text-indigo-300 px-3 py-1.5 rounded-lg text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        Vence: {{ formatearHora(tarea.fecha_vencimiento) }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-2 mt-auto pt-4 border-t border-white/5">
                                    <button @click="actualizarEstadoTarea(tarea.id, 'no_realizado')" class="w-full py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 hover:border-red-500/40 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                        Omitir
                                    </button>
                                    <button @click="actualizarEstadoTarea(tarea.id, 'realizado')" class="w-full py-2 bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 border border-emerald-500/20 hover:border-emerald-500/40 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        Hecho
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 flex-1 flex flex-col shadow-xl">
                        <h3 class="text-xl font-bold text-white mb-5 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                            Tareas para Mañana
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div v-if="!tareasManana || tareasManana.length === 0" class="col-span-full py-6 text-center text-gray-500 text-sm bg-black/10 rounded-2xl border border-white/5">
                                Aún no tienes tareas asignadas para mañana.
                            </div>

                            <div v-for="tarea in tareasManana" :key="tarea.id" class="relative bg-black/30 border border-white/10 hover:border-purple-500/50 hover:bg-white/5 rounded-2xl p-5 transition-all flex flex-col justify-between group shadow-lg">
                                <div class="mb-5">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-purple-400">{{ tarea.categoria }}</span>
                                    </div>
                                    <h4 class="text-base font-bold text-white leading-snug mb-3">{{ tarea.titulo }}</h4>

                                    <div v-if="tarea.fecha_vencimiento" class="inline-flex items-center gap-1.5 bg-purple-500/20 border border-purple-500/30 text-purple-300 px-3 py-1.5 rounded-lg text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        Vence: {{ formatearHora(tarea.fecha_vencimiento) }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-2 mt-auto pt-4 border-t border-white/5">
                                    <button @click="actualizarEstadoTarea(tarea.id, 'no_realizado')" class="w-full py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 hover:border-red-500/40 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                        Omitir
                                    </button>
                                    <button @click="actualizarEstadoTarea(tarea.id, 'realizado')" class="w-full py-2 bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 border border-emerald-500/20 hover:border-emerald-500/40 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        Hecho
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 lg:col-span-1 h-fit sticky top-6 shadow-xl">
                    <div class="flex justify-between items-center mb-6 border-b border-white/5 pb-4">
                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                            <span class="text-teal-400">📅</span>
                            Agenda (Eventos)
                        </h3>
                        <Link href="/calendario" class="text-xs font-bold text-indigo-400 hover:text-indigo-300 bg-indigo-500/10 px-3 py-1.5 rounded-lg transition-colors">Ver Calendario</Link>
                    </div>

                    <div v-if="!proximosEventos || proximosEventos.length === 0" class="text-sm text-gray-500 text-center py-10 bg-black/10 rounded-2xl border border-white/5">
                        Tu calendario está libre de eventos.
                    </div>

                    <div class="space-y-4">
                        <div v-for="evento in proximosEventos" :key="evento.id" class="relative group">
                            
                            <div class="bg-black/30 border border-white/10 hover:border-white/20 rounded-2xl p-4 transition-all">
                                <div class="absolute left-0 top-4 bottom-4 w-1.5 rounded-r-md" :style="{ backgroundColor: evento.color || '#6366f1' }"></div>
                                
                                <div class="pl-2">
                                    <div class="flex flex-col gap-1 mb-3">
                                        <span class="text-xs font-bold text-indigo-300 bg-indigo-500/10 w-fit px-2 py-1 rounded-md mb-1">
                                            {{ formatearHora(evento.fecha_inicio) }} - {{ formatearHora(evento.fecha_fin) }}
                                        </span>
                                        <span class="text-sm font-bold text-white">{{ evento.titulo }}</span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-2 mt-4 pt-3 border-t border-white/5 opacity-80 group-hover:opacity-100 transition-opacity">
                                        <button @click="abrirConfirmacion(evento.id, 'no_realizado')" class="py-1.5 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 rounded-lg text-xs font-bold transition-all flex items-center justify-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            No realizado
                                        </button>

                                        <button @click="abrirConfirmacion(evento.id, 'completado')" class="py-1.5 bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 border border-emerald-500/20 rounded-lg text-xs font-bold transition-all flex items-center justify-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            Completado
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <Transition enter-active-class="transition ease-out duration-300" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="transition ease-in duration-200" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
        <div v-if="isNewTaskModalOpen" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-[#1e293b]/95 border border-white/10 rounded-3xl p-8 shadow-2xl max-w-md w-full relative">
                
                <button @click="isNewTaskModalOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition-colors bg-white/5 p-2 rounded-full hover:bg-white/10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>

                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-white mb-1">Nueva Tarea</h2>
                    <p class="text-gray-400 text-sm">Añade una tarea rápida a tu lista de pendientes.</p>
                </div>

                <form @submit.prevent="guardarNuevaTarea" class="flex flex-col gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">¿Qué necesitas hacer?</label>
                        <input v-model="formTarea.titulo" type="text" required autofocus placeholder="Ej. Repasar código..." class="w-full bg-black/30 border border-white/10 rounded-xl px-4 py-2.5 text-white placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Categoría</label>
                            <input v-model="formTarea.categoria" type="text" placeholder="Ej. Estudios" class="w-full bg-black/30 border border-white/10 rounded-xl px-4 py-2.5 text-white placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Prioridad</label>
                            <select v-model="formTarea.prioridad" class="w-full bg-black/30 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all appearance-none [color-scheme:dark]">
                                <option value="Baja">Baja</option>
                                <option value="Media">Media</option>
                                <option value="Alta">Alta 🔥</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Fecha y Hora Límite</label>
                        <input v-model="formTarea.fecha_vencimiento" type="datetime-local" required class="w-full bg-black/30 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all [color-scheme:dark]">
                    </div>

                    <button type="submit" :disabled="formTarea.processing" class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white font-bold py-3.5 rounded-xl transition-all shadow-[0_0_15px_rgba(99,102,241,0.4)] disabled:opacity-50 mt-4">
                        {{ formTarea.processing ? 'Guardando...' : 'Crear Tarea' }}
                    </button>
                </form>
            </div>
        </div>
    </Transition>

    <Transition enter-active-class="transition ease-out duration-300" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="transition ease-in duration-200" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
        <div v-if="modalConfirmacion.isOpen" class="fixed inset-0 z-[110] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-[#1e293b]/95 border border-white/10 rounded-3xl p-6 shadow-2xl max-w-sm w-full relative text-center">

                <button @click="cerrarConfirmacion" class="absolute top-4 right-4 text-gray-400 hover:text-white transition-colors p-1 bg-white/5 rounded-full hover:bg-white/10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>

                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full mb-4 shadow-lg mt-2"
                     :class="modalConfirmacion.accion === 'completado' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-red-500/20 text-red-400 border border-red-500/30'">
                    
                    <svg v-if="modalConfirmacion.accion === 'completado'" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <svg v-else class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>

                <h2 class="text-xl font-bold text-white mb-2">
                    {{ modalConfirmacion.accion === 'completado' ? '¡Evento Completado!' : 'Evento No Realizado' }}
                </h2>
                <p class="text-gray-400 text-sm mb-6">
                    ¿Qué deseas hacer con este evento en tu agenda?
                </p>

                <div class="flex flex-col gap-3">
                    <button @click="procesarEvento" class="w-full py-2.5 rounded-xl transition-all shadow-lg text-sm font-semibold"
                            :class="modalConfirmacion.accion === 'completado' ? 'bg-emerald-500 hover:bg-emerald-600 text-white shadow-emerald-500/30' : 'bg-red-500 hover:bg-red-600 text-white shadow-red-500/30'">
                        {{ modalConfirmacion.accion === 'completado' ? 'Marcar y Eliminar' : 'Eliminar de la agenda' }}
                    </button>
                    
                    <button @click="posponerEvento" class="w-full py-2.5 bg-indigo-500/10 hover:bg-indigo-500/20 border border-indigo-500/30 text-indigo-300 rounded-xl transition-colors text-sm font-semibold flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Omitir (Posponer para mañana)
                    </button>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { ref } from 'vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import ProductivityChart from '@/Components/ProductivityChart.vue'; // Opcional, si lo tienes creado

const props = defineProps({
    userName: String,
    eventosHoyCount: Number,
    horasBloqueadas: Number,
    proximosEventos: Array,
    tareasHoy: Array,
    tareasManana: Array,
    estadisticasSemana: Object,
});

const isNewTaskModalOpen = ref(false);

const formTarea = useForm({
    titulo: '',
    categoria: 'General',
    prioridad: 'Media',
    fecha_vencimiento: '',
});

// ==========================================
// TAREAS (Crear y Cambiar estado)
// ==========================================
const guardarNuevaTarea = () => {
    formTarea.post('/tareas', {
        preserveScroll: true,
        onSuccess: () => {
            isNewTaskModalOpen.value = false;
            formTarea.reset();
        }
    });
};

const actualizarEstadoTarea = (tareaId, nuevoEstado) => {
    // Al usar PUT, Laravel actualizará la tarea a "realizado" y desaparecerá de la vista
    router.put(`/tareas/${tareaId}`, { estado: nuevoEstado }, {
        preserveScroll: true
    });
};

// ==========================================
// EVENTOS (Modal Reactivo)
// ==========================================
const modalConfirmacion = ref({
    isOpen: false,
    eventoId: null,
    accion: ''
});

const abrirConfirmacion = (id, accion) => {
    // Forzamos la reactividad rescribiendo el objeto
    modalConfirmacion.value = {
        isOpen: true,
        eventoId: id,
        accion: accion
    };
};

const cerrarConfirmacion = () => {
    modalConfirmacion.value.isOpen = false;
    setTimeout(() => {
        modalConfirmacion.value = { isOpen: false, eventoId: null, accion: '' };
    }, 300);
};

// Elimina el evento permanentemente
const procesarEvento = () => {
    router.delete(`/calendario/${modalConfirmacion.value.eventoId}`, {
        preserveScroll: true,
        onSuccess: () => {
            cerrarConfirmacion();
        }
    });
};

// Posponer evento para mañana
const posponerEvento = () => {
    // Mandamos una petición PUT especial para posponer
    router.put(`/calendario/${modalConfirmacion.value.eventoId}/posponer`, {}, {
        preserveScroll: true,
        onSuccess: () => {
            cerrarConfirmacion();
        }
    });
};

// ==========================================
// UTILIDADES (Fechas)
// ==========================================
const esUrgente = (fechaString) => {
    if (!fechaString) return false;
    const ahora = new Date();
    const fechaVencimiento = new Date(fechaString);
    const diferenciaHoras = (fechaVencimiento - ahora) / (1000 * 60 * 60);
    return diferenciaHoras > 0 && diferenciaHoras <= 2;
};

const formatearHora = (fechaString) => {
    if (!fechaString) return '';
    const fecha = new Date(fechaString);
    return fecha.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', hour12: true });
};
</script>