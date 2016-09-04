<template>
    <button class="btn btn-default" v-on:click.prevent="backToAccounts">Back to accounts</button>

    <h1>{{ account.name }}</h1>

    <div>
        <button class="btn btn-danger" v-on:click="deleteAccount(false)" v-if="!confirmDeletion">Delete</button>

        <div v-if="confirmDeletion">
            <div>Are you sure you want to delete this account?</div>
            <button class="btn btn-danger" v-on:click="deleteAccount(true)">Yes</button>
            <button class="btn btn-default" v-on:click="cancelDeletion">Cancel</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['account'],
        data () {
            return {
                confirmDeletion: false
            };
        },
        methods: {
            backToAccounts () {
                this.$dispatch('showing-account', false);
            },
            deleteAccount (confirmed = false) {
                if (confirmed) {
                    $.ajax(`/api/accounts/${this.account.id}`, {
                        method: 'DELETE'
                    })
                    .done(data => {
                        this.backToAccounts();
                    });
                } else {
                    this.confirmDeletion = true;
                }
            },
            cancelDeletion () {
                this.confirmDeletion = false;
            }
        }
    };
</script>
