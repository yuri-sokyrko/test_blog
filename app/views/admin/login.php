<section class="login">
    <div class="flex-container">
        <div class="flex-xl-6 flex-sm-12">
            <form action="/admin/login" method="post" id="formLogin">
                <div class="login-form">
                    <h3 class="login-form__title"><?php echo $title; ?></h3>
                    <div class="box-field">
                        <div class="box-field__input">
                            <input type="text" class="form-control" placeholder="Enter your login" name="login">
                        </div>
                    </div>
                    <div class="box-field">
                        <div class="box-field__input">
                            <input type="password" class="form-control" placeholder="Enter your password" name="password">
                        </div>
                    </div>
                    <button type="submit" class="main-button main-button--center main-button--black">Login</button>
                </div>
            </form>
        </div>
    </div>
</section>