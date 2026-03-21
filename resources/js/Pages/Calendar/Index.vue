<template>

    <Head title="Calendario" />

    <div class="min-h-screen bg-[#0f172a] p-4 sm:p-8 overflow-x-hidden relative font-sans text-white">
        <div class="absolute top-20 left-20 w-96 h-96 bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="w-full mx-auto relative z-10">
            <div class="mb-8">
                <Navbar />
            </div>
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
                        class="w-full sm:w-auto relative flex justify-center items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-[0_0_15px_rgba(111,114,246,0.3)]">
                        <span>{{ estaProcesandoIA ? 'Procesando...' : 'Agendar con IA' }}</span>
                    </button>
                </form>
            </div>

            <div class="flex flex-col lg:flex-row gap-6 relative items-stretch min-h-[calc(100vh-16rem)]">

                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-2xl transition-all duration-500 ease-in-out flex flex-col"
                    :class="isPanelOpen ? 'lg:w-2/3' : 'w-full'">
                    <div class="calendar-container flex-1 h-full min-h-[600px]">
                        <FullCalendar ref="calendarRef" :options="calendarOptions" class="h-full" />
                    </div>
                </div>

                <EventPanel :show="isPanelOpen" :is-editing="!!eventoIdEnEdicion" :form="form"
                    :colores-disponibles="coloresDisponibles" v-model:fecha-dia="fecha_dia"
                    v-model:hora-inicio="hora_inicio" v-model:hora-fin="hora_fin" @close="cerrarPanel"
                    @save="guardarEvento" @delete="isDeleteModalOpen = true" @sumar-tiempo="sumarTiempo" />
            </div>
        </div>

        <DeleteModal :show="isDeleteModalOpen" @close="isDeleteModalOpen = false" @confirm="confirmarEliminacion" />
    </div>
</template>

<script setup>

// Librerias
import { ref, watch } from 'vue';
import { Head, router, useForm, Link } from '@inertiajs/vue3';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

//Componentes
import Navbar from '@/Components/Navbar.vue';
import EventPanel from '@/Components/EventPanel.vue';
import DeleteModal from '@/Components/DeleteModal.vue';

const props = defineProps({ eventos: { type: Array, default: () => [] } });

// REFS GLOBALES
const comandoIA = ref('');
const estaProcesandoIA = ref(false);
const isPanelOpen = ref(false);
const isDeleteModalOpen = ref(false);
const calendarRef = ref(null);
const tempEventId = ref(null);
const eventoIdEnEdicion = ref(null);

const fecha_dia = ref('');
const hora_inicio = ref('');
const hora_fin = ref('');
const coloresDisponibles = ['#6366f1', '#ec4899', '#10b981', '#f59e0b', '#8b5cf6', '#ef4444'];

const form = useForm({
    titulo: '', descripcion: '', fecha_inicio: '', fecha_fin: '', color: '#6366f1', es_ia_generado: false
});

const procesarComandoIA = () => { };

const syncFechasAlFormulario = (startStr, endStr) => {
    if (startStr.includes('T')) {
        fecha_dia.value = startStr.split('T')[0];
        hora_inicio.value = startStr.split('T')[1].slice(0, 5);
        if (endStr) {
            hora_fin.value = endStr.split('T')[1].slice(0, 5);
        } else {
            const tempDate = new Date(startStr);
            tempDate.setHours(tempDate.getHours() + 1);
            hora_fin.value = tempDate.toISOString().split('T')[1].slice(0, 5);
        }
    } else {
        fecha_dia.value = startStr;
        hora_inicio.value = '08:00';
        hora_fin.value = '09:00';
    }
};

