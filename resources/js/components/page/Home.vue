<template>
  <main class="container">

     <Posts/>


  </main>
</template>

<script>

import Posts from './Posts.vue'

export default {
   name: 'Home',

      components:{
      Posts
   }
}
</script>

<style lang='scss' scoped>
main{
   margin-top: 180px;
}

</style>