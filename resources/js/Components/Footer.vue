<template>
    <footer class="mt-20 py-10 border-t border-white/5 relative z-10 bg-black/20 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8 mb-10">
                
                <div class="col-span-2 md:col-span-2 flex flex-col gap-3">
                    <Link href="/" class="flex items-center gap-3 group w-fit">
                        <div class="bg-gradient-to-tr from-indigo-500 to-purple-500 p-2 rounded-xl group-hover:scale-105 transition-transform shadow-[0_0_15px_rgba(99,102,241,0.4)]">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400 tracking-wide">
                            Agenda IA
                        </span>
                    </Link>
                    <p class="text-sm text-gray-400 max-w-sm">
                        Optimiza tu tiempo y duplica tu productividad con el primer sistema de organización impulsado por Inteligencia Artificial real.
                    </p>
                </div>

                <div>
                    <h5 class="font-semibold text-white mb-4">Producto</h5>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Funcionalidades</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Precios</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">API</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-semibold text-white mb-4">Compañía</h5>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Sobre Nosotros</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Carreras</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-semibold text-white mb-4">Legal</h5>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Términos</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Privacidad</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Soporte</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/5 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-xs text-gray-500">
                    &copy; {{ new Date().getFullYear() }} Agenda IA Inc. Todos los derechos reservados.
                </p>
                <div class="flex items-center gap-4 text-gray-500">
                    <a href="#" class="hover:text-white transition-colors" title="Twitter"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.137 8.137 0 0 1-2.008 2.083z"></path></svg></a>
                    <a href="#" class="hover:text-white transition-colors" title="GitHub"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"></path></svg></a>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>