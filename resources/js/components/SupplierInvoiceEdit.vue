<template>
    <div class="container">
        <section class="content mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-2 rounded-0" style="margin-bottom: 5px !important;">
                        <div class="card-header pb-0">
                          <div class="row">
                            <div class="col-md-3 float-left">
                                <p><router-link to="/dashboard"> Home </router-link> / Add New SupplierInvoice</p>
                          </div>
                          <div class="col-md-6">

                          </div>
                          <div class="col-md-3">
                              <div class="d-inline-flex float-right">
                                <router-link to="/supplier-invoice" class="btn btn-sm btn-primary float-right btn_acitve">
                                    <i class="nav-icon far fa-file-alt"></i> Supplier Invoice
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body bg_light_gray">
                    <form @submit.prevent="updateSupplierInvoice">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label">Select Supplier <i class="text-danger">*</i></label>
                                        <div class="col-sm-8">
                                            <select id="supplier_id" v-model="form.supplier_id" name="supplier_id" class="form-control-sm w-100 w-100" required>
                                                 <option v-for="supplier in suppliers" :value="supplier.id">{{ supplier.supplier_name }}</option>
                                            </select>
                                            <input id="auth_id" type="hidden" name="auth_id" value="1">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="warehouse_id" class="col-sm-3 form-control-label">Warehouse </label>
                                        <div class="col-sm-8">
                                            <select id="warehouse_id" v-model="form.warehouse_id" name="warehouse_id" class="form-control-sm w-100 w-100" data-plugin="select2" required>
                                                <option v-for="warehouse in warehouses" :value="warehouse.id">{{ warehouse.warehouse_name }}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-5">
                                    <div class="form-group row mb-1">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Date</label>
                                        <div class="col-sm-10">
                                            <input type="text" v-model="form.invoice_date" name="" class="form-control-sm w-100 datetimepicker" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-7 ml-2">
                                            <input type="file" :src="form.image" @change="uploadImage" class="form-control-sm w-100 border p-0" />
                                        </div>

                                        <div v-if="!img_url" id="preview col-sm-2">
                                            <img v-show="this.form.image" :src="getImgUrl(this.form.image)"  class="img-fluid table_img" alt="User Avatar">
                                        </div>

                                        <div id="preview col-sm-2">
                                            <img v-if="img_url" :src="img_url" class="img-fluid table_img"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-hover" id="normalinvoice">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Item Information <i class="text-danger">*</i></th>
                                            <th class="text-center">Quantity <i class="text-danger">*</i></th>
                                            <th class="text-center">Rate <i class="text-danger">*</i></th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="add_row_to_invoice">

                                        <tr v-for="(product, index) in products">
                                            <td style="width: 320px">
                                                <input @blur="onBlur=true" @focus="onFocus = true;onBlur = false;" v-model="product.product_name" @keyDown="keyDown"  type="text" placeholder="Product Name" class="form-control-sm w-100" required>
                                                <div class="product.index-items search_dynamic_product">
                                                    <div v-for="(i, index) in all_product_arr" v-if= "onFocus && i.product_name.substr(0, product.product_name.length).toUpperCase() == product.product_name.toUpperCase()" @click="product.product_name = i.product_name; product.sell_price = i.sell_price; onFocus = false;">
                                                       <p class="product_name_active mb-0 border-bottom">  
                                                          {{i.product_name.substr(product.product_name.length)}} 
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 320px">
                                                <input v-model="product.product_quantity" placeholder="Product Quantity" type="text" class="form-control-sm w-100" autocomplete="off" required>
                                            </td>
                                            <td>
                                                <input v-model="product.supplier_price" placeholder="Product Price" type="text" class="form-control-sm w-100" autocomplete="off" required>
                                            </td>
                                            <td class="text-center">
                                                <input class="form-control-sm w-100" :value="product.product_quantity * product.supplier_price" tabindex="-1" type="text" style="text-align: center;" disabled>
                                            </td>
                                            <td class="text-center">
                                                <span @click="deleteRow(index)" class="btn btn-danger btn-sm">&times;</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr id="appssss">
                                            <td colspan="3" style="text-align:right;"><b>Grand Total:</b></td>
                                            <td class="text-center">
                                                <input class="form-control-sm w-100" :value="grand_total_price" tabindex="-1" type="text" style="text-align: center;" disabled>
                                            </td>
                                            <td align="center">
                                                <input id="add-invoice-item" class="btn btn-info btn-sm" name="add-invoice-item" @click="add_new_row_to_invoice" value="Add New Item" tabindex="5" type="button">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;" colspan="3"><b>Paid Amount:</b></td>
                                            <td class="text-right">
                                                <input id="paidAmount" class="form-control-sm w-100" v-model="form.paid_amount" value="5455" name="paid_amount" tabindex="6" type="number" required style="text-align: center;">
                                            </td>
                                        </tr>
                                        <tr v-show="due_amount">
                                            <td style="text-align:right;" colspan="3"><b>Due:</b></td>
                                            <td  class="text-center">
                                                <input class="form-control-sm w-100" :value="due_amount"  type="number" style="text-align: center;" disabled>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="card-footer">
                                    <router-link to="/supplier-invoice" class="btn btn-sm btn-default float-left">
                                        Back to Invoice list
                                    </router-link>

                                    <button class="btn btn-sm btn-primary float-right" >
                                        <i class="fa fa-sync"></i> Update Supplier Invoice
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</template>

