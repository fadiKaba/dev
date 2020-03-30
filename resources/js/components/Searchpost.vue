<template>
      <div class="main-search py-5 px-md-4">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search keyword" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><img src="/ico/search.svg" alt="search" width="25px"></span>
            </div>
          </div>
          <button class="btn">Search</button>
      </div>
</template>
<script>
export default {
    name: 'Searchpost'
}
</script>
<style lang="scss" scoped>
     .main-search{
         background-color: #FBF9FF;
         .input-group{
             input{
                 height: 50px;
                 border-radius: 0;
                 &:focus{
                     border:transparent 1px solid;
                 }
             }
             .input-group-append{
                 span{
                   background-color: #FF5C97;
                   border-radius: 0;  
                 }                
             }
         }
         button{
           width:100%;
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
     }
</style>