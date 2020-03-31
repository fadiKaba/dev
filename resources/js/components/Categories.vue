<template>
    <div class="py-5 px-md-4 mt-4 main-categories">
        <h4 class="border-bottom pb-3">
            Category
        <div :class="loading ? 'spinner-border spinner-border-sm ml-3' : 'd-none'" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        </h4>
        <div class="mt-4">
            <a @click="getPosts">All</a>
            <a  class="py-2"
             v-for="category in categoriesReady"
              :key="'c'+category.name"
              @click="getSingleCat(category.name, category.count)">
              {{category.name+'('+category.count+')'}}
            </a>
        </div>
    </div>    
</template>
<script>

import axios from 'axios';

export default {
    name: 'Categories',
    data: function(){
        return {
            loading: false,
            categories:['Food', 'Health', 'Travel', 'Lifestyle', 'Technology', 'Inspiration', 'Products'],
            categoriesReady: [],
        }
    },
    mounted: function(){
        this.getCat(this.categories)
    },
    methods:{
        getCat: function(arr){
            arr.forEach((item) => {
                this.loading = true;
                axios.post(`/searchcat/${this.categories.indexOf(item)}`)
                .then((response)=>{
                    this.categoriesReady.push({name: item, count: response.data.length});
                    this.loading = false;
                })
            });
        },
        getSingleCat: function(catName, catCount){
           if(catCount > 0){
               this.loading = true;
               axios.post(`/searchcat/${this.categories.indexOf(catName)}`)
               .then((response)=> {
                   this.$emit('catresults', response.data);
                   this.loading = false;
               })
           }
        },
        getPosts: function(){
            this.loading = true;
            axios.post('/getposts')
            .then((response)=>{
                this.$emit('catresults', response.data);
                this.loading = false;
            })
      },
    }

}
</script>
<style lang="scss" scoped>
    .main-categories{
        background-color: #FBF9FF;
        h4{
            font-size: 1.3rem;
            font-weight: 500;
            color: #2B4B80;           
        }
        div{
            a{  
                display: block;   
                color: #707b8e;
                font-size: 1.05rem;
                font-weight: 400;
                transition:0.2s;
                cursor: pointer;
                &:hover{
                    color: #EC4683;
                }
            }
        }
    }
</style>