<template>
    <div class="main-post mt-5">
        <div class="card rounded-0 border-0 shadow" width="100%">
            <img :src="/posts-images/+src" class="card-img-top rounded-0" alt="img">                        
            <div class="card-body">
                <h5 class="card-title mt-3 mt-md-5">{{title}}</h5>
                <p class="card-text">{{body}}</p>
                <div class="mt-md-4 links">
                    <a href="#" class="card-link">
                        <img class="mr-1 pink" src="/ico/category-pink.svg" alt="Category" width="22px"> 
                        <img class="mr-1 grey" src="/ico/category.svg" alt="Category" width="22px"> 
                        Travel. Life
                    </a>
                    <span class="mx-2"></span>
                    <a href="#" class="card-link">
                        <img class="mr-1 pink" src="/ico/comment-pink.svg" alt="comments" width="22px">
                        <img class="mr-1 grey" src="/ico/comment.svg" alt="comments" width="22px">                       
                        03 Comments
                    </a>
                    <button v-if="admin" class="btn btn-danger ml-3" @click="deletePost(id)">Delete</button>
                </div>          
            </div>
        </div>
    </div>    
</template>
<script>

import axios from 'axios';

export default {
    name: 'Post',
    props: ['admin', 'id', 'userId', 'title', 'body', 'src'],
    mounted:function(){

    },
    methods:{
        deletePost: function(postId){
           let ask = confirm(`Are you sure to delete ${this.title} ?`);
           if(ask){
              axios.delete(`/post/${postId}`)
              .then((response) => {
                    this.$emit('deleteditem', response.data)
                }) 
           }
           
        }
    }
}
</script>
<style lang="scss" scoped>
.main-post{
    .card{
         h5{
            font-size: 1.5rem;
            font-weight: 600;
            color: #2B4B80;
            }
        p{
            font-size: 1.05rem;
            font-weight: 400;
            color: #707B92;
        }
        .links{
            a{  
                transition: 0.1s;
                color: #707B92;
                .pink{
                     display: none;
                }
                &:hover{
                    color: #EC4683;
                    .grey {                       
                        display: none;
                    }
                    .pink {
                        display: inline-block;
                    }
                }             
            }
            span{
                display:inline-block;
                height: 12px;
                width:1.5px;
                border-right: 1.5px solid #000;
            }
        }
     }
}  
</style>