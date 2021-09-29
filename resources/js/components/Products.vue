<template>
    <div>
        <h2>Products</h2>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" @click = "fetchProducts(pagination.first_page_url)">First</a></li>
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click = "fetchProducts(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item disabled">
                    <a class=" text-dark page-link">
                        page {{ pagination.current_page }} of {{ pagination.last_page }} pages
                    </a>
                </li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click = "fetchProducts(pagination.next_page_url)">Next</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" @click = "fetchProducts(pagination.last_page_url)">Last</a></li>
            </ul>
        </nav>
        <div v-for="product in products" v-bind:key="product.id">
            <div class="card mb-3">
                <div class="card-body">
                    <h3>{{ product.id }}</h3>
                    <h3>{{ product.name }}</h3>
                    <p>{{ product.description }}</p>
                    <p>{{ product.slug }}</p>
                    <h6>{{ product.price }}</h6>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <button @click='deleteProduct(product.id)' class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    data(){
        return{
            products:[], 
            product:{
                id: '',
                description: '',
                slug: '',
                price: ''
            },
            pagination: {},
            edit:false
        }
    },
    created(){
        this.fetchProducts();
    },
    methods:{
        fetchProducts(page_url){
            let vm =this;
            page_url = page_url || 'api/products'
            fetch(page_url)
                .then(res => res.json()) 
                .then(res => {
                    this.products = res.data;
                    vm.makePagination(res);
                })
                .catch(err => console.log(err));
        },
        makePagination(res){
            let pagination = {
                first_page_url: res.first_page_url,
                prev_page_url: res.prev_page_url,
                current_page: res.current_page,
                last_page: res.last_page,
                next_page_url:res.next_page_url,
                last_page_url:res.last_page_url
            };
            this.pagination = pagination;
        },
        deleteProduct(id){
            // console.log(id);
            if(confirm('Are You Sure?')){
                axios.delete(`/api/products/${id}`) 
                // .then(res => res.json())
                .then(data=>{
                    alert('Product Removed');
                    this.fetchProducts();
                })
                .catch(err => console.log(err));            
            }
        },
    }
}
</script>