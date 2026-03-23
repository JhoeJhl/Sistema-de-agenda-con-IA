<template>
    <nav class="bg-gray-900/80 backdrop-blur-xl border-b border-gray-800/50 px-4 sm:px-6 py-3 flex justify-between items-center sticky top-0 z-50 transition-all duration-300">
        <Link href="/" class="flex items-center gap-3 group">
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-xl blur-md group-hover:blur-xl transition-all duration-300 opacity-75"></div>
                <div class="relative bg-gradient-to-br from-indigo-500 to-purple-600 p-2 rounded-xl group-hover:scale-105 transition-all duration-300 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="hidden sm:block">
                <span class="text-xl font-bold bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent tracking-wide">
                    Agenda IA
                </span>
                <span class="text-xs text-gray-500 block -mt-1">Inteligencia Artificial</span>
            </div>
        </Link>

        <div v-if="$page.props.auth.user" class="hidden md:flex items-center gap-1 bg-gray-800/30 p-1.5 rounded-xl border border-gray-700/50 backdrop-blur-sm">
            <Link href="/dashboard" :class="['px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-2', 
                $page.url.startsWith('/dashboard') ? 'bg-gradient-to-r from-indigo-500/20 to-purple-500/20 text-white border border-indigo-500/30 shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gray-700/50']">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </Link>
            <Link href="/calendario" :class="['px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-2',
                $page.url.startsWith('/calendario') ? 'bg-gradient-to-r from-indigo-500/20 to-purple-500/20 text-white border border-indigo-500/30 shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gray-700/50']">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Calendario
            </Link>
            <Link href="/habitos" :class="['px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-2',
                $page.url.startsWith('/habitos') ? 'bg-gradient-to-r from-indigo-500/20 to-purple-500/20 text-white border border-indigo-500/30 shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gray-700/50']">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Hábitos
            </Link>
            <Link href="/ajustes-ia" :class="['px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-2',
                $page.url.startsWith('/ajustes-ia') ? 'bg-gradient-to-r from-indigo-500/20 to-purple-500/20 text-white border border-indigo-500/30 shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gray-700/50']">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Ajustes IA
            </Link>
        </div>
        <div class="flex items-center gap-3">

            <div v-if="$page.props.auth.user" class="relative">
                <button @click="toggleNotifications" class="relative p-2 text-gray-400 hover:text-white hover:bg-gray-800/50 rounded-full transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span v-if="unreadNotifications > 0" class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                </button>
                <Transition>
                    <div v-if="showNotifications" class="absolute right-0 mt-2 w-80 bg-gray-800 border border-gray-700 rounded-xl shadow-2xl z-50">
                        <div class="p-3 border-b border-gray-700">
                            <h3 class="text-white font-semibold">Notificaciones</h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <div v-for="notif in notifications" :key="notif.id" class="p-3 hover:bg-gray-700/50 transition-colors cursor-pointer border-b border-gray-700/50">
                                <p class="text-sm text-white">{{ notif.message }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ formatTime(notif.created_at) }}</p>
                            </div>
                            <div v-if="notifications.length === 0" class="p-4 text-center text-gray-400 text-sm">
                                No hay notificaciones
                            </div>
                        </div>
                    </div>
                </Transition>
            </div>

            <!-- menu usuario -->
            <div v-if="$page.props.auth.user" class="relative">
                <div v-if="isMenuOpen" @click="isMenuOpen = false" class="fixed inset-0 z-40"></div>
                <button @click="isMenuOpen = !isMenuOpen" class="relative z-50 flex items-center gap-2 text-gray-400 hover:text-white transition-all duration-200 p-2 bg-gray-800/50 rounded-full hover:bg-gray-700/50 border border-gray-700/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </button>
                
                <Transition>
                    <div v-if="isMenuOpen" class="absolute right-0 mt-3 w-64 bg-gray-800 backdrop-blur-xl border border-gray-700 rounded-2xl shadow-2xl z-50 overflow-hidden">
                        <div class="px-4 py-3 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 border-b border-gray-700">
                            <p class="text-sm font-semibold text-white truncate">{{ $page.props.auth.user.name }}</p>
                            <p class="text-xs text-gray-400 truncate mt-0.5">{{ $page.props.auth.user.email }}</p>
                        </div>
                        <div class="p-2">
                            <Link href="/profile" @click="isMenuOpen = false" class="flex items-center gap-3 w-full px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-700/50 rounded-xl transition-all duration-200">
                                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Mi Perfil
                            </Link>
                            <Link href="/ajustes-ia" @click="isMenuOpen = false" class="flex items-center gap-3 w-full px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-700/50 rounded-xl transition-all duration-200 mt-1">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Preferencias IA
                            </Link>
                            <Link href="/estadisticas" @click="isMenuOpen = false" class="flex items-center gap-3 w-full px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-700/50 rounded-xl transition-all duration-200 mt-1">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Estadísticas
                            </Link>
                        </div>
                        <div class="p-2 border-t border-gray-700 bg-gray-900/50">
                            <Link href="/logout" method="post" as="button" class="flex items-center gap-3 w-full px-3 py-2 text-sm text-red-400 hover:text-red-300 hover:bg-red-400/10 rounded-xl transition-all duration-200 text-left">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Cerrar Sesión
                            </Link>
                        </div>
                    </div>
                </Transition>
            </div>

            <!-- botones autenticacion -->
            <div v-else class="flex items-center gap-2">
                <button @click="isLoginModalOpen = true" class="text-gray-300 hover:text-white text-sm font-medium px-4 py-2 rounded-lg transition-all duration-200 hover:bg-gray-800/50">
                    Iniciar Sesión
                </button>
                <button @click="isRegisterModalOpen = true" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-all duration-200 shadow-lg hover:shadow-indigo-500/25">
                    Registrarse
                </button>
            </div>
        </div>
    </nav>

    <!-- login modal -->
    <Transition>
        <div v-if="isLoginModalOpen" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/70 backdrop-blur-md p-4" @click.self="isLoginModalOpen = false">
            <div class="bg-gray-800/95 border border-gray-700 rounded-2xl p-8 shadow-2xl max-w-md w-full relative transform transition-all">
                <button @click="isLoginModalOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition-colors bg-gray-700/50 p-2 rounded-full hover:bg-gray-600/50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">Bienvenido de nuevo</h2>
                    <p class="text-gray-400 text-sm">Inicia sesión para continuar organizando tu tiempo con IA</p>
                </div>

                <form @submit.prevent="submitLogin" class="flex flex-col gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Correo Electrónico</label>
                        <input v-model="loginForm.email" type="email" required autofocus 
                               class="w-full bg-gray-900/50 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                        <span v-if="loginForm.errors.email" class="text-red-400 text-xs mt-1 block">{{ loginForm.errors.email }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Contraseña</label>
                        <input v-model="loginForm.password" type="password" required 
                               class="w-full bg-gray-900/50 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                        <span v-if="loginForm.errors.password" class="text-red-400 text-xs mt-1 block">{{ loginForm.errors.password }}</span>
                    </div>

                    <div class="flex items-center justify-between mt-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input v-model="loginForm.remember" type="checkbox" class="rounded border-gray-600 bg-gray-900 text-indigo-500 focus:ring-indigo-500">
                            <span class="text-sm text-gray-400">Recordarme</span>
                        </label>
                        <a href="#" class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" :disabled="loginForm.processing" 
                            class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-3.5 rounded-xl transition-all duration-200 shadow-lg hover:shadow-indigo-500/25 disabled:opacity-50 mt-4">
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

    <!-- registro modal -->
    <Transition>
        <div v-if="isRegisterModalOpen" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/70 backdrop-blur-md p-4" @click.self="isRegisterModalOpen = false">
            <div class="bg-gray-800/95 border border-gray-700 rounded-2xl p-8 shadow-2xl max-w-md w-full relative transform transition-all">
                <button @click="isRegisterModalOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition-colors bg-gray-700/50 p-2 rounded-full hover:bg-gray-600/50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">Crea tu Cuenta</h2>
                    <p class="text-gray-400 text-sm">Únete hoy y multiplica tu productividad con IA</p>
                </div>

                <form @submit.prevent="submitRegister" class="flex flex-col gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Nombre Completo</label>
                        <input v-model="registerForm.name" type="text" required autofocus 
                               class="w-full bg-gray-900/50 border border-gray-700 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                        <span v-if="registerForm.errors.name" class="text-red-400 text-xs mt-1 block">{{ registerForm.errors.name }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Correo Electrónico</label>
                        <input v-model="registerForm.email" type="email" required 
                               class="w-full bg-gray-900/50 border border-gray-700 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                        <span v-if="registerForm.errors.email" class="text-red-400 text-xs mt-1 block">{{ registerForm.errors.email }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Contraseña</label>
                            <input v-model="registerForm.password" type="password" required 
                                   class="w-full bg-gray-900/50 border border-gray-700 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                            <span v-if="registerForm.errors.password" class="text-red-400 text-xs mt-1 block">{{ registerForm.errors.password }}</span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Confirmar</label>
                            <input v-model="registerForm.password_confirmation" type="password" required 
                                   class="w-full bg-gray-900/50 border border-gray-700 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                        </div>
                    </div>

                    <button type="submit" :disabled="registerForm.processing" 
                            class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-3.5 rounded-xl transition-all duration-200 shadow-lg hover:shadow-indigo-500/25 disabled:opacity-50 mt-4">
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
const showNotifications = ref(false);

