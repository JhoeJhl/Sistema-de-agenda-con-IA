<template>
    <Transition enter-active-class="transition ease-out duration-300" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="transition ease-in duration-200" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
        <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
            <div class="bg-[#1e293b] border border-white/10 rounded-2xl p-6 shadow-2xl max-w-sm w-full relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-red-500"></div>
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-red-500/20 p-3 rounded-full text-red-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Eliminar Evento</h3>
                </div>
                <p class="text-gray-300 mb-6 text-sm">¿Estás seguro de que deseas eliminar este evento? Esta acción no se puede deshacer y desaparecerá de tu calendario.</p>
                <div class="flex justify-end gap-3">
                    <button @click="$emit('close')" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-white/5 transition-colors font-medium">
                        Cancelar
                    </button>
                    <button @click="$emit('confirm')" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl font-medium transition-colors shadow-lg shadow-red-500/30">
                        Sí, eliminar
                    </button>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup>
defineProps({
    show: Boolean
});

defineEmits(['close', 'confirm']);
</script>