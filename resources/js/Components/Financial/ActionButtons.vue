<!-- ActionButtons.vue -->
<template>
    <div class="">
        <SecondaryButton @click="edit">
            Edit
        </SecondaryButton>
        <DangerButton @click="deleteItem">
            Delete
        </DangerButton>
    </div>
</template>

<script>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";  // Import DangerButton

export default {
    components: {
        SecondaryButton,
        DangerButton,
    },
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    methods: {
        edit() {
            this.$emit('edit', this.item);
        },
        deleteItem() {
            this.$emit('delete', this.item);  // Emit a 'delete' event when the button is clicked
        },
    },
};
</script>
