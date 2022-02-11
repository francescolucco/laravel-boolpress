<template>
  <main>

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
    padding: 130px 0 50px 0;
    min-height: calc(100vh + 80px);
}

</style>