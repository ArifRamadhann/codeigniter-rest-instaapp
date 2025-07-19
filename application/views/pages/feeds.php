<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-center">
        <div class="w-100 row g-5">
            <div class="col-12 col-md-6 offset-md-1">
                <div class="row g-5">
                    <?php if(isset($options['feeds']) && !empty($options['feeds'])): ?>
                        <?php foreach($options['feeds'] as $post): ?>
                            <div class="col-12">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="<?= base_url('profile/view/' . $post->user->username) ?>">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar me-4">
                                                        <img src="<?= assets('uploads/'. ($post->user->profile_picture ?? 'placeholder.jpg')) ?>" alt="Avatar" class="rounded-circle">
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <h6 class="mb-0 text-truncate"><?= $post->user->full_name ?></h6>
                                                            <small class="text-truncate">@<?= $post->user->username ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <a href="<?= base_url('post/detail/' . $post->id) ?>">
                                        <img class="img-fluid" src="<?= assets('uploads/'. $post->image_url) ?>" alt="Card image cap">
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-start">
                                            <?php if($post->is_liked): ?>
                                                <a href="<?= base_url('post/unlike/' . $post->id) ?>" class="btn text-danger px-1 pb-3 d-flex align-items-center me-5 unlike-btn">
                                                    <i class="ri-heart-fill"></i>
                                                    <span class="ms-2"><?= $post->total_likes ?></span>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?= base_url('post/like/' . $post->id) ?>" class="btn px-1 pb-3 d-flex align-items-center me-5 like-btn">
                                                    <i class="ri-heart-line"></i>
                                                    <span class="ms-2"><?= $post->total_likes ?></span>
                                                </a>
                                            <?php endif ?>
                                            <a href="<?= base_url('post/detail/' . $post->id) ?>" class="btn px-1 pb-3 d-flex align-items-center comment-btn">
                                                <i class="ri-chat-4-line"></i>
                                                <span class="ms-2"><?= $post->total_comments ?></span>
                                            </a>
                                        </div>
                                        <p class="card-text"><?= $post->caption ?></p>
                                        <span class="card-text text-sm text-muted"><?= date('d M Y', strtotime($post->created_at)) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else: ?>
                        <div class="col-12">
                            <h3 class="text-muted">No Post Yet</h3>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            
            <div class="d-none d-md-block col-12 col-md-4">
                <div class="card">
                    
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Suggest Follow</h5>
                        </div>
                    </div>

                    <div class="card-body pt-5">
                        <?php $suggestions = $options['suggestions'] ?>
                        <?php foreach($suggestions as $user): ?>
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <a href="<?= base_url('profile/view/' . $user->username) ?>">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar me-4">
                                            <img src="<?= assets('uploads/'. ($user->profile_picture ?? 'placeholder.jpg')) ?>" alt="Avatar" class="rounded-circle">
                                        </div>
                                        <div>
                                            <div>
                                                <h6 class="mb-0 text-truncate"><?= $user->full_name ?></h6>
                                                <small class="text-truncate">@<?= $user->username ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="text-end">
                                    <?php if($user->is_followed): ?>
                                        <button url="<?= base_url('feed/unfollow/' . $user->id) ?>" class="btn btn-outline-primary unfollow-btn">Unfollow</button>
                                    <?php elseif($user->is_following && !$user->is_followed): ?>
                                        <button url="<?= base_url('feed/follow/' . $user->id) ?>" class="btn btn-primary follow-btn">Follow Back</button>
                                    <?php else: ?>
                                        <button url="<?= base_url('feed/follow/' . $user->id) ?>" class="btn btn-primary follow-btn">Follow</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->

<script>
$(document).ready(function() {
    $(document).on('click', '.like-btn', function(e) {
        e.preventDefault();
        var $this = $(this);
        var url = $this.attr('href');
        $.get(url, function(response) {
            var res = JSON.parse(response)
            if(res.status) {
                $this.addClass('text-danger').removeClass('like-btn').addClass('unlike-btn')
                $this.find('.ri-heart-line').addClass('ri-heart-fill').removeClass('ri-heart-line')
                $this.find('span').text(parseInt($this.find('span').text()) + 1)
                $this.attr('href', $this.attr('href').replace('like', 'unlike'))
            }
        })
    })

    $(document).on('click', '.unlike-btn', function(e) {
        e.preventDefault();
        var $this = $(this);
        var url = $this.attr('href');
        $.get(url, function(response) {
            var res = JSON.parse(response)
            if(res.status) {
                $this.removeClass('text-danger').removeClass('unlike-btn').addClass('like-btn')
                $this.find('.ri-heart-fill').addClass('ri-heart-line').removeClass('ri-heart-fill')
                $this.find('span').text(parseInt($this.find('span').text()) - 1)
                $this.attr('href', $this.attr('href').replace('unlike', 'like'))
            }
        })
    })

    $(document).on('click', '.follow-btn', function(e) {
        e.preventDefault();
        var $this = $(this);
        var url = $this.attr('url');
        $.get(url, function(response) {
            var res = JSON.parse(response)
            if(res.status) {
                $this.addClass('btn-outline-primary').removeClass('btn-primary').addClass('unfollow-btn').removeClass('follow-btn')
                $this.text('Unfollow')
                $this.attr('url', $this.attr('url').replace('follow', 'unfollow'))
            }
        })
    })

    $(document).on('click', '.unfollow-btn', function(e) {
        e.preventDefault();
        var $this = $(this);
        var url = $this.attr('url');
        $.get(url, function(response) {
            var res = JSON.parse(response)
            if(res.status) {
                $this.removeClass('btn-outline-primary').removeClass('unfollow-btn').addClass('btn-primary').addClass('follow-btn')
                $this.text('Follow')
                $this.attr('url', $this.attr('url').replace('unfollow', 'follow'))
            }
        })
    })
})
</script>