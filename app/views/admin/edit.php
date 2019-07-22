<section class="add-post">
    <div class="admin__title"><?php echo $title; ?></div>
    <form action="admin/edit/<?php echo $data['id']; ?>" method="post">
        <div class="box-field">
            <label class="box-field__label">Post title</label>
            <div class="box-filed__input">
                <input type="text" class="form-control" name="post_title" value="<?php echo htmlspecialchars($data['post_title'], ENT_QUOTES); ?>">
            </div>
        </div>
        <div class="box-field">
            <label class="box-field__label">Post description</label>
            <div class="box-filed__input">
                <input type="text" class="form-control" name="post_description" value="<?php echo htmlspecialchars($data['post_title'], ENT_QUOTES); ?>">
            </div>
        </div>
        <div class="box-field">
            <label class="box-field__label">Post content</label>
            <div class="box-filed__input">
                <textarea name="post_content" id="editor"><?php echo $data['post_content']; ?></textarea>
            </div>
        </div>
        <div class="box-field">
            <label class="box-field__label">Post category</label>
            <div class="box-filed__input">
                <select name="category" class="form-control">
                    <?php
                        foreach($list as $category) {
                            switch ($category['id']) {
                                case $data['category']:
                                    echo '<option value="' . $category['id'] . '" selected>' . $category['cat_name'] . '</option>';
                                    break;
                                default:
                                    echo '<option value="' . $category['id'] . '">' . $category['cat_name'] . '</option>';
                                    break;
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="box-field">
            <label class="box-field__label">Post image</label>
            <div class="box-filed__input">
                <input type="file" class="form-control" name="post_image">
            </div>
        </div>
        <div class="box-field">
            <label class="box-field__label">Likes amount</label>
            <div class="box-filed__input">
                <input type="number" class="form-control" name="post_likes" value="<?php echo htmlspecialchars($data['post_likes'], ENT_QUOTES); ?>">
            </div>
        </div>
        <button type="submit" class="main-button main-button--black"><?php echo $title; ?></button>
    </form>
</section>