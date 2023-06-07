<template>
    <Head title="Create Payment Plan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Payment Plan</h2>
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
                                    <div class="form-control basis-1/2">
                                        <label for="amount" class="label">
                                            <span class="label-text">Plan name</span>
                                        </label>
                                        <input v-model="form.name" type="text" name="name" placeholder="Plan name" class="input input-bordered" />
                                    </div>
                                    <div class="form-control basis-1/2">
                                        <label for="amount" class="label">
                                            <span class="label-text">Amount</span>
                                        </label>
                                        <input v-model="form.amount" type="text" name="amount" placeholder="Amount" class="input input-bordered" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-actions flex flex-row-reverse">
                                <div class="form-control p-8 flex flex-row gap-2">
                                    <button @click="submit()" type="button" class="btn btn-primary normal-case">Create</button>
                                    <Link href="/admin/parents" type="button" class="btn btn-warning normal-case">Cancel</Link>
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
    name: "CreatePlan",
    components: { SideNav, Link, AuthenticatedLayout, Head },
    // props: ['students'],
    data() {
        return {
            form: {
                name: null,
                amount: null
            },
        }
    },
    methods :{
        submit() {
            this.$inertia.post(route("plan.store", this.form));
        }
    },
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
