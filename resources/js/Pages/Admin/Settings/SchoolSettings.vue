<template>
    <Head title="School Settings" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sessions & Terms</h2>
        </template>

        <div class="py-12">
            <div class="flex mx-24 gap-4">
                <div class="w-[20%]">
                    <SideNav/>
                </div>
                <div class="w-[80%] flex flex-col md:flex-row">
                    <div class="w-full">
                        <div class="pb-4 flex flex-row-reverse">
                            <Link class="btn btn-primary btn-sm gap-1 normal-case" href="/admin/settings/create-session">
                                Add Session
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
                                        <th>Session Name</th>
                                        <th>Status</th>
                                        <th>Terms</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(session, index) in sessions">
                                        <td>{{ ++index }}</td>
                                        <td>{{ session.from + '-' + session.to }}</td>
                                        <td>
                                            <div :class="session.status === 1 ? 'badge-success': 'badge-error'" class="badge">{{ session.status === 1 ? 'Active': 'Inactive' }}</div>
                                        </td>
                                        <td>
                                            <template v-for="term in session.terms">
                                                <h5>{{ term.name }} <p v-if="term.status == 1" class="badge badge-success pl-1">Active</p></h5>
                                            </template>
                                        </td>
                                        <td>
                                            <Link :href="`/admin/settings/${session.id}/edit-session`" class="btn btn-xs btn-warning normal-case mr-1">edit</Link>
                                            <button @click.prevent="deleteSession(session.id)" class="btn btn-xs btn-error normal-case">delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
import SideNav from "@/Components/SideNav.vue";

export default {
    name: "SchoolSettings",
    components: {Link, SideNav, AuthenticatedLayout, Head},
    props: ['sessions'],
    methods: {
        deleteSession(id) {
            if (confirm("Are you sure you want to delete?")) {
                this.$inertia.post(route("settings.destroy", id));
            }
        }
    }
}
</script>

<style scoped>

</style>
