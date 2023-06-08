<template>
    <ul class="menu bg-base-100 w-full rounded-box">
        <li><Link :class="{ 'active': $page.url.startsWith('/parent/home') }" href="/parent/home">Home</Link></li>
        <li><Link :class="{ 'active': $page.url.startsWith('/parent/attendance') }" href="/parent/attendance">Attendance</Link></li>
        <li><Link :class="{ 'active': $page.url.startsWith('/parent/school-fees') }" href="/parent/school-fees">School fees</Link></li>
    </ul>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "ParentNav",
    components: {Link},
}
</script>

<style scoped>

</style>
