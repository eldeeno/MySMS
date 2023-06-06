<template>
    <ul class="menu bg-base-100 w-full rounded-box">
        <li><Link :class="{ 'active': $page.url.startsWith('/dashboard') }" href="/dashboard">Dashboard</Link></li>
        <li><Link :class="{ 'active': $page.url.startsWith('/admin/classes') }" href="/admin/classes">Classes</Link></li>
        <li><Link :class="{ 'active': $page.url.startsWith('/admin/students') }" href="/admin/students">Students</Link></li>
        <li><Link :class="{ 'active': $page.url.startsWith('/admin/parents') }" href="/admin/parents">Parents</Link></li>
        <li><Link :class="{ 'active': $page.url.startsWith('/admin/attendance') }" href="/admin/attendance">Attendance</Link></li>
        <li><Link :class="{ 'active': $page.url.startsWith('/admin/school-fees') }" href="/admin/school-fees">School fees</Link></li>
        <li><Link :class="{ 'active': $page.url.startsWith('/admin/settings') }" href="/admin/settings">School Settings</Link></li>
    </ul>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "SideNav",
    components: {Link},
}
</script>

<style scoped>

</style>
