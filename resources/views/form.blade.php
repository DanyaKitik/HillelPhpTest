<div class="container">
    <div class="row">
        <div class="col">
            <form method="POST" action="{{route('login')}}">
                @csrf
                <div class="form-group">
                    @error('username')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp">
                    <small id="usernameHelp" class="form-text text-muted">Not email</small>
                </div>
                <div class="form-group">
                    @error('password')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password ">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <br>
            <a href="{{route('register')}}"><p class="btn btn-primary">Register</p></a>
        </div>
        </div>
    </div>
</div>
</div>
