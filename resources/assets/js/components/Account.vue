<template>
    <button class="btn btn-default" v-on:click.prevent="backToAccounts">Back to accounts</button>

    <h1 v-on:click="toggleEdit" v-if="!editMode">{{ account.name }}</h1>

    <div class="form-group" v-bind:class="{ 'has-error': fieldErrors.name }" v-if="editMode">
        <input type="text" class="form-control" v-model="account.name" @keyup.enter="save">
        <span class="help-block" v-if="fieldErrors">{{ fieldErrors.name }}</span>
    </div>

    <div v-if="!editMode">
        <button class="btn btn-danger" v-on:click="deleteAccount(false)" v-if="!confirmDeletion">Delete</button>

        <div v-if="confirmDeletion">
            <div>Are you sure you want to delete this account?</div>
            <button class="btn btn-danger" v-on:click="deleteAccount(true)">Yes</button>
            <button class="btn btn-default" v-on:click="cancelDeletion">Cancel</button>
        </div>
    </div>

    <div v-if="editMode">
        <button class="btn btn-success" v-on:click="save">Save</button>
        <button class="btn btn-default" v-on:click="cancelEditMode">Cancel</button>
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
