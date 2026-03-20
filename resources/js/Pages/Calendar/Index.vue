<template>

    <Head title="Calendario" />

    <div class="min-h-screen bg-[#0f172a] p-4 sm:p-8 overflow-x-hidden relative font-sans text-white">

        <div class="absolute top-20 left-20 w-96 h-96 bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="w-full mx-auto relative z-10">

            <header class="mb-8 flex justify-center items-center">
                <h1
                    class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">
                    Tu Calendario IA
                </h1>
            </header>

            <div
                class="mb-8 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-3 shadow-2xl relative overflow-hidden group">
                <div
                    class="absolute -inset-px bg-gradient-to-r from-indigo-500/50 to-purple-500/50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-sm pointer-events-none">
                </div>

                <form @submit.prevent="procesarComandoIA"
                    class="relative z-10 flex flex-col sm:flex-row items-center gap-3">
                    <div class="flex-1 w-full relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-indigo-400">✨</span>
                        <input v-model="comandoIA" type="text" :disabled="estaProcesandoIA"
                            class="w-full bg-black/20 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white placeholder:text-gray-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all disabled:opacity-60"
                            placeholder="Ej: 'Reunión de programación mañana a las 5pm por 2 horas'...">
                    </div>

                    <button type="submit" :disabled="estaProcesandoIA || !comandoIA.trim()"
                        class="w-full sm:w-auto relative flex justify-center items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed group active:scale-95 shadow-[0_0_15px_rgba(111,114,246,0.3)]">

                        <svg v-if="estaProcesandoIA" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>

                        <svg v-else class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                        </svg>

                        <span>{{ estaProcesandoIA ? 'Procesando...' : 'Agendar con IA' }}</span>
                    </button>
                </form>
            </div>
            <div class="flex flex-col lg:flex-row gap-6 relative items-stretch min-h-[75vh]">

                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-2xl transition-all duration-500 ease-in-out"
                    :class="isPanelOpen ? 'lg:w-2/3' : 'w-full'">
                    <div class="calendar-container">
                        <FullCalendar ref="calendarRef" :options="calendarOptions" />
                    </div>
                </div>

                <Transition name="slide-panel">
                    <div v-if="isPanelOpen"
                        class="lg:w-1/3 bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-2xl h-full flex flex-col justify-between">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-white flex items-center gap-2">Nuevo Evento</h3>
                            <button @click="cerrarPanel" class="text-gray-400 hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form @submit.prevent="guardarEvento">
                            <div class="mb-5">
                                <label class="block text-sm text-gray-400 mb-1">¿Qué planeas hacer?</label>
                                <input v-model="form.titulo" type="text"
                                    class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all"
                                    placeholder="Ej. Estudiar, Reunión..." required autofocus>
                            </div>

                            <div class="bg-black/20 border border-white/5 rounded-2xl p-4 mb-6">
                                <div class="mb-4">
                                    <label class="block text-xs text-gray-500 uppercase tracking-wider mb-1">Día del
                                        Evento</label>
                                    <input v-model="fecha_dia" type="date" required
                                        class="w-full bg-white/10 border border-white/10 rounded-xl px-4 py-2 text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            class="block text-xs text-gray-500 uppercase tracking-wider mb-1">Inicio</label>
                                        <input v-model="hora_inicio" type="time" required
                                            class="w-full bg-white/10 border border-white/10 rounded-xl px-4 py-2 text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs text-gray-500 uppercase tracking-wider mb-1">Fin</label>
                                        <input v-model="hora_fin" type="time" required
                                            class="w-full bg-white/10 border border-white/10 rounded-xl px-4 py-2 text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-white/5">
                                    <p class="text-xs text-gray-500 mb-2">Ajuste rápido de duración:</p>
                                    <div class="flex gap-2">
                                        <button type="button" @click="sumarTiempo(30)"
                                            class="flex-1 bg-white/5 hover:bg-white/10 text-xs text-indigo-300 py-1.5 rounded-lg border border-white/5 transition-colors">+30
                                            min</button>
                                        <button type="button" @click="sumarTiempo(60)"
                                            class="flex-1 bg-white/5 hover:bg-white/10 text-xs text-indigo-300 py-1.5 rounded-lg border border-white/5 transition-colors">+1
                                            hora</button>
                                        <button type="button" @click="sumarTiempo(120)"
                                            class="flex-1 bg-white/5 hover:bg-white/10 text-xs text-indigo-300 py-1.5 rounded-lg border border-white/5 transition-colors">+2
                                            horas</button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end gap-3 mt-8">
                                <button type="button" @click="cerrarPanel"
                                    class="px-5 py-2.5 rounded-xl text-gray-300 hover:bg-white/5 transition-colors font-medium">
                                    Cancelar
                                </button>
                                <button type="submit" :disabled="form.processing"
                                    class="bg-indigo-500 hover:bg-indigo-600 px-6 py-2.5 rounded-xl text-white font-medium transition-all shadow-[0_0_15px_rgba(99,102,241,0.4)] disabled:opacity-50 flex-1">
                                    {{ form.processing ? 'Guardando...' : 'Guardar Evento' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </Transition>

            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

const props = defineProps({
    eventos: { type: Array, default: () => [] }
});

// -- REFS IA --
const comandoIA = ref('');
const estaProcesandoIA = ref(false);

const procesarComandoIA = () => {
    if (!comandoIA.value.trim() || estaProcesandoIA.value) return;

    estaProcesandoIA.value = true;

    router.post('/eventos/ia-parse', {
        prompt: comandoIA.value
    }, {
        preserveScroll: true,
        onSuccess: () => {
            comandoIA.value = '';
            // FullCalendar se actualizará solo gracias al watcher
            alert('✨ ¡Evento agendado exitosamente por la IA!');
        },
        onError: (errors) => {
            alert('⚠️ Ups, la IA no pudo procesar esa frase. Intenta ser más específico con la fecha y hora.');
            console.error(errors);
        },
        onFinish: () => {
            estaProcesandoIA.value = false;
        }
    });
};

// -- REFS CALENDARIO MANUAL --
const isPanelOpen = ref(false);
const calendarRef = ref(null);

const fecha_dia = ref('');
const hora_inicio = ref('');
const hora_fin = ref('');

const form = useForm({
    titulo: '',
    fecha_inicio: '',
    fecha_fin: '',
    es_ia_generado: false
});

const calendarOptions = ref({
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    initialView: 'timeGridWeek',
    headerToolbar: {
        left: 'prev,next today',
        center: '',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    locale: 'es',
    slotMinTime: '06:00:00',
    allDaySlot: true,
    editable: true,
    selectable: true,
    selectMirror: true,
    events: props.eventos,

    select: (info) => {
        const startString = info.startStr;
        const endString = info.endStr;

        if (startString.includes('T')) {
            fecha_dia.value = startString.split('T')[0];
            hora_inicio.value = startString.split('T')[1].slice(0, 5);
            hora_fin.value = endString.split('T')[1].slice(0, 5);
        } else {
            fecha_dia.value = startString;
            hora_inicio.value = '08:00';
            hora_fin.value = '09:00';
        }
        abrirPanel();
    },

    eventDrop: (info) => {
        router.put(`/eventos/${info.event.id}`, {
            fecha_inicio: info.event.startStr,
            fecha_fin: info.event.endStr || info.event.startStr
        }, { preserveScroll: true, onError: () => info.revert() });
    },

    eventResize: (info) => {
        router.put(`/eventos/${info.event.id}`, {
            fecha_inicio: info.event.startStr,
            fecha_fin: info.event.endStr
        }, { preserveScroll: true, onError: () => info.revert() });
    }
});

watch(() => props.eventos, (newEvents) => {
    calendarOptions.value.events = newEvents;
}, { deep: true });

const abrirPanel = () => {
    isPanelOpen.value = true;
    setTimeout(() => {
        if (calendarRef.value) {
            calendarRef.value.getApi().updateSize();
        }
    }, 550);
};

const cerrarPanel = () => {
    isPanelOpen.value = false;
    form.reset();
    form.clearErrors();
    const calendarApi = calendarOptions.value?.calendar;
    if (calendarApi) calendarApi.unselect();

    setTimeout(() => {
        if (calendarRef.value) calendarRef.value.getApi().updateSize();
    }, 550);
};

const sumarTiempo = (minutosAAgregar) => {
    if (!hora_inicio.value) return;

    const [horas, minutos] = hora_inicio.value.split(':').map(Number);
    const fechaTotal = new Date();
    fechaTotal.setHours(horas, minutos + minutosAAgregar, 0, 0);

    const horasFinal = String(fechaTotal.getHours()).padStart(2, '0');
    const minutosFinal = String(fechaTotal.getMinutes()).padStart(2, '0');

    hora_fin.value = `${horasFinal}:${minutosFinal}`;
};

const guardarEvento = () => {
    form.fecha_inicio = `${fecha_dia.value}T${hora_inicio.value}:00`;
    form.fecha_fin = `${fecha_dia.value}T${hora_fin.value}:00`;

    form.post('/eventos', {
        preserveScroll: true,
        onSuccess: () => cerrarPanel()
    });
};
</script>

<style>
.slide-panel-enter-active,
.slide-panel-leave-active {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.slide-panel-enter-from,
.slide-panel-leave-to {
    opacity: 0;
    transform: translateX(100%);
    margin-left: -33.333333%;
}

.fc-theme-standard td,
.fc-theme-standard th,
.fc-theme-standard .fc-scrollgrid {
    border-color: rgba(255, 255, 255, 0.1);
}

.fc .fc-button-primary {
    background-color: rgba(99, 102, 241, 0.2);
    border: 1px solid rgba(99, 102, 241, 0.3);
    color: #e0e7ff;
    text-transform: capitalize;
}

.fc .fc-button-primary:hover {
    background-color: rgba(99, 102, 241, 0.4);
}

.fc .fc-button-primary:not(:disabled):active,
.fc .fc-button-primary:not(:disabled).fc-button-active {
    background-color: #6366f1;
    border-color: #6366f1;
}

.fc-timegrid-slot-label-cushion,
.fc-col-header-cell-cushion {
    color: #9ca3af;
}

.fc-event {
    border-radius: 6px;
    padding: 2px 4px;
    font-size: 0.85rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.fc-event:hover {
    transform: scale(1.02);
}
</style>