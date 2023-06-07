<template>
    <Head title="Create Attendance" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Attendance</h2>
        </template>

        <div class="py-12">
            <div class="flex mx-24 gap-4">
                <div class="w-[20%]">
                    <SideNav/>
                </div>
                <div class="w-[80%]">
                    <form>
                        <div class="card fw-full shadow-2xl bg-base-100">
                            <div class="card-body">
                                <div class="flex flex-row gap-4">
                                    <div class="form-control basis-1/3">
                                        <label class="label">
                                            <span class="label-text">Date</span>
                                        </label>
                                        <input v-model="form.date" type="date" name="date" placeholder="Pick date" class="input input-bordered" />
                                    </div>
                                    <div class="form-control basis-1/3">
                                        <label class="label">
                                            <span class="label-text">Class</span>
                                        </label>
                                        <select @change="filter()" v-model="form.class_id" name="class" class="select select-bordered w-full">
                                            <option disabled selected>Select class</option>
                                            <option v-for="classs in classes" :value="classs.id">{{ classs.name }}</option>
                                        </select>
                                    </div>
                                    <div class="form-control basis-1/3">
                                        <label class="label">
                                            <span class="label-text">Term</span>
                                        </label>
                                        <select v-model="form.term_id" name="term" class="select select-bordered w-full">
                                            <option disabled selected>Select term</option>
                                            <option v-for="term in session.terms" :value="term.id">{{ term.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex flex-row mt-8" v-if="display_table">
                                    <div class="overflow-x-auto">
                                        <table class="table w-full">
                                            <thead>
                                                <tr>
                                                    <th>S/No.</th>
                                                    <th>Student Name</th>
                                                    <th>Present</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(student, index) in students">
                                                    <th>{{ ++index }}</th>
                                                    <td>{{ student.fullname }}</td>
                                                    <td>
                                                        <input v-model="form.selected_students" name="" type="checkbox" :value="student.id" class="checkbox checkbox-primary checkbox-sm" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-actions flex flex-row-reverse">
                                <div class="form-control p-8" v-if="display_table">
                                    <button @click="submit()" type="button" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {Head, Link, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SideNav from "@/Components/SideNav.vue";

export default {
    name: "CreateAttendance",
    components: {SideNav, Link, AuthenticatedLayout, Head},
    props: ['students'],
    data() {
        return {
            form: {
                term_id: null,
                class_id: null,
                date: null,
                selected_students: []
            },
            classes: null,
            session: {
                terms: []
            },
            display_table: false,
        }
    },
    methods :{
        submit() {
            this.$inertia.post(route("attendance.store", this.form));
        },
        filter() {
            this.display_table = true
            this.$inertia.get('/admin/attendance/create', { class: this.form.class_id }, { preserveState: true });
        },
    },
    created() {
        this.session = this.$attrs.session
        this.classes = this.$attrs.classes
        this.form.date = new Date().toISOString().slice(0,10)

        let terms = this.$attrs.session.terms
        let current_term = function (){
            for(let term in terms) {
                return term.status === '1' ? term['id']: ''
            }
        }
        this.form.term_id = current_term()
    }
}
</script>

<style scoped>

</style>
