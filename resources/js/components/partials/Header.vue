<template>
  <header>
        <img src="../../../img/Logo_flat-e1618850991633.jpg" alt="">
     <nav>
        <ul>
           <li>
              <a href="#">News</a>
           </li>
           <li>
              <a class="active" href="#">Squadra</a>
           </li>
           <li>
              <a href="#">Tifosi</a>
           </li>
           <li>
              <a href="#">Stadio</a>
           </li>
           <li>
              <a href="#">Club</a>
           </li>
           <li>
              <a href="#">Contatti</a>
           </li>
        </ul>
     </nav>
        <img src="../../../img/Logo_flat-e1618850991633.jpg" alt="">
  </header>
</template>

<script>
export default {
   name: 'Header'
}
</script>

<style lang="scss" scoped>

header{
   background-color: rgba(1,46,113,255);
   position: fixed;
   top: 0;
   left: 0;
   line-height: 80px;
   height: 80px;
   display: flex;
   justify-content: space-around;
   width: 100%;
      img{
         padding: 10px;
      }
      ul{
         list-style: none;
         li{
            display: inline-block;
            margin:  0 20px;
            a{
               text-decoration: none;
               text-transform: uppercase;
               color: white;
               padding: 10px;
               &:hover{
                  cursor: pointer;
                  background-color: yellow;
                  color: rgba(1,46,113,255);
                  padding: 10px;
                  border-radius: 15px;
               }
               &.active{
                  color: yellow;
                  &:hover{
                     background-color: yellow;
                     color: rgba(1,46,113,255);
                  }
               }
            }
         }
      }
}

</style>