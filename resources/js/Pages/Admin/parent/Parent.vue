<template>
    <Head title="Manage Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Users</h2>
        </template>

        <div class="py-10">
            <div class="flex mx-24 gap-4">
                <div class="w-[20%]">
                    <SideNav/>
                </div>
                <div class="w-[80%] flex flex-col md:flex-row">
                    <div class="w-full">
                        <div class="pb-4 flex flex-row-reverse">
                            <Link class="btn btn-primary btn-sm gap-1 normal-case" href="parents/create">
                                Add parent
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Emergency Number</th>
                                    <th>Children</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(parent, index) in parents">
                                        <td>{{ ++index }}</td>
                                        <td>{{ parent.user.name }}</td>
                                        <td>{{ parent.user.email }}</td>
                                        <td>{{ parent.phone_number }}</td>
                                        <td>{{ parent.emergency_number }}</td>
                                        <td>
                                            {{ parent.children.length }}
                                        </td>
                                        <td>
                                            <Link :href="`/admin/parents/${parent.id}/edit`" class="btn btn-xs btn-success mr-2 normal-case">edit</Link>
                                            <button @click.prevent="deleteParent(parent.id)" class="btn btn-xs btn-error normal-case">delete</button>
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
    name: "ManageUsers",
    components: {SideNav, Link, AuthenticatedLayout, Head},
    props: ['parents'],
    methods: {
        deleteParent(id) {
            if (confirm("Are you sure you want to delete?")) {
                this.$inertia.post(route("parents.destroy", id));
            }
        }
    }
}
</script>

<style scoped>

</style>
