
import dashboard from './components/admin/dashboard.vue';
import categoryList from './components/admin/category/index.vue';
import createCategory from './components/admin/category/create.vue';

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
    }

];