<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-center" data-session-username="<?= $this->user_data->username ?>" data-base-url="<?= base_url() ?>">
        <div class="w-100 row g-5">
            <?php $post = $options['post'] ?>
            <div class="col-12 col-md-6">
                <div class="card w-100">

                    <a href="<?= base_url('post/detail/' . $post->id) ?>">
                        <img class="img-fluid" src="<?= assets('uploads/'. $post->image_url) ?>" alt="Card image cap">
                    </a>
                    
                </div>
            </div>
            
            <div class="col-12 col-md-6">
                <div class="card">
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="text-black" href="<?= base_url('profile/preview/' . $post->user->username) ?>">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar me-4">
                                        <img src="<?= assets('uploads/'. $post->user->profile_picture) ?>" alt="Avatar" class="rounded-circle">
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

                    <div class="card-body">
                        <p class="card-text"><?= $post->caption ?></p>
                        <span class="card-text text-sm text-muted"><?= date('d M Y', strtotime($post->created_at)) ?></span>
                        <div class="d-flex justify-content-start">
                            <?php if($post->is_liked): ?>
                                <a href="<?= base_url('post/unlike/' . $post->id) ?>" class="btn text-danger px-1 pb-3 d-flex align-items-center me-5 unlike-btn">
                                    <i class="ri-heart-fill"></i>
                                    <span class="ms-2"><?= count($post->likes) ?></span>
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('post/like/' . $post->id) ?>" class="btn px-1 pb-3 d-flex align-items-center me-5 like-btn">
                                    <i class="ri-heart-line"></i>
                                    <span class="ms-2"><?= count($post->likes) ?></span>
                                </a>
                            <?php endif ?>
                            <a href="#" class="btn px-1 pb-3 d-flex align-items-center comment-btn">
                                <i class="ri-chat-4-line"></i>
                                <span class="ms-2"><?= count($post->comments) ?></span>
                            </a>
                        </div>
                    </div>

                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link waves-effect likes-tab" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-likes" aria-controls="navs-tab-likes" aria-selected="false" tabindex="-1">
                                <?= count($post->likes) ?> Likes
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link waves-effect comments-tab active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-comments" aria-controls="navs-tab-comments" aria-selected="true">
                                <?= count($post->comments) ?> Comments
                            </button>
                        </li>
                        <span class="tab-slider" style="left: 90.375px; width: 94.3px; bottom: 0px;"></span>
                    </ul>

                    <div class="card-body">
                        <div class="tab-content p-0">
                            <div class="tab-pane fade" id="navs-tab-likes" role="tabpanel">
                                <?php if(!empty($post->likes)): ?>
                                    <?php foreach($post->likes as $like): ?>
                                        <div class="d-flex justify-content-between align-items-center mb-2 likes-item" data-ref-username="<?= $like->user->username ?>">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar me-4">
                                                    <img src="<?= assets('uploads/'. ($like->user->profile_picture ?? 'placeholder.jpg')) ?>" alt="Avatar" class="rounded-circle">
                                                </div>
                                                <div>
                                                    <div>
                                                        <h6 class="mb-0 text-truncate"><?= $like->user->full_name ?></h6>
                                                        <small class="text-truncate">@<?= $like->user->username ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <h5 class="card-title m-0 text-center text-muted placeholder-text">No likes yet</h5>
                                <?php endif ?>
                            </div>
                            <div class="tab-pane fade active show" id="navs-tab-comments" role="tabpanel">
                                <div class="mb-3">
                                    <textarea name="comment" class="form-control" id="comment-box" placeholder="Input Comment..."></textarea>
                                </div>
                                <div class="mb-3 d-flex justify-content-end">
                                    <button class="btn btn-primary" id="submit-comment" href="<?= base_url('post/comment/' . $post->id) ?>">Comment</button>
                                </div>
                                <hr>
                                <div id="comments-section">
                                    <?php if(!empty($post->comments)): ?>
                                        <?php foreach($post->comments as $comment): ?>
                                            <div class="d-flex justify-content-between align-items-center mb-3 comments-item" data-ref-username="<?= $comment->user->username ?>">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar me-4">
                                                        <img src="<?= assets('uploads/'. ($comment->user->profile_picture ?? 'placeholder.jpg')) ?>" alt="Avatar" class="rounded-circle">
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <h6 class="mb-0 text-truncate"><?= $comment->user->full_name ?></h6>
                                                            <small class="text-truncate">@<?= $comment->user->username ?></small>
                                                        </div>
                                                        <p class="text-truncate mb-0"><?= $comment->comment ?></p>
                                                    </div>
                                                </div>
                                                <?php if($comment->user->username == $this->user_data->username): ?>
                                                    <div class="text-end">
                                                        <a class="text-danger uncomment-btn" href="<?= base_url('post/uncomment/' . $comment->id) ?>"><i class="ri-delete-bin-line"></i></a>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        <?php endforeach ?>
                                    <?php else: ?>
                                        <h5 class="card-title m-0 text-center text-muted placeholder-text">No comments yet</h5>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->

