
import dashboard from './components/admin/dashboard.vue';
import categoryList from './components/admin/category/index.vue';
import createCategory from './components/admin/category/create.vue';
import EditCategory from './components/admin/category/edit.vue';

import productList from './components/admin/product/index.vue';
import createProduct from './components/admin/product/create.vue';
import EditProduct from './components/admin/product/edit.vue';

export  const routes =[
    {
         path:'/dashboard',
        component:dashboard
    },
    {
        path:'/admin/category',
        component:categoryList
    },
    {
        path:'/admin/cateogry/create',
        component:createCategory
    },
    {
        path:'/admin/category/edit/:id',
        component:EditCategory
    },
    {
        path:'/admin/products',
        component:productList
    },
    {
        path:'/admin/product/create',
        component:createProduct
    },
    {
        path:'/admin/product/edit/:id',
        component:EditProduct
    },

];