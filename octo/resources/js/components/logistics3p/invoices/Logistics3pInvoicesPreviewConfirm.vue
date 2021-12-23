<template>
    <div>
        <form role="form" @submit.prevent="submit">
            <button type="submit" id="saveButton" class="btn btn-block btn-primary " :disabled="submitted">Confirm and Save</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "Logistics3pInvoicesPreviewConfirm",
    props: ['previewid'],
    data() {
        return {
            form: new SparkForm ({
                previewID: this.previewid,
                subType: 1
            }),
            submitted: false
        }
    },

    methods: {
        submit(event) {
            event.preventDefault();

            this.submitted = true;

            Spark.post('/api/v1/finances/invoices/invoice/create/3pl', this.form)
                .then(data => {
                    window.location = '/logistics3p/invoices/' + data._id
                });
        }
    }
}
</script>

<style scoped>

</style>
