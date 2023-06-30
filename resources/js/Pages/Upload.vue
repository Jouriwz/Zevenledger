<template>
    <div>
        <form @submit.prevent="onSubmit">
            <input type="file" @change="onFileChange">
            <button type="submit">Upload</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            file: null
        }
    },
    methods: {
        onFileChange(e) {
            this.file = e.target.files[0];
        },
        onSubmit() {
            let formData = new FormData();
            formData.append('file', this.file);

            axios.post('/upload', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(() => {
                console.log('SUCCESS!!');
            })
                .catch(() => {
                    console.log('FAILURE!!');
                });
        }
    }
}
</script>
