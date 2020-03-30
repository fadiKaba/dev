<template>
    <div class="main-post mt-5">
        <div class="card rounded-0 border-0 shadow" width="100%">
            
            <img :src="/posts-images/+srcVar" class="card-img-top rounded-0" alt="img"> 
            
            <div class="card-body">

                <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="successMessage != ''">
                {{successMessage}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="alert alert-warning alert-dismissible fade show" role="alert" v-if="errMessage != ''">
                    {{errMessage}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

              <form :class="editMode ? 'd-block': 'd-none'" action=""  :id="'pfd'+id">
                  <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="post-image">Image</label>
                        <input id="post-image" class="form-control" type="file" name="image">
                        <p class="text-danger" v-if="errs.image">{{errs.image[0]}}</p>
                    </div>
                    <div class="form-group">
                        <label for="post-title">Title</label>
                        <input id="post-title" class="form-control" type="text" name="title" :value="titleVar">
                        <p class="text-danger" v-if="errs.title">{{errs.title[0]}}</p>
                    </div>
                    <div class="form-group">
                        <label for="post-body">Body</label>
                        <textarea id="post-body" class="form-control" name="body" :value="bodyVar"></textarea>
                        <p class="text-danger"  v-if="errs.body">{{errs.body[0]}}</p>
                    </div>
              </form>
              <button :class="editMode ? 'd-block btn btn-secondary': 'd-none btn btn-secondary'" @click="postUpdate(id)">Save</button>
                

               <div :id="'post-content'+id" :class="editMode ? 'd-none': 'd-block'">
                   <h5 class="card-title mt-3 mt-md-5">{{titleVar}}</h5>
                   <p class="card-text">{{bodyVar}}</p>
               </div>
                

                <div class="mt-md-4 links">
                    <a href="#" class="card-link">
                        <img class="mr-1 pink" src="/ico/category-pink.svg" alt="Category" width="22px"> 
                        <img class="mr-1 grey" src="/ico/category.svg" alt="Category" width="22px"> 
                        {{categories[category1]+ '. ' + categories[category2]}}
                    </a>
                    <span class="mx-2"></span>
                    <a href="#" class="card-link">
                        <img class="mr-1 pink" src="/ico/comment-pink.svg" alt="comments" width="22px">
                        <img class="mr-1 grey" src="/ico/comment.svg" alt="comments" width="22px">                       
                        03 Comments
                    </a>
                    <div v-if="admin" class="mt-3">
                        <button  class="btn btn-dark ml-3" @click="showEdit()">Edit</button>
                        <button  class="btn btn-danger ml-3" @click="deletePost(id)">Delete</button>
                    </div>                   
                </div>          
            </div>
        </div>
    </div>    
</template>
<script>

import axios from 'axios';

export default {
    name: 'Post',
    props: ['admin', 'id', 'userId', 'title', 'body', 'src', 'category1', 'category2'],
    data: function(){
        return{
          titleVar: this.title,
          bodyVar: this.body,
          srcVar: this.src,
          category1Val: this.category1,
          category2Val: this.category2,
          editMode: false,
          successMessage: '',
          errMessage:'',
          errs:'',
          categories:['Food', 'Health', 'Travel', 'Lifestyle', 'Technology', 'Inspiration', 'Products'],
        }
    },
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
           
        },
        showEdit: function(){
          this.editMode = !this.editMode;
        },
        postUpdate: function(postId){
            let saveChanges = confirm('Save your changes ?');
            if(saveChanges){
                let pFD = new FormData(document.querySelector('#pfd'+this.id));
                axios({
                    method: 'post',
                    url: `post/${postId}`,
                    data: pFD,
                    config: { headers: {'Content-Type': 'multipart/form-data' }}
                }).then((response) => {
                    this.titleVar = response.data.title;
                    this.bodyVar= response.data.body;
                    this.srcVar = response.data.src;
                    this.editMode = false;
                    this.successMessage = 'Post updated successfuly';
                }).catch((err) => {
                    if(err.response){
                      this.errMessage = err.response.data.message;
                      this.errs =  err.response.data.errors
                    }
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