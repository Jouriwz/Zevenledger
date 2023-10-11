<script setup>

import {Head} from "@inertiajs/vue3";
import UploadForm from "@/Pages/Upload.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">arrrrr</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <Table :columns="columns" :items="transactions"></Table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>

<script>
import Table from '../../Components/Table.vue';
export default {
    components: { Table },
    data() {
        return {
            columns: [
                { key: 'name', label: 'Name' },
                { key: 'amount', label: 'Amount' },
                { key: 'due_date', label: 'Due Date' },
                { key: 'description', label: 'Description' },
                { key: 'actions', label: 'Actions' },
            ],
            transactions: [],
        };
    },
    created() {
        axios.get('/transactions')
            .then(response => {
                this.transactions = response.data.data;
            })
            .catch(error => {
                console.log(error);
            });
    }
}
</script>
