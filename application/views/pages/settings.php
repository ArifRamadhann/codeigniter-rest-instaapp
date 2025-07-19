<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-center">
        <div class="w-100 row g-5" data-base-url="<?= base_url() ?>">
            <div class="col-12 col-md-7 offset-md-2">
                
                <div class="mb-3" id="image-preview">
                    <img src="<?= assets('uploads/' . ($this->user_data->profile_picture ?? 'placeholder.jpg')) ?>" alt="" class="img-fluid w-100">
                </div>

                <div class="mb-3">
                    <label for="profile-picture" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" id="image"> 
                </div>
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" value="<?= $this->user_data->username ?>" placeholder="Input Username...">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?= $this->user_data->email ?>" placeholder="Input Email...">
                </div>
                
                <div class="mb-3">
                    <label for="full-name" class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-control" id="full-name" value="<?= $this->user_data->full_name ?>" placeholder="Input Full Name...">
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" id="bio" placeholder="Input Bio..."><?= $this->user_data->bio ?></textarea> 
                </div>

                <div class="mb-3">
                    <p class="text-center text-danger" id="error-msg"></p>
                    <p class="text-center text-success" id="success-msg"></p>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary me-2" id="submit-profile">Update</button>
                        <button class="btn btn-outline-secondary" id="cancel-profile">Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- / Content -->

<script>
$(document).ready(function() {
    cancelBtn = $('#cancel-profile');
    submitBtn = $('#submit-profile');
    base_url = $('div[data-base-url]').attr('data-base-url');
    imageInput = $('#image');

    cancelBtn.on('click', function(e) {
        e.preventDefault();
        window.location.href = base_url + 'profile';
    });

    imageInput.on('change', function(e) {
        e.preventDefault();
        const file = this.files[0];
        const reader = new FileReader();
        reader.onload = function(event) {
            $('#image-preview').html('<img src="'+event.target.result+'" class="img-fluid w-100">');
        }
        reader.readAsDataURL(file);
    });

    submitBtn.on('click', function(e) {
        e.preventDefault();
        var file = imageInput[0].files[0];
        var username = $('#username').val();
        var full_name = $('#full-name').val();
        var bio = $('#bio').val();
        var email = $('#email').val();
        
        if(file == undefined || username == '' || full_name == '' || email == '') {
            alert('Please fill all the fields');
            return false;
        }

        var data = new FormData();
        data.append('profile_picture', file);
        data.append('username', username);
        data.append('full_name', full_name);
        data.append('bio', bio);
        data.append('email', email);

        $.ajax({
            url: base_url + 'profile/save-settings',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(res) {
                var res = JSON.parse(res);
                if(res.status) {
                    $('#success-msg').html('Successfully updated, redirecting..');
                    setInterval(function() {
                        window.location.href = res.redirect;
                    }, 2000)
                } else {
                    $('#error-msg').html(res.message);
                }
            }
        });

    });
});
</script>