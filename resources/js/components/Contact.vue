<template>
    <div class="pt-5 main-blog">
        <Loading :res="false"></Loading>
        <div class="container mt-5 pt-md-5">
            <h2 class="text-center mt-md-5"><span class="line"></span> Contact <br>
            <span class="title-h2 mt-3">Contact Us</span> 
            </h2>
            <div class="map mt-md-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53228.20837645547!2d36.24787605476267!3d33.50754214156293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1518e6dc413cc6a7%3A0x6b9f66ebd1e394f2!2sDamascus%2C%20Syria!5e0!3m2!1sen!2s!4v1585902664816!5m2!1sen!2s" 
                width="100%" 
                height="450" 
                frameborder="0" 
                style="border:0;" 
                allowfullscreen="" 
                aria-hidden="false" 
                tabindex="0">
                </iframe>
            </div>
            <h3 class="mt-5">Get In Touch</h3>
            <div class="row mt-md-2">
                <div class="col-md-8">                   
                    <div class="mt-2 mt-md-4">
                        <form action="">
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="" cols="30" rows="10" placeholder="Write a message"></textarea>
                            </div>         
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="name" placeholder="Enter your name">
                                    </div>                                  
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="email" placeholder="Enter your email">
                                    </div>                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="subject" placeholder="Enter your subject">
                            </div>                           
                        </form>                        
                    </div>
                </div>
                <div class="col-md-4 p-2 px-md-5 py-md-4">
                    <div class="d-flex mb-3 mb-md-5">
                        <div>
                            <img src="/ico/home.svg" alt="" width="35px">
                        </div>
                        <div class="pl-4">
                          <p class="font-weight-bold mb-0">Damascus, Syria</p>
                          <span class="text-muted">Jaramana</span>  
                        </div>                       
                    </div>
                    <div class="d-flex mb-3 mb-md-5">
                        <div>
                            <img src="/ico/phone.svg" alt="" width="35px">
                        </div>
                        <div class="pl-4">
                          <p class="font-weight-bold mb-0">0940378308</p>
                          <span class="text-muted">03 mr dd</span>  
                        </div>                       
                    </div>
                    <div class="d-flex mb-3 mb-md-5">
                        <div>
                            <img src="/ico/mail.svg" alt="" width="35px">
                        </div>
                        <div class="pl-4">
                          <p class="font-weight-bold mb-0">fadikaba9@gmail.com</p>
                          <span class="text-muted">Send me an email</span>  
                        </div>                       
                    </div>
                </div>
            </div>
            <button class="send-btn mt-md-4">Send</button>
        </div>
    </div>
</template>
<script>

import Loading from './Loading';

export default {
    name: 'Contact',
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
           h3{
                color: #2B4B80;
                font-weight: 600;
               }
           .row{
               
               .col-md-8{
                   
               }
           }
        }
    }

 .send-btn{
    transition: 0.3s;
    width:150px;
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

</style>