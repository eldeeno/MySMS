<template>
    <Head title="School Settings" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Settings</h2>
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
                                    <h2 class="card-title underline">Session Details</h2>
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
                                        <h2 class="card-title underline">Terms</h2>
                                    </div>
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <div v-for="(term, index) in form.session.terms" class="form-control basis-full sm:basis-1/3">
                                            <label for="from" class="label">
                                                <span class="label-text">Term 2</span>
                                            </label>
                                            <input type="text" v-model="term.name" name="from" placeholder="From" class="input input-bordered" />
                                            <div class="form-control basis-1/6">
                                                <label class="label cursor-pointer">
                                                    <span class="label-text">{{ term.status }}</span>
                                                    <input type="checkbox" v-model="term.status" name="status" class="checkbox checkbox-success checkbox-sm" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-actions flex flex-row-reverse">
                                    <div class="form-control p-8 flex flex-row gap-2">
                                        <button @click="updateSettings()" type="button" class="btn btn-primary">Save</button>
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
    name: "EditSettings",
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
        updateSettings() {
            console.log(this.form)
            this.$inertia.post(`/admin/settings/${this.form.session.id}/update-session`, this.form)
        }
    },
    mounted() {
        this.form.session.from = this.$attrs.session.from
        this.form.session.to = this.$attrs.session.to
        this.form.session.status = this.$attrs.session.status
        this.form.session.id = this.$attrs.session.id
        this.$attrs.session.status === 1 ? this.form.session.status = true: this.form.session.status = false
        this.form.session.terms = this.$attrs.session.terms
        this.form.session.terms.forEach((term) => {
            parseInt(term.status) === 1 ? term.status = true: term.status = false
        })
    }
}
</script>

<style scoped>

</style>
