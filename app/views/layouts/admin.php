<?php
	$url = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php echo $title; ?></title>
	<meta name='description' content="" />
	<meta name="keywords" content="" />
	<link rel="icon" type="image/x-icon" href="/public/img/favicon.png" />
	<link rel="stylesheet" type="text/css" href="/public/css/style.css" />
</head>
<body class="loaded">

<!-- BEGIN BODY -->

<div class="main-wrapper">

<!-- BEGIN HEADER -->

<header class="header header--admin">		
    <div class="wrapper">
        <div class="header-container">
            <div class="header-logo header-logo--admin">
                <a href="/">Test Blog</a>
            </div>
            <?php if($this->route['action'] != 'login') : ?>
                <div class="header-functionals">
                    <a href="/admin/logout" class="header-functionals__link active">Logout</a>
                    <div class="header-functionals__name">Hi, <span class="account-name">admin</span></div>
                </div>
            <?php endif; ?>
        </div>
    </div>		
</header>

<!-- HEADER EOF   -->

<!-- BEGIN CONTENT -->

<main class="main admin">
	<div class="wrapper">
		<div class="flex-container">
            <?php if($this->route['action'] != 'login') : ?>
                <div class="flex-xl-3 flex-md-12">
                    <aside class="admin-sidebar">
                        <a href="/admin/posts" class="admin-sidebar__title">Admin panel</a>
                        <ul class="admin-sidebar__nav">
                            <li>
                                <a href="/admin/add">Add post</a>
                            </li>
                            <li>
                                <a href="/admin/posts">Posts</a>
                            </li>
                            <li>
                                <a href="/admin/categories">Categories</a>
                            </li>
                            <li>
                                <a href="/admin/logout">Logout</a>
                            </li>
                        </ul>
                    </aside>
                </div>
            <?php endif; ?>
            <div class="flex-xl-9 flex-md-12">
                <?php
                    echo $content;
                ?>
            </div>
        </div>
	</div>
</main>

<!-- CONTENT EOF   -->

<!-- BEGIN FOOTER -->	
	
<footer class="footer footer--admin">
    <div class="wrapper">
        <div class="footer-container">
            <div class="footer-logo">
                <a href="/">Test blog</a>
            </div>
            <div class="footer-copy">&copy; <a href="https://github.com/yuri-sokyrko" title="author">YS</a></div>
        </div>
    </div>	
</footer>

<!-- FOOTER EOF   -->

</div>

<div class="icon-load"></div>

<!-- BODY EOF -->
	<script src="/public/libs/jquery/dist/jquery.min.js"></script>
	<script src="/public/libs/jquery-migrate/jquery-migrate.min.js"></script>
	<script src="/public/libs/ckeditor5-build-classic/ckeditor.js"></script>
	<script src="/public/js/main.js"></script>
	<script src="/public/js/admin.js"></script>
	<script src="/public/js/forms.js"></script>
</body>
</html>