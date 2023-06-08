<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Link} from "@inertiajs/vue3";
import SideNav from "@/Components/SideNav.vue";

    const props = defineProps ({
        total_number_of_students: String,
        total_number_of_parents: String,
        total_number_of_classes: String,
        current_session: String,
    })
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

            <div class="flex mx-24">
                <div class="w-[20%]">
                    <SideNav/>
                </div>
                <div class="w-[80%]">
                    <div class="flex flex-col w-full mb-10">
                        <div class="flex flex-row justify-between px-8">
                            <h4 class="font-bold text-lg">Current Session:
                                <span class="text-primary">{{ current_session.from +'-'+current_session.to }}</span>
                            </h4>
                            <h4 class="font-bold text-lg">Current Term:
                                <span class="text-primary">{{ current_session.terms[0]['name'] }}</span>
                            </h4>
                        </div>
                        <div class="grid grid-cols-1 gap-2 px-4 mt-8 sm:grid-cols-3 sm:px-8">
                            <div class="flex items-center border rounded-sm overflow-hidden shadow">
                                <div class="p-4 bg-green-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                                                                   viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg></div>
                                <div class="px-4 text-gray-700">
                                    <h3 class="text-sm tracking-wider">Total Students</h3>
                                    <p class="text-3xl">{{ total_number_of_students }}</p>
                                </div>
                            </div>
                            <div class="flex items-center border rounded-sm overflow-hidden shadow">
                                <div class="p-4 bg-blue-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                                                                   viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg></div>
                                <div class="px-4 text-gray-700">
                                    <h3 class="text-sm tracking-wider">Total Parents</h3>
                                    <p class="text-3xl">{{ total_number_of_parents }}</p>
                                </div>
                            </div>
                            <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                                <div class="p-4 bg-indigo-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                                    </path>
                                </svg></div>
                                <div class="px-4 text-gray-700">
                                    <h3 class="text-sm tracking-wider">Total Classes</h3>
                                    <p class="text-3xl">{{ total_number_of_classes }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
