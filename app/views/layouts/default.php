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

<header class="header">		
    <div class="wrapper">
        <div class="header-container">
            <div class="header-logo">
                <a href="/">Test Blog</a>
            </div>
            <?php if(!isset($_SESSION['admin'])) : ?>
                <nav class="header-nav">
                    <ul class="header-nav__list">
                        <li><a href="/">Home</a></li>
                        <?php if(!empty($categories)) : ?>
                            <li>
                                <a href="javascript:void(0);">Categories</a>
                                <ul class="sub-menu">                            
                                    <?php
                                        foreach($categories as $cat) {
                                            echo '<li><a href="/main/category/' . $cat['id'] . '">' . $cat['cat_name'] . '</a></li>';
                                        }
                                    ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if(!isset($_SESSION['auth'])) : ?>
                            <li><a href="/account/login">Login</a></li>
                            <li><a href="/account/register">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
            <?php if(isset($_SESSION['auth'])) : ?>
                <div class="header-functionals">
                    <a href="/account/logout" class="header-functionals__link active">Logout</a>
                </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['admin'])) : ?>
                <div class="header-functionals">
                    <a href="/admin/logout" class="header-functionals__link active">Logout</a>
                    <a href="/admin/posts" class="header-functionals__name">Hi, <span class="account-name">admin</span></a>
                </div>
            <?php endif; ?>
        </div>
    </div>		
</header>

<!-- HEADER EOF   -->

<!-- BEGIN CONTENT -->

<main class="main">
	<div class="wrapper">
		<?php
			echo $content;
		?>
	</div>
</main>

<!-- CONTENT EOF   -->

<!-- BEGIN FOOTER -->	
	
<footer class="footer">
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
	<script src="/public/js/main.js"></script>
	<script src="/public/js/forms.js"></script>
</body>
</html>