<template>
    <div class="container">
        <section class="content mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-2 rounded-0" style="margin-bottom: 5px !important;">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-md-3 float-left">
                                    <p><router-link to="/dashboard"> Home </router-link> / Edit Product</p>
                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-3">
                                    <div class="d-inline-flex float-right">
                                        <router-link to="/product" class="btn btn-sm btn-primary btn_acitve float-right">
                                            <i class="nav-icon fab fa-product-hunt"></i> Products list
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form @submit.prevent="updateProduct">
                            <div class="card-body pb-0 bg_light_gray">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">Title(Name) <i class="text-danger">*</i> </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="" v-model="form.product_name" class="form-control-sm w-100" required>
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
                                                    <input type="" name="" v-model="form.supplier_price" class="form-control-sm w-100 w-100" required>
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="warehouse_id" class="col-sm-3 form-control-label">Sell Price <i class="text-danger">*</i> </label>
                                                <div class="col-sm-9">
                                                    <input type="" name="" v-model="form.sell_price" class="form-control-sm w-100 w-100" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="warehouse_id" class="col-sm-3 form-control-label">Product Qty <i class="text-danger">*</i></label>
                                                <div class="col-sm-9">
                                                    <input type="" name="product_qty" v-model="form.product_qty" class="form-control-sm w-100 w-100" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="warehouse_id" class="col-sm-3 form-control-label">Model </label>
                                                <div class="col-sm-9">
                                                    <input type="" name="detail" v-model="form.model" class="form-control-sm w-100 w-100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"> Make Date</label>
                                                <div class="col-sm-9">
                                                    <input type="text" v-model="form.mfg_date" name="" class="form-control-sm w-100 datetimepicker" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Expired Date</label>
                                                <div class="col-sm-9">
                                                    <input type="text" v-model="form.exp_date" name="" class="form-control-sm w-100 datetimepicker" autocomplete="off"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="warehouse_id" class="col-sm-3 form-control-label">Product Detail </label>
                                                <div class="col-sm-9">
                                                    <textarea rows="3" class="form-control" v-model="form.product_detail"></textarea>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="form-control-label col-sm-3">Image</label>
                                                <div class="col-sm-5">
                                                    <input type="file" :src="form.image" @change="uploadImage" class="form-control-sm w-100 border p-0"/>
                                                </div>

                                                <img v-if="form.image" :src="getImgUrl(form.image)"  class="img-fluid table_img" alt="image">

                                                <img v-else src="/images/product/default.png"  class="img-fluid table_img" alt="image">
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
                                   <i class="fa fa-sync"></i> Update Product
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
            return {
                form: new Form({

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
            this.getProducts();
        },

        computed: {
            
        },

        methods:{

            updateProduct: function(){
                this.$Progress.start()
                var temp = this
                temp.form.products = temp.products;
                axios.put('/api/products/'+this.form.id,{
                    product:temp.form,
                    updateImgUrl:temp.img_url
                })
                .then(function (response) {
                    console.log(response.data)
                    toastr.success('Updated Supplier Successfully');
                    temp.$Progress.finish()
                })
                .catch(function (error) {
                    toastr.error('Updated Supplier Failed')
                    temp.$Progress.fail()
                });
            },

            getProducts(){
                var temp = this;
                axios.get('/api/products/'+this.$route.params.id)
                .then((response) => {
                    console.log(response)
                    temp.form = response.data
                })
                .catch(function (error) {
                    toastr.error('Something is wrong Data Loaded')
                });
            },

            getImgUrl: function(image){
                var temp = this;
                if (temp.img_url) {
                    var photo = temp.img_url
                }else{
                    photo = "/images/product/"+ image
                }
               
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
