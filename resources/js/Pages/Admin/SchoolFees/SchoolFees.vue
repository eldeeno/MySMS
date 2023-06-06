<template>
    <Head title="School Fess" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">School Fees</h2>
        </template>

        <div class="py-12">
            <div class="flex mx-24 gap-4">
                <div class="w-[20%]">
                    <SideNav/>
                </div>
                <div class="w-[80%]">

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SideNav from "@/Components/SideNav.vue";

export default {
    name: "SchoolFees",
    components: {SideNav, AuthenticatedLayout, Head}
}
</script>

<style scoped>

</style>
