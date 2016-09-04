<template>
    <button class="btn btn-default" v-on:click.prevent="backToAccounts">Back to accounts</button>

    <h1>{{ account.name }}</h1>
</template>

<script>
    export default {
        props: ['account'],
        methods: {
            backToAccounts () {
                this.$dispatch('showing-account', false);
            }
        }
    };
</script>
