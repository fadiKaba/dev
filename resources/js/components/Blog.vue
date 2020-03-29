<template>
    <div class="pt-5 main-blog">
        <div class="container mt-5 pt-md-5">
            <h2 class="text-center mt-md-5"><span class="line"></span> Blog <br>
            <span class="title-h2 mt-3">Our Blog Area</span> 
            </h2>
            <div class="row pt-2 pt-md-5">
                <div class="col-md-8">
                    <!-- admin new post -->
                    <div v-if="admin">
                        <p>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Add New Post
                        </button>
                        </p>
                        <div class="collapse" id="collapseExample">
                                                      
                            <div class="card p-md-5 border-0 shadow">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert" v-if="errMessage != ''">
                                    {{errMessage}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="">
                                    <div class="form-group">
                                        <label for="post-image">Chose an image</label>
                                        <input class="form-control" type="file" id="post-image" @change="uploadImg">
                                        <p class="text-danger" v-if="errs.image">{{errs.image[0]}}</p>
                                    </div> 
                                    <div class="form-group">
                                        <label for="post-title">Title</label>
                                        <input class="form-control" type="text" id="post-title" v-model="postTitle">
                                        <p class="text-danger" v-if="errs.title">{{errs.title[0]}}</p>
                                    </div> 
                                    <div class="form-group">
                                        <label for="post-body">Body</label>
                                        <textarea rows="5" class="form-control" type="text" id="post-body" v-model="postBody"></textarea>
                                        <p class="text-danger" v-if="errs.body">{{errs.body[0]}}</p>
                                    </div>                                
                                </form>  
                                <button class="btn btn-primary" @click="addNewPost">Add</button>                     
                            </div>                          
                        </div>
                    </div>                   
                    <!-- end admin new post -->
                    <Post></Post>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
</template>
<script>

import Post from "./Post";

export default {
    name: 'Blog',
    components:{Post, },
    data: function(){
        return{
            admin: false,
            postImage:'',
            postTitle:'',
            postBody:'',
            errMessage:'',
            errs:'',
        }
    },
    mounted: function(){
      this.getUser()
    },
    methods:{
        getUser: function(){
        axios.post('./getuser')
        .then((response)=>{
           if(response.data.is_admin == 1){
               this.admin = true;
           }
        })//.catch((err) => console.log(err));
      },
      uploadImg: function(e){
        let img = e.target.files[0];
        this.postImage = new FormData();
        this.postImage.append('image', img); 
        console.log(img)
      },
      addNewPost: function(){
          axios.post('/post', {
              title: this.postTitle,
              body: this.postBody,
              image: this.postImage
          }).then((response) => {
              this.errMessage = '';
              this.errs = '';
              console.log(response)
          }).catch((err) => {
              if(err.response){
                 this.errMessage = err.response.data.message;
                 this.errs =  err.response.data.errors
              }            
          })
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