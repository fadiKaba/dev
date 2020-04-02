<template>
    <div class="main-comment fade show">
        <div class="d-flex my-3 my-md-4">
            <div>
                <img v-if="authuser.src != null || authuser.src != ''" class="rounded-circle" :src="'/users-photos/'+ authuser.src" alt="user" width="70px">
                <img v-else class="rounded-circle" src="/images/default-user.png" alt="user" width="70px">
            </div>
            <div class="pt-2 pl-2 w-100">
                <p>{{comt.body}}</p>
                <div class="row">
                    <div class="col-md-6">
                        <span class="name">{{comt.userName}}</span> <span class="ml-2 date"> {{comt.createdAt}}</span>
                    </div>
                    <div class="col-md-6" v-if="authuser.id == comt.userId" >
                        <a class="del-btn" @click="deleteComment(comt.id)">Delete</a>
                    </div>
                </div>               
            </div>
        </div>
    </div>
</template>
<script>

import axios from 'axios';

export default {
    name: 'Comment',
    props:['comt', 'authuser'],
    data: function(){
        return{
           
        }
    },   
    mounted: function(){

    },
    methods:{
     deleteComment(commentId){
         let ask = confirm('delete your comment ?');
         if(ask){
            axios.post(`/comment/delete/${commentId}/${this.comt.userId}`)
         .then((response) => {
             this.$emit('delItemId', response.data.id)
         }) 
         }        
     }
    }
}
</script>
<style lang="scss" scoped>
    .main-comment{
        .d-flex{
             div:nth-child(2){
                 p{
                     color: #777777;
                     font-size: 1rem;
                 }
                 .name{
                     color: #2B4B80;
                     font-size: 1.1rem;
                     font-weight: 500;
                 }
                 .date{
                     font-size: 0.9;
                     color: #A1A1A5;
                 }
                 .del-btn{
                     cursor: pointer;
                 }
             } 
        }
    }
</style>