<script>
$(document).ready(function() {
    var base_url = $('div[data-base-url]').attr('data-base-url')

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
                $('.likes-tab').text((parseInt($('.likes-tab').text()) + 1) + ' Likes')
                $('#navs-tab-likes').find('.placeholder-text').remove()
                $('#navs-tab-likes').append($('<div>', {
                    class: 'd-flex justify-content-between align-items-center mb-2 likes-item',
                    'data-ref-username': '<?= $this->user_data->username ?>',
                    html: $('<div>', {
                        class: 'd-flex align-items-center',
                        html: [
                            $('<div>', {
                                class: 'avatar avatar me-4',
                                html: $('<img>', {
                                    src: '<?= assets('uploads/'. ($this->user_data->profile_picture ?? 'placeholder.jpg')) ?>',
                                    alt: 'Avatar',
                                    class: 'rounded-circle'
                                })
                            }),
                            $('<div>', {
                                html: [
                                    $('<h6>', {
                                        class: 'mb-0 text-truncate',
                                        text: '<?= $this->user_data->full_name ?>'
                                    }),
                                    $('<small>', {
                                        class: 'text-truncate',
                                        text: '@<?= $this->user_data->username ?>'
                                    })
                                ]
                            })
                        ]
                    })
                }))
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
                $('.likes-tab').text((parseInt($('.likes-tab').text()) - 1) + ' Likes')
                if($('.likes-tab').children().length == 0) {
                    $('#navs-tab-likes').append($('<h5>', {
                        class: 'card-title m-0 text-center text-muted placeholder-text',
                        text: 'No likes yet'
                    }))
                }
                $('#navs-tab-likes').find('.likes-item[data-ref-username="<?= $this->user_data->username ?>"]').remove()
            }
        })
    })

    $(document).on('click', '#submit-comment', function(e) {
        e.preventDefault();
        var $this = $(this);
        var url = $this.attr('href');
        var comment = $('#comment-box').val();
        $.post(url, { comment: comment }, function(response) {
            var res = JSON.parse(response)
            console.log(res)
            if(res.status) {
                $('#comment-box').val('');
                $('#comments-section').find('.placeholder-text').remove()
                $('#comments-section').prepend($('<div>', {
                    class: 'd-flex justify-content-between align-items-center mb-3 comments-item',
                    'data-ref-username': '<?= $this->user_data->username ?>',
                    html: [
                        $('<div>', {
                            class: 'd-flex align-items-center',
                            html: [
                                $('<div>', {
                                    class: 'avatar avatar me-4',
                                    html: $('<img>', {
                                        src: '<?= assets('uploads/'. ($this->user_data->profile_picture ?? 'placeholder.jpg')) ?>',
                                        alt: 'Avatar',
                                        class: 'rounded-circle'
                                    })
                                }),
                                $('<div>', {
                                    html: [
                                        $('<div>', {
                                            html: [
                                                $('<h6>', {
                                                    class: 'mb-0 text-truncate',
                                                    text: '<?= $this->user_data->full_name ?>'
                                                }),
                                                $('<small>', {
                                                    class: 'text-truncate',
                                                    text: '@<?= $this->user_data->username ?>'
                                                })
                                            ]
                                        }),
                                        $('<p>', {
                                            class: 'text-truncate mb-0',
                                            text: comment
                                        })
                                    ]
                                })
                            ]
                        }),
                        $('<div>', {
                            class: 'text-end',
                            html: $('<a>', {
                                class: 'text-danger uncomment-btn',
                                href: base_url + 'post/uncomment/' + res.data.id,
                                html: $('<i>', {
                                    class: 'ri-delete-bin-line'
                                })
                            })
                        })
                    ]
                }))

                $('.comments-tab').text((parseInt($('.comments-tab').text()) + 1) + ' Comments')
                $('.comment-btn').find('span').text((parseInt($('.comment-btn').find('span').text()) + 1))
            }
        })
    })

    $(document).on('click', '.uncomment-btn', function(e) {
        e.preventDefault();
        var $this = $(this);
        var url = $this.attr('href');
        $.get(url, function(response) {
            var res = JSON.parse(response)
            if(res.status) {
                $this.parents('.comments-item').remove()
                $('.comments-tab').text((parseInt($('.comments-tab').text()) - 1) + ' Comments')
                $('.comment-btn').find('span').text((parseInt($('.comment-btn').find('span').text()) - 1))
            }
        })
    })
})
</script>