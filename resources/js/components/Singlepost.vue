<template>
    <div class="main-post mb-3 mb-md-5">
        <div class="card rounded-0 border-0" width="100%">
            
            <img :src="'/posts-images/'+src" class="card-img-top rounded-0" alt="img">
            <div class="">
               <div :id="'post-content'">
                   <h5 class="card-title mt-2 mt-md-3">{{title}}</h5>
                   <div class="mt-2 mb-3 links">
                        <a href="#" class="card-link">
                            <img class="mr-md-1 pink" src="/ico/category-pink.svg" alt="Category" width="22px"> 
                            <img class="mr-md-1 grey" src="/ico/category.svg" alt="Category" width="22px"> 
                            {{categories[category1] + '. ' + (categories[category2]  != undefined ? categories[category2] : '')}}
                        </a>
                        <span class="mx-md-2"></span>
                        <a href="#" class="card-link">
                            <img class="mr-md-1 pink" src="/ico/comment-pink.svg" alt="comments" width="22px">
                            <img class="mr-md-1 grey" src="/ico/comment.svg" alt="comments" width="22px">                       
                            03 Comments
                        </a>       
                   </div>
                   <p class="card-text">{{body}}</p>               
               </div>
               <div class="row social-single border-top py-2 my-3 px-0">
                   <div class="col-md-6">
                       <div :class="auth ? 'd-inline': 'd-none'">
                           <img v-if="didLike" @click="like(postid)" src="/ico/heart-pink.svg" alt="like" width="20px">
                           <img v-else @click="like(postid)" src="/ico/heart.svg" alt="like" width="20px">
                           <span class="badge badge-secondary text-light" v-if="likesCount > 0">{{likesCount}}</span>                          
                       </div>                                              
                           <!-- Button trigger modal -->
                            <a :class="!auth ? 'd-inline': 'd-none'" type="button" data-toggle="modal" data-target="#not-auth-modal">
                             <img src="/ico/heart.svg" alt="like" width="20px">
                             <span class="badge badge-secondary text-light" v-if="likesCount > 0">{{likesCount}}</span>
                            </a>
                            <!-- end Button trigger modal -->                          
                           <span class="ml-3">
                             {{sentence}}
                            </span> 
                    </div>
                   <div class="col-md-6 text-right">
                       <a href="">
                           <img src="/ico/facebook.svg" alt="like" width="25px">
                        </a>
                        <a href="">
                           <img src="/ico/instagram.svg" alt="like" width="25px">
                        </a>
                        <a href="">
                           <img src="/ico/twitter.svg" alt="like" width="25px">
                        </a>
                   </div>
               </div>
               <div class="mt-3 mt-md-5 comments-container">
                   <div class="pb-2 pb-md-5">
                       <h4>Comments</h4>
                        <div v-for="comment in comments" :key="'c'+comment.id">
                            <Comment :comt="comment"></Comment>
                        </div>
                   </div>                 
                   <div class="mt-5 add-comment-container">
                       <form action="">
                           <h4>Leave a comment</h4>
                           <div class="form-group mt-2 mt-md-5">
                               <textarea 
                               v-if="auth"
                               class="form-control border-0" 
                               name="body" 
                               cols="30" 
                               rows="10"
                               v-model="newComment" 
                               placeholder="Write Comment">
                               </textarea>
                               <textarea 
                               v-else
                               class="form-control border-0" 
                               name="body" 
                               cols="30" 
                               rows="10"
                               v-model="newComment" 
                               placeholder="Write Comment">
                               </textarea>
                           </div>                          
                       </form> 
                       <a v-if="!auth" href="/login" class="px-3">Login or Register</a> 
                       <button v-else @click="addComment(postid)" class="px-3">Add Comment</button>                      
                   </div>
               </div>
                  <Notauthmodal></Notauthmodal>       
            </div>
        </div>
        
    </div>    
</template>
<script>

import axios from 'axios';
import Notauthmodal from './Notauthmodal';
import Comment from './Comment';

export default {
    name: 'Singlepost',
    components:{Notauthmodal, Comment},
    props:['postid', 'auth'],
    data: function(){
        return {
            user:'',
            moment: require('moment'),
            title:'',
            body: '',
            src: '',
            category1:'',
            category2: '',
            likes:'',
            likedUsers:'',
            likesCount:'',
            comments:[],
            sentence:'',
            didLike:false,
            createdAt:'',
            newComment:'',
            categories:['Food', 'Health', 'Travel', 'Lifestyle', 'Technology', 'Inspiration', 'Products'],
        }
    },
    mounted: function(){       
        this.getPost(this.postid);
    },
    methods:{
        getPost: function(id){
            axios.post(`/getsinglepost/${id}`)
            .then((response) => {
                let pos = response.data[0];
                this.title = pos.title;
                this.body = pos.body;
                this.src = pos.src;
                this.likes = pos.likes == null || pos.like == '' ? '' : pos.likes.split(',');
                this.createdAt = pos.created_at;
                this.category1 = pos.category1;
                this.category2 = pos.category2; 
                this.makeCommentsArr(pos.comment);

                if(this.likes != null && this.likes != ''){
                    axios.post(`/getlikedusers/${this.likes}`)
                    .then((response) => {
                        this.likedUsers =response.data;
                        this.likesCount = this.likedUsers.length;
                        this.sentence = this.likedUsers.length == 1 ? `${this.likedUsers[0].name} like this`  :
                    `${this.likedUsers[this.likedUsers.length -1].name} and ${this.likedUsers.length -1} people like this`  ;                  
                    })
                }               
            })
        },
        like: function(postId){
            axios.post(`/post/like/${postId}`)
            .then((response)=>{
                if(response.data == 'like'){
                    this.didLike = true;
                    this.likesCount += 1;
                }else{
                    this.didLike = false;
                    this.likesCount -= 1;
                }
            })
        },
        makeCommentsArr: function(arr){
            class Comment{

                constructor(element){
                   this.id = element.id;
                   this.userId = element.user_id;
                   this.body = element.body;
                   this.createdAt = element.createdAt;
                }    
            }
            arr.forEach(item => {
                let commentR = new Comment(item); 
                    axios.post(`/getusername${commentR.userId}`)
                    .then((response)=>{
                        commentR.userName = response.data;
                        this.comments.unshift(commentR);
                    }).catch((err) => '');               
            });
        },
        addComment: function(postId){
          if(this.newComment != ''){
              axios.post(`/comment/create/${postId}`,{
                  'body': this.newComment 
              })
              .then((response) => {
                  this.makeCommentsArr([response.data]);
              })
          }
        }
    },
    watch:{
      postid: function(newVal, oldVal){
          this.getPost(newVal);
      }
    }
}
</script>
<style lang="scss" scoped>

a{
    text-decoration: none;
}


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
           h5{
            transition: 0.3s;
            display: inline-block;
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

.social-single{
    .col-md-6:nth-child(1){
       img{
           cursor: pointer;
       }
       span{
         color: #707B8E;
       }
    }
    .col-md-6:nth-child(2){
        a{
            background-color: #707B8E;
            border-radius: 2px;
            transition: 0.2s;
            &:hover{
            background-color: #EC4683;
            }
        }
    }
}

.comments-container{
    h4{
      font-size: 1.2rem;
      font-weight: 500;
      color: #2b4b80;  
    }   
    .add-comment-container{
        button,a{
           height: 60px;
           border-radius: 0;
           border: 1px #FF5C97 solid;
           color:#FF5C97;
           letter-spacing: 5px;
           text-transform: uppercase;
           transition: 0.2s;
           &:hover{
               background-color: #FF5C97;
               color:#fff;
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