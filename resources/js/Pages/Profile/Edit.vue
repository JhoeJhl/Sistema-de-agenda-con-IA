<template>
    <Head title="Mi Perfil" />

    <div class="min-h-screen bg-[#0f172a] p-4 sm:p-8 overflow-x-hidden relative font-sans text-white profile-theme">
        
        <div class="absolute top-20 right-20 w-[400px] h-[400px] bg-purple-600/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-10 left-10 w-[300px] h-[300px] bg-indigo-600/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="w-full max-w-7xl mx-auto relative z-10">
            <div class="mb-8">
                <Navbar />
            </div>

            <div class="mb-8 border-b border-white/5 pb-4 flex items-center gap-3">
                <div class="bg-gradient-to-tr from-indigo-500 to-purple-500 p-3 rounded-2xl shadow-[0_0_15px_rgba(99,102,241,0.4)]">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Configuración de Cuenta</h1>
                    <p class="text-gray-400 text-sm">Gestiona tu información personal, seguridad y preferencias del sistema.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pb-12">
                
                <div class="lg:col-span-8 flex flex-col gap-6">
                    
                    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-8 shadow-xl backdrop-blur-lg">
                        <div class="max-w-xl">
                            <UpdateProfileInformationForm
                                :must-verify-email="mustVerifyEmail"
                                :status="status"
                                class="custom-breeze-form"
                            />
                        </div>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-8 shadow-xl backdrop-blur-lg">
                        <div class="max-w-xl">
                            <UpdatePasswordForm class="custom-breeze-form" />
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-4">
                    <div class="bg-gradient-to-br from-red-900/10 to-transparent border border-red-500/20 rounded-3xl p-6 sm:p-8 shadow-xl backdrop-blur-lg relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-red-500/10 rounded-full blur-[50px] pointer-events-none group-hover:bg-red-500/20 transition-colors"></div>
                        
                        <div class="relative z-10">
                            <DeleteUserForm class="custom-breeze-danger" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup>
// Importamos los componentes internos que Laravel Breeze ya creó por ti
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

// Importamos nuestro Navbar personalizado
import Navbar from '@/Components/Navbar.vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<style>
/* ==========================================================================
   MAGIA CSS: Oscurecemos los formularios de Laravel Breeze sin tocar sus archivos
   ========================================================================== */

.profile-theme {
    /* Forzamos textos claros para los encabezados y párrafos de Breeze */
    h2 { color: #ffffff !important; font-size: 1.25rem !important; font-weight: 700 !important; }
    p.mt-1.text-sm.text-gray-600 { color: #94a3b8 !important; margin-bottom: 1.5rem; }
    
    /* Etiquetas de los inputs */
    label { color: #cbd5e1 !important; font-weight: 500 !important; }

    /* Los inputs de texto y contraseñas (Estilo cristal oscuro) */
    input[type="text"], 
    input[type="email"], 
    input[type="password"] {
        background-color: rgba(0, 0, 0, 0.2) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #ffffff !important;
        border-radius: 0.75rem !important;
        padding: 0.75rem 1rem !important;
        box-shadow: none !important;
        transition: all 0.3s ease;
    }

    input:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2) !important;
        outline: none !important;
    }

    /* Botones principales de guardar (Índigo) */
    .custom-breeze-form button[type="submit"] {
        background: linear-gradient(to right, #6366f1, #a855f7) !important;
        border: none !important;
        border-radius: 0.75rem !important;
        padding: 0.5rem 1.5rem !important;
        color: white !important;
        font-weight: 600 !important;
        text-transform: none !important;
        letter-spacing: 0 !important;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3) !important;
        transition: transform 0.2s !important;
    }
    .custom-breeze-form button[type="submit"]:hover {
        transform: scale(1.02);
    }
    .custom-breeze-form button[type="submit"]:active {
        transform: scale(0.95);
    }

    /* Mensaje de "Guardado." */
    .text-sm.text-gray-600 {
        color: #10b981 !important; /* Verde esmeralda */
        font-weight: 500;
    }

    /* =========================================
       ZONA DE PELIGRO (Eliminar Cuenta)
       ========================================= */
    .custom-breeze-danger h2 { color: #f87171 !important; }
    .custom-breeze-danger p.mt-1 { color: #fca5a5 !important; opacity: 0.8; }
    
    .custom-breeze-danger button {
        background-color: rgba(239, 68, 68, 0.1) !important;
        border: 1px solid rgba(239, 68, 68, 0.3) !important;
        color: #f87171 !important;
        border-radius: 0.75rem !important;
        transition: all 0.3s ease;
    }
    .custom-breeze-danger button:hover {
        background-color: rgba(239, 68, 68, 0.2) !important;
        border-color: rgba(239, 68, 68, 0.5) !important;
        color: #ffffff !important;
        box-shadow: 0 0 15px rgba(239, 68, 68, 0.2) !important;
    }
}
</style>