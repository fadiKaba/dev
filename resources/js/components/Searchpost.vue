<template>
      <div class="main-search py-5 px-md-4">
          <form action="">
                <div class="input-group">
                    <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Search keyword" 
                    aria-label="Recipient's username" 
                    aria-describedby="basic-addon2"
                    @keyup="searchPost(value)"
                    v-model="value">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">
                            <img :class=" searching ? 'd-none' : 'd-block'" src="/ico/search.svg" alt="search" width="32px">
                            <div :class=" searching ? 'd-block spinner-border text-light': 'd-none'" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </span>
                    </div>
                </div>
          </form>
          <div class="search-results" v-if="results.length > 0">
              <div class="p-3 mt-0">
                  <p class="my-1" v-for="result in results" :key="'r'+result.id">
                      <router-link :to="'/singleblog/'+result.id">{{result.title}}</router-link>
                  </p>
              </div>
          </div>
          <button class="btn mt-3">Search</button>
      </div>
</template>
<script>

import axios from 'axios';

export default {
    name: 'Searchpost',
    data: function(){
        return{
          searching: false,
          value: '',
          results:'',
        }
    },
    methods:{
        searchPost: function(val){
            if(this.value.length > 0){
                this.searching = true;
            axios.post(`/searchpost/${val}`)
            .then((response) => {
                this.searching = false;
                this.results = response.data;
            })
            }else{
                this.results = '';
            }            
        }
    },
}
</script>
<style lang="scss" scoped>
     .main-search{
         background-color: #FBF9FF;
         .input-group{
             input{
                 height: 50px;
                 border-radius: 0;
                 &:focus{
                     border:transparent 1px solid;
                 }
             }
             .input-group-append{
                 span{
                   background-color: #FF5C97;
                   border-radius: 0;  
                 }                
             }
         }
         button{
           width:100%;
           height: 60px;
           border-radius: 0;
           border: 1px #FF5C97 solid;
           color:#FF5C97;
           letter-spacing: 5px;
           text-transform: uppercase;
           &:hover{
               background-color: #FF5C97;
               color:#fff;
           }
         }
         .search-results{
             position: relative;
             div{
                 background-color: #fff;
                 position: absolute;
                 overflow-y: scroll;
                 scrollbar-width: thin;
                 max-height: 150px;
                 p{
                     a{
                         text-decoration: none;
                         &:hover{
                             color:#FF5C97;
                             transition: 0.2s;
                         }
                     }
                 }
             }
         }
     }
</style>