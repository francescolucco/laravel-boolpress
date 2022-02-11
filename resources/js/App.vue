<template>
  <div>

    <Header/>


<!-- 7 inietto i componenti su cui devono atterrare le rotte del VueRouter. Lo posso fare tramite il seguente tag
ATTENZIONE!! NON router-link MA router-view!!!!!! A volte suggerisce male-->
    <router-view></router-view>




    <Footer/>
      
  </div>
</template>

<script>

import Header from './components/partials/Header.vue'
import Footer from './components/partials/Footer.vue'


export default {
    name: 'App',

    components:{
      Header,
      Footer
    }

}
</script>

<style>

</style>
