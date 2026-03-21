<template>
    <Head title="Tu Tiempo, Optimizado. El Futuro es Ahora" />

    <div class="min-h-screen bg-[#0f172a] overflow-x-hidden relative font-sans text-white">
        
        <div class="absolute top-20 left-20 w-96 h-96 bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none z-0"></div>
        <div class="absolute bottom-40 right-10 w-80 h-80 bg-purple-600/10 rounded-full blur-[110px] pointer-events-none z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="pt-6 pb-12">
                <Navbar />
            </div>

            <main class="py-16 text-center flex flex-col items-center gap-6">

                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter max-w-4xl leading-[0.95] bg-clip-text text-transparent bg-gradient-to-b from-white to-gray-400">
                    Tu Tiempo, Optimizado.<br> El Futuro de la Organización es Ahora.
                </h1>

                <p class="text-xl text-gray-400 max-w-2xl mt-3">
                    Agenda IA es un sistema de organización inteligente que aprende tus ritmos, predice tus huecos y bloquea tiempo de enfoque automáticamente para que tú solo tengas que producir.
                </p>

                <div class="flex items-center gap-4 mt-6">
                    <Link href="/register" class="bg-indigo-500 hover:bg-indigo-600 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-[0_0_20px_rgba(99,102,241,0.4)] active:scale-95">
                        Empezar Gratis 
                    </Link>
                    <a href="#funcionalidades" class="text-gray-300 hover:text-white px-8 py-3 rounded-full font-medium flex items-center gap-2 transition-colors">
                        Ver funcionalidades <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                </div>
            </main>

            <section id="funcionalidades" class="py-20">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <div class="bg-white/5 border border-white/10 rounded-3xl p-8 shadow-xl backdrop-blur-lg hover:border-indigo-500/40 transition-all group">
                        <div class="bg-indigo-500/10 p-4 rounded-full text-indigo-400 w-fit mb-6 border border-indigo-500/20 shadow-[0_0_10px_rgba(99,102,241,0.1)]">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h4 class="text-2xl font-semibold text-white mb-2">Auto-Bloqueo Inteligente</h4>
                        <p class="text-gray-400 text-sm">Nuestra IA analiza tu historial y bloquea automáticamente tiempo de enfoque y descanso para prevenir el burn-out.</p>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-3xl p-8 shadow-xl backdrop-blur-lg hover:border-indigo-500/40 transition-all">
                        <div class="bg-indigo-500/10 p-4 rounded-full text-indigo-400 w-fit mb-6 border border-indigo-500/20 shadow-[0_0_10px_rgba(99,102,241,0.1)]">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h4 class="text-2xl font-semibold text-white mb-2">Sincronización Total</h4>
                        <p class="text-gray-400 text-sm">Integramos todos tus calendarios (Google, Outlook, etc.) y la IA gestiona todos tus compromisos en un solo lugar.</p>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-3xl p-8 shadow-xl backdrop-blur-lg hover:border-indigo-500/40 transition-all">
                        <div class="bg-indigo-500/10 p-4 rounded-full text-indigo-400 w-fit mb-6 border border-indigo-500/20 shadow-[0_0_10px_rgba(99,102,241,0.1)]">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h4 class="text-2xl font-semibold text-white mb-2">Análisis de Hábitos</h4>
                        <p class="text-gray-400 text-sm">Recibe reportes semanales impulsados por IA sobre cómo usas tu tiempo y qué rutinas te hacen más productivo.</p>
                    </div>
                </div>
            </section>

            <section class="py-20 text-center flex flex-col items-center gap-6 mt-12 bg-white/5 border border-white/10 rounded-[40px] px-10 relative overflow-hidden group">
                <div class="absolute -inset-px bg-gradient-to-r from-indigo-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-1000 blur-xl pointer-events-none"></div>
                <h2 class="text-5xl font-extrabold tracking-tighter bg-clip-text text-transparent bg-gradient-to-r from-indigo-300 to-purple-300 relative z-10">
                    No dejes que tu día te controle.<br> Controla tu día.
                </h2>
                <p class="text-lg text-gray-400 max-w-xl relative z-10">Únete a miles de profesionales que ya están usando la Inteligencia Artificial para recuperar el control de su tiempo y lograr más con menos esfuerzo.</p>
                <Link href="/register" class="bg-indigo-500 hover:bg-indigo-600 text-white px-10 py-4 rounded-full font-semibold transition-all shadow-[0_0_30px_rgba(99,102,241,0.5)] active:scale-95 relative z-10 text-lg">
                    Empezar mi Prueba Gratuita
                </Link>
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