// Modales
const isLoginModalOpen = ref(false);
const isRegisterModalOpen = ref(false);

// Notificaciones
const unreadNotifications = ref(3);
const notifications = ref([
    { id: 1, message: '📅 Tienes una reunión en 30 minutos', created_at: new Date() },
    { id: 2, message: '🤖 La IA ha optimizado tu agenda para mañana', created_at: new Date(Date.now() - 3600000) },
    { id: 3, message: '✅ Completaste 5 tareas hoy!', created_at: new Date(Date.now() - 7200000) }
]);

// Formularios
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

// Funciones
const switchToRegister = () => {
    isLoginModalOpen.value = false;
    setTimeout(() => { isRegisterModalOpen.value = true; }, 200);
};

const switchToLogin = () => {
    isRegisterModalOpen.value = false;
    setTimeout(() => { isLoginModalOpen.value = true; }, 200);
};

const toggleNotifications = () => {
    showNotifications.value = !showNotifications.value;
    if (showNotifications.value) {
        unreadNotifications.value = 0;
    }
};

const formatTime = (date) => {
    const now = new Date();
    const diff = now - new Date(date);
    const minutes = Math.floor(diff / 60000);
    const hours = Math.floor(minutes / 60);
    const days = Math.floor(hours / 24);

    if (minutes < 1) return 'Ahora mismo';
    if (minutes < 60) return `Hace ${minutes} min`;
    if (hours < 24) return `Hace ${hours} h`;
    return `Hace ${days} d`;
};

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

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: all 0.3s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
    transform: scale(0.95);
}
</style>