<div class="form-container" style="text-align: center; padding: 0; width: 70%; margin: 0 auto">

    <div class="dashboardcard">
        <h5 style="text-align: center">LOGIN</h5>

        <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateEmail()">
            <div class="form-group">
                <label for="email"></label>
                <input autofocus="autofocus" type="email" class="form-control" name="email" id="login-email"
                       aria-describedby="email" placeholder="Enter email" required/>
            </div>
            <div class="form-group">
                <label for="password"></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                       required/>
            </div>

            <input type="submit" name='login' class="btn btn-custom"/>
        </form>

        <div class="form-container">
            <h2>
                Don't have an account? <a href='?controller=User&action=registerUser'>Sign up now</a>.
            </h2>
        </div
    </div>
</div>



