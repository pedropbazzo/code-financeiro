<template>
    <div id="app">
        <header>
            <menu v-if="showMenu"></menu>
        </header>

        <main>
            <router-view></router-view>
        </main>

        <footer class="page-footer">
            <div class="footer-copyright">
                <div class="container">
                    Todos os direitos reservados {{ year }}
                    <a href="#" class="grey-text text-lighten-4">Code Education</a>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    import MenuComponent from './Menu.vue';
    import Auth from '../services/auth';

    export default{
        components: {
            'menu' : MenuComponent
        },
        data(){
            return {
                year: new Date().getFullYear(),
                user: Auth.user
            }
        },
        computed: {
            showMenu() {
                return this.user.check && this.$route.name != 'auth.login'
            }
        }
    };
    
</script>

<style type="text/css">    
    #app{
        display: flex;
        min-height: 100vh;
        flex-direction: column;
    }
    main{
        flex: 1 0 auto
    }
</style>