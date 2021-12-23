<template>
    <div>
        <div class="card card-custom">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-8">
                        <div class="form-group">
                            <label class="fs-6 fw-bold mb-2" for="store">Warehouse <span class="text-danger">*</span></label>
                            <select class="form-select s2storeID" id="store">
                                <option>Select a warehouse</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 mb-8">
                        <div class="form-group">
                            <label class="fs-6 fw-bold mb-2" for="customerID">Customer <span class="text-danger">*</span></label>
                            <select class="form-control s2customerID" id="customerID">
                                <option>Select a customer</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 mb-8">
                        <label class="fs-6 fw-bold mb-2">Date</label>
                        <div class="position-relative d-flex align-items-center">
                            <div class="symbol symbol-20px me-4 position-absolute ms-4">
                                <span class="symbol-label bg-secondary">
                                    <span class="fa fa-calendar-alt"></span>
                                </span>
                            </div>

                            <input class="form-control ps-12 flatpickr-input active" id="datepicker_date" placeholder="Select date" type="text" readonly="readonly">
                        </div>
                    </div>

                    <div class="col-md-3 mb-8">
                        <label class="fs-6 fw-bold mb-2">Custom ID</label>
                        <b-input-group class="mb-2">
                            <b-input-group-prepend is-text>
                                <input type="checkbox" aria-label="Checkbox for following text input" v-model="form.autoID"><span class="ml-2">Auto</span>
                            </b-input-group-prepend>
                            <b-form-input aria-label="Text input with checkbox" v-model="form.customID" :disabled="form.autoID"></b-form-input>
                        </b-input-group>
                    </div>

                    <div class="col-md-3 mb-8">
                        <label class="fs-6 fw-bold mb-2" for="name">Name</label>
                        <b-form-input class="form-control" id="name" type="text" v-model="form.name"></b-form-input>
                    </div>

                    <div class="col-md-12 mb-8">
                        <label for="description">Description and notes</label>
                        <b-form-textarea class="form-control" id="description" v-model="form.description" placeholder="" rows="3"></b-form-textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 d-grid">
                        <button class="btn btn-primary" @click="submit" :disabled="form.busy">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Logistics3pInvoicesCreate",
    props: ['stores'],
    data() {
        return {
            form: new SparkForm ({
                subType: 2,
                autoID: true,
                customID: '',
                storeID: '',
                customerID: '',
                name: '',
                date: '',
                statusID: 7601,
                description: ''
            }),
            submitted: false
        }
    },
    methods: {
        submit(event) {
            event.preventDefault()
            this.submitted = true;

            Spark.post('/api/v1/stock/transfers/create/location', this.form)
                .then(data => {
                    window.location = '/logistics3p/transfers/' + data._id;
                });
        }
    },

    mounted() {
        var component = this;

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#datepicker_date").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    component.form.date = dateStr;
                }
            });

            $('.s2customerID').select2({
                ajax: {
                    url: '/api/v1/crm/customers/list',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item._id
                                }
                            })
                        };
                    },
                    cache: true
                }
            }).on('select2:select', function (e) {
                component.form.customerID = e.params.data.id;
            });

            $('.s2storeID').select2({
                ajax: {
                    url: '/api/v1/stores/stores',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item._id
                                }
                            })
                        };
                    },
                    cache: true
                }
            }).on('select2:select', function (e) {
                component.form.storeID = e.params.data.id;
            });
        });
    }
}
</script>

<style scoped>

</style>
