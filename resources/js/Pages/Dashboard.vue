<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Link} from "@inertiajs/vue3";
import SideNav from "@/Components/SideNav.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>

            <div class="flex flex-col mx-24">
                <div class="w-[20%]">
                    <SideNav/>
                </div>
                <div class="w-[80%] bg-white">

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
