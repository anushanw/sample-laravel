<template>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 mb-8">
                <div class="form-group">
                    <label class="fs-6 fw-bold mb-2">Inward ID</label>
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
                <div class="form-group">
                    <label class="fs-6 fw-bold mb-2">Container number<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter container number" v-model="form.number">
                </div>
            </div>

            <div class="col-md-3 mb-8">
                <label class="form-label mb-2">MLO</label>
                <select class="form-select s2mlo" aria-label="Select MLO">
                    <option>Select MLO</option>
                </select>
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">Type of cargo</label>
                <input type="text" class="form-control" placeholder="Enter type of cargo" v-model="form.name">
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">In date and time</label>
                <div class="position-relative d-flex align-items-center">
                    <div class="symbol symbol-20px me-4 position-absolute ms-4">
                        <span class="symbol-label bg-secondary">
                            <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-grid.svg-->
                            <span class="svg-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <rect fill="#000000" opacity="0.3" x="4" y="4" width="4" height="4" rx="1"></rect>
                                        <path d="M5,10 L7,10 C7.55228475,10 8,10.4477153 8,11 L8,13 C8,13.5522847 7.55228475,14 7,14 L5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 L14,7 C14,7.55228475 13.5522847,8 13,8 L11,8 C10.4477153,8 10,7.55228475 10,7 L10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,10 L13,10 C13.5522847,10 14,10.4477153 14,11 L14,13 C14,13.5522847 13.5522847,14 13,14 L11,14 C10.4477153,14 10,13.5522847 10,13 L10,11 C10,10.4477153 10.4477153,10 11,10 Z M17,4 L19,4 C19.5522847,4 20,4.44771525 20,5 L20,7 C20,7.55228475 19.5522847,8 19,8 L17,8 C16.4477153,8 16,7.55228475 16,7 L16,5 C16,4.44771525 16.4477153,4 17,4 Z M17,10 L19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 L17,14 C16.4477153,14 16,13.5522847 16,13 L16,11 C16,10.4477153 16.4477153,10 17,10 Z M5,16 L7,16 C7.55228475,16 8,16.4477153 8,17 L8,19 C8,19.5522847 7.55228475,20 7,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,17 C4,16.4477153 4.44771525,16 5,16 Z M11,16 L13,16 C13.5522847,16 14,16.4477153 14,17 L14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 L10,17 C10,16.4477153 10.4477153,16 11,16 Z M17,16 L19,16 C19.5522847,16 20,16.4477153 20,17 L20,19 C20,19.5522847 19.5522847,20 19,20 L17,20 C16.4477153,20 16,19.5522847 16,19 L16,17 C16,16.4477153 16.4477153,16 17,16 Z" fill="#000000"></path>
                                    </g>
                                </svg>
                            </span>
                        </span>
                    </div>

                    <input class="form-control ps-12 flatpickr-input active" id="datepicker_in_date_time" placeholder="Select container in date time" type="text" readonly="readonly">
                </div>
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">Vehicle number</label>
                <input type="text" class="form-control" placeholder="Enter vehicle number" v-model="form.vehicle_number">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-8">
                <label class="form-label mb-2">Inward vessel</label>
                <select class="form-select s2vessel" aria-label="Select example" name="vessel">
                    <option>Select inward vessel</option>
                </select>
            </div>

            <div class="col-md-3 mb-8">
                <label class="fs-6 fw-bold mb-2">Date</label>
                <div class="position-relative d-flex align-items-center">
                    <div class="symbol symbol-20px me-4 position-absolute ms-4">
                        <span class="symbol-label bg-secondary">
                            <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-grid.svg-->
                            <span class="svg-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <rect fill="#000000" opacity="0.3" x="4" y="4" width="4" height="4" rx="1"></rect>
                                        <path d="M5,10 L7,10 C7.55228475,10 8,10.4477153 8,11 L8,13 C8,13.5522847 7.55228475,14 7,14 L5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 L14,7 C14,7.55228475 13.5522847,8 13,8 L11,8 C10.4477153,8 10,7.55228475 10,7 L10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,10 L13,10 C13.5522847,10 14,10.4477153 14,11 L14,13 C14,13.5522847 13.5522847,14 13,14 L11,14 C10.4477153,14 10,13.5522847 10,13 L10,11 C10,10.4477153 10.4477153,10 11,10 Z M17,4 L19,4 C19.5522847,4 20,4.44771525 20,5 L20,7 C20,7.55228475 19.5522847,8 19,8 L17,8 C16.4477153,8 16,7.55228475 16,7 L16,5 C16,4.44771525 16.4477153,4 17,4 Z M17,10 L19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 L17,14 C16.4477153,14 16,13.5522847 16,13 L16,11 C16,10.4477153 16.4477153,10 17,10 Z M5,16 L7,16 C7.55228475,16 8,16.4477153 8,17 L8,19 C8,19.5522847 7.55228475,20 7,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,17 C4,16.4477153 4.44771525,16 5,16 Z M11,16 L13,16 C13.5522847,16 14,16.4477153 14,17 L14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 L10,17 C10,16.4477153 10.4477153,16 11,16 Z M17,16 L19,16 C19.5522847,16 20,16.4477153 20,17 L20,19 C20,19.5522847 19.5522847,20 19,20 L17,20 C16.4477153,20 16,19.5522847 16,19 L16,17 C16,16.4477153 16.4477153,16 17,16 Z" fill="#000000"></path>
                                    </g>
                                </svg>
                            </span>
                        </span>
                    </div>

                    <input class="form-control ps-12 flatpickr-input active" id="datepicker_start_date" placeholder="Select inward date" type="text" readonly="readonly">
                </div>
            </div>

            <div class="col-md-2 mb-8">
                <label class="fs-6 fw-bold mb-2">Voyage</label>
                <input type="text" class="form-control" placeholder="Enter voyage" v-model="form.voyage">
            </div>

            <div class="col-md-2 mb-8">
                <label class="fs-6 fw-bold mb-2">B/L Number</label>
                <input type="text" class="form-control" placeholder="Enter B/L number" v-model="form.blnumber">
            </div>

            <div class="col-md-2 mb-8">
                <label class="fs-6 fw-bold mb-2">Consignee</label>
                <input type="text" class="form-control" placeholder="Enter consignee" v-model="form.consignee">
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 mb-8">
                <label class="form-label mb-2">ISO type</label>
                <select class="form-select s2iso" aria-label="Select example">
                    <option>Select ISO type</option>
                </select>
            </div>

            <div class="col-md-4 mb-8">
                <label class="fs-6 fw-bold mb-2">Size type</label>
                <input type="text" class="form-control" placeholder="Enter voyage" v-model="form.size_type">
            </div>

            <div class="col-md-2 mb-8">
                <label class="fs-6 fw-bold mb-2">Gross weight</label>
                <input type="text" class="form-control" placeholder="Enter B/L number" v-model="form.weight_gross">
            </div>

            <div class="col-md-2 mb-8">
                <label class="fs-6 fw-bold mb-2">Ventilation</label>
                <select class="form-select s2ventilation" aria-label="Select example">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <div class="col-md-2 mb-8">
                <label class="fs-6 fw-bold mb-2">V</label>
                <select class="form-select s2v" aria-label="Select example">
                    <option value="2V">2V</option>
                    <option value="4V">4V</option>
                    <option value="Sp V">Sp V</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-8">
                <div class="form-group">
                    <label for="exampleTextarea">Notes</label>
                    <textarea class="form-control" v-model="form.description" id="exampleTextarea" rows="3"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 d-grid">
                <button class="btn btn-primary" @click="submit" :disabled="form.busy">Create container inward</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ContractsCustomersCreate",
    data: function () {
        return {
            form: new SparkForm({
                autoID: true,
                customID: '',
                bl_number: '',
                consignee: '',
                date: null,
                description: null,
                in_at: null,
                isoTypeID: null,
                number: '',
                name: '',
                size_type: '',
                v: '',
                vehicle_number: '',
                ventilation: '0',
                vesselID: null,
                voyage: '',
                weight_gross: '',

                risk: 3,

                end_date: null,
                value: null,

            })
        }
    },

    methods: {
        submit() {
            Spark.post('/api/v1/containers/inwards', this.form)
                .then(response => {
                    console.log(response);
                    window.location.href = "/containers/inwards/" + response._id;
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

            $("#datepicker_in_date_time").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                onChange: function(selectedDates, dateStr, instance) {
                    component.form.in_at = dateStr;
                }
            });

            $("#datepicker_date").flatpickr({
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    component.form.date = dateStr;
                }
            });

            $("#datepicker_end_date").flatpickr({
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    component.form.end_date = dateStr;
                }
            });

            $('.s2mlo').select2({
                palceholder: 'Select a MLO',
                ajax: {
                    url: '/api/v1/containers/mlos',
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
                },
            }).on('select2:select', function (e) {
                component.form.mloID = e.params.data.id;
            });

            $('.s2vessel').select2({
                palceholder: 'Select a vessel',
                ajax: {
                    url: '/api/v1/containers/vessels',
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
                },
            }).on('select2:select', function (e) {
                component.form.vesselID = e.params.data.id;
            });

            $('.s2iso').select2({
                palceholder: 'Select ISO type',
                ajax: {
                    url: '/api/v1/containers/iso-types',
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
                },
            }).on('select2:select', function (e) {
                component.form.isoTypeID = e.params.data.id;
            });

            $('.s2ventilation').select2().on('select2:select', function (e) {
                component.form.ventilation = Number(e.params.data.id);
            });

            $('.s2v').select2().on('select2:select', function (e) {
                component.form.v = Number(e.params.data.id);
            });
        });
    }
}
</script>

<style scoped>

</style>
