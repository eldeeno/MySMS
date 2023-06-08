<template>
    <Head title="School fees" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">School Fees</h2>
        </template>

        <div class="py-12">
            <div class="flex mx-24 gap-4">
                <div class="w-[20%]">
                    <ParentNav/>
                </div>
                <div class="w-[80%]">
                    <div class="pb-4 flex flex-row-reverse">
                        <Link class="btn btn-primary btn-sm gap-1 normal-case" href="/parent/school-fees/pay">
                            Pay Fees
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </Link>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th>S/No.</th>
                                <th>Student</th>
                                <th>Plan</th>
                                <th>Term</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(payment, index) in payments">
                                    <td>{{ ++index }}</td>
                                    <td>{{ payment.student.fullname }}</td>
                                    <td>{{ payment.payment_plan.name }}</td>
                                    <td>{{ payment.term.name }}</td>
                                    <td>₦{{ payment.amount }}</td>
                                </tr>
                            </tbody>
                        </table>
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
    name: "SchoolFees",
    components: {ParentNav, Link, AuthenticatedLayout, Head},
    props: ['payments'],
    data() {
        return {

        }
    },
    methods: {

    }
}
</script>

<style scoped>

</style>
