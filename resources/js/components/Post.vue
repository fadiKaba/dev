<template>
    <div class="main-post mb-3 mb-md-5">
        <div class="card rounded-0 border-0 shadow" width="100%">
            
            <img :src="'/posts-images/'+srcVar" class="card-img-top rounded-0" alt="img">
            <div class="date">
                <p class="text-center mt-2 mb-0">{{moment(createdAt).format('D')}}</p>
                <p class="text-center">{{moment(createdAt).format('MMM')}}</p>
            </div> 
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
                   <router-link :to="'/singleblog/'+id"><h5 class="card-title mt-2 mt-md-3">{{titleVar}}</h5></router-link>
                   <p class="card-text" v-html="limitString(bodyVar, 200, id)"></p>
                   <router-link v-if="bodyVar.length > 200" :to="'/singleblog/'+id">Read more</router-link>
               </div>

                <div class="mt-3 mt-md-4 links">
                    <a @click="emitCatName" class="card-link">
                        <img class="mr-md-1 pink" src="/ico/category-pink.svg" alt="Category" width="22px"> 
                        <img class="mr-md-1 grey" src="/ico/category.svg" alt="Category" width="22px"> 
                        {{categories[category1]+ '. ' + (categories[category2]  != undefined ? categories[category2] : '')}}
                    </a>
                    <span class="mx-md-2"></span>
                    <router-link :to="'/singleblog/'+id">
                        <img class="mr-md-1 pink" src="/ico/comment-pink.svg" alt="comments" width="22px">
                        <img class="mr-md-1 grey" src="/ico/comment.svg" alt="comments" width="22px">                       
                        <span class="border-0 mr-2" v-if="likesCount > 0">{{likesCount}}</span> Comments
                    </router-link>
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
    props: ['admin', 'id', 'userId', 'title', 'body', 'src', 'category1', 'category2', 'createdAt'],
    data: function(){
        return{
          titleVar: this.title,
          bodyVar: this.body,
          srcVar: this.src,
          category1Val: this.category1,
          category2Val: this.category2,
          likesCount: '',
          editMode: false,
          successMessage: '',
          errMessage:'',
          errs:'',
          categories:['Food', 'Health', 'Travel', 'Lifestyle', 'Technology', 'Inspiration', 'Products'],
          moment: require('moment')
        }
    },
    mounted:function(){
     this.commentsLength(this.id);
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
        commentsLength: function(postId){
           axios.post(`/commentLength/${postId}`)
           .then((response)=> {
               this.likesCount = response.data;
           })
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
             
        },
        limitString(str, limit, postId){
           if(str.length > limit){
              let string = str.substring(0, limit)+ ' ...';
              return string
               
           }
           return str;
        }, 
        emitCatName: function(){
            this.$emit('catname', this.categories[this.category1])
        }
    }
}
</script>
<style lang="scss" scoped>
.main-post{
    .card{     
        .date{
            margin-top: -80px;
            margin-left:50px;
            border-radius: 7px;
            background-color: #FF5C97;
            display: flex;
            flex-direction: column;
            align-content: center;
            align-items: center;
            display: inline-block;
            width: 100px;
            height: 100px;
            p:nth-child(1){
                font-size: 30px;
                color: #fff;
                font-weight: 600;
            }
            p:nth-child(2){
                font-size: 18px;
                color: #fff;
                font-weight: 400;
            }
            
        }
        a{
           
           h5{
            transition: 0.3s;
            display: inline-block;
            font-size: 1.5rem;
            font-weight: 600;
            color: #2B4B80;
            &:hover{
                color: #EC4683;
            }
            } 
            &:hover{
                text-decoration: none;
            }
        }
         
        p{
            font-size: 1.05rem;
            font-weight: 400;
            color: #707B92;
        }
        .links{
            a{  
                cursor: pointer;
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








@media screen and (max-width:500px){


   .main-post{
    .card{     
        .date{
            margin-top: -55px;
            margin-left:10px;
            border-radius: 5px;
            width: 60px;
            height: 70px;
            p:nth-child(1){
                font-size: 20px;
                color: #fff;
                font-weight: 600;
            }
            p:nth-child(2){
                font-size: 14px;
                color: #fff;
                font-weight: 400;
            }
            
        }
         h5{
            font-size: 1.3rem;
            font-weight: 500;
            }
        .links{
            a{  
                transition: 0.1s;
                font-size: 0.8rem;
                img{
                    transform: scale(0.8);
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


}
</style>