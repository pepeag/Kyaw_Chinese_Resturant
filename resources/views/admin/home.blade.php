Admin
<form action="{{route('logout')}}" method="POST">
    @csrf
<div>
    <input type="submit" value="Logout" class="btn btn-dark text-white">
</div>
</form>
