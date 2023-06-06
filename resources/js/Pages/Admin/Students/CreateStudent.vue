<template>
    <Head title="Create Student" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Student</h2>
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
                                    <div class="form-control basis-1/2">
                                        <label class="label">
                                            <span class="label-text">Firstname</span>
                                        </label>
                                        <input v-model="form.firstname" type="text" name="firstname" placeholder="First name" class="input input-bordered" />
                                    </div>
                                    <div class="form-control basis-1/2">
                                        <label class="label">
                                            <span class="label-text">Lastname</span>
                                        </label>
                                        <input v-model="form.lastname" type="text" name="lastname" placeholder="Last name" class="input input-bordered" />
                                    </div>
                                </div>
                                <div class="flex flex-row gap-4">
                                    <div class="form-control basis-1/3">
                                        <label class="label">
                                            <span class="label-text">Email</span>
                                        </label>
                                        <input v-model="form.email" type="email" name="email" placeholder="Email" class="input input-bordered" />
                                    </div>
                                    <div class="form-control basis-1/3">
                                        <label class="label">
                                            <span class="label-text">Phone number</span>
                                        </label>
                                        <input v-model="form.phone_number" type="text" name="phone_number" placeholder="Phone number" class="input input-bordered" />
                                    </div>
                                    <div class="form-control basis-1/3">
                                        <label class="label">
                                            <span class="label-text">Class</span>
                                        </label>
                                        <select v-model="form.class_id" name="class" class="select select-bordered w-full">
                                            <option disabled selected>Select Gender?</option>
                                            <option v-for="(classs, index) in classes" :value="classs.id">{{ classs.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex flex-col md:flex-row gap-4">
                                    <div class="form-control basis-1/3">
                                        <label class="label">
                                            <span class="label-text">Emergency number</span>
                                        </label>
                                        <input  v-model="form.emergency_number" type="text" name="emergency_number" placeholder="Emergency number" class="input input-bordered" />
                                    </div>
                                    <div class="form-control basis-1/3">
                                        <label class="label">
                                            <span class="label-text">Birth date</span>
                                        </label>
                                        <input  v-model="form.date_of_birth" type="date" name="date_of_birth" placeholder="Date of birth" class="input input-bordered" />
                                    </div>
                                    <div class="form-control basis-1/3">
                                        <label class="label">
                                            <span class="label-text">Gender</span>
                                        </label>
                                        <select v-model="form.gender" name="gender" class="select select-bordered w-full">
                                            <option disabled selected>Select Gender?</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="form-control basis-full">
                                        <label class="label">
                                            <span class="label-text">Email</span>
                                        </label>
                                        <textarea v-model="form.address" placeholder="Address" name="address" class="textarea textarea-bordered textarea-sm w-full" ></textarea>
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
    name: "CreateStudent",
    components: {SideNav, Link, AuthenticatedLayout, Head},
    props: ['classes'],
    data() {
        return {
            form: {
                firstname: null,
                lastname: null,
                email: null,
                address: null,
                phone_number: null,
                emergency_number: null,
                gender: null,
                date_of_birth: null,
                photo: null,
                class_id: null
            }
        }
    },
    methods :{
        submit() {
            this.$inertia.post(route("student.store", this.form));
        }
    }
}
</script>

<style scoped>

</style>
