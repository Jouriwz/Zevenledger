<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import UploadForm from './Upload.vue';
</script>


<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        You're logged in!
                        <UploadForm />
                    </div>
                </div>

                <Table :columns="columns" :items="transactions"></Table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import Table from '../Components/Table.vue';
export default {
    components: { Table },
    data() {
        return {
            columns: [
                { key: 'date', label: 'Date' },
                { key: 'description', label: 'Description' },
                { key: 'account_number', label: 'Account Number' },
                { key: 'counter_account_number', label: 'Counter Account Number' },
                { key: 'code', label: 'Code' },
                { key: 'debit_credit', label: 'Debit/Credit' },
                { key: 'amount', label: 'Amount' },
                { key: 'transaction_type', label: 'Transaction Type' },
                { key: 'notes', label: 'Notes' },
                { key: 'balance_after_transaction', label: 'Balance After Transaction' },
                { key: 'tag', label: 'Tag' },
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
