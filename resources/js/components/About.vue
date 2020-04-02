<template>
       <div class="main-home py-md-5">
           <div class="row pt-5 mt-md-5 container mx-auto">
               <div class="col-md-6 showcase-img d-none d-md-block">
                   <img class="mr-5" src="/images/about.png" alt="" width="110%">
               </div>
               <div class="col-md-6 pt-md-5 showcase-title">
                   <h1>About Our Development Service</h1>
                   <p class="pb-5 text-left">
                       Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                       Quisquam odio placeat atque fuga mollitia distinctio eveniet quae eligendi a quo?
                   </p>
                   <button class="btn showcase-btn">Contact Us</button>
               </div>               
           </div>
           <div class="container mx-auto showcase2 py-5 mt-md-5">
               <h2 class="text-center pt-md-5 mt-md-5">Our Experience</h2>
               <div class="row">
                   <div class="col-md-4 mt-3">
                       <div class="card">
                            <div class="card-body text-center">
                                <div class="img-container">
                                    <img src="/images/tips_1.png" alt="" width="100%">
                                </div>
                                <h5 class="card-title text-left">Link Building</h5>
                                <a>
                                    <div class="col-6 text-left pl-0">Read More</div>
                                </a>
                            </div>
                        </div>
                   </div>
                   <div class="col-md-4 mt-3">
                       <div class="card shadow">
                            <div class="card-body text-center">
                                <div class="img-container">
                                    <img src="/images/tips_2.jpg" alt="" width="100%">
                                </div>                               
                                <h5 class="card-title text-left">Content marketing</h5>
                                <a>
                                    <div class="col-6 text-left pl-0">Read More</div>
                                </a>
                            </div>
                        </div>
                   </div>
                   <div class="col-md-4 mt-3">
                       <div class="card">
                            <div class="card-body text-center">
                                <div class="img-container">
                                    <img src="/images/tips_3.jpg" alt="" width="100%">
                                </div>
                                <h5 class="card-title text-left">On Page SEO</h5>
                                <a>
                                    <div class="col-6 text-left pl-0">Read More</div>
                                </a>
                            </div>
                        </div>
                   </div>
               </div>
           </div>
       </div>
</template>





<script>

import axios from 'axios';

export default {
    name: 'About',
    mounted: function(){
        
    },
    methods:{
       
    }
}

</script>








<style lang="scss" scoped>

@mixin main-btn($paddingy, $paddingx, $backgroundcolor, $color, $fontsize){
    background-color: $backgroundcolor;
    color:$color;
    padding: $paddingy $paddingx;
    font-size: $fontsize;
    transition:0.2s;
    &:hover{
        background-color: #EC4683;
        color: $color;
    }
}


.main-home{
    
    background-image: url('/images/shape2.png');
    background-size: contain;
    background-position: right;
    background-repeat: no-repeat;
    .row{      
        .showcase-title{       
            h1{
                animation: fromRight 1s ease backwards;
                font-weight: 700;
                font-size: 4rem;
                color: #2B4B80;
                padding-bottom: 25px;
            }
            p{  
                animation: fromRight 1s 0.2s ease backwards;
                color: #707B8E;
                font-size: 16px;
            }
            .showcase-btn{
                animation: fromRight 1s 0.5s ease backwards;
                @include main-btn(15px, 30px  , lighten(#EC4683, 5) , #fff, 16px );
            }
        }
        .showcase-img{       
            animation: fromLeft 1s 0.3s ease backwards;
        }
    }
    .showcase2{
        h2{
            animation: fromLeft 1s ease backwards;
            font-weight: 700;
            font-size: 3rem;
            color: #2B4B80;
            padding-bottom: 25px;
        }
        .card{
            transition:0.3s;
            border:none;
            .card-body{
                padding: 60px 0px;
                h5{ 
                    padding: 40px 0px;
                    font-weight: 700;
                    font-size: 1.4rem;
                    color: #2B4B80;
                    padding-bottom: 25px;
                }
                p{
                    color: #707B8D;
                    line-height: 25px;
                    font-size: 1rem;
                }
                a{  
                    cursor: pointer;
                    color: #EC4683;
                    font-size: 1rem;
                    padding: 5px;
                }
                .img-container{
                    overflow: hidden;
                    img{
                        transition:0.3s;
                    }
                }
                
            }
            &:hover{
                box-shadow: 5px 5px 10px rgb(219, 219, 219);
                .img-container > img{
                    transform: scale(1.2);
                }
            }
        }
        
    }
}



@keyframes fromRight{
    0%{
        transform: translateX(50vw);
    }
    100%{
        transform: translateX(0px);
    }
}

@keyframes fromLeft{
    0%{
        transform: translateX(-1000px);
    }
    100%{
        transform: translateX(0px);
    }
}
















@media screen and (max-width: 750px){
    .main-home{
        background-image: none;
    .row{
        padding-left: 0;
        padding-right: 0;
        .showcase-title{
            h1{
                font-size: 2rem;
            }
            p{
                font-size: 16px;
            }
            .showcase-btn{
                @include main-btn(15px, 30px  , lighten(#EC4683, 5) , #fff, 16px );
            }
        }
    }
    .showcase2{
        h2{
            font-size: 2rem;
        }
    }
} 
}


</style>