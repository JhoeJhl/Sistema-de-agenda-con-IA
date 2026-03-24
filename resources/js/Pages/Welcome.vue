<template>
    <Head title="AgendaIA" />

    <div class="min-h-screen bg-gray-900 overflow-x-hidden relative font-sans text-white">
        
        <!-- Elementos decorativos mejorados -->
        <div class="fixed top-20 left-20 w-96 h-96 bg-indigo-600/20 rounded-full blur-[120px] pointer-events-none z-0 animate-pulse-slow"></div>
        <div class="fixed bottom-40 right-10 w-80 h-80 bg-purple-600/20 rounded-full blur-[110px] pointer-events-none z-0 animate-pulse-slow animation-delay-2000"></div>
        <div class="fixed top-1/2 left-1/2 w-96 h-96 bg-pink-600/10 rounded-full blur-[120px] pointer-events-none z-0 animate-pulse-slow animation-delay-4000"></div>
    
       
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="pt-6 pb-12">
                <Navbar />
            </div>

            <!-- Hero Section mejorado -->
            <main class="py-16 text-center flex flex-col items-center gap-6">
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter max-w-4xl leading-[1.1] bg-clip-text text-transparent bg-gradient-to-b from-white via-indigo-200 to-gray-400">
                    Tu Tiempo, Optimizado.<br> El Futuro de la Organización es Ahora.
                </h1>

                <p class="text-xl text-gray-400 max-w-2xl mt-3">
                    Agenda IA es un sistema de organización inteligente que aprende tus ritmos, predice tus huecos y bloquea tiempo de enfoque automáticamente para que tú solo tengas que producir.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4 mt-6">
                    <Link href="/register" class="group relative bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 shadow-lg hover:shadow-indigo-500/25 active:scale-95">
                        <span class="relative z-10 flex items-center gap-2">
                            Empezar Gratis
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                    </Link>
                    <a href="#funcionalidades" class="text-gray-300 hover:text-white px-8 py-3 rounded-full font-medium flex items-center gap-2 transition-all duration-300 hover:bg-white/5">
                        Ver funcionalidades 
                        <svg class="w-4 h-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Stats Section -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mt-16 pt-8 border-t border-gray-800/50 w-full">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-400">10K+</div>
                        <div class="text-sm text-gray-500">Usuarios Activos</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-400">85%</div>
                        <div class="text-sm text-gray-500">Más Productividad</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-400">24/7</div>
                        <div class="text-sm text-gray-500">Soporte IA</div>
                    </div>
                </div>
            </main>

            <!-- Funcionalidades mejoradas con IA -->
            <section id="funcionalidades" class="py-20">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">
                        Potenciado por Inteligencia Artificial
                    </h2>
                    <p class="text-gray-400 max-w-2xl mx-auto">
                        Descubre cómo nuestra IA transforma tu organización personal
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <div class="group bg-gray-800/30 border border-gray-700/50 rounded-2xl p-8 backdrop-blur-sm hover:border-indigo-500/50 transition-all duration-300 hover:transform hover:-translate-y-1">
                        <div class="bg-gradient-to-br from-indigo-500/20 to-purple-500/20 p-4 rounded-2xl text-indigo-400 w-fit mb-6 border border-indigo-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-semibold text-white mb-3">Auto-Bloqueo Inteligente</h4>
                        <p class="text-gray-400 text-sm leading-relaxed">Nuestra IA analiza tu historial y bloquea automáticamente tiempo de enfoque y descanso para prevenir el burn-out.</p>
                        <div class="mt-4 flex items-center gap-2 text-indigo-400 text-sm">
                            <span>Predictivo</span>
                            <span class="w-1 h-1 bg-indigo-400 rounded-full"></span>
                            <span>Adaptativo</span>
                        </div>
                    </div>

                    <div class="group bg-gray-800/30 border border-gray-700/50 rounded-2xl p-8 backdrop-blur-sm hover:border-indigo-500/50 transition-all duration-300 hover:transform hover:-translate-y-1">
                        <div class="bg-gradient-to-br from-indigo-500/20 to-purple-500/20 p-4 rounded-2xl text-indigo-400 w-fit mb-6 border border-indigo-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-semibold text-white mb-3">Sincronización Total</h4>
                        <p class="text-gray-400 text-sm leading-relaxed">Integramos todos tus calendarios (Google, Outlook, etc.) y la IA gestiona todos tus compromisos en un solo lugar.</p>
                        <div class="mt-4 flex items-center gap-2 text-indigo-400 text-sm">
                            <span>Multiplataforma</span>
                            <span class="w-1 h-1 bg-indigo-400 rounded-full"></span>
                            <span>En Tiempo Real</span>
                        </div>
                    </div>

                    <div class="group bg-gray-800/30 border border-gray-700/50 rounded-2xl p-8 backdrop-blur-sm hover:border-indigo-500/50 transition-all duration-300 hover:transform hover:-translate-y-1">
                        <div class="bg-gradient-to-br from-indigo-500/20 to-purple-500/20 p-4 rounded-2xl text-indigo-400 w-fit mb-6 border border-indigo-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-semibold text-white mb-3">Análisis de Hábitos</h4>
                        <p class="text-gray-400 text-sm leading-relaxed">Recibe reportes semanales impulsados por IA sobre cómo usas tu tiempo y qué rutinas te hacen más productivo.</p>
                        <div class="mt-4 flex items-center gap-2 text-indigo-400 text-sm">
                            <span>Reportes IA</span>
                            <span class="w-1 h-1 bg-indigo-400 rounded-full"></span>
                            <span>Insights Accionables</span>
                        </div>
                    </div>
                </div>

                <!-- Funcionalidades extras de IA -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
                    <div class="bg-gradient-to-br from-indigo-500/5 to-purple-500/5 border border-gray-700/50 rounded-2xl p-8 backdrop-blur-sm">
                        <div class="flex items-start gap-4">
                            <div class="bg-indigo-500/20 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-white mb-2">Recomendaciones Personalizadas</h4>
                                <p class="text-gray-400 text-sm">La IA aprende de tus patrones y sugiere horarios óptimos para tareas específicas basadas en tu productividad histórica.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-indigo-500/5 to-purple-500/5 border border-gray-700/50 rounded-2xl p-8 backdrop-blur-sm">
                        <div class="flex items-start gap-4">
                            <div class="bg-indigo-500/20 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-white mb-2">Predicción de Conflictos</h4>
                                <p class="text-gray-400 text-sm">Anticipa conflictos de horarios antes de que ocurran y recibe sugerencias automáticas de reubicación de tareas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sección de IA en acción -->
            <section class="py-12">
                <div class="bg-gradient-to-r from-indigo-500/10 to-purple-500/10 border border-indigo-500/20 rounded-3xl p-8 md:p-12 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div class="flex-1 text-center md:text-left">
                            <div class="inline-flex items-center gap-2 bg-indigo-500/20 rounded-full px-4 py-2 mb-4">
                                <svg class="w-4 h-4 text-indigo-400 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 3.5a1.5 1.5 0 013 0V4a1.5 1.5 0 01-3 0v-.5zM10 7a3 3 0 00-3 3v3a3 3 0 003 3 3 3 0 003-3v-3a3 3 0 00-3-3z"/>
                                </svg>
                                <span class="text-xs text-indigo-300 font-medium">ASISTENTE IA ACTIVO</span>
                            </div>
                            <h3 class="text-3xl font-bold text-white mb-4">Tu asistente IA está listo para ayudarte</h3>
                            <p class="text-gray-400 mb-6">Configura tus preferencias y deja que la inteligencia artificial optimice tu agenda diaria</p>
                            <Link href="/register" class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold transition-all">
                                Activar IA ahora
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </Link>
                        </div>
                        <div class="flex-1 flex justify-center">
                            <div class="relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full blur-xl opacity-50 animate-pulse"></div>
                                <div class="relative bg-gray-800/50 rounded-full p-6 border border-indigo-500/30">
                                    <svg class="w-16 h-16 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section mejorado -->
            <section class="py-20 text-center flex flex-col items-center gap-6 mt-12 bg-gray-800/30 border border-gray-700/50 rounded-[40px] px-10 relative overflow-hidden group">
                <div class="absolute -inset-px bg-gradient-to-r from-indigo-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-1000 blur-xl pointer-events-none"></div>
                
                <!-- Partículas animadas -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full">
                    <div class="absolute top-10 left-10 w-2 h-2 bg-indigo-400 rounded-full animate-ping"></div>
                    <div class="absolute bottom-10 right-20 w-3 h-3 bg-purple-400 rounded-full animate-ping animation-delay-1000"></div>
                    <div class="absolute top-1/3 right-1/4 w-2 h-2 bg-pink-400 rounded-full animate-ping animation-delay-2000"></div>
                </div>
                
                <h2 class="text-5xl font-extrabold tracking-tighter bg-clip-text text-transparent bg-gradient-to-r from-indigo-300 via-purple-300 to-pink-300 relative z-10">
                    No dejes que tu día te controle.<br> Controla tu día.
                </h2>
                <p class="text-lg text-gray-400 max-w-xl relative z-10">Únete a miles de profesionales que ya están usando la Inteligencia Artificial para recuperar el control de su tiempo y lograr más con menos esfuerzo.</p>
                
                <div class="flex flex-col sm:flex-row gap-4 relative z-10">
                    <Link href="/register" class="group bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white px-10 py-4 rounded-full font-semibold transition-all duration-300 shadow-lg hover:shadow-indigo-500/25 active:scale-95 text-lg">
                        <span class="flex items-center gap-2">
                            Empezar mi Prueba Gratuita
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                    </Link>
                    <a href="#" class="border border-gray-600 hover:border-indigo-500 text-gray-300 hover:text-white px-10 py-4 rounded-full font-semibold transition-all duration-300">
                        Ver Demo IA
                    </a>
                </div>

                <!-- Testimonial mini -->
                <div class="mt-12 pt-8 border-t border-gray-700/50 flex items-center gap-4 text-left">
                    <div class="flex -space-x-2">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm border-2 border-gray-800">JD</div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white font-bold text-sm border-2 border-gray-800">MA</div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-400 to-purple-400 flex items-center justify-center text-white font-bold text-sm border-2 border-gray-800">CR</div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">"La IA me ha ayudado a recuperar más de 10 horas a la semana"</p>
                        <p class="text-xs text-indigo-400 mt-1">— Carlos Rodríguez, CEO TechStart</p>
                    </div>
                </div>
            </section>

        </div>

        <Footer />
        
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
</script>

<style scoped>
@keyframes pulse-slow {
    0%, 100% {
        opacity: 0.5;
        transform: scale(1);
    }
    50% {
        opacity: 0.8;
        transform: scale(1.05);
    }
}

.animate-pulse-slow {
    animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.animation-delay-1000 {
    animation-delay: 1s;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}
</style>