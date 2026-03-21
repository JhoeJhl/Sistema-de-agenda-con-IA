<template>
    <Transition name="slide-panel">
        <div v-if="show"
            class="lg:w-1/3 bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-2xl flex flex-col">

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-white flex items-center gap-2">
                    {{ isEditing ? 'Editar Evento' : 'Nuevo Evento' }}
                </h3>
                <button @click="$emit('close')" class="text-gray-400 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form @submit.prevent="$emit('save')" class="flex-1 flex flex-col">
                <div class="mb-5">
                    <label class="block text-sm text-gray-400 mb-1">¿Qué planeas hacer?</label>
                    <input v-model="form.titulo" type="text"
                        class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all"
                        placeholder="Ej. Estudiar, Reunión, Ir al Gimnasio, etc..." required autofocus>
                </div>
                <div class="mb-5">
                    <label class="block text-sm text-gray-400 mb-1">Descripción o detalles (Opcional)</label>
                    <textarea v-model="form.descripcion" rows="3"
                        class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder:text-gray-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all resize-y"
                        placeholder="Añade notas, enlaces o detalles adicionales aquí..."></textarea>
                </div>
                <div class="bg-black/20 border border-white/5 rounded-2xl p-4 mb-6">
                    <div class="mb-4">
                        <label class="block text-xs text-gray-500 uppercase tracking-wider mb-1">Día del Evento</label>
                        <input v-model="fechaDia" type="date" required
                            class="w-full bg-white/10 border border-white/10 rounded-xl px-4 py-2 text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 uppercase tracking-wider mb-1">Inicio</label>
                            <input v-model="horaInicio" type="time" required
                                class="w-full bg-white/10 border border-white/10 rounded-xl px-4 py-2 text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 uppercase tracking-wider mb-1">Fin</label>
                            <input v-model="horaFin" type="time" required
                                class="w-full bg-white/10 border border-white/10 rounded-xl px-4 py-2 text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-white/5">
                        <p class="text-xs text-gray-500 mb-2">Ajuste rápido de duración:</p>
                        <div class="flex gap-2">
                            <button type="button" @click="$emit('sumarTiempo', 30)"
                                class="flex-1 bg-white/5 hover:bg-white/10 text-xs text-indigo-300 py-1.5 rounded-lg border border-white/5 transition-colors">+30
                                min</button>
                            <button type="button" @click="$emit('sumarTiempo', 60)"
                                class="flex-1 bg-white/5 hover:bg-white/10 text-xs text-indigo-300 py-1.5 rounded-lg border border-white/5 transition-colors">+1
                                hora</button>
                            <button type="button" @click="$emit('sumarTiempo', 120)"
                                class="flex-1 bg-white/5 hover:bg-white/10 text-xs text-indigo-300 py-1.5 rounded-lg border border-white/5 transition-colors">+2
                                horas</button>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm text-gray-400 mb-2">Color del Evento</label>
                    <div class="flex gap-3">
                        <button v-for="color in coloresDisponibles" :key="color" type="button"
                            @click="form.color = color"
                            class="w-8 h-8 rounded-full transition-transform hover:scale-110 flex items-center justify-center border-2"
                            :style="{ backgroundColor: color, borderColor: form.color === color ? 'white' : 'transparent' }">
                            <svg v-if="form.color === color" class="w-4 h-4 text-white drop-shadow-md" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex-1"></div>

                <div class="flex items-center justify-between mt-8 pt-4 border-t border-white/5">
                    <button v-if="isEditing" type="button" @click="$emit('delete')"
                        class="text-red-400 hover:text-red-300 hover:bg-red-400/10 px-4 py-2.5 rounded-xl transition-colors flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Eliminar
                    </button>
                    <div v-else></div>

                    <div class="flex gap-3">
                        <button type="button" @click="$emit('close')"
                            class="px-4 py-2.5 rounded-xl text-gray-300 hover:bg-white/5 transition-colors font-medium">
                            Cancelar
                        </button>
                        <button type="submit" :disabled="form.processing"
                            class="bg-indigo-500 hover:bg-indigo-600 px-6 py-2.5 rounded-xl text-white font-medium transition-all shadow-[0_0_15px_rgba(99,102,241,0.4)] disabled:opacity-50">
                            {{ form.processing ? 'Guardando...' : 'Guardar' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </Transition>
</template>

<script setup>
const props = defineProps({
    show: Boolean,
    isEditing: Boolean,
    form: Object,
    coloresDisponibles: Array
});

defineEmits(['close', 'save', 'delete', 'sumarTiempo']);

// Enlazamos las fechas directamente con el componente padre usando defineModel (Vue 3.4+)
const fechaDia = defineModel('fechaDia');
const horaInicio = defineModel('horaInicio');
const horaFin = defineModel('horaFin');
</script>

<style scoped>
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
</style>