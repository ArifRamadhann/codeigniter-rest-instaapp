<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-center">
        <div class="w-100 row g-5">
            <div class="col-12 col-md-7 offset-md-2">
                <div class="row">

                    <?php $profile = $options['profile'] ?>

                    <div class="col-3">
                        <img src="<?= assets('uploads/'. ($profile->profile_picture ?? 'placeholder.jpg')) ?>" alt="Avatar" class="img-fluid">
                    </div>

                    <div class="col-8">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3">
                            <h3 class="mb-1">@<?= $profile->username ?></h3>
                            <?php if($profile->is_self): ?>
                                <div>
                                    <a href="<?= base_url('profile/settings') ?>" class="btn btn-sm btn-primary d-flex g-2 align-items-center">Update Profile</a>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="d-flex justify-content-around">
                            <h5 class="d-flex flex-column align-items-center">
                                <span><?= count($profile->posts) ?></span>
                                <span>Post</span>
                            </h5>
                            <h5 class="d-flex flex-column align-items-center">
                                <span><?= $profile->total_followers ?></span>
                                <span>Followers</span>
                            </h5>
                            <h5 class="d-flex flex-column align-items-center">
                                <span><?= $profile->total_following ?></span>
                                <span>Following</span>
                            </h5>
                        </div>
                    </div>

                    <div class="col-12 py-5">
                        <h5 class="m-0"><?= $profile->full_name ?></h5>
                        <p class="pt-2 fs-12"><?= $profile->bio ?></p>
                    </div>

                </div>
                <h4 class="text-center">Post</h4>
                <div class="row g-5">
                    <?php foreach($profile->posts as $post): ?>
                        <div class="col-12 col-md-4">
                            <a href="<?= base_url('post/detail/' . $post->id) ?>">
                                <img class="img-fluid" src="<?= assets('uploads/' . $post->image_url) ?>" alt="Card image cap">
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->