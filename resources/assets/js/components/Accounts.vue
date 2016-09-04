<template>
    <h1>Accounts</h1>

    <div class="list-group">
        <a href="#" class="list-group-item" v-for="account in accounts">
            <div class="row">
                <div class="col-sm-3">{{ account.name }}</div>
                <div class="col-sm-6">Expenses accout</div>
                <div class="col-sm-3">123 €</div>
            </div>
        </a>

        <div class="list-group-item" v-if="newAccount">
            <form>
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Name" v-model="newAccount.name">
                    </div>

                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Description" v-model="newAccount.description">
                    </div>

                    <div class="col-sm-3">
                        <input type="submit" value="Save" class="btn btn-primary" v-on:click.prevent="save">
                        <button class="btn btn-primary" v-on:click.prevent="cancelNew">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <a href="#" class="btn btn-primary" v-on:click.prevent="showNewForm" v-if="!newAccount">New account</a>
</template>

<script>
    export default {
        data () {
            return {
                accounts: [],
                newAccount: null
            };
        },
        created () {
            this.fetchAccounts();
        },
        methods: {
            showNewForm () {
                this.newAccount = {};
            },
            save () {
                $.post('/api/accounts', this.newAccount).done(data => {
                    this.newAccount = null;
                    this.fetchAccounts();
                });
            },
            cancelNew () {
                this.newAccount = null;
            },
            fetchAccounts () {
                $.get('api/accounts').done(data => {
                    this.accounts = data;
                });
            }
        }
    };
</script>
