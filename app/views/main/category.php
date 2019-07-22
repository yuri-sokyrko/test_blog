<section class="blog">
    <h1 class="main-title"><?php echo $title; ?> <?php echo $catNAME; ?></h1>
    <?php if(empty($list)) : ?>
        <div class="info-box">
            <p>Something went wrong, there are no posts now</p>
        </div>
        <?php else: ?>
            <div class="flex-container blog-container" id="blog-container">
                <?php foreach($list as $post) : ?>
                    <div class="flex-xl-3 flex-md-4 flex-sm-6 flex-xs-12">
                        <article class="blog-item">
                            <a href="/post/<?php echo $post['id']; ?>" class="blog-item__link">
                                <div class="blog-item__image">
                                    <img src="/public/thumbnails/thumb-<?php echo $post['id']; ?>.jpg" alt="">
                                </div>
                                <h3 class="blog-item__title"><?php echo htmlspecialchars($post['post_title'] ,ENT_QUOTES); ?></h3>
                                <p class="blog-item__exerpt"><?php echo htmlspecialchars($post['post_description'] ,ENT_QUOTES); ?></p>
                                <div class="blog-item__likes">Likes <span class="likes-counter"><?php echo htmlspecialchars($post['post_likes'] ,ENT_QUOTES); ?></span></div>
                            </a>
                        </article>
                    </div>
                    <?php endforeach; ?>
            </div>
    <?php endif; ?>
</section>