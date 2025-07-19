<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-center">
        <div class="w-100 row g-5">
            <div class="col-12">
                <div class="row g-5">
                    <?php if(isset($options['feeds']) && !empty($options['feeds'])): ?>
                        <?php foreach($options['feeds'] as $post): ?>
                            <div class="col-12 col-md-4">
                                <a href="<?= base_url('post/detail/' . $post->id) ?>">
                                    <img class="img-fluid" src="<?= assets('uploads/' . $post->image_url) ?>" alt="Card image cap">
                                </a>
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->