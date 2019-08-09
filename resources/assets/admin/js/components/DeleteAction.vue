<template>
    <slot></slot>
    <form method="POST" :action="action" :id="id">
        <input type="hidden" name="_method" value="DELETE"/>
        <input type="hidden" name="_token" :value="csrfToken"/>
    </form>
</template>

<script type="text/javascript">
    export default{
        // Definição de propriedades
        props: ['action','csrfToken','actionElement'],
        computed: {
            id(){
                return `form-delete-action_${this.actionElement}`;
            }
        },
        ready(){
            let actionElement = this.actionElement,
                       formId = this.id;

            $(document).ready(() => {
                $(`#${actionElement}`).click((event) => {
                    event.preventDefault(); // Cancela o evento do elemento
                    $(`#${formId}`).submit();
                })
            })
        }
    }
</script>

<style scoped>
    /* scoped aplica somente no escopo do formulário */
    form{
        display: none;
    }
</style>