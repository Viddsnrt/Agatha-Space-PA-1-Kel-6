@extends('user.layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center">Login Admin</h2>
    <form action="/login" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection
