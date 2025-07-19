<!-- Register Card -->
<div class="card p-md-7 p-1">
    
    <!-- Logo -->
    <div class="app-brand justify-content-center mt-5">
        <a href="index.html" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
                <span style="color: var(--bs-primary)">
                <!-- load svg -->
                <img src="<?= assets('svg/icons/layout.svg') ?>" width="40px" class="img-fluid" alt="">
                </span>
            </span>
            <span class="app-brand-text demo text-heading fw-semibold">Insta App</span>
        </a>
    </div>
    <!-- /Logo -->

    <div class="card-body mt-1">
        <h4 class="mb-1">Adventure starts here 🚀</h4>
        <p class="mb-5">Make your app management easy and fun!</p>

        <div id="register-form" class="mb-5" url="<?= base_url('auth/do-register') ?>">
            <div class="form-floating form-floating-outline mb-5">
                <input
                type="text"
                class="form-control"
                id="username"
                name="username"
                placeholder="Enter your username"
                autofocus />
                <label for="username">Username</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                <label for="email">Email</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
                <input type="text" class="form-control" id="full-name" name="full_name" placeholder="Enter your full name" />
                <label for="full-name">Full Name</label>
            </div>
            <div class="mb-5 form-password-toggle">
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

            <p class="text-center text-danger" id="error-msg"></p>
            <p class="text-center text-success" id="success-msg"></p>

            <button class="btn btn-primary d-grid w-100" id="submit">Sign up</button>
        </div>

        <p class="text-center">
            <span>Already have an account?</span>
            <a href="<?= base_url('auth/login') ?>">
                <span>Sign in instead</span>
            </a>
        </p>

    </div>
</div>
<!-- Register Card -->
<img
    alt="mask"
    src="<?= assets('img/illustrations/auth-basic-register-mask-light.png') ?>"
    class="authentication-image d-none d-lg-block"
    data-app-light-img="illustrations/auth-basic-register-mask-light.png"
    data-app-dark-img="illustrations/auth-basic-register-mask-dark.png" />

<script>
    $(document).ready(function() {
        var form = $('#register-form');
        var submitBtn = form.find('#submit');
    
        submitBtn.on('click', function(e) {
            e.preventDefault();
            var url = form.attr('url');
            var data = { 
                username: form.find('#username').val(),
                email: form.find('#email').val(),
                full_name: form.find('#full-name').val(),
                password: form.find('#password').val()
            }

            if(data.username == '' || data.email == '' || data.full_name == '' || data.password == '') {
                $('#error-msg').html('Please fill all the fields')
                return false;
            }

            $.post(url, data, function(res) {
                var res = JSON.parse(res);
                if(res.status) {
                    $('#success-msg').html('Successfully registered, redirecting..')
                    setInterval(function() {
                        window.location.href = res.redirect;
                    }, 2000)
                } else {
                    $('#error-msg').html(res.message)
                }
            })
        })
    })
</script>