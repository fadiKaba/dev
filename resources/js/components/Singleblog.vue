<template>
    <div class="pt-5 main-blog">
        <div class="container mt-5 pt-md-5">
            <h2 class="text-center mt-md-5"><span class="line"></span>Single Blog <br>
            <span class="title-h2 mt-3">Single Blog</span> 
            </h2>
            <div class="row pt-2 pt-md-5 mt-md-5">
                <div class="col-md-8">                
                    <!-- posts-->
                    <div>
                        <Singlepost :auth="auth" :postid="postid"></Singlepost>
                    </div>                   
                    <!-- end posts -->
                </div>
                <div class="col-md-4">
                    <Searchpost :single="true"></Searchpost>
                </div>                  
            </div>
        </div>
    </div>
</template>
<script>

import Singlepost from "./Singlepost";
import Searchpost from "./Searchpost";
import Categories from "./Categories";

export default {
    name: 'Blog',
    components:{Singlepost, Searchpost},
    props:['postid'],
    data: function(){
        return{
          auth:''
        }
    },
    mounted: function(){
       this.getUser()
    },
    methods:{
       getUser: function(){
            axios.post('/getuser')
            .then((response)=>{
            if(response.data != ''){
                this.user = response.data;
                this.auth = true;
            }
            }).catch((err) => '');
      },
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