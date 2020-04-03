<template>
    <div class="pt-5 main-blog">
        <div class="Loading">
            <Loading :res="loading"></Loading>
        </div>
        <div class="container mt-5 pt-md-5">
            <h2 class="text-center mt-md-5"><span class="line"></span> Blog <br>
            <span class="title-h2 mt-3">Our Blog Area</span> 
            </h2>
            <div class="row pt-2 pt-md-5 mt-md-5">
                <div class="col-md-8">
                    <!-- posts-->
                    <Posts v-on:finishloadin="finishLoading" :cress="catResults" :ress="results" :single="results.length == 1? true: false"></Posts>                                  
                    <!-- end posts -->
                </div>
                <div class="col-md-4">
                    <!-- Search -->
                    <Searchpost v-on:searchresults="sendSearchResults"></Searchpost>
                    <!-- end search -->
                    
                    <!--categories-->
                    <Categories v-on:catresults="sendCatResults"></Categories>
                    <!--end categories-->
                </div>
            </div>
        </div>
    </div>
</template>
<script>


import Posts from "./Posts";
import Searchpost from "./Searchpost";
import Categories from "./Categories";
import Loading from "./Loading";

export default {
    name: 'Blog',
    components:{Posts, Searchpost, Categories, Loading},
    data: function(){
        return {
            results: '',
            catResults:'',
            loading:true,
        }
    },
    mounted: function(){
         window.scrollTo(0, 0); 
    },
    methods:{
        sendSearchResults(val){
          this.results = val;
        },
        sendCatResults(val){
          this.catResults = val;
        },
        finishLoading: function(){
            this.loading = false;
        }
    }
    
}
</script>
<style lang="scss" scoped>
    .main-blog{
        div{
           h2{
               font-size: 1rem;
               font-weight: 700;
               color: #2B4B80;
               span{
                  
                   display: inline-block;
                   &.line{
                        width: 45px;
                        height: 5px;
                        border-top: 1.5px solid #2B4B80;
                        margin-right: 10px; 
                   }                  
                   &.title-h2{
                       font-size: 3rem;
                   }
               }
           }
           .row{
               .col-md-8{
                   
               }
           }
        }
    }
</style>