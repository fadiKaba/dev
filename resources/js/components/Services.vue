<template>
    <div class="pt-5 main-services">
        <Loading :res="false"></Loading>
        <div class="mt-5 pt-md-5">
            <div class="container">
               <h2 class="text-center mt-md-5"><span class="line"></span> Services <br>
               <span class="title-h2 mt-3">What We Do</span> 
               </h2> 
            </div> 
            <div class="container img-l-r mt-md-5">
            <div class="row mb-3">
                <div class="col-md-3"><img src="/images/1.png" alt="" width="100%"></div>
                <div class="col-md-9">
                    <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi, eveniet quia sit natus nostrum 
                    numquam laborum quisquam quo vel distinctio in odio aspernatur placeat doloremque est fuga soluta id praesentium.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi, eveniet quia sit natus nostrum 
                    numquam laborum quisquam quo vel distinctio in odio aspernatur placeat doloremque est fuga soluta id praesentium.
                    </p>               
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <p>
                      Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempora inventore porro expedita dolor iusto, culpa 
                    aperiam saepe, quisquam, eveniet alias ab neque maxime laborum veritatis quia ullam ut omnis et.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi, eveniet quia sit natus nostrum 
                    numquam laborum quisquam quo vel distinctio in odio aspernatur placeat doloremque est fuga soluta id praesentium.  
                    </p>               
                </div>
                <div class="col-md-3"><img src="/images/3.png" alt="" width="100%"></div>                
            </div>
            </div> 
            
            <div class="container middle mt-3 mt-md-5">
                <h3 class="mb-md-3">Description</h3>
                <div>
                    <p class="p-2 p-md-5">
                        "Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto sunt repudiandae aperiam error dolores 
                        mollitia dolorum magni at nesciunt sit, autem similique impedit quae accusantium ut, facere quaerat 
                        veritatis et ullam vitae eveniet natus provident excepturi. Natus, quia necessitatibus maxime error 
                        totam fuga ea incidunt expedita rem, eveniet iure quisquam fugiat similique. Consequatur voluptatem 
                        autem beatae? Blanditiis maiores rerum asperiores enim, possimus labore doloremque deleniti vitae 
                        repellendus a ipsa quo accusantium quas numquam nihil provident? Rerum quisquam veniam voluptatibus 
                        nisi ea provident dignissimos consequatur quis autem ipsam? Maxime, quod sunt. Amet nisi distinctio 
                        placeat natus nam vel. Fuga, eaque rem."
                    </p>
                </div>
            </div>                      
            <div class="container-fluid serveices row pt-2 pt-md-5 mt-md-5">
                  <div class="col-md-3">
                      <div class="card bg-dark text-white border-0">
                            <img src="/images/visit_1.jpg" class="card-img" alt="...">
                            <div class="card-img-overlay">
                                <div class="">
                                   <h5 class="card-title"><a href="http://blife.dx.am" target="_blank">Better Life</a></h5>
                                   <p class="card-text">Be a part of our comunity</p> 
                                </div>                              
                            </div>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="card bg-dark text-white border-0">
                            <img src="/images/visit_2.jpg" class="card-img" alt="...">
                            <div class="card-img-overlay">
                                <div class="">
                                   <h5 class="card-title"><a href="http://blife.dx.am" target="_blank">Better Life</a></h5>
                                   <p class="card-text">Be a part of our comunity</p> 
                                </div>                              
                            </div>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="card bg-dark text-white border-0">
                            <img src="/images/visit_3.jpg" class="card-img" alt="...">
                            <div class="card-img-overlay">
                                <div class="">
                                   <h5 class="card-title"><a href="http://blife.dx.am" target="_blank">Better Life</a></h5>
                                   <p class="card-text">Be a part of our comunity</p> 
                                </div>                              
                            </div>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="card bg-dark text-white border-0">
                            <img src="/images/visit_4.jpg" class="card-img" alt="...">
                            <div class="card-img-overlay">
                                <div class="">
                                   <h5 class="card-title"><a href="http://blife.dx.am" target="_blank">Better Life</a></h5>
                                   <p class="card-text">Be a part of our comunity</p> 
                                </div>                              
                            </div>
                      </div>
                  </div>
            </div>
        </div>
    </div>
</template>
<script>

import Loading from './Loading';

export default {
    name: 'Services',
    components:{Loading},
    data: function(){
        return {

        }
    },
    mounted: function(){
        window.scrollTo(0, 0); 
    },
    methods:{

    }
    
}
</script>
<style lang="scss" scoped>
    .main-services{
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
           }.img-l-r{
               div{
                   display: flex;
                   align-items: center;
                   p{
                       color: #707b8e;
                       font-size: 1rem;
                   }
               }
           }
           .middle{
                   h3{
                     font-size: 1.7rem;
                     color:#2B4B80;
                     font-weight: 500;
                   }
                   p{
                       font-size: 1rem;
                       background-color: #F9F9FF;
                       border-left: 2px solid #000;
                   }
               }
           .serveices{
               margin-left: 0;
               margin-right: 0;
               .col-md-3{
                   .card{
                       margin-bottom: 10px;
                       div{
                           display: flex;
                           flex-direction: column;
                           justify-content: flex-end;
                           padding: 0;                          
                           div{
                              background-color: #fff;
                              color: #2B4B80; 
                              padding: 15px;
                              width: 80%;
                              border-radius: 0 10px 0 0;
                              h5{
                                  font-size: 2rem;
                                  font-weight: 600;
                                  a{
                                      text-decoration: none;
                                      transition: 0.3s;
                                      &:hover{
                                          color: #FF5C97;
                                      }
                                  }
                              }
                           }                          
                       }
                   }
               }
           }
        }
    }








@media screen and (max-width: 1100px) and (min-width: 766px){
       .main-services{
        div{
           h2{

               span{
                  

               }
           }
           .serveices{
               .col-md-3{
                   .card{
                       div{
                           div{
                              h5{
                                  font-size: 1rem;
                                  font-weight: 500;
                                  a{
                                      &:hover{
                                          color: #FF5C97;
                                      }
                                  }
                              }
                              p{
                                  display: none;
                              }
                           }                          
                       }
                   }
               }
           }
        }
    }
}    
</style>