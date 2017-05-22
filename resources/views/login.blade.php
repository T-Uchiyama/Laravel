<form action="/" method="post">
    {{csrf_field()}}
    <label>ID: <input type="text" name="id" id="id"></label>
    <label>Password: <input type="password" name="password"> </label>
    <button type="submit">Login</button>
</form>
