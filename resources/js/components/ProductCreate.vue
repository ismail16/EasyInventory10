<template>
    <div class="container">
        <section class="content mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-2 rounded-0" style="margin-bottom: 5px !important;">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-md-3 float-left">
                                    <p><router-link to="/dashboard"> Home </router-link> / Add New Product</p>
                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-3">
                                    <div class="d-inline-flex float-right">
                                        <router-link to="/product" class="btn btn-sm btn-primary float-right">
                                            <i class="nav-icon fab fa-product-hunt"></i> Products list
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form @submit.prevent="addNewProduct">
                            <div class="card-body pb-0 bg_light_gray">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">Title(Name) <i class="text-danger">*</i> </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="" v-model="form.product_name" class="form-control-sm w-100" :class="{ 'is-invalid': form.errors.has('product_name') }" required>
                                                    <has-error :form="form" field="product_name"></has-error>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="form-control-label col-sm-3">Category <i class="text-danger">*</i></label>
                                                <div class="col-sm-9">
                                                    <select id="supplier_id" v-model="form.category_id" name="supplier_id" class="form-control-sm w-100" required>
                                                        <option v-for="category in categories" :value="category.id">{{ category.category_name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">Select Supplier <i class="text-danger">*</i></label>
                                                <div class="col-sm-9">
                                                    <select id="supplier_id" v-model="form.supplier_id" name="supplier_id" class="form-control-sm w-100 w-100" required>
                                                         <option v-for="supplier in suppliers" :value="supplier.id">{{ supplier.supplier_name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="warehouse_id" class="col-sm-3 form-control-label">Warehouse </label>
                                                <div class="col-sm-9">
                                                    <select id="warehouse_id" v-model="form.warehouse_id" name="warehouse_id" class="form-control-sm w-100 w-100" data-plugin="select2">
                                                        <option v-for="warehouse in warehouses" :value="warehouse.id">{{ warehouse.warehouse_name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="warehouse_id" class="col-sm-3 form-control-label">Supplier Price <i class="text-danger">*</i></label>
                                                <div class="col-sm-9">
                                                   <input type="number" name="" v-model="form.supplier_price" class="form-control-sm w-100 w-100" required>
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="warehouse_id" class="col-sm-3 form-control-label">Sell Price  <i class="text-danger">*</i></label>
                                                <div class="col-sm-9">
                                                   <input type="number" name="" v-model="form.sell_price" class="form-control-sm w-100 w-100" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="warehouse_id" class="col-sm-3 form-control-label">Product Qty <i class="text-danger">*</i></label>
                                                <div class="col-sm-9">
                                                   <input type="number" name="product_qty" v-model="form.product_qty" class="form-control-sm w-100 w-100" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="warehouse_id" class="col-sm-3 form-control-label">Model </label>
                                                <div class="col-sm-9">
                                                   <input type="" name="detail" v-model="form.model" class="form-control-sm w-100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"> Make Date</label>
                                                <div class="col-sm-9">    
                                                    <input type="text" v-model="form.mfg_date" name="" class="form-control-sm w-100 datetimepicker" :class="{ 'is-invalid': form.errors.has('mfg_date') }" autocomplete="off">
                                                    <has-error :form="form" field="mfg_date"></has-error>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Expired Date</label>
                                                <div class="col-sm-9">       
                                                    <input type="text"  v-model="form.exp_date" name="" class="form-control-sm w-100 datetimepicker" :class="{ 'is-invalid': form.errors.has('exp_date') }" autocomplete="off">
                                                    <has-error :form="form" field="exp_date"></has-error>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6">
                                             <div class="form-group row">
                                                <label class="col-sm-3 form-control-label" >Product Detail</label>
                                                <div class="col-sm-9">
                                                     <textarea rows="3" class="form-control w-100" v-model="form.product_detail"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="form-control-label col-sm-3">Image</label>
                                                <div class="col-sm-5">
                                                    <input type="file" :src="form.image" @change="uploadImage" class="form-control-sm w-100 border p-0"/>
                                                </div>
                                                <div id="preview col-sm-2">
                                                    <img v-if="img_url" :src="img_url" class="img-fluid table_img"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <router-link to="/product" class="btn btn-sm btn-default float-left">
                                    Back to Product list
                                </router-link>
                                <button class="btn btn-sm btn-primary float-right" >
                                    Create Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data() {
            var today = new Date();
            var current_date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
            return {
                form: new Form({
                    product_name : '',
                    category_id : '',
                    supplier_id : '',
                    warehouse_id : '',
                    product_qty : '',
                    supplier_price : '',
                    sell_price : '',
                    mfg_date : current_date ,
                    exp_date : current_date,
                    model : '',
                    image : '',
                    product_detail : '',              
                }), 
                img_url: '',
                suppliers:{},
                categories:{},
                warehouses:{}
            }
        },

        mounted(){
            this.getCategories();
            this.getSuppliers();
            this.getWarehouses();
        },

        computed: {
        },

        methods:{
            addNewProduct(){
                var temp = this
                temp.$Progress.start()
                temp.form.post('/api/products')
                .then(function (response) {
                    console.log(response)
                    toastr.success('Saved Product Successfully')
                    temp.$Progress.finish()
                })
                .catch(function (error) {
                    toastr.error('Saved Product Failed')
                    temp.$Progress.fail()
              });
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

            getCategories(){
                var temp = this;
                axios.get('/api/categories')
                .then((response) => {
                  temp.categories = response.data.data;
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
        }
    }
</script>
