<h1>New user</h1>
<form action="?controller=user&action=store" method="POST">
    <div class="form-group">
        <label for="first_name">First name</label>
        <input type="text" class="form-control" id="first_name"  name="first_name" required>
    </div>

    <div class="form-group">
        <label for="last_name">Last name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" required>
    </div>

    <div class="form-group">
        <label for="age">Age</label>
        <input type="number" class="form-control" id="age" name="age" required>
    </div>

    <div class="form-group">
        <label for="gender">Gender</label>
        <select name="gender" id="gender" class="form-control">
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select>
    </div>
    <br>
    <button type="submit" class="btn btn-success">Submit</button>
    <a href="?controller=user&action=index" class="btn btn-primary">Return on users list</a>
</form>