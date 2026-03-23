<template>
    <nav class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl px-4 sm:px-6 py-4 flex justify-between items-center shadow-2xl relative z-50">

        <Link href="/" class="flex items-center gap-3 group">
            <div class="bg-gradient-to-tr from-indigo-500 to-purple-500 p-2 rounded-xl group-hover:scale-105 transition-transform shadow-[0_0_15px_rgba(99,102,241,0.4)]">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400 tracking-wide hidden sm:block">
                Agenda IA
            </span>
        </Link>

        <div v-if="$page.props.auth.user" class="hidden md:flex items-center gap-1 bg-black/20 p-1.5 rounded-xl border border-white/5">
            <Link href="/dashboard" :class="['px-4 py-2 rounded-lg text-sm font-medium transition-all', $page.url.startsWith('/dashboard') ? 'text-white bg-indigo-500/20 shadow-[0_0_10px_rgba(99,102,241,0.2)] border border-indigo-500/30' : 'text-gray-400 hover:text-white hover:bg-white/10']">
                Dashboard
            </Link>
            <Link href="/calendario" :class="['px-4 py-2 rounded-lg text-sm font-medium transition-all', $page.url.startsWith('/calendario') ? 'text-white bg-indigo-500/20 shadow-[0_0_10px_rgba(99,102,241,0.2)] border border-indigo-500/30' : 'text-gray-400 hover:text-white hover:bg-white/10']">
                Calendario
            </Link>
            <button class="px-4 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/10 transition-all">Hábitos</button>
            <button class="px-4 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/10 transition-all">Ajustes IA</button>
        </div>

        <div class="flex items-center gap-3">
            
            <div v-if="$page.props.auth.user" class="relative">
                <div v-if="isMenuOpen" @click="isMenuOpen = false" class="fixed inset-0 z-40"></div>
                <button @click="isMenuOpen = !isMenuOpen" class="relative z-50 flex items-center gap-2 text-gray-400 hover:text-white transition-colors p-2 bg-white/5 rounded-full hover:bg-white/10 border border-white/5 focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </button>
                <Transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 scale-95 translate-y-2" enter-to-class="opacity-100 scale-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 scale-100 translate-y-0" leave-to-class="opacity-0 scale-95 translate-y-2">
                    <div v-if="isMenuOpen" class="absolute right-0 mt-3 w-56 bg-[#1e293b] backdrop-blur-2xl border border-white/10 rounded-2xl shadow-2xl z-50 overflow-hidden">
                        <div class="px-4 py-3 bg-white/5 border-b border-white/5">
                            <p class="text-sm font-semibold text-white truncate">{{ $page.props.auth.user.name }}</p>
                            <p class="text-xs text-gray-400 truncate mt-0.5">{{ $page.props.auth.user.email }}</p>
                        </div>
                        <div class="p-2">
                            <Link href="/profile" @click="isMenuOpen = false" class="flex items-center gap-3 w-full px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition-colors">
                                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Mi Perfil
                            </Link>
                            <Link href="#" @click="isMenuOpen = false" class="flex items-center gap-3 w-full px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition-colors mt-1">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                                Preferencias de IA
                            </Link>
                        </div>
                        <div class="p-2 border-t border-white/5 bg-black/10">
                            <Link href="/logout" method="post" as="button" class="flex items-center gap-3 w-full px-3 py-2 text-sm text-red-400 hover:text-red-300 hover:bg-red-400/10 rounded-xl transition-colors text-left">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                Cerrar Sesión
                            </Link>
                        </div>
                    </div>
                </Transition>
            </div>

            <div v-else class="flex items-center gap-2">
                <button @click="isLoginModalOpen = true" class="text-gray-300 hover:text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                    Iniciar Sesión
                </button>
                <button @click="isRegisterModalOpen = true" class="bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors shadow-[0_0_10px_rgba(99,102,241,0.3)]">
                    Registrarse
                </button>
            </div>
        </div>
    </nav>

    <Transition enter-active-class="transition ease-out duration-300" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="transition ease-in duration-200" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
        <div v-if="isLoginModalOpen" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-[#1e293b]/90 border border-white/10 rounded-3xl p-8 shadow-2xl max-w-md w-full relative">
                
                <button @click="isLoginModalOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition-colors bg-white/5 p-2 rounded-full hover:bg-white/10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>

                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-white mb-2">Bienvenido de nuevo</h2>
                    <p class="text-gray-400 text-sm">Inicia sesión para continuar organizando tu tiempo.</p>
                </div>

                <form @submit.prevent="submitLogin" class="flex flex-col gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Correo Electrónico</label>
                        <input v-model="loginForm.email" type="email" required autofocus class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all">
                        <span v-if="loginForm.errors.email" class="text-red-400 text-xs mt-1 block">{{ loginForm.errors.email }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Contraseña</label>
                        <input v-model="loginForm.password" type="password" required class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all">
                        <span v-if="loginForm.errors.password" class="text-red-400 text-xs mt-1 block">{{ loginForm.errors.password }}</span>
                    </div>

                    <div class="flex items-center justify-between mt-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input v-model="loginForm.remember" type="checkbox" class="rounded border-gray-600 bg-black/20 text-indigo-500 focus:ring-indigo-500">
                            <span class="text-sm text-gray-400">Recordarme</span>
                        </label>
                        <a href="#" class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" :disabled="loginForm.processing" class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white font-bold py-3.5 rounded-xl transition-all shadow-[0_0_15px_rgba(99,102,241,0.4)] disabled:opacity-50 mt-4">
                        {{ loginForm.processing ? 'Iniciando...' : 'Iniciar Sesión' }}
                    </button>
                </form>

                <p class="text-center text-sm text-gray-400 mt-6">
                    ¿No tienes una cuenta? 
                    <button @click="switchToRegister" class="text-indigo-400 font-semibold hover:text-indigo-300 transition-colors">Regístrate aquí</button>
                </p>
            </div>
        </div>
    </Transition>

    <Transition enter-active-class="transition ease-out duration-300" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="transition ease-in duration-200" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
        <div v-if="isRegisterModalOpen" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-[#1e293b]/90 border border-white/10 rounded-3xl p-8 shadow-2xl max-w-md w-full relative">
                
                <button @click="isRegisterModalOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition-colors bg-white/5 p-2 rounded-full hover:bg-white/10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>

                <div class="text-center mb-6">
                    <h2 class="text-3xl font-bold text-white mb-2">Crea tu Cuenta</h2>
                    <p class="text-gray-400 text-sm">Únete hoy y multiplica tu productividad.</p>
                </div>

                <form @submit.prevent="submitRegister" class="flex flex-col gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Nombre Completo</label>
                        <input v-model="registerForm.name" type="text" required autofocus class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all">
                        <span v-if="registerForm.errors.name" class="text-red-400 text-xs mt-1 block">{{ registerForm.errors.name }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Correo Electrónico</label>
                        <input v-model="registerForm.email" type="email" required class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all">
                        <span v-if="registerForm.errors.email" class="text-red-400 text-xs mt-1 block">{{ registerForm.errors.email }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Contraseña</label>
                            <input v-model="registerForm.password" type="password" required class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all">
                            <span v-if="registerForm.errors.password" class="text-red-400 text-xs mt-1 block">{{ registerForm.errors.password }}</span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Confirmar</label>
                            <input v-model="registerForm.password_confirmation" type="password" required class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all">
                        </div>
                    </div>

                    <button type="submit" :disabled="registerForm.processing" class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white font-bold py-3.5 rounded-xl transition-all shadow-[0_0_15px_rgba(99,102,241,0.4)] disabled:opacity-50 mt-4">
                        {{ registerForm.processing ? 'Creando cuenta...' : 'Registrarse Ahora' }}
                    </button>
                </form>

                <p class="text-center text-sm text-gray-400 mt-6">
                    ¿Ya tienes una cuenta? 
                    <button @click="switchToLogin" class="text-indigo-400 font-semibold hover:text-indigo-300 transition-colors">Inicia sesión</button>
                </p>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';

const isMenuOpen = ref(false);

// Modales
const isLoginModalOpen = ref(false);
const isRegisterModalOpen = ref(false);
const switchToRegister = () => {
    isLoginModalOpen.value = false;
    setTimeout(() => { isRegisterModalOpen.value = true; }, 300);
};

const switchToLogin = () => {
    isRegisterModalOpen.value = false;
    setTimeout(() => { isLoginModalOpen.value = true; }, 300);
};
// Inertia Form
const loginForm = useForm({
    email: '',
    password: '',
    remember: false,
});

const registerForm = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submitLogin = () => {
    loginForm.post('/login', {
        onSuccess: () => {
            isLoginModalOpen.value = false;
            loginForm.reset();
        },
        onError: () => {
            loginForm.password = '';
        }
    });
};

// envia registro
const submitRegister = () => {
    registerForm.post('/register', {
        onSuccess: () => {
            isRegisterModalOpen.value = false;
            registerForm.reset();
        },
        onError: () => {
            registerForm.password = '';
            registerForm.password_confirmation = '';
        }
    });
};
</script>