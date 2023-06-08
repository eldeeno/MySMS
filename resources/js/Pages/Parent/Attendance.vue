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
                        <div class="form-control basis-1/3">
                            <label class="label label-text">Select Child</label>
                            <select @change="filter()" v-model="selected_child" class="select select-bordered">
                                <option selected disabled>Select child</option>
                                <option v-for="student in children" :value="student.id">{{ student.fullname }}</option>
                            </select>
                        </div>
                        <div class="form-control basis-1/3">
                            <label class="label label-text">Select Date</label>
                            <input @change="filter()" type="date" v-model="selected_date" class="input input-bordered" name="date">
                        </div>
                    </div>

                    <div class="card w-full bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title underline">Attendances</h2>
                            <ul>
                                <li v-if="display_attendance" v-for="child_attendance in children_attendances">
                                    <h4 class="font-bold text-[18px]">{{ child_attendance.fullname }}</h4>
                                    <span v-if="child_attendance.attendances.length > 0" v-for="(attendance, index) in child_attendance.attendances">
                                        <h5>
                                            {{++index}}- {{ moment(attendance.date).format('LL') }}
                                        </h5>
                                    </span>
                                    <p v-else >No attendance for selected child or date</p>
                                </li>
                            </ul>
                            <div class="card-actions justify-end">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {Head, Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ParentNav from "@/Components/ParentNav.vue";
import moment from "moment";

export default {
    name: "Attendance",
    components: {ParentNav, Link, AuthenticatedLayout, Head},
    props: ['attendances', 'children', 'session', 'children_attendances'],
    data() {
        return {
            moment: moment,
            display_attendance: false,
            selected_child: '',
            selected_date: '',
        }
    },
    methods: {
        filter() {
            if (this.selected_child) {
                this.display_attendance = true
                this.$inertia.get('/parent/attendance', {
                    child_id: this.selected_child,
                    date: this.selected_date,
                }, { preserveState: true });
            }
        },
    }
}
</script>

<style scoped>

</style>
