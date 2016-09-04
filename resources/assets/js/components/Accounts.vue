<template>
    <h1>Accounts</h1>

    <div class="list-group">
        <a href="#" class="list-group-item" v-for="account in accounts">
            <div class="row">
                <div class="col-sm-3">{{ account.name }}</div>
                <div class="col-sm-6">{{ account.description }}</div>
                <div class="col-sm-3">123 €</div>
            </div>
        </a>

        <div class="list-group-item" v-if="newAccount">
            <form>
                <div class="row">
                    <div class="col-sm-3" v-bind:class="{ 'has-error': fieldErrors.name }">
                        <input type="text" class="form-control" placeholder="Name" v-model="newAccount.name">
                        <span class="help-block" v-if="fieldErrors.name">{{ fieldErrors.name.join(' ') }}</span>
                    </div>

                    <div class="col-sm-6" v-bind:class="{ 'has-error': fieldErrors.description }">
                        <input type="text" class="form-control" placeholder="Description" v-model="newAccount.description">
                        <span class="help-block" v-if="fieldErrors.description">{{ fieldErrors.description.join(' ') }}</span>
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
                newAccount: null,
                fieldErrors: []
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
                $.post('/api/accounts', this.newAccount)
                .done(data => {
                    this.newAccount = null;
                    this.fetchAccounts();
                })
                .fail((xhr) => {
                    switch (xhr.status) {
                    case 422:
                        this.fieldErrors = xhr.responseJSON;
                    }
                });
            },
            cancelNew () {
                this.newAccount = null;
                this.fieldErrors = [];
            },
            fetchAccounts () {
                $.get('api/accounts').done(data => {
                    this.accounts = data;
                });
            }
        }
    };
</script>
