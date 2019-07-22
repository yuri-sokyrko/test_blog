<section class="post-categories">
    <div class="admin__title"><?php echo $title; ?></div>
    <table class="post-categories__table">
        <tbody>
            <tr>
                <th>Name</th>
                <th>ID</th>
                <th>Delete</th>
            </tr>
            <?php 
                foreach($list as $category) {
                    switch ($category['id']) {
                        case '1':
                            echo "<tr><td> " . htmlspecialchars($category['cat_name'], ENT_QUOTES) . "</td><td>" . $category['id'] . "</td><td></td></tr>";
                            break;
                        
                        default:
                            echo "<tr><td> " . htmlspecialchars($category['cat_name'], ENT_QUOTES) . "</td><td>" . $category['id'] . "</td><td><a href=\"/admin/deleteCat/" . $category['id'] . "\">delete</a></td></tr>";
                            break;
                    }
                }
            ?>
        </tbody>
    </table>
    <form action="admin/categories" method="post">
        <div class="box-field">
            <label class="box-field__label">Add category</label>
            <div class="box-field__input">
                <input type="text" class="form-control" name="category" placeholder="Type category name*">
            </div>
        </div>
        <button type="submit" class="main-button main-button--black">+Add</button>
    </form>
</section>