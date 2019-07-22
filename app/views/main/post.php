<section class="post text-box">
    <?php if(isset($_SESSION['admin'])) : ?>
        <div class="post__functionals">
            <a href="/admin/edit/<?php echo $data['id']; ?>" class="edit">Edit</a>
        </div>
    <?php endif ?>
    <ul class="post__categories">
        <?php
            foreach($categories as $cat) {
                if($data['category'] == $cat['id']) {
                    echo '<li><a href="/main/category/' . $cat['id'] . '">' . $cat['cat_name'] . '</a></li>';
                } 
            }
        ?>
    </ul>
    <h1 class="main-title"><?php echo htmlspecialchars($data['post_title'] ,ENT_QUOTES); ?></h1>
    <div class="post__image">
        <img src="/public/thumbnails/thumb-<?php echo $data['id']; ?>.jpg" alt="">
    </div>
    <?php echo $data['post_content']; ?>

        <div class="post__likes js-post__likes">
            <div class="likes-counter">Likes: <span><?php echo htmlspecialchars($data['post_likes'] ,ENT_QUOTES); ?></span></div>
            
            <?php if(isset($_SESSION['auth'])) : ?>
                <a href="/like/<?php echo $data['id']; ?>" class="like">Like this post +1</a>
            <?php endif; ?>
        </div>
</section>