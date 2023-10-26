<script setup>
import {Head} from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
<!--        <template #header>-->
<!--            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Fixed Charges</h2>-->
<!--        </template>-->

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <primary-button @click="showModal = true">Create</primary-button>
                <Table :columns="columns" :items="transactions">
                    <template #actions="{ item }">
                        <ActionButtons :item="item" @edit="editItem" @delete="deleteItem" />
                    </template>
                </Table>

                <Modal :show="showModal" @close="showModal = false">
                    <form @submit.prevent="submitForm">
                        <InputLabel value="Name">
                            <TextInput v-model="name" />
                            <InputError :message="errors.name" />
                        </InputLabel>

                        <InputLabel value="Amount">
                            <TextInput v-model="amount" />
                            <InputError :message="errors.amount" />
                        </InputLabel>

                        <InputLabel value="Due Date">
                            <TextInput v-model="due_date" />
                            <InputError :message="errors.due_date" />
                        </InputLabel>

                        <InputLabel value="Description">
                            <TextInput v-model="description" />
                            <InputError :message="errors.description" />
                        </InputLabel>

                        <primary-button type="submit">Save</primary-button>
                    </form>
                </Modal>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>

</style>

<script>
import Table from '../../Components/Table.vue';
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ActionButtons from "@/Components/Financial/ActionButtons.vue";
export default {
    components: {
        Modal,
        Table,
        TextInput,
        InputLabel,
        InputError,
        PrimaryButton,
        AuthenticatedLayout,
        ActionButtons
    },
    data() {
        return {
            showModal: false,
            name: '',
            amount: '',
            due_date: '',
            description: '',
            errors: {},
            columns: [
                { key: 'name', label: 'Name' },
                { key: 'amount', label: 'Amount' },
                { key: 'due_date', label: 'Due Date' },
                { key: 'description', label: 'Description' },
                { key: 'actions', label: 'Actions' },
            ],
            transactions: [],  // Initialized as an empty array
        };
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('/fixedCharges', {
                    name: this.name,
                    amount: this.amount,
                    due_date: this.due_date,
                    description: this.description,
                });

                this.fetchFixedCharges();

                this.showModal = false;
                this.name = '';
                this.amount = '';
                this.due_date = '';
                this.description = '';
                this.errors = {};

            } catch (error) {
                if (error.response && error.response.data && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                }
            }
        },

        fetchFixedCharges() {
            axios.get('/fixedCharges')
                .then(response => {
                    if (response.data && Array.isArray(response.data.fixedCharges)) {
                        this.transactions = response.data.fixedCharges;
                    } else {
                        console.error("Unexpected data format from /fixedCharges endpoint");
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },

        async editItem(item) {
            this.$inertia.visit(`/fixedCharges/${item.id}/edit`);
        },

        async deleteItem(item) {
            if (confirm('Are you sure you want to delete this item?')) {
                try {
                    await axios.delete(`/fixedCharges/${item.id}`);
                    this.fetchFixedCharges(); // Refresh the list after deletion
                } catch (error) {
                    console.log('Error deleting item', error);
                }
            }
        },

    },
    props: {
        fixedCharges: {
            type: Array,
            required: true,
        }
    },
    created() {
        this.transactions = this.fixedCharges;
    }
}
</script>