const calendarOptions = ref({
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    initialView: 'timeGridWeek',
    headerToolbar: { left: 'prev,next today', center: '', right: 'dayGridMonth,timeGridWeek,timeGridDay' },
    locale: 'es', slotMinTime: '06:00:00', allDaySlot: true, editable: true, selectable: true,
    selectMirror: false, expandRows: true, height: '100%', unselectAuto: false,
    events: props.eventos,

    select: (info) => {
        const api = calendarRef.value.getApi();
        api.unselect();
        eventoIdEnEdicion.value = null;
        form.reset();

        if (tempEventId.value) {
            const oldTemp = api.getEventById(tempEventId.value);
            if (oldTemp) oldTemp.remove();
        }

        tempEventId.value = 'temp-' + Date.now();
        api.addEvent({
            id: tempEventId.value, title: '(Nuevo Evento)', start: info.startStr, end: info.endStr,
            backgroundColor: form.color, borderColor: form.color, editable: true
        });

        syncFechasAlFormulario(info.startStr, info.endStr);
        if (!isPanelOpen.value) abrirPanel();
    },

    eventClick: (info) => {
        const ev = info.event;
        if (ev.id.startsWith('temp-')) return;

        eventoIdEnEdicion.value = ev.id;
        form.titulo = ev.title;
        form.color = ev.backgroundColor;
        form.descripcion = ev.description || '';

        syncFechasAlFormulario(ev.startStr, ev.endStr || ev.startStr);
        if (!isPanelOpen.value) abrirPanel();
    },

    eventDrop: (info) => {
        if (info.event.id.startsWith('temp-')) {
            syncFechasAlFormulario(info.event.startStr, info.event.endStr);
        } else {
            router.put(`/eventos/${info.event.id}`, { fecha_inicio: info.event.startStr, fecha_fin: info.event.endStr || info.event.startStr }, { preserveScroll: true, onError: () => info.revert() });
        }
    },

    eventResize: (info) => {
        if (info.event.id.startsWith('temp-')) {
            syncFechasAlFormulario(info.event.startStr, info.event.endStr);
        } else {
            router.put(`/eventos/${info.event.id}`, { fecha_inicio: info.event.startStr, fecha_fin: info.event.endStr }, { preserveScroll: true, onError: () => info.revert() });
        }
    }
});

watch(() => props.eventos, (newEvents) => { calendarOptions.value.events = newEvents; }, { deep: true });

watch([() => form.titulo, () => form.color], ([nuevoTitulo, nuevoColor]) => {
    if (calendarRef.value) {
        const api = calendarRef.value.getApi();
        if (tempEventId.value) {
            const tempEv = api.getEventById(tempEventId.value);
            if (tempEv) {
                tempEv.setProp('title', nuevoTitulo || '(Nuevo Evento)');
                tempEv.setProp('backgroundColor', nuevoColor);
                tempEv.setProp('borderColor', nuevoColor);
            }
        } else if (eventoIdEnEdicion.value) {
            const realEv = api.getEventById(eventoIdEnEdicion.value);
            if (realEv) {
                realEv.setProp('title', nuevoTitulo || '(Nuevo Evento)');
                realEv.setProp('backgroundColor', nuevoColor);
                realEv.setProp('borderColor', nuevoColor);
            }
        }
    }
});

const abrirPanel = () => {
    isPanelOpen.value = true;
    setTimeout(() => { if (calendarRef.value) calendarRef.value.getApi().updateSize(); }, 550);
};

const cerrarPanel = () => {
    if (eventoIdEnEdicion.value && calendarRef.value) {
        const api = calendarRef.value.getApi();
        const realEv = api.getEventById(eventoIdEnEdicion.value);
        const evOriginal = props.eventos.find(e => e.id == eventoIdEnEdicion.value);
        if (realEv && evOriginal) {
            realEv.setProp('title', evOriginal.title);
            realEv.setProp('backgroundColor', evOriginal.backgroundColor);
            realEv.setProp('borderColor', evOriginal.borderColor);
        }
    }
    isPanelOpen.value = false;
    form.reset(); form.clearErrors();
    eventoIdEnEdicion.value = null;
    if (tempEventId.value && calendarRef.value) {
        const tempEv = calendarRef.value.getApi().getEventById(tempEventId.value);
        if (tempEv) tempEv.remove();
        tempEventId.value = null;
    }
    setTimeout(() => { if (calendarRef.value) calendarRef.value.getApi().updateSize(); }, 550);
};

