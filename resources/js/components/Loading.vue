<template>
    <div class="main-loading" v-if="loading || res">       
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <img src="/images/logo.png" alt="logo" width="25px" >
           <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>
<script>
export default {
    name:'Loading',
    props: ['res'],
    data: function(){
        return{
            loading: true,
            readyS:document.readyState,
        }
    },
    mounted: function(){
        let myInt = setInterval(()=>{
          this.readyS = document.readyState
          if(this.readyS === 'complete'){
             this.loading = false;
           clearInterval(myInt);
        }   
        },100)  
    }
}
</script>
<style lang="scss" scoped>
   .main-loading{
       position: fixed;
       height: 100vh;
       width: 100vw;
       background-color: #fff;
       display: flex;
       align-items: center;
       justify-content: center;
       z-index: 100;
       .spinner-border{
          color: #EC4683;
          
       }
   }
</style>