<script>
export default {

    data() {
        return {
            form: new Form({
              id : '',
              products:[],

              supplier_id : '',
              warehouse_id : '',
              invoice_date :'',
              image : '',
              grand_total_price : '',
              paid_amount : '',
              discount : '',
              due_amount : ''
            }),

            img_url: '',
            suppliers:{},
            warehouses:{},
            products:[],

            all_product_arr: [],
            currentFocus: '',
            autocomplete: '',
            onBlur: true,
            onFocus: false,
        }
    },

    mounted(){
        this.getSuppliers();
        this.getWarehouses();
        this.getSupplierInvoice();
        this.getAllProduct();
    },

    computed: {

        grand_total_price: function() {
            var temp = this
            return temp.products.reduce(function(carry, product) {
                let total = carry + (parseFloat(product.product_quantity) * parseFloat(product.supplier_price));
                temp.form.grand_total_price = total
                return total
            }, 0);
        },

        due_amount: function() {
           var temp = this
           let due_ammount = temp.grand_total_price - parseFloat(temp.form.paid_amount);
           temp.form.due_amount = due_ammount
           return due_ammount
        }
    },

    methods:{

        // for product search
        addActive(){
            var vm = this;
            if (!vm.array) return false;
            if (vm.currentFocus >= vm.array.length) vm.currentFocus = 0;
            if (vm.currentFocus < 0) vm.currentFocus = (vm.array.length - 1);
        },
        keyDown(e){ 
            var vm = this;
            if (e.keyCode == 40) {
                vm.currentFocus++;
                vm.addActive()
            } else if (e.keyCode == 38) {
                vm.currentFocus;
                vm.addActive()
            }
        },

        updateSupplierInvoice: function(){
            this.$Progress.start()
            var temp = this
            temp.form.products = temp.products;
            axios.put('/api/supllier-invoice/'+this.form.id,{
                SupplierInvoice:temp.form,
                updateImgUrl:temp.img_url
            })
            .then(function (response) {
              toastr.success('Updated Supplier Successfully');
              temp.$Progress.finish()
            })
            .catch(function (error) {
              toastr.error('Updated Supplier Failed')
              temp.$Progress.fail()
            });
        },

        getImgUrl: function(image){
            var photo = "/images/supplier_invoice/"+ image
            return photo
        },

        uploadImage(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 2;
            if(file['size'] > limit){
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'You are uploading a large file',
                })
                return false;
            }else{
                file = e.target.files[0]
                this.img_url = URL.createObjectURL(file);
            }
            reader.onloadend = (file) => {
                this.form.image = reader.result
            }
            reader.readAsDataURL(file);
        },

        add_new_row_to_invoice: function(){
            var temp = this;
            this.products.push({product_name : '', product_quantity : 1, supplier_price : 0 })
        },

        deleteRow: function(index){
           this.products.splice(index, 1)
        },

        getSupplierInvoice(){
            var temp = this;
            axios.get('/api/supllier-invoice/'+this.$route.params.id)
            .then((response) => {
              temp.form = response.data.supplierInvoice;
              temp.products = response.data.supplierInvoiceProduct;
            })
            .catch(function (error) {
              toastr.error('Something is wrong Data Loaded')
            });
        },

        getSuppliers(){
            var temp = this;
            axios.get('/api/suppliers')
            .then((response) => {
              temp.suppliers = response.data.data;
            })
            .catch(function (error) {
              toastr.error('Something is wrong Data Loaded')
            });
        },

        getWarehouses(){
            var temp = this;
            axios.get('/api/warehouses')
            .then((response) => {
                temp.warehouses = response.data.data;
            })
            .catch(function (error) {
                toastr.error('Something is wrong Data Loaded')
            });
        },

        getAllProduct(){
                var temp = this;
                axios.get('/api/allProduct')
                .then((response) => {
                    temp.all_product_arr = response.data.data;
                })
                .catch(function (error) {
                    this.loadin = true; 
                    toastr.error('Something is wrong Data Loaded')
                });
            },
    }
}
</script>
