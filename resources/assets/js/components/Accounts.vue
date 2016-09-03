<template>
    <h1>Accounts</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="account in accounts">
                <td>{{ account.name }}</td>
                <td><a href="/accounts/{{ account.id }}/destroy" class="btn btn-danger">Delete</a></td>
            </tr>
        </tbody>
    </table>

    <a href="/accounts/create" class="btn btn-primary" tabindex="1">New account</a>
</template>

<script>
export default {
    data () {
        return {
            accounts: []
        };
    },
    created () {
        $.get('api/accounts').done(data => {
            this.accounts = data;
        });
    }
};
</script>
