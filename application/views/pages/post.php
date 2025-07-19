<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-center">
        <div class="w-100 row g-5" data-base-url="<?= base_url() ?>">
            <div class="col-12 col-md-7 offset-md-2">
                
                <div class="mb-3" id="image-preview">

                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image"> 
                </div>
                
                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
                    <textarea name="caption" class="form-control" id="caption" placeholder="Input Caption..."></textarea> 
                </div>

                <div class="mb-3">
                    <p class="text-center text-danger" id="error-msg"></p>
                    <p class="text-center text-success" id="success-msg"></p>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary me-2" id="submit-post">Post</button>
                        <button class="btn btn-outline-secondary" id="cancel-post">Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- / Content -->

<script>
$(document).ready(function() {
    cancelBtn = $('#cancel-post');
    submitBtn = $('#submit-post');
    base_url = $('div[data-base-url]').attr('data-base-url');
    imageInput = $('#image');

    cancelBtn.on('click', function(e) {
        e.preventDefault();
        window.location.href = base_url + 'feed';
    });

    imageInput.on('change', function(e) {
        e.preventDefault();
        const file = this.files[0];
        const reader = new FileReader();
        reader.onload = function(event) {
            $('#image-preview').html('<img src="'+event.target.result+'" class="img-fluid">');
        }
        reader.readAsDataURL(file);
    });

    submitBtn.on('click', function(e) {
        e.preventDefault();
        var file = imageInput[0].files[0];
        var caption = $('#caption').val();
        
        if(file == undefined || caption == '') {
            alert('Please fill all the fields');
            return false;
        }

        var data = new FormData();
        data.append('image_url', file);
        data.append('caption', caption);

        $.ajax({
            url: base_url + 'post/add',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(res) {
                var res = JSON.parse(res);
                if(res.status) {
                    $('#success-msg').html('Successfully posted, redirecting..');
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