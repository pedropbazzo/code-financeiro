<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        Conteúdo dashboard
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Auth from '../services/auth';
    import { User } from '../services/resources';

    export default {
        ready() {
            User.get().then((response) => {
                
            });
        }
    }
</script>
