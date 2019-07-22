<section class="admin-posts">
    <div class="admin__title"><?php echo $title; ?></div>
    <?php if(empty($list)) : ?>
        <div class="info-box">
            <p>Something went wrong, there are no posts now</p>
        </div>
        <?php else: ?>
            <ul class="admin-posts__container">
                <?php foreach ($list as $post) : ?>
                    <li class="admin-posts__item">
                        <a href="/admin/edit/<?php echo $post['id']; ?>" class="img-wrapper">
                            <img src="/public/thumbnails/thumb-<?php echo $post['id']; ?>.jpg" alt="">
                        </a>
                        <a href="/admin/edit/<?php echo $post['id']; ?>" class="short-content">
                            <div class="title"><?php echo htmlspecialchars($post['post_title'] ,ENT_QUOTES); ?></div>
                            <div class="description"><?php echo htmlspecialchars($post['post_description'] ,ENT_QUOTES); ?></div>
                            <?php
                                foreach($categories as $cat) {
                                    switch($post['category']) {
                                        case $cat['id']:
                                            echo '<div class="category">' . $cat['cat_name'] . '</div>';
                                            break;
                                        default:
                                            break;
                                    }
                                }
                            ?>
                        </a>
                        <div class="functionals">
                            <a href="/post/<?php echo $post['id']; ?>" target="_blank">View</a>
                            <a href="/admin/edit/<?php echo $post['id']; ?>">Edit</a>
                            <a href="/admin/delete/<?php echo $post['id']; ?>">Delete</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php echo $pagination; ?>
    <?php endif; ?>
</section>