<template>
    <nav
        class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl px-4 sm:px-6 py-4 flex justify-between items-center shadow-2xl relative z-50">

        <Link href="/" class="flex items-center gap-3 group">
            <div
                class="bg-gradient-to-tr from-indigo-500 to-purple-500 p-2 rounded-xl group-hover:scale-105 transition-transform shadow-[0_0_15px_rgba(99,102,241,0.4)]">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <span
                class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400 tracking-wide hidden sm:block">
                Agenda IA
            </span>
        </Link>

        <div v-if="$page.props.auth.user"
            class="hidden md:flex items-center gap-1 bg-black/20 p-1.5 rounded-xl border border-white/5">
            <Link href="/dashboard"
                :class="['px-4 py-2 rounded-lg text-sm font-medium transition-all',
                    $page.url.startsWith('/dashboard') ? 'text-white bg-indigo-500/20 shadow-[0_0_10px_rgba(99,102,241,0.2)] border border-indigo-500/30' : 'text-gray-400 hover:text-white hover:bg-white/10']">
                Dashboard
            </Link>

            <Link href="/calendario"
                :class="['px-4 py-2 rounded-lg text-sm font-medium transition-all',
                    $page.url.startsWith('/calendario') ? 'text-white bg-indigo-500/20 shadow-[0_0_10px_rgba(99,102,241,0.2)] border border-indigo-500/30' : 'text-gray-400 hover:text-white hover:bg-white/10']">
                Calendario
            </Link>

            <button
                class="px-4 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/10 transition-all">
                Hábitos
            </button>
            <button
                class="px-4 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/10 transition-all">
                Ajustes IA
            </button>
        </div>

        <div class="flex items-center gap-3">
            <Link v-if="$page.props.auth.user" href="/profile"
                class="text-gray-400 hover:text-white transition-colors p-2 bg-white/5 rounded-full hover:bg-white/10 border border-white/5"
                title="Ir al Perfil">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </Link>

            <div v-else class="flex items-center gap-2">
                <Link href="/login"
                    class="text-gray-300 hover:text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                    Iniciar Sesión
                </Link>
                <Link href="/register"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors shadow-[0_0_10px_rgba(99,102,241,0.3)]">
                    Registrarse
                </Link>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>