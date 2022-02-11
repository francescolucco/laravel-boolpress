// importo vue e vue-router
import Vue from 'vue';
import VueRouter from 'vue-router';

// inietto vue-router dentro Vue
Vue.use(VueRouter);

// inizializzo la classe del router che conterrà tutte le rotte
// 1. creo una costante, che chiamo router


// 5 importo componenti pagine
import Home from './components/page/Home';
import About from './components/page/About';
import Club from './components/page/Club';
import Contacts from './components/page/Contacts';
import Stadium from './components/page/Stadium';
import Fans from './components/page/Fans';
import PostDetails from './components/page/PostDetails';


const router = new VueRouter({
   // 2 // la VueRouter contiene un oggetto ceh avrà una serie di proprietà e avrà tutte le nostre rotte
   // §per prima cosa gli diciamo che il nostro router deve essere in relazione alla history del browser, ossia in una memoria del browser in modo tale che si possa andare avanti/indietro con le pagine 
   mode: 'history',

   // 9 se voglio customizzare il nome della classe che di default vuerouter assegna al link attivo del menu che corrisponde al componente su cui si sta atterrando, devo utlizziare la proprietà linkExactActiveClass per assegnargli un nuovo nome (magari perchè nei css ho già impostato tutto utlizzando semplicemnte la parola active)
   linkExactActiveClass: 'active',

   // 6  routes è un array di oggetti, e ogni oggetto è una rotta.
   // le parole chiave di ogni signola rotta sono il path, il name, il componente.
   routes: [
      {
         path: '/',
         name: 'home',
         component: Home
      },
      {
         path: '/chi-siamo',
         name: 'about',
         component: About
      },
      {
         path: '/la-societa',
         name: 'club',
         component: Club
      },
      {
         path: '/contatti',
         name: 'contacts',
         component: Contacts
      },
      {
         path: '/stadio',
         name: 'stadium',
         component: Stadium
      },
      {
         path: '/tifoseria',
         name: 'fans',
         component: Fans
      },
      // creaiamo una rotta che si chiamerà details e gli passiamo il parametro slug con i due punti sappiamo essere un dato dinamico, è l'equivalente delle graffe in blade
      {
         path: '/details/:slug',
         name: 'postDetails',
         component: PostDetails
      },
   ]
   
});

// 3 come tutti i file javascript, anche questo file ha bisogno di un export per poter essere trasferito-->inseriamo quindi in  fondo alla pagina la dicitura export default router (è proprio una regola javascript: se voglio poter importare una classe esternamente, da un altro file, il file precente deve aver l'export default )
export default router;