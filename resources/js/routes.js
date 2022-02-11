// importo vue e vue-router
import Vue from 'vue';
import VueRouter from 'vue-router';

// inietto vue-router dentro Vue
Vue.use(VueRouter);

// inizializzo la classe del router che conterrà tutte le rotte
// 1. creo una costante, che chiamo router


// 5 importo componenti pagine
import Home from './components/page/Home'
import About from './components/page/About'
import Club from './components/page/Club'
import Contacts from './components/page/Contacts'
import Stadium from './components/page/Stadium'
import Fans from './components/page/Fans'


const router = new VueRouter({
   // 2 // la VueRouter contiene un oggetto ceh avrà una serie di proprietà e avrà tutte le nostre rotte
   // §per prima cosa gli diciamo che il nostro router deve essere in relazione alla history del browser, ossia in una memoria del browser in modo tale che si possa andare avanti/indietro con le pagine 
   mode: 'history',


   // 6  routes è un array di oggetti, e ogni oggetto è una rotta.
   // le parole chiave di ogni signola rotta sono il path, il name, il componente.
   routes: [
      {
         path: '/',
         name: 'home',
         component: 'Home'
      },
      {
         path: '/chi-siamo',
         name: 'about',
         component: 'About'
      },
      {
         path: '/la-società',
         name: 'club',
         component: 'Club'
      },
      {
         path: '/contatti',
         name: 'contacts',
         component: 'Contacts'
      },
      {
         path: '/stadio',
         name: 'stadium',
         component: 'Stadium'
      },
      {
         path: '/tifoseria',
         name: 'fans',
         component: 'Fans'
      },
   ]
   
})

// 3 come tutti i file javascript, anche questo file ha bisogno di un export per poter essere trasferito-->inseriamo quindi in  fondo alla pagina la dicitura export default router (è proprio una regola javascript: se voglio poter importare una classe esternamente, da un altro file, il file precente deve aver l'export default )
export default router;