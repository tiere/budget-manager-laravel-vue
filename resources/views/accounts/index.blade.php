@extends('layouts.app')

@section('content')
    <account v-if="showingAccount" :account="showingAccount"></account>
    <accounts v-else></accounts>
@endsection
