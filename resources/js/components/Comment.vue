<template>
    <div class="main-comment">
        <div class="d-flex my-3 my-md-4">
            <div>
                <img class="rounded-circle" src="/images/default-user.png" alt="user" width="70px">
            </div>
            <div class="pt-2 pl-2">
                <p>{{comt.body}}</p>
                <span class="name">{{comt.userName}}</span> <span class="ml-2 date"> {{comt.createdAt}}</span>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Comment',
    props:['comt'],
    data: function(){
        return{
           
        }
    },   
    mounted: function(){

    },
    methods:{
     
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
             } 
        }
    }
</style>