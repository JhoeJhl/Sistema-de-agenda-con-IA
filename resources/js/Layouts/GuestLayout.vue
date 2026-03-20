<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#0f172a] overflow-hidden relative">

        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-purple-600/30 rounded-full blur-[100px] animate-pulse"></div>
        <div class="absolute bottom-1/4 -right-20 w-80 h-80 bg-blue-600/20 rounded-full blur-[100px]"></div>

        <div class="z-10">
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-100" />
            </Link>
        </div>

        <div class="z-10 w-full sm:max-w-md mt-6 px-8 py-10 
                    bg-white/5 backdrop-blur-xl 
                    border border-white/10 
                    shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] 
                    sm:rounded-3xl overflow-hidden">

            <h2 class="text-white text-2xl font-bold mb-6 text-center">Agenda AI</h2>

            <slot />
        </div>
    </div>
</template>
