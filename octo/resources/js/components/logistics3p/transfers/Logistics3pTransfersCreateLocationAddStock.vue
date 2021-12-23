<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr><td>Number</td><td>{{ transfer.customID }}</td></tr>
                                    <tr><td>Date</td><td>{{ transfer.date }}</td></tr>
                                    <tr><td>Status</td><td>{{ transfer.status.name }}</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr><td>Store name</td><td><a :href="'/warehouse/warehouses/warehouse/' + transfer.storeID" class="align-middle kt--margin-right-10"><i class="flaticon-location"></i></a>{{ transfer.store.name }}</td></tr>
                                        <tr><td>Name/memo</td><td>{{ transfer.store.name }}</td></tr>

                                        <tr v-if="transfer.customerID">
                                            <td>Customer</td><td><a :href="'/crm/customers/customer/' + transfer.customerID" class="align-middle kt--margin-right-10"><i class="flaticon-user"></i></a>{{ transfer.customer.name }}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th colspan="5"></th>
                                        <th class="text-center" colspan="3">Origin</th>
                                        <th class="text-center" colspan="3">Destination</th>
                                    </tr>
                                    <tr>
                                        <th class="invoice-title"></th>
                                        <th class="invoice-title">ID</th>
                                        <th class="invoice-title">SKU</th>
                                        <th class="invoice-title">Name</th>
                                        <th class="invoice-title">Batch</th>
                                        <th class="invoice-title">Package #</th>
                                        <th class="invoice-title text-center">Qty</th>
                                        <th class="invoice-title text-center">Sub Qty</th>
                                        <th class="invoice-title text-center">Location</th>
                                        <th class="invoice-title text-center">Qty</th>
                                        <th class="invoice-title text-center">Sub Qty</th>
                                        <th class="invoice-title text-center">Location</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="stock in form.stocks" v-if="stock.selected">
                                        <td><input type="checkbox" v-model="stock.selected"></td>
                                        <td>{{ stock._id }} </td>
                                        <td>{{ stock.product.sku }} </td>
                                        <td>{{ stock.product.name }} </td>
                                        <td>{{ stock.batch }} </td>
                                        <td>{{ stock.packageNumber }} </td>
                                        <td class="text-end">{{ stock.qtyAvailable }} </td>
                                        <td class="text-end">{{ stock.qtySubAvailable }} </td>
                                        <td class="text-center">{{ stock.location }} </td>
                                        <td><input type="number" v-model="stock.txQty" :disabled="!stock.selected" min="0.01" step="0.01" :max="stock.qtyAvailable"></td>
                                        <td class="text-end"><span v-text="(stock.qtySubAvailable / stock.qtyAvailable) * stock.txQty" v-if="stock.txQty"></span></td>
                                        <td><input type="text" v-model="stock.txLocation" :disabled="!stock.selected"></td>
                                    </tr>
                                    </tbody>
                                </table>
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
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-header card-header-tabs-line">
                        <div class="card-title">
                            <h3 class="card-label">Available stocks</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th colspan="6"></th>
                                <th class="text-center" colspan="3">Origin</th>
                                <th class="text-center" colspan="3">Destination</th>
                            </tr>
                            <tr>
                                <th class="invoice-title"></th>
                                <th class="invoice-title">ID</th>
                                <th class="invoice-title">SKU</th>
                                <th class="invoice-title">Name</th>
                                <th class="invoice-title">Batch</th>
                                <th class="invoice-title">Package #</th>
                                <th class="invoice-title text-center">Qty</th>
                                <th class="invoice-title text-center">Sub Qty</th>
                                <th class="invoice-title text-center">Location</th>
                                <th class="invoice-title text-center">Qty</th>
                                <th class="invoice-title text-center">Sub Qty</th>
                                <th class="invoice-title text-center">Location</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="stock in form.stocks">
                                <td><input type="checkbox" v-model="stock.selected"></td>
                                <td>{{ stock._id }} </td>
                                <td>{{ stock.product.sku }} </td>
                                <td>{{ stock.product.name }} </td>
                                <td>{{ stock.batch }} </td>
                                <td>{{ stock.packageNumber }} </td>
                                <td class="text-end">{{ stock.qtyAvailable }} </td>
                                <td class="text-end">{{ stock.qtySubAvailable }} </td>
                                <td class="text-center">{{ stock.location }} </td>
                                <td><input type="number" v-model="stock.txQty" :disabled="!stock.selected" min="0.01" step="0.01" :max="stock.qtyAvailable"></td>
                                <td class="text-end"><span v-text="(stock.qtySubAvailable / stock.qtyAvailable) * stock.txQty" v-if="stock.txQty"></span></td>
                                <td><input type="text" v-model="stock.txLocation" :disabled="!stock.selected"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Logistics3pInvoicesCreate",
    props: ['stocksIn', 'transfer'],
    data() {
        return {
            form: new SparkForm ({
                transferID: this.transfer._id,
                stocks: null
            }),
            submitted: false
        }
    },

    methods: {
        submit(event) {
            event.preventDefault()
            this.submitted = true;

            Spark.post('/api/v1/stock/transfers/create/location/stock', this.form)
                .then(data => {
                    window.location = '/logistics3p/transfers/' + data._id;
                });
        }
    },

    mounted() {
        var component = this;
        component.form.stocks = this.stocksIn;

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    }
}
</script>

<style scoped>

</style>
