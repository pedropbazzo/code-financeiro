import AppComponent from './components/App.vue';
import routerMap from './router.map';
import VueRouter from 'vue-router';
import Auth from './services/auth';

const router = new VueRouter();

/**
 * Primeiro realiza o mapeamento
 */
router.map(routerMap);

/**
 * Depois realiza o evento
 */
router.beforeEach((transition) => {    
    /**
     * Se a transição precisa de autenticação e não estivermos autenticados
     */
    if(transition.to.auth && !Auth.user.check) {
        return router.go({name: 'auth.login'});
    }
    transition.next();
})

router.start({
    components:{
        'app': AppComponent
    }
},'body');