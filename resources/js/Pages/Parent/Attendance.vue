<template>
    <Head title="Children Attendance" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Children Attendance Record</h2>
        </template>

        <div class="py-12">
            <div class="flex mx-24 gap-4">
                <div class="w-[20%]">
                    <ParentNav/>
                </div>
                <div class="w-[80%]">
                    <div class="pb-4 flex flex-row gap-2">
                        <select class="select-bordered select">
                            <option>Child</option>
                            <option>Child</option>
                            <option>Child</option>
                        </select>
<!--                        <input class="input input-group-md input-bordered" type="text" name="" id="">-->
<!--                        <input class="input input-group-md input-bordered" type="text" name="" id="">-->
<!--                        <input class="input input-group-md input-bordered" type="text" name="" id="">-->
<!--                        <input class="input input-group-md input-bordered" type="text" name="" id="">-->
                    </div>
<!--                    <div class="overflow-x-auto">-->
<!--                        <table class="table table-compact w-full">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>S/No.</th>-->
<!--                                <th>Class Name</th>-->
<!--                                <th>Date</th>-->
<!--                                <th>Action</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            <tr v-for="(attendance, index) in attendances">-->
<!--                                <td>{{ ++index }}</td>-->
<!--                                <td>{{ attendance.class.name }}</td>-->
<!--                                <td>{{ attendance.date }}</td>-->
<!--                                <td>-->
<!--                                    <button @click.prevent="deleteAttendance(attendance.id)" class="btn btn-xs btn-error normal-case">delete</button>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {Head, Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ParentNav from "@/Components/ParentNav.vue";

export default {
    name: "Attendance",
    components: {ParentNav, Link, AuthenticatedLayout, Head},
    props: ['attendances', 'students'],
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
