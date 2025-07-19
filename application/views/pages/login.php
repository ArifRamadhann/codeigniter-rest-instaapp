<!-- Login -->
<div class="card p-md-7 p-1">
    <!-- Logo -->
    <div class="app-brand justify-content-center mt-5">
        <a href="index.html" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
            <span style="color: #666cff">
                <!-- load svg -->
                <img src="<?= assets('svg/icons/layout.svg') ?>" width="40px" class="img-fluid" alt="">
            </span>
            </span>
            <span class="app-brand-text demo text-heading fw-semibold">Insta App</span>
        </a>
    </div>
    <!-- /Logo -->

    <div class="card-body mt-1">
        <h4 class="mb-1">Welcome to Insta App! 👋</h4>
        <p class="mb-5">Please sign-in to your account and start the adventure</p>

        <div id="login-form" class="mb-5" url="<?= base_url('auth/do-login') ?>">
            <div class="form-floating form-floating-outline mb-5">
            <input
                type="text"
                class="form-control"
                id="username"
                name="username"
                placeholder="Enter your  username"
                autofocus />
            <label for="username">Username</label>
            </div>
            <div class="mb-5">
            <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                    <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                    <label for="password">Password</label>
                </div>
                <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                </div>
            </div>
            </div>
            <div class="mb-5 d-flex justify-content-between mt-5">
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="remember-me" />
                <label class="form-check-label" for="remember-me"> Remember Me </label>
            </div>
            <a href="auth-forgot-password-basic.html" class="float-end mb-1 mt-2">
                <span>Forgot Password?</span>
            </a>
            </div>

            <p class="text-center text-danger" id="error-msg"></p>

            <div class="mb-5">
                <button class="btn btn-primary d-grid w-100" type="submit" id="submit">Sign in</button>
            </div>
        </div>

        <p class="text-center">
            <span>New on our platform?</span>
            <a href="<?= base_url('auth/register') ?>">
            <span>Create an account</span>
            </a>
        </p>
    </div>
</div>
<!-- /Login -->
 
<img
    alt="mask"
    src="<?= assets('img/illustrations/auth-basic-login-mask-light.png')?>"
    class="authentication-image d-none d-lg-block"
    data-app-light-img="illustrations/auth-basic-login-mask-light.png"
    data-app-dark-img="illustrations/auth-basic-login-mask-dark.png" />

<script>
    $(document).ready(function() {
        var form = $('#login-form');
        var submitBtn = form.find('#submit');
    
        submitBtn.on('click', function(e) {
            e.preventDefault();
            var url = form.attr('url');
            var data = { 
                username: form.find('#username').val(),
                password: form.find('#password').val()
            }

            if(data.username == '' || data.password == '') {
                $('#error-msg').html('Please fill all the fields')
                return false;
            }

            $.post(url, data, function(res) {
                var res = JSON.parse(res);
                if(res.status) {
                    window.location.href = res.redirect;
                } else {
                    $('#error-msg').html(res.message)
                }
            })
        })
    })
</script>