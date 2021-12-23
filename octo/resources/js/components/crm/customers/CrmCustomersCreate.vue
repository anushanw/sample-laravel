<template>
    <div>
        <div class="row">
            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">Customer name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Customer/company name" v-model="form.name" required>
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">Customer code</label>
                <input type="text" class="form-control" placeholder="Customer/company code" v-model="form.code">
            </div>

            <div class="col-md-3 mb-8">
                <div class="form-group">
                    <label class="fs-6 fw-bold mb-2">Category</label>
                    <select class="form-select s2categoryID" name="categoryID">
                        <option>Select a category</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3 mb-8">
                <div class="form-group">
                    <label class="fs-6 fw-bold mb-2">Custom ID</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <label class="checkbox checkbox-inline"><input type="checkbox" v-model="form.autoID"><span></span></label><span class="ms-3">Auto</span>
                            </span>
                        </div>
                        <input type="text" class="form-control" v-model="form.customID" aria-label="Enter ID or leave blank for auto generate" :disabled="form.autoID">
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">E-mail address</label>
                <input type="email" class="form-control" placeholder="E-mail address" v-model="form.email">
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">Website</label>
                <input type="url" class="form-control" placeholder="Website" v-model="form.website">
            </div>

            <div class="col-md-3 mb-8">
                <div class="form-group">
                    <label class="fs-6 fw-bold mb-2">Country</label>
                    <select class="form-select s2countryID" name="countryID">
                        <option>Select a customer</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">Address line 1</label>
                <input type="text" class="form-control" placeholder="50 Main Street" v-model="form.address1">
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">Address line 2</label>
                <input type="text" class="form-control" placeholder="Unit 10" v-model="form.address2">
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">City</label>
                <input type="text" class="form-control" placeholder="New York" v-model="form.city">
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">ZIP/Post code</label>
                <input type="text" class="form-control" placeholder="ZIP or post code" v-model="form.zip">
            </div>

            <div class="col-md-3 mb-8">
                <div class="form-group">
                    <label class="fs-6 fw-bold mb-2">State</label>
                    <select class="form-select s2stateID" name="stateID">
                        <option>Select a customer</option>
                    </select>
                </div>
            </div>




            <div class="col-md-3 mb-8">
                <div class="form-group">
                    <label class="fs-6 fw-bold mb-2">Customer status</label>
                    <select class="form-select s2statusID" name="statusID">
                        <option>Select a status</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3 mb-8">
                <div class="form-group">
                    <label class="fs-6 fw-bold mb-2">Lead source</label>
                    <select class="form-select s2leadSourceID" name="leadSourceID">
                        <option>Select lead source</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3 mb-8">
                <div class="form-group">
                    <label class="fs-6 fw-bold mb-2">Marketing campaign</label>
                    <select class="form-select s2marketingCampaignID" name="marketingCampaignID">
                        <option>Select marketing campaign</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">Customer since</label>
                <div class="position-relative d-flex align-items-center">
                    <div class="symbol symbol-20px me-4 position-absolute ms-4">
                        <span class="symbol-label bg-secondary">
                            <span class="fa fa-calendar-alt"></span>
                        </span>
                    </div>

                    <input class="form-control ps-12 flatpickr-input active" id="datepicker_customer_since" placeholder="Select customer since date" type="text" readonly="readonly">
                </div>
            </div>

            <div class="col-md-3 mb-8">
                <div class="form-group">
                    <label class="fs-6 fw-bold mb-2">Industry</label>
                    <select class="form-select s2industryID" name="industryID">
                        <option>Select marketing campaign</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">Legal name</label>
                <input type="text" class="form-control" placeholder="Legal name" v-model="form.nameLegal">
            </div>

            <div class="col-md-12 mb-8">
                <div class="form-group">
                    <label for="exampleTextarea">Description and notes</label>
                    <textarea class="form-control" v-model="form.description" id="exampleTextarea" rows="3"></textarea>
                </div>
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">VAT number</label>
                <input type="text" class="form-control" placeholder="VAT number" v-model="form.taxNumberVAT">
            </div>

            <div class="col-md-3 mb-8 form-check form-switch form-check-custom form-check-solid">
                <label class="fs-6 fw-bold mb-2">Enable SVAT for tax</label>
                <input class="form-control form-check-input" type="checkbox" v-model="form.useTaxSVAT" />
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">SVAT number</label>
                <input type="text" class="form-control" placeholder="SVAT number" v-model="form.taxNumberSVAT">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 d-grid">
                <button class="btn btn-primary" @click="submit" :disabled="form.busy">Create customer</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CrmCustomersCreate",
    data: function () {
        return {
            form: new SparkForm({
                type: 3,
                autoID: true,
                customID: '',
                subType: '1',
                name: '',
                nameLegal: '',
                code: '',
                telephones: [],
                mobile: '',
                fax: '',
                email: '',
                website: '',
                address1: '',
                address2: '',
                city: '',
                stateID: '',
                zip: '',
                countryID: '',
                description: '',
                categoryID: '',
                customerSince: '',
                leadSourceID: '',
                creditLimit: '',
                creditPeriod: '',
                industryID: '',
                marketingCampaignID: '',
                useTaxSVAT: false,
                taxNumberVAT: '',
                taxNumberSVAT: '',
                statusID: 1
            }),
            fields: '',
            submitted: false
        }
    },

    methods: {
        submit() {
            Spark.post('/api/v1/crm/customers', this.form)
                .then(response => {
                    window.location.href = "/crm/customers/" + response._id;
                });
        }
    },

    mounted: function () {
        var component = this;

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#datepicker_customer_since").flatpickr({
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    component.form.customerSince = dateStr;
                }
            });

            // $('.s2customer').select2({
            //     palceholder: 'Select a customer',
            //     ajax: {
            //         url: '/api/v1/crm/customers/list',
            //         dataType: 'json',
            //         processResults: function (data) {
            //             return {
            //                 results:  $.map(data, function (item) {
            //                     return {
            //                         text: item.name,
            //                         id: item._id
            //                     }
            //                 })
            //             };
            //         },
            //         cache: true
            //     }
            // }).on('select2:select', function (e) {
            //     component.form.customerID = e.params.data.id;
            // });
            //
            // $('.s2risk').select2().on('select2:select', function (e) {
            //     component.form.risk = Number(e.params.data.id);
            // });
        });
    }
}
</script>

<style scoped>

</style>
