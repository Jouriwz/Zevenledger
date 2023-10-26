<template>
    <nav class="bg-gray-800 w-16 h-screen fixed">
        <!-- Add your sidebar content here -->
        <div class="text-white">
            <div class="p-4">
                <Link :href="route('dashboard')" class="text-white">
                    Dashboard
                </Link>
            </div>
            <div class="p-4">
                <Link :href="route('fixedCharges.index')" class="text-white">
                    Fixed Charges
                </Link>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
/* Add any additional styling for your sidebar here */
</style>
