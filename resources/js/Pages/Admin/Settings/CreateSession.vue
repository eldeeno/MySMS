<template>
    <Head title="Create Session" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Session</h2>
        </template>

        <div class="py-12">
            <div class="flex mx-24 gap-4">
                <div class="w-[20%]">
                    <SideNav/>
                </div>
                <div class="w-[80%]">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="card w-full shadow-2xl bg-base-100">
                            <form>
                                <div class="card-body">
                                    <h4 class="card-title underline text-[16px]">Session Details</h4>
                                    <div class="flex flex-row gap-4">
                                        <div class="form-control basis-1/2">
                                            <label for="from" class="label">
                                                <span class="label-text">From Year</span>
                                            </label>
                                            <input type="text" v-model="form.session.from" name="from" placeholder="From year (2022)" class="input input-bordered" />
                                        </div>
                                        <div class="form-control basis-1/2">
                                            <label for="to" class="label">
                                                <span class="label-text">To Year</span>
                                            </label>
                                            <input type="text" v-model="form.session.to" name="to" placeholder="To year (2023)" class="input input-bordered" />
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="form-control basis-1/6">
                                            <label class="label cursor-pointer">
                                                <span class="label-text">Current</span>
                                                <input type="checkbox" v-model="form.session.status" name="status" class="checkbox checkbox-success checkbox-sm" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex mt-3">
                                        <h4 class="card-title underline text-[16px]">Terms</h4>
                                    </div>
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <div v-for="(term, index) in form.session.terms" class="form-control basis-full sm:basis-1/3">
                                            <label for="from" class="label">
                                                <span class="label-text">Term {{ ++index }}</span>
                                            </label>
                                            <input type="text" v-model="term.name" name="from" placeholder="From" class="input input-bordered" />
                                            <div class="form-control basis-1/6">
                                                <label class="label cursor-pointer">
                                                    <span class="label-text">Current</span>
                                                    <input type="checkbox" v-model="term.status" name="status" class="checkbox checkbox-success checkbox-sm" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-actions flex flex-row-reverse">
                                    <div class="form-control p-8 flex flex-row gap-2">
                                        <button @click="submitSettings()" type="button" class="btn btn-primary">Save</button>
                                        <Link href="/admin/settings" type="button" class="btn btn-warning">Cancel</Link>
                                    </div>
                                </div>
                            </form>
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
    name: "CreateSession",
    components: {SideNav, Link, AuthenticatedLayout, Head},
    data() {
        return {
            form: {
                session: {
                    from: '',
                    to: '',
                    status: true,
                    terms: [
                        { name: 'First Term', status: true },
                        { name: 'Second Term', status: false },
                        { name: 'Third Term', status: false },
                    ],
                }
            },
        }
    },
    methods: {
        submitSettings() {
            // console.log(this.form)
            this.$inertia.post(route("settings.store", this.form));
        }
    }
}
</script>

<style scoped>

</style>
