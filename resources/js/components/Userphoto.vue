<template>
      <div class="card border-0">
           <div class="card-body">
               <img v-if="user.src == null || user.src == ''" class="rounded-circle" src="/images/default-user.png" alt="your photo" width="100%">
               <img v-else class="rounded-circle" :src="'/users-photos/' + user.src" alt="your photo" width="100%">
           </div>
           <div class="form-group">
               <form action="" id="user-profile">
                   <label for="user-photo">Your photo</label>
                   <input class="form-control" type="file" id="user-photo" name="photo">
                   <p v-if="errors != ''" class="alert alert-danger">{{errors.photo[0]}}</p>
               </form>
               <button @click="savePhoto(user.id)" type="button" class="mt-3 button-pink">Save</button>          
           </div>
      </div>
</template>
<script>

import axios from 'axios';

export default {
    name:'Userphoto',
    props: ['authUser'],
    data: function (){
        return {
            user: this.authUser,
            errors: '',
        }
    },
    methods:{
        savePhoto: function(userId){
            let uP = new FormData(document.querySelector('#user-profile'));
            axios({
                    method: 'post',
                    url: `/authedit/${userId}`,
                    data: uP,
                    config: { headers: {'Content-Type': 'multipart/form-data' }}})
                    .then((response) => {
                        this.user.src = response.data;
                    }).catch((err) =>{
                        if(err){
                            if(err.response){
                                this.errors = err.response.data.errors;
                            }
                        }
                    })
        }
    }
}
</script>
<style lang="scss" scoped>
.button-pink{
    width:100%;
    height: 60px;
    border-radius: 0;
    border: 1px #FF5C97 solid;
    color:#FF5C97;
    letter-spacing: 5px;
    transition: 0.3s;
    text-transform: uppercase;
    &:hover{
        background-color: #FF5C97;
        color:#fff;
    }
  }
</style>