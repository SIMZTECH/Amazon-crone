<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex flex-col items-center min-h-screen bg-gray-100 sm:justify-center sm:pt-0">
        <div>
            <Link href="/">
                <img class="h-12 text-gray-500 fill-current" src="/images/am_logo/AMAZON_LOGO_DARK.png" />
            </Link>
        </div>

        <div
            class="w-full px-6 py-4 mt-6 overflow-hidden bg-white rounded-sm border border-gray-300 max-w-[400px]"
        >
            <slot />
        </div>
        <div v-if="$page.url==='/login'" class="w-[400px]">
            <div class="w-full p-2 text-sm font-extrabold text-center">New to Amazon</div>
            <div class="w-full p-2 text-sm font-extrabold bg-gray-200 border border-gray-500 hover:bg-gray-300">
                <Link :href="route('register')">
                    Create your Amazon account
                </Link>
            </div>
        </div>
        
    </div>
</template>
