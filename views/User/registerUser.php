<div class="form-container" style="text-align: center; padding: 0; width: 70%; margin: 0 auto">

    <div class="dashboardcard">
        <h5 style="text-align: center">PLEASE REGISTER BELOW</h5>

        <form id="form" name="form" action="" method="POST" enctype="multipart/form-data" class="registerForm">
            <div class="form-group">
                <label for="email"></label>
                <input autofocus="autofocus" type="email" class="form-control" name="email" id="email"
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" onchange="checkEmailExists(this.value)"
                       aria-describedby="email" placeholder="Enter email" required/>
                <p id="emailMsg"></p>
            </div>
            <div class="form-group">
                <label for="password"></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                       required/>
            </div>
            <div id="message">
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
            <div class="form-group">
                <label for="confirm_password"></label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                       placeholder="Password" required/>
            </div>
            <div class="form-group">
                <label for="first_name"></label>
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name"
                       required/>
            </div>
            <div class="form-group">
                <label for="last_name"></label>
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name"
                       required/>
            </div>
            <div class="form-group">
                <label for="bio"></label>
                <textarea rows="3" maxlength="255" class="md-textarea form-control" name="bio" id="bio"
                          placeholder="Write something about yourself"></textarea>
                <small class="form-text text-muted">255 characters</small>
            </div>

            <button type="submit" name='registerUser' class="btn btn-custom">REGISTER</button>
        </form>
        <script src="views/js/email-checker.js"></script>
        <script src="views/js/password-checker.js"></script>
        <script src="views/js/form-checker.js"></script>

    </div>
</div>