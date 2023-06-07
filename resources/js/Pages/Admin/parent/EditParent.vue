<template>
    <Head title="Edit Parent" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Parent</h2>
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
                                <!--                                <div class="mb-6">-->
                                <!--                                    <label class="block">-->
                                <!--                                        <img id="preview" src="https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png" class="object-cover rounded-full h-40 w-40 my-2 border border-gray-200" alt="student image">-->
                                <!--                                        <span class="sr-only cursor-pointer">Choose File</span>-->
                                <!--                                        <div class="flex">-->
                                <!--                                            <input type="file" name="photo" id="photo"-->
                                <!--                                                   class="block w-4/5 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mr-1"/>-->
                                <!--                                        </div>-->
                                <!--                                    </label>-->
                                <!--                                </div>-->
                                <div class="flex flex-row gap-4">
                                    <div class="form-control w-full">
                                        <label for="name" class="label">
                                            <span class="label-text">Full name</span>
                                        </label>
                                        <input v-model="form.name" type="text" name="name" placeholder="Full name" class="input input-bordered" />
                                    </div>
                                </div>
                                <div class="flex flex-row gap-4">
                                    <div class="form-control basis-1/3">
                                        <label for="email" class="label">
                                            <span class="label-text">Email</span>
                                        </label>
                                        <input v-model="form.email" type="email" name="email" placeholder="Email" class="input input-bordered" />
                                    </div>
                                    <div class="form-control basis-1/3">
                                        <label for="phone_number" class="label">
                                            <span class="label-text">Phone number</span>
                                        </label>
                                        <input v-model="form.phone_number" type="text" name="phone_number" placeholder="Phone number" class="input input-bordered" />
                                    </div>
                                    <div class="form-control basis-1/3">
                                        <label class="label">
                                            <span class="label-text">Emergency number</span>
                                        </label>
                                        <input  v-model="form.emergency_number" type="text" name="emergency_number" placeholder="Emergency number" class="input input-bordered" />
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="form-control basis-full">
                                        <label for="address" class="label">
                                            <span class="label-text">Address</span>
                                        </label>
                                        <textarea v-model="form.address" placeholder="Address" name="address" class="textarea textarea-bordered textarea-sm w-full" ></textarea>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="form-control basis-full">
                                        <label for="" class="label">
                                            <span class="label-text">Associate Child</span>
                                        </label>
                                        <VueMultiselect
                                            v-model="form.selected_children"
                                            :options="children"
                                            :multiple="true"
                                            :close-on-select="true"
                                            placeholder="Select Children"
                                            label="fullname"
                                            track-by="fullname"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="card-actions flex flex-row-reverse">
                                <div class="form-control flex flex-row gap-2 p-8">
                                    <button @click="submit()" type="button" class="btn btn-primary normal-case">Save</button>
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
import VueMultiselect from 'vue-multiselect';

export default {
    name: "EditParent",
    components: {SideNav, Link, AuthenticatedLayout, Head, VueMultiselect},
    data() {
        return {
            form: {
                name: null,
                email: null,
                address: null,
                phone_number: null,
                emergency_number: null,
                selected_children: null
            },
            children: [
                { name: 'name', language: 'JavaScript' },
                { name: 'Adonis', language: 'JavaScript' },
                { name: 'Rails', language: 'Ruby' },
                { name: 'Sinatra', language: 'Ruby' },
                { name: 'Laravel', language: 'PHP' },
                { name: 'Phoenix', language: 'Elixir' }
            ],
        }
    },
    methods :{
        submit() {
            this.$inertia.post(`/admin/parents/${this.form.id}/update`, this.form)
        }
    },
    created() {
        this.form.name = this.$attrs.parent.user.name
        this.form.email = this.$attrs.parent.user.email
        this.form.address = this.$attrs.parent.address
        this.form.phone_number = this.$attrs.parent.phone_number
        this.form.emergency_number = this.$attrs.parent.emergency_number
        this.form.id = this.$attrs.parent.id
        this.children = this.$attrs.students
        this.form.selected_children = this.$attrs.parent.children
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
