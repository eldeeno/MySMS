<template>
    <Head title="Pay fees" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pay Fees</h2>
        </template>

        <div class="py-12">
            <div class="flex mx-24 gap-4">
                <div class="w-[20%]">
                    <ParentNav/>
                </div>
                <div class="w-[80%]">
                    <div class="card w-full bg-base-100 shadow-xl" v-if="!show_form">
                        <div class="card-body flex">
                            <div class="pb-4 flex flex-row gap-2">
                                <div class="form-control basis-1/3">
                                    <label class="label label-text">Select Child</label>
                                    <select required v-model="form.child_id" class="select select-bordered">
                                        <option selected disabled>Select child</option>
                                        <option v-for="student in children" :value="student.id">{{ student.fullname }}</option>
                                    </select>
                                </div>
                                <div class="form-control basis-1/3">
                                    <label class="label label-text">Select Term</label>
                                    <select required v-model="form.term_id" class="select select-bordered">
                                        <option selected disabled>Select term</option>
                                        <option v-for="term in session.terms" :value="term.id">{{ term.name }}</option>
                                    </select>
                                </div>
                                <div class="form-control basis-1/3">
                                    <label class="label label-text">Payment Plan</label>
                                    <select required v-model="selected_plan" class="select select-bordered">
                                        <option selected disabled>Select plan</option>
                                        <option v-for="plan in payment_plans" :value="plan">{{ plan.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <div class="form-control basis-1/2" v-if="selected_plan.amount">
                                    <label class="">Amount: ₦<span class="font-bold">{{ selected_plan.amount }}</span></label>
                                </div>
                            </div>
                            <div class="card-actions flex flex-row-reverse">
                                <div class="form-control mt-4">
                                    <button @click="proceedPayment()" type="button" class="btn btn-primary">Proceed payment</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="show_form" class="w-full mx-auto rounded-lg bg-white shadow-lg p-5 text-gray-700" style="max-width: 600px">
                        <div class="w-full pt-1 pb-5">
                            <div class="bg-indigo-500 text-white overflow-hidden rounded-full w-20 h-20 -mt-16 mx-auto shadow-lg flex justify-center items-center">
                                <i class="mdi mdi-credit-card-outline text-3xl"></i>
                            </div>
                        </div>
                        <div class="mb-10">
                            <h1 class="text-center font-bold text-xl uppercase">Secure payment info</h1>
                        </div>
                        <div class="mb-3 flex -mx-2">
                            <div class="px-2">
                                <label for="type1" class="flex items-center cursor-pointer">
                                    <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="type" id="type1" checked>
                                    <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" class="h-8 ml-3">
                                </label>
                            </div>
                            <div class="px-2">
                                <label for="type2" class="flex items-center cursor-pointer">
                                    <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="type" id="type2">
                                    <img src="https://www.sketchappsources.com/resources/source-image/PayPalCard.png" class="h-8 ml-3">
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="font-bold text-sm mb-2 ml-1">Name on card</label>
                            <div>
                                <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="John Smith" type="text"/>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="font-bold text-sm mb-2 ml-1">Card number</label>
                            <div>
                                <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="0000 0000 0000 0000" type="text"/>
                            </div>
                        </div>
                        <div class="mb-3 -mx-2 flex items-end">
                            <div class="px-2 w-1/2">
                                <label class="font-bold text-sm mb-2 ml-1">Expiration date</label>
                                <div>
                                    <select class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                                        <option value="01">01 - January</option>
                                        <option value="02">02 - February</option>
                                        <option value="03">03 - March</option>
                                        <option value="04">04 - April</option>
                                        <option value="05">05 - May</option>
                                        <option value="06">06 - June</option>
                                        <option value="07">07 - July</option>
                                        <option value="08">08 - August</option>
                                        <option value="09">09 - September</option>
                                        <option value="10">10 - October</option>
                                        <option value="11">11 - November</option>
                                        <option value="12">12 - December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="px-2 w-1/2">
                                <select class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label class="font-bold text-sm mb-2 ml-1">CVV</label>
                            <div>
                                <input class="w-32 px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="000" type="text"/>
                            </div>
                        </div>
                        <div class="flex flex-row-reverse gap-2">
                            <button @click="cancelPayment" class="btn btn-warning"> CANCEL</button>
                            <button @click="makePayment" class="btn btn-success">PAY NOW</button>
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
import ParentNav from "@/Components/ParentNav.vue";
import moment from "moment";

export default {
    name: "MakePayment",
    components: {ParentNav, Link, AuthenticatedLayout, Head},
    props: ['children', 'payment_plans', 'session'],
    data() {
        return {
            form: {
                child_id: '',
                fee_plan_id: '',
                term_id: '',
                amount: '',
            },
            selected_plan: '',
            show_form: false,
        }
    },
    methods: {
        proceedPayment() {
            if (this.form.child_id != '' && this.form.term_id != '' && this.form.selected_plan != '')
                this.form.fee_plan_id = this.selected_plan.id
                this.form.amount = this.selected_plan.amount
                this.show_form = true
        },
        cancelPayment() {
            this.show_form = false
        },
        makePayment() {
            this.$inertia.post(route("payment.store", this.form));
        }
    }
}
</script>

<style scoped>

</style>
