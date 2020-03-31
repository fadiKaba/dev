<template>
    <div>
            <!-- admin new post -->
        <div v-if="admin">
            <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Add New Post
            </button>
            </p>
            <div class="collapse" id="collapseExample">
                                            
                <div class="card p-2 p-md-5 border-0 shadow">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" v-if="errMessage != ''">
                        {{errMessage}}
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="successMessage != ''">
                        {{successMessage}}
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <form action="" ref="addPostForm" class="was-validated">
                        <div class="form-group">
                            <label for="post-image">Chose an image</label>
                            <input class="form-control" name="image" type="file" id="post-image" accept="image/*">                                       
                            <p class="text-danger" v-if="errs.image">{{errs.image[0]}}</p>
                        </div> 
                        <div class="form-group">
                            <label for="post-title">Title</label>
                            <input class="form-control is-invalid" name="title" type="text" required id="post-title" v-model="postTitle">
                            <p class="text-danger" v-if="errs.title">{{errs.title[0]}}</p>
                        </div> 
                        <div class="form-group">
                            <label for="post-body">Body</label>
                            <textarea rows="5" name="body" class="form-control is-invalid" required type="text" id="post-body" v-model="postBody"></textarea>
                            <p class="text-danger"  v-if="errs.body">{{errs.body[0]}}</p>
                        </div> 
                        <div class="form-row">
                            <div class="col-12 text-center"><p>Category</p></div>                                       
                                <div class="col-md-6 mb-3">                                            
                                <select class="custom-select" name="category1" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="0">Food</option>
                                    <option value="1">Health</option>
                                    <option value="2">Travel</option>
                                    <option value="3">Lifestyle</option>
                                    <option value="4">Technology</option>
                                    <option value="5">Inspiration</option>
                                    <option value="6">Products</option>
                                </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                <select class="custom-select" name="category2">
                                    <option selected disabled value="">Choose...</option>
                                    <option value="0">Food</option>
                                    <option value="1">Health</option>
                                    <option value="2">Travel</option>
                                    <option value="3">Lifestyle</option>
                                    <option value="4">Technology</option>
                                    <option value="5">Inspiration</option>
                                    <option value="6">Products</option>
                                </select>
                                </div>
                        </div>                            
                    </form>  
                    <button class="btn btn-primary" @click="addNewPost">Add</button>                     
                </div>                          
            </div>
        </div>                   
        <!-- end admin new post -->  
        <!-- Posts -->
        <div v-if=" arrPosts.length > 0">
            <Post 
            v-for="post in arrPosts" 
            :key="'p'+post.id" 
            :id="post.id" 
            :admin="admin"
            :user-id="post.user_id"
            :title="post.title"
            :body="post.body"
            :src="post.src"
            :category1="post.category1"
            :category2="post.category2"
            :createdAt="post.created_at"
            v-on:deleteditem="deletedItem"
            ></Post>
        </div>    
        <!-- end posts -->      
    </div>
</template>
<script>

import Post from "./Post";

export default {
    name:'Posts',
    components:{Post},
    props:['ress', 'cress'],
    data: function(){
        return{
            admin: false,
            postImage:'',
            postTitle:'',
            postBody:'',
            successMessage: '',
            errMessage:'',
            errs:'',
            arrPosts:[],
        }
    },
    mounted: function(){
      this.getUser();
      this.getPosts();
    },
    methods:{
        getUser: function(){
        axios.post('./getuser')
        .then((response)=>{
           if(response.data.is_admin == 1){
               this.admin = true;
           }
        }).catch((err) => '');
      },
      getPosts: function(){
        axios.post('/getposts')
        .then((response)=>{
             this.makePostsArr(response.data);
        })
      },
      makePostsArr: function(arr){  
          class Post {

           constructor(element){
                   this.id = element.id;
                   this.userId = element.user_id;
                   this.src = element.src;
                   this.title = element.title;
                   this.body = element.body;
                   this.category1 = element.category1,
                   this.category2 = element.category2,
                   this.createdAt = element.created_at
                }

                static obj (){
                    return {userId: this.userId, src: this.src, title: this.title, body: this.body}
                }
          }        
          arr.forEach(element => {
              let objPostReady = new Post(element);
              this.arrPosts.unshift(objPostReady)
          });
      },
      addNewPost: function(){
          let postFormData = new FormData(this.$refs.addPostForm);
          axios({
            method: 'post',
            url: '/post',
            data: postFormData,
            config: { headers: {'Content-Type': 'multipart/form-data' }}
            }).then((response) => {
              this.errMessage = '';
              this.errs = '';
              this.makePostsArr([response.data]);
              this.postTitle = '';
              this.postBody= '';
              document.querySelector('#post-image').value = null;
              this.successMessage = 'New post added successfully'                          
          }).catch((err) => {
              if(err.response){
                 this.errMessage = err.response.data.message;
                // this.errs =  err.response.data.errors
              }            
          })
      },
      deletedItem: function(val){
          for(let i = 0; i < this.arrPosts.length; i++){
              if(this.arrPosts[i].id == val.id){
                  this.arrPosts.splice(i, 1);
              }
          }
      }  
    },
    watch:{
        ress: function(newVal, oldVal){
            if(newVal != ''){
               this.arrPosts = [];
            this.makePostsArr(newVal); 
            }           
        },
        cress: function(newVal, oldVal){
            if(newVal != ''){
               this.arrPosts = [];
            this.makePostsArr(newVal); 
            }           
        }
    }
}
</script>
<style scoped>

</style>