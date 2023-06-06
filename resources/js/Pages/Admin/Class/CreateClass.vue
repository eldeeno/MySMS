<template>
    <Head title="Create Classes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Class</h2>
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
                                        <label class="label">
                                            <span class="label-text">Class name</span>
                                        </label>
                                        <input v-model="form.name" type="text" name="name" placeholder="Class name" class="input input-bordered" />
                                    </div>
                                    <div class="form-control basis-1/2">
                                        <label class="label">
                                            <span class="label-text">Class section</span>
                                        </label>
                                        <select v-model="form.section" name="section" class="select select-bordered w-full">
                                            <option disabled selected>Select Section?</option>
                                            <option value="nursery">Nursery</option>
                                            <option value="primary">Primary</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-actions flex flex-row-reverse">
                                <div class="form-control p-8">
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
    name: "CreateClass",
    components: {SideNav, Link, AuthenticatedLayout, Head},
    data() {
        return {
            form: {
                name: null,
                section: null,
            }
        }
    },
    methods :{
        submit() {
            this.$inertia.post(route("classes.store", this.form));
        }
    }
}
</script>

<style scoped>

</style>
