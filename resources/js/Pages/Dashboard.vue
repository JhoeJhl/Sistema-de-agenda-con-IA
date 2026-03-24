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
                                <p class="text-gray-400 text-sm">No tienes tareas pendientes para hoy. ¡Todo al día!</p>
                            </div>

                            <div v-for="tarea in tareasHoy" :key="tarea.id" :class="['relative bg-black/30 border rounded-2xl p-5 transition-all flex flex-col justify-between group shadow-lg', esUrgente(tarea.fecha_vencimiento) ? 'border-red-500/40 bg-gradient-to-br from-red-500/10 to-transparent' : 'border-white/10 hover:border-indigo-500/50 hover:bg-white/5']">
                                <div v-if="esUrgente(tarea.fecha_vencimiento)" class="absolute top-4 right-4 flex items-center gap-2">
                                    <span class="text-[10px] font-bold text-red-400 uppercase tracking-wider">¡Urgente!</span>
                                    <div class="w-2 h-2 bg-red-500 rounded-full animate-ping"></div>
                                </div>

                                <div class="mb-4">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-400">{{ tarea.categoria }}</span>
                                        <span :class="clasePrioridad(tarea.prioridad)">{{ tarea.prioridad }}</span>
                                    </div>
                                    <h4 class="text-base font-bold text-white leading-snug mb-3 pr-12">{{ tarea.titulo }}</h4>

                                    <div v-if="tarea.fecha_vencimiento" class="flex flex-col gap-1">
                                        <div class="inline-flex items-center gap-1.5 bg-indigo-500/20 border border-indigo-500/30 text-indigo-300 px-3 py-1.5 rounded-lg text-xs font-semibold">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            Límite: {{ formatearFechaLarga(tarea.fecha_vencimiento) }} a las {{ formatearHora(tarea.fecha_vencimiento) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <div class="flex justify-between items-center bg-black/40 px-3 py-2 rounded-xl mb-3 border border-white/5">
                                        <div class="flex items-center gap-1 text-[10px] text-gray-400">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            Creada el {{ formatearFechaCorta(tarea.created_at) }}
                                        </div>
                                        <div v-if="tarea.fecha_vencimiento" class="flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold" :class="calcularTiempoRestante(tarea.fecha_vencimiento).color">
                                            {{ calcularTiempoRestante(tarea.fecha_vencimiento).texto }}
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-2 border-t border-white/5 pt-3">
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

                    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 flex-1 flex flex-col shadow-xl">
                        <h3 class="text-xl font-bold text-white mb-5 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                            Tareas para Mañana
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div v-if="!tareasManana || tareasManana.length === 0" class="col-span-full py-6 text-center text-gray-500 text-sm bg-black/10 rounded-2xl border border-white/5">
                                Aún no tienes tareas asignadas para mañana.
                            </div>

                            <div v-for="tarea in tareasManana" :key="tarea.id" class="relative bg-black/30 border border-white/10 hover:border-purple-500/50 hover:bg-white/5 rounded-2xl p-5 transition-all flex flex-col group shadow-lg">
                                <div class="mb-4">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-purple-400">{{ tarea.categoria }}</span>
                                        <span :class="clasePrioridad(tarea.prioridad)">{{ tarea.prioridad }}</span>
                                    </div>
                                    <h4 class="text-base font-bold text-white leading-snug mb-3">{{ tarea.titulo }}</h4>

                                    <div v-if="tarea.fecha_vencimiento" class="inline-flex items-center gap-1.5 bg-purple-500/20 border border-purple-500/30 text-purple-300 px-3 py-1.5 rounded-lg text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        Límite: {{ formatearFechaLarga(tarea.fecha_vencimiento) }} a las {{ formatearHora(tarea.fecha_vencimiento) }}
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <div class="flex justify-between items-center bg-black/40 px-3 py-2 rounded-xl mb-3 border border-white/5">
                                        <div class="flex items-center gap-1 text-[10px] text-gray-400">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            Creada el {{ formatearFechaCorta(tarea.created_at) }}
                                        </div>
                                        <div v-if="tarea.fecha_vencimiento" class="flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold" :class="calcularTiempoRestante(tarea.fecha_vencimiento).color">
                                            {{ calcularTiempoRestante(tarea.fecha_vencimiento).texto }}
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-2 border-t border-white/5 pt-3">
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
                </div>

                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 lg:col-span-1 h-fit sticky top-6 shadow-xl">
                    <div class="flex justify-between items-center mb-6 border-b border-white/5 pb-4">
                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                            Eventos Calendario
                        </h3>
                        <Link href="/calendario" class="text-xs font-bold text-indigo-400 hover:text-indigo-300 bg-indigo-500/10 px-3 py-1.5 rounded-lg transition-colors">Ver Calendario</Link>
                    </div>

                    <div v-if="!proximosEventos || proximosEventos.length === 0" class="text-sm text-gray-500 text-center py-10 bg-black/10 rounded-2xl border border-white/5">
                        Tu calendario está libre de eventos.
                    </div>

                    <div class="space-y-4">
                        <div v-for="evento in proximosEventos" :key="evento.id" class="relative group">
                            
                            <div class="bg-black/30 border border-white/10 hover:border-white/20 rounded-2xl p-5 transition-all overflow-hidden relative">
                                
                                <div class="absolute top-0 right-0 w-24 h-24 opacity-10 blur-2xl rounded-full" :style="{ backgroundColor: evento.color || '#6366f1' }"></div>
                                <div class="absolute left-0 top-0 bottom-0 w-1.5" :style="{ backgroundColor: evento.color || '#6366f1' }"></div>
                                
                                <div class="pl-2 relative z-10">
                                    
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="flex items-center gap-2">
                                            <span :class="['text-[10px] font-bold uppercase px-2 py-0.5 rounded border flex items-center gap-1.5', estadoEvento(evento).color]">
                                                <span v-if="estadoEvento(evento).ping" class="w-1.5 h-1.5 rounded-full bg-current animate-ping"></span>
                                                {{ estadoEvento(evento).texto }}
                                            </span>
                                        </div>
                                        <span class="text-[10px] font-bold text-gray-400 bg-white/5 px-2 py-0.5 rounded-md border border-white/10 flex items-center gap-1">
                                            ⏱️ {{ duracionEvento(evento) }}
                                        </span>
                                    </div>

                                    <h4 class="text-base font-bold text-white mb-2 pr-4">{{ evento.titulo }}</h4>

                                    <div class="flex flex-col gap-1.5 mb-3">
                                        <div class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-300 bg-indigo-500/10 px-2.5 py-1.5 rounded-lg border border-indigo-500/20 w-fit">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            {{ formatearFechaLarga(evento.fecha_inicio) }}
                                        </div>
                                        <div class="text-xs text-gray-400 pl-1 flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            De {{ formatearHora(evento.fecha_inicio) }} a {{ formatearHora(evento.fecha_fin) }}
                                        </div>
                                    </div>

                                    <div v-if="evento.descripcion" class="flex gap-2 text-xs text-gray-400 bg-black/40 p-3 rounded-xl border border-white/5 mb-3 mt-1">
                                        <svg class="w-4 h-4 flex-shrink-0 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                                        <p class="line-clamp-2 leading-relaxed">{{ evento.descripcion }}</p>
                                    </div>

                                    <div class="flex justify-between items-center mt-2 text-[10px] text-gray-500 border-t border-white/5 pt-3">
                                        <span>Añadido a la agenda: {{ formatearFechaCorta(evento.created_at) }}</span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-2 mt-3 pt-3 border-t border-white/5 opacity-80 group-hover:opacity-100 transition-opacity">
                                        <button @click="abrirConfirmacion(evento.id, 'no_realizado')" class="py-1.5 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 rounded-lg text-xs font-bold transition-all flex items-center justify-center gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            No realizado
                                        </button>
                                        <button @click="abrirConfirmacion(evento.id, 'completado')" class="py-1.5 bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 border border-emerald-500/20 rounded-lg text-xs font-bold transition-all flex items-center justify-center gap-1.5">
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
                                <option value="Alta">Alta</option>
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
                    <svg v-if="modalConfirmacion.accion === 'completado'" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    <svg v-else class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
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
                        Omitir (Posponer siguiente dia)
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
import ProductivityChart from '@/Components/ProductivityChart.vue';

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

// tareas
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
    router.put(`/tareas/${tareaId}`, { estado: nuevoEstado }, { preserveScroll: true });
};

// eventos modal
const modalConfirmacion = ref({
    isOpen: false,
    eventoId: null,
    accion: ''
});

const abrirConfirmacion = (id, accion) => {
    modalConfirmacion.value = { isOpen: true, eventoId: id, accion: accion };
};

const cerrarConfirmacion = () => {
    modalConfirmacion.value.isOpen = false;
    setTimeout(() => {
        modalConfirmacion.value = { isOpen: false, eventoId: null, accion: '' };
    }, 300);
};

const procesarEvento = () => {
    router.delete(`/calendario/${modalConfirmacion.value.eventoId}`, {
        preserveScroll: true,
        onSuccess: () => cerrarConfirmacion()
    });
};

const posponerEvento = () => {
    router.put(`/calendario/${modalConfirmacion.value.eventoId}/posponer`, {}, {
        preserveScroll: true,
        onSuccess: () => cerrarConfirmacion()
    });
};

//eventos
const estadoEvento = (evento) => {
    if (!evento.fecha_inicio) return { texto: 'Próximo', color: 'text-gray-400 bg-gray-500/20 border-gray-500/30' };
    
    const ahora = new Date();
    const inicio = new Date(evento.fecha_inicio);
    const fin = evento.fecha_fin ? new Date(evento.fecha_fin) : new Date(inicio.getTime() + 60*60*1000); 
    
    if (ahora >= inicio && ahora <= fin) {
        return { texto: 'En curso', color: 'text-emerald-400 bg-emerald-500/20 border-emerald-500/30', ping: true };
    } else if (ahora > fin) {
        return { texto: 'Finalizado', color: 'text-gray-400 bg-gray-500/20 border-gray-500/30', ping: false };
    } else {
        return { texto: 'Próximamente', color: 'text-indigo-400 bg-indigo-500/20 border-indigo-500/30', ping: false };
    }
};

const duracionEvento = (evento) => {
    if (!evento.fecha_inicio || !evento.fecha_fin) return '1h';
    
    const diffMs = new Date(evento.fecha_fin) - new Date(evento.fecha_inicio);
    const minutosTotales = Math.floor(diffMs / 60000);
    
    if (minutosTotales >= 60) {
        const horas = Math.floor(minutosTotales / 60);
        const minutosRestantes = minutosTotales % 60;
        return minutosRestantes > 0 ? `${horas}h ${minutosRestantes}m` : `${horas}h`;
    }
    return `${minutosTotales}m`;
};

const clasePrioridad = (prioridad) => {
    if (prioridad === 'Alta') return 'text-[9px] font-bold uppercase bg-red-500/20 text-red-400 px-1.5 py-0.5 rounded border border-red-500/30';
    if (prioridad === 'Media') return 'text-[9px] font-bold uppercase bg-blue-500/20 text-blue-400 px-1.5 py-0.5 rounded border border-blue-500/30';
    return 'text-[9px] font-bold uppercase bg-gray-500/20 text-gray-400 px-1.5 py-0.5 rounded border border-gray-500/30';
};

// NUEVO: Fecha corta (Ej. "24 Mar")
const formatearFechaCorta = (fechaString) => {
    if (!fechaString) return 'Desconocida';
    const opciones = { day: 'numeric', month: 'short' };
    return new Date(fechaString).toLocaleDateString('es-ES', opciones);
};

// FECHA LARGA (Ej. "jue, 24 oct")
const formatearFechaLarga = (fechaString) => {
    if (!fechaString) return '';
    const opciones = { weekday: 'short', day: 'numeric', month: 'short' };
    return new Date(fechaString).toLocaleDateString('es-ES', opciones);
};

const calcularTiempoRestante = (fechaString) => {
    if (!fechaString) return { texto: 'Sin fecha', color: 'text-gray-400 bg-gray-500/10 border-gray-500/20' };

    const ahora = new Date();
    const vencimiento = new Date(fechaString);
    const diffMs = vencimiento - ahora;
    const diffHoras = diffMs / (1000 * 60 * 60);
    const diffDias = Math.floor(diffHoras / 24);

    if (diffHoras < 0) {
        return { texto: 'Vencida', color: 'text-red-400 bg-red-500/10 border-red-500/20 animate-pulse' };
    } else if (diffHoras <= 2) {
        return { texto: 'Vence muy pronto', color: 'text-red-400 bg-red-500/10 border-red-500/20' };
    } else if (diffHoras <= 24) {
        return { texto: `En ${Math.floor(diffHoras)} horas`, color: 'text-amber-400 bg-amber-500/10 border-amber-500/20' };
    } else {
        return { texto: `Faltan ${diffDias} días`, color: 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20' };
    }
};

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