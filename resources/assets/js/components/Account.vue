<template>
    <div class="row">
        <div class="col-sm-12">
            <button class="btn btn-default" v-on:click.prevent="backToAccounts">Back to accounts</button>
        </div>
    </div>

    <div id="accountNameRow" class="row">
        <div class="col-sm-12" v-show="!editMode">
            <h1 v-on:click="toggleEdit">{{ account.name }}</h1>
        </div>

        <div class="form-group form-group-lg col-sm-5 col-md-4 col-lg-3" v-bind:class="{ 'has-error': fieldErrors.name }" v-show="editMode">
            <label for="accountName">Name</label>
            <input id="accountName" type="text" class="form-control" v-model="account.name" @keyup.enter="save">
            <span class="help-block" v-if="fieldErrors">{{ fieldErrors.name }}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12" v-show="!editMode">
            <p v-on:click="toggleEdit">{{ account.description }}</p>
        </div>

        <div class="form-group col-sm-7 col-md-5 col-lg-4" v-bind:class="{ 'has-error': fieldErrors.name }" v-show="editMode">
            <label for="accountDescription">Description</label>
            <input id="accountDescription" type="text" class="form-control" v-model="account.description" @keyup.enter="save">
            <span class="help-block" v-if="fieldErrors">{{ fieldErrors.description }}</span>
        </div>
    </div>

    <div class="row" v-if="!editMode">
        <div class="col-sm-12">
            <button class="btn btn-danger" v-on:click="deleteAccount(false)" v-if="!confirmDeletion">Delete</button>

            <div v-if="confirmDeletion">
                <div>Are you sure you want to delete this account?</div>
                <button class="btn btn-danger" v-on:click="deleteAccount(true)">Yes</button>
                <button class="btn btn-default" v-on:click="cancelDeletion">Cancel</button>
            </div>
        </div>
    </div>

    <div class="row" v-if="editMode">
        <div class="col-sm-12">
            <button class="btn btn-success" v-on:click="save">Save</button>
            <button class="btn btn-default" v-on:click="cancelEditMode">Cancel</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['account'],
        data () {
            return {
                confirmDeletion: false,
                editMode: false,
                fieldErrors: [],
                oldAccount: null
            };
        },
        created () {
            this.oldAccount = JSON.parse(JSON.stringify(this.account));
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
            },
            toggleEdit (e) {
                this.editMode = true;

                Vue.nextTick(() => {
                    $(e.target).closest('.row')
                        .find('input')
                        .focus();
                });
            },
            cancelEditMode () {
                this.editMode    = false;
                this.account     = JSON.parse(JSON.stringify(this.oldAccount));
                this.fieldErrors = [];
            },
            save () {
                $.ajax(`/api/accounts/${this.account.id}`, {
                    method: 'PATCH',
                    data: this.account
                })
                .done(data => {
                    this.account  = data;
                    this.editMode = false;
                })
                .fail(xhr => {
                    switch (xhr.status) {
                    case 422:
                        this.fieldErrors = xhr.responseJSON;
                    }
                });
            }
        }
    };
</script>

<style>
    #accountNameRow {
        margin-top: 22px;
    }

    #accountNameRow h1 {
        margin-top: 0;
    }
</style>
