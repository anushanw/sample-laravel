<template>
    <div>
        <div class="card card-custom">
            <div class="card-body">
                <b-form @reset="onReset">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="customerID">Customer <span class="text-danger">*</span></label>
                                <select class="form-control s2customerID" id="customerID">
                                    <option>Select a customer</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Invoice reference/number</label>
                                <b-input-group class="mb-2">
                                    <b-input-group-prepend is-text>
                                        <input type="checkbox" aria-label="Checkbox for following text input" v-model="form.autoID"><span class="ml-2">Auto</span>
                                    </b-input-group-prepend>
                                    <b-form-input aria-label="Text input with checkbox" v-model="form.customID" :disabled="form.autoID"></b-form-input>
                                </b-input-group>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="date" readonly="readonly" placeholder="Select contract start date" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Billing period start date</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="dateFrom" readonly="readonly" placeholder="Select billing period start date" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Billing period end date</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="dateTo" readonly="readonly" placeholder="Select billing period end date" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="scope">Scope</label>
                                <select class="form-control s2scope" id="scope">
                                    <option value="all">All</option>
                                    <option value="storageOnly">Storage only</option>
                                    <option value="exceptStorage">Everything except storage</option>
                                    <option value="steppedByDuration">Stepped rated based on duration</option>
                                    <option value="steppedByDurationStorageOnly">Stepped rated based on duration - storage only</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Name/memo</label>
                                <b-form-input id="name" type="text" v-model="form.name"></b-form-input>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="creditPeriod">Credit period</label>
                                <b-form-input id="creditPeriod" type="number" v-model="form.creditPeriod"></b-form-input>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-hover" id="table1">
                                <thead>
                                <tr>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Memo</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Unit Price</th>
                                    <th class="text-center">Discount</th>
                                    <th class="text-center">Line total</th>
                                    <th class="text-center"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(product, key, index) in form.products">
                                    <td v-text="product['name']"></td>
                                    <td v-text="product['memo']"></td>
                                    <td v-text="product['qty']" class="text-right"></td>
                                    <td v-text="product['unitPrice']" class="text-right"></td>
                                    <td v-text="product['discount']" class="text-right"></td>
                                    <td v-text="product['lineTotal']" class="text-right"></td>
                                    <td class="text-center align-middle">
                                        <a href="#" v-on:click="editProductRow(key)"><span class="margin-right-10 fa fa-edit"></span></a>
                                        <a href="#" v-on:click="removeLine(key)"><span class="fa fa-trash"></span></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group row no-padding">
                        <div class="col-md-3">
                            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#m_modal" ><i class="fa fa-plus"></i> Add another product</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 text-right">Total discounts</div>
                        <div class="col-md-3 text-right">{{ discount }}</div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2 text-right">Sub total</div>
                        <div class="col-md-3 text-right"><span id="subTotal" v-text="subTotal"></span></div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="description">Description and notes</label>
                            <b-form-textarea id="description" v-model="form.description" placeholder="" rows="3"></b-form-textarea>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <button type="submit" id="saveButton" class="btn btn-block btn-primary " :class="{'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light': submitted}" @click="submit" :disabled="submitted">Preview</button>
                        </div>
                    </div>
                </b-form>
            </div>
        </div>

        <div class="modal fade" id="m_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add a product to invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="form-group kt-form__group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="productID" class="form-control-label">Product</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-group s2productID productSelect" id="productID">
                                            <option value="">Select product</option>

                                            <option v-for="product in products" :data-unitprice="product.price ? product.price : 0.00" :data-productName="product.name ? product.name : 'n/a'" :value="product._id">
                                                {{ product.sku ? product.sku + ' - ' + product.name : product.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="memo" class="form-control-label">Memo</label>
                                <input type="text" class="form-control" id="memo" v-model="temp.memo">
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="qty" class="form-control-label">Qty</label>
                                        <input type="number" class="form-control" id="qty" v-model="temp.qty" v-on:keyup="lineTotal()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="unitPrice" class="form-control-label">Unit Price</label>
                                        <input type="number" class="form-control" id="unitPrice" v-model="temp.unitPrice" v-on:keyup="lineTotal()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="discount" class="form-control-label">Discount</label>
                                        <input type="number" class="form-control" id="discount" v-model="temp.discount" v-on:keyup="lineTotal()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="lineTotal" class="form-control-label">Line Total</label>
                                        <input type="number" class="form-control" id="lineTotal" v-model="temp.lineTotal" v-on:keyup="lineTotal()">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="addProduct()" data-dismiss="modal">Add product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



</template>

<script>
export default {
    name: "Logistics3pInvoicesCreate",
    props: ['customerID', 'products'],
    data() {
        return {
            form: new SparkForm ({
                autoID: true,
                customID: '',
                subType: 1,
                customerID: this.customerID,
                reference: '',
                date: '',
                dateFrom: '',
                dateTo: '',
                description: '',
                name: '',
                salesOrderID: '',
                scope: 'all',
                quotationID: '',
                creditPeriod: '{{ Facades\App\Libraries\Finance\Invoices::creditPeriodDefault() }}',
                products: [],
                discount: 0.00,
                subTotal: 0.00,
                tax: 0.00,
                total: 0.00
            }),
            temp: {productID: '', name:'', memo: '', qty: 1.00, qtySub: 0.00, unitPrice: 0.00, discount: 0.00, lineTotal: 0.00, edit: false, lineKey: 0},
            discount: 0.00,
            subTotal: 0.00,
            tax: 0.00,
            netTotal: 0.00,
            submitted: false
        }
    },
    methods: {
        submit(event) {
            event.preventDefault()
            this.submitted = true;

            Spark.post('/api/v1/finances/invoices/invoice/create/3pl/preview', this.form)
                .then(data => {
                    window.location = '/logistics3p/invoices/create/preview/' + data._id;
            });
        },

        onReset(event) {
            event.preventDefault()
            // Reset our form values
            this.form.email = ''
            this.form.name = ''
            this.form.food = null
            this.form.checked = []
            // Trick to reset/clear native browser form validation state
            this.show = false
            this.$nextTick(() => {
                this.show = true
            })
        },

        addProduct: function() {
            if(this.temp.edit) {
                var lineKey = this.temp.lineKey;

                this.form.products[lineKey].productID = this.temp.productID;
                this.form.products[lineKey].name = this.temp.name;
                this.form.products[lineKey].memo = this.temp.memo;
                this.form.products[lineKey].qty = this.temp.qty;
                this.form.products[lineKey].qtySub = this.temp.qtySub;
                this.form.products[lineKey].unitPrice = this.temp.unitPrice;
                this.form.products[lineKey].discount = this.temp.discount;
                this.form.products[lineKey].lineTotal = this.temp.lineTotal;
            } else {
                this.form.products.push({
                    productID: this.temp.productID,
                    name: this.temp.name,
                    memo: this.temp.memo,
                    qty: this.temp.qty,
                    qtySub: this.temp.qtySub,
                    unitPrice: this.temp.unitPrice,
                    discount: this.temp.discount,
                    lineTotal: this.temp.lineTotal
                });
            }

            this.total();

            this.temp = {productID: '', name:'', memo: '', qty: 1.00, qtySub: 0.00, unitPrice: 0.00, discount: 0.00, lineTotal: 0.00, edit: false, lineKey: 0};
        },

        editProductRow(lineKey) {
            $(".s2productID").val(this.form.products[lineKey].productID).trigger('change');
            this.temp.productID = this.form.products[lineKey].productID;
            this.temp.name = this.form.products[lineKey].name;
            this.temp.memo = this.form.products[lineKey].memo;
            this.temp.qty = this.form.products[lineKey].qty;
            this.temp.qtySub = this.form.products[lineKey].qtySub;
            this.temp.unitPrice = this.form.products[lineKey].unitPrice;
            this.temp.discount = this.form.products[lineKey].discount;
            this.temp.lineTotal = this.form.products[lineKey].lineTotal;
            this.temp.edit = true;
            this.temp.lineKey = lineKey;
            $("#m_modal").modal('show');
        },

        lineTotal: function() {
            this.temp.lineTotal = (this.temp.qty * this.temp.unitPrice) - this.temp.discount;
            this.total();
        },

        total: function() {
            var subTotal = 0.00;
            var discount = 0.00;
            var tax = 0.00;

            this.form.products.forEach(function(item) {
                subTotal += item.lineTotal;
                discount += item.discount;
            });

            this.form.discount = discount;
            this.subTotal = numeral(subTotal).format('0,0.00');
        },

        removeLine: function (lineKey) {
            this.form.products.splice(lineKey, 1);
            this.total();
        },
    },

    mounted() {
        var component = this;

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true
            }).on('changeDate', function(e) {
                component.form.date = $('#' + e.target.id).val();
            });

            $('#dateFrom').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true
            }).on('changeDate', function(e) {
                component.form.dateFrom = $('#' + e.target.id).val();
            });

            $('#dateTo').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true
            }).on('changeDate', function(e) {
                component.form.dateTo = $('#' + e.target.id).val();
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

            $('.s2productID').select2({
                dropdownParent: $('#m_modal'),
                width: '100%'
            }).on('change', function (event) {
                var tempData = $(this).select2('data');
                var data = tempData[0];
                var productName = data.element.attributes.getNamedItem('data-productName').value;
                var unitprice = data.element.attributes.getNamedItem('data-unitprice').value;
                component.temp.productID = data.element.value;
                component.temp.name = productName;
                component.temp.unitPrice = unitprice;
                component.lineTotal();
            });

            $('.s2scope').select2().on('select2:select', function (e) {
                component.form.scope = e.params.data.id;
            });
        });
    }
}
</script>

<style scoped>

</style>
