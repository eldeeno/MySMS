<template>
    <Head title="Attendance" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Attendance Record</h2>
        </template>

        <div class="py-12">
            <div class="flex mx-24 gap-4">
                <div class="w-[20%]">
                    <SideNav/>
                </div>
                <div class="w-[80%]">
                    <div class="pb-4 flex flex-row-reverse">
                        <Link class="btn btn-primary btn-sm gap-1 normal-case" href="attendance/create">
                            Add attendance
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </Link>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table table-compact w-full">
                            <thead>
                                <tr>
                                    <th>S/No.</th>
                                    <th>Class Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(attendance, index) in attendances">
                                    <td>{{ ++index }}</td>
                                    <td>{{ attendance.class.name }}</td>
                                    <td>{{ moment(attendance.date).format('LLLL') }}</td>
                                    <td>
                                        <button @click.prevent="deleteAttendance(attendance.id)" class="btn btn-xs btn-error normal-case">delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {Head, Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SideNav from "@/Components/SideNav.vue";
import moment from "moment";

export default {
    name: "Attendance",
    components: {SideNav, Link, AuthenticatedLayout, Head},
    props: ['attendances'],
    data() {
        return {
            moment: moment,
        }
    },
    methods: {
        deleteAttendance(id) {
            if (confirm("Are you sure you want to delete?")) {
                this.$inertia.post(route("attendance.destroy", id));
            }
        }
    }
}
</script>

<style scoped>

</style>
