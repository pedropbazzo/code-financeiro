<template>
    <div class="container">
        <div class="row">
            <div class="box-login">
                <div class="col s8 offset-s2 z-depth-2">
                    <h4 class="center">Efetuando logout...</h4>
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import Auth from '../services/auth';

    export default {

        /**
         * Cria um delay de um segundo
         */
        ready() {
            setTimeout(() => {
                this.logout();
            }, 1000);
        },

        /**
         * Realiza o logout e redireciona para rota de login
         */
        methods:{
            logout(){
                let goToLogin = () => this.$router.go({name: 'auth.login'});
                Auth.logout()
                    .then(goToLogin())
                    .catch(goToLogin());

            }
        }
    }
</script>