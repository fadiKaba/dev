/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';

import Home from './components/Home';
import Blog from './components/Blog';


Vue.use(VueRouter)

// const app = new Vue({
//     el: '#app',
// });




const routes = [
  {path: '/', name: 'home', component: Home},
  {path: '/blog', component: Blog}
];



const router = new VueRouter({
  routes,
  mode: 'history'
});

const app = new Vue({
  router,
  data: function(){
      return{
        showNav: false,
      }
  },
  mounted: function(){
    window.addEventListener('scroll', this.isTop);
  },
  methods:{
      isTop: function(){
        if(window.scrollY > 200){
          document.querySelector('.second-nav').classList.add('x-nav')
        }else{
          document.querySelector('.second-nav').classList.remove('x-nav')
        }      
      },  
  },
}).$mount('#app');