<template>
  <header>
        <img src="../../../img/Logo_flat-e1618850991633.jpg" alt="">
     <nav>
        <ul>
           <li>
              <!--8 per atterrare nei componenti Vue attraverso un link non utilizziamo il tag <a/> ma il tag <router-link></router-link> -->
              <!--9 per farlo funzionare gli si scrive dopo il tag di apertura quello che vogliamo veder in pagina, poi :to="", gli si passa un oggetto {}, questo oggetto deve aver il name, e il name deve essere lo stesso che abbiamo assegnato nella chiave name dentro il file routes.js -->
               <router-link :to="{name: 'home'}">HOME</router-link>
           </li>
           <li>
               <router-link :to="{name: 'about'}">SQUADRA</router-link>
           </li>
           <li>
               <router-link :to="{name: 'club'}">CLUB</router-link>
           </li>
           <li>
               <router-link :to="{name: 'fans'}">TIFOSERIA</router-link>
           </li>
           <li>
               <router-link :to="{name: 'stadium'}">STADIO</router-link>
           </li>
           <li>
               <router-link :to="{name: 'contacts'}">CONTATTI</router-link>
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