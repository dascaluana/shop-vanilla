@extends ('layouts2.master')

@section('content')
    <div class="col-md-8">

        <form method="POST" action="<?= route('login-action') ?>">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="email">Email Adress:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

            @include ('layouts.errors')

        </form>

    </div>
@endsection

