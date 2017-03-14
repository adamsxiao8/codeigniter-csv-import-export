<style type="text/css">
body, html {
    height: 100%;
    background-repeat: no-repeat;
    background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
}

.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}

/*
 * Card component
 */
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
    /*background-color: #4d90fe; */
    background-color: rgb(104, 145, 162);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}

.forgot-password {
    color: rgb(104, 145, 162);
}

.forgot-password:hover,
.forgot-password:active,
.forgot-password:focus{
    color: rgb(12, 97, 33);
}
</style>
<body>

    <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png">
            <p id="profile-name" class="profile-name-card"></p>
            <?php echo form_open('/user/do_login', array('class'=>'form-signin')); ?>
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" name="username" id="username" class="form-control" placeholder="User name" required="" autofocus="" autocomplete="off">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="" autocomplete="off">
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" name="remember_me" value="remember_me"> Remember me
                    </label>
                </div>
                <?php echo $image; ?>
                <p>
                    <label for="captcha">Captcha:</label>
                    <input id="captcha" name="captcha" type="text" autocomplete="off">
                </p>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>

                <script>
                    // This is called with the results from from FB.getLoginStatus().
                    function statusChangeCallback(response) {
                        console.log('statusChangeCallback');
                        console.log(response);
                        // The response object is returned with a status field that lets the
                        // app know the current login status of the person.
                        // Full docs on the response object can be found in the documentation
                        // for FB.getLoginStatus().
                        if (response.status === 'connected') {
                            // Logged into your app and Facebook.
                            testAPI();
                        } else if (response.status === 'not_authorized') {
                            // The person is logged into Facebook, but not your app.
                            document.getElementById('status').innerHTML = 'Please log ' +
                                'into this app.';
                        } else {
                            // The person is not logged into Facebook, so we're not sure if
                            // they are logged into this app or not.
                            document.getElementById('status').innerHTML = 'Please log ' +
                                'into Facebook.';
                        }
                    }

                    // This function is called when someone finishes with the Login
                    // Button.  See the onlogin handler attached to it in the sample
                    // code below.
                    function checkLoginState() {
                        FB.getLoginStatus(function(response) {
                            statusChangeCallback(response);
                        });
                    }

                    window.fbAsyncInit = function() {
                        FB.init({
                            appId: '123050457758183',
                            cookie: true, // enable cookies to allow the server to access 
                            // the session
                            xfbml: true, // parse social plugins on this page
                            version: 'v2.2' // use version 2.2
                        });

                        // Now that we've initialized the JavaScript SDK, we call 
                        // FB.getLoginStatus().  This function gets the state of the
                        // person visiting this page and can return one of three states to
                        // the callback you provide.  They can be:
                        //
                        // 1. Logged into your app ('connected')
                        // 2. Logged into Facebook, but not your app ('not_authorized')
                        // 3. Not logged into Facebook and can't tell if they are logged into
                        //    your app or not.
                        //
                        // These three cases are handled in the callback function.

                        FB.getLoginStatus(function(response) {
                            statusChangeCallback(response);
                        });

                    };

                    // Load the SDK asynchronously
                    (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));

                    // Here we run a very simple test of the Graph API after login is
                    // successful.  See statusChangeCallback() for when this call is made.
                    function testAPI() {
                        console.log('Welcome!  Fetching your information.... ');
                        FB.api('/me', function(response) {
                            console.log('Successful login for: ' + response.name);
                            document.getElementById('status').innerHTML =
                                'Thanks for logging in, ' + response.name + '!';
                        });
                    }
                </script>
                
                <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                </fb:login-button>

                <div id="status"></div>    
            <?php echo form_close(); ?>
        </div><!-- /card-container -->
    </div>
</body>