const sumarTiempo = (minutos) => {
    if (!hora_inicio.value) return;
    const [h, m] = hora_inicio.value.split(':').map(Number);
    const date = new Date(); date.setHours(h, m + minutos, 0, 0);
    hora_fin.value = `${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}`;

    if (tempEventId.value && calendarRef.value) {
        const tempEv = calendarRef.value.getApi().getEventById(tempEventId.value);
        if (tempEv) tempEv.setEnd(`${fecha_dia.value}T${hora_fin.value}:00`);
    }
};

const guardarEvento = () => {
    form.fecha_inicio = `${fecha_dia.value}T${hora_inicio.value}:00`;
    form.fecha_fin = `${fecha_dia.value}T${hora_fin.value}:00`;

    if (eventoIdEnEdicion.value) form.put(`/eventos/${eventoIdEnEdicion.value}`, { preserveScroll: true, onSuccess: () => cerrarPanel() });
    else form.post('/eventos', { preserveScroll: true, onSuccess: () => cerrarPanel() });
};

const confirmarEliminacion = () => {
    router.delete(`/eventos/${eventoIdEnEdicion.value}`, {
        preserveScroll: true, onSuccess: () => { isDeleteModalOpen.value = false; cerrarPanel(); }
    });
};
</script>

<style>
:root {
    --fc-page-bg-color: transparent;
    --fc-neutral-bg-color: rgba(255, 255, 255, 0.02);
    --fc-neutral-text-color: #cbd5e1;
    --fc-border-color: rgba(255, 255, 255, 0.1);
    --fc-today-bg-color: rgba(99, 102, 241, 0.15);
}
.fc {
    color: #f1f5f9;
    font-family: inherit;
}
.fc-toolbar-chunk {
    display: flex !important;
    align-items: center;
    gap: 0.5rem;
}
.fc-toolbar-chunk .fc-button-group {
    display: flex !important;
}
.fc .fc-button {
    background-color: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    color: #e2e8f0 !important;
    padding: 0.4rem 0.8rem !important;
    border-radius: 0.5rem !important;
    font-weight: 500;
    text-transform: capitalize;
    backdrop-filter: blur(8px);
    transition: all 0.3s ease;
    box-shadow: none !important;
}
.fc .fc-button:hover {
    background-color: rgba(99, 102, 241, 0.3) !important;
    border-color: rgba(99, 102, 241, 0.5) !important;
}
.fc .fc-button-active, .fc .fc-button:active {
    background-color: #6366f1 !important;
    border-color: #6366f1 !important;
    color: white !important;
    box-shadow: 0 0 12px rgba(99, 102, 241, 0.6) !important;
}

.fc-theme-standard th, .fc-theme-standard td, .fc-theme-standard .fc-scrollgrid {
    border: 1px solid var(--fc-border-color) !important;
}

.fc a {
    text-decoration: none !important;
    color: inherit;
}

.fc-timegrid-slot-label-cushion, .fc-col-header-cell-cushion {
    color: #94a3b8;
    font-weight: 500;
}

.fc-event {
    border: none !important;
    border-radius: 6px;
    padding: 3px 5px;
    font-size: 0.8rem;
    font-weight: 500;
    cursor: pointer;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.fc-event:hover {
    transform: scale(1.02);
    box-shadow: 0 6px 12px -2px rgba(0, 0, 0, 0.4);
    z-index: 50;
}

.fc-scroller::-webkit-scrollbar {
    width: 8px;
}

.fc-scroller::-webkit-scrollbar-track {
    background: transparent;
}

.fc-scroller::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
}
</style>