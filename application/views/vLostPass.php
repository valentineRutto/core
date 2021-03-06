<?php
	/*
	* @name            : vLostPass.php
	* @description     : Lost pass view (password or passphrase)
	* @authors         : Dylan Clement <dylanclement7@protonmail.ch>
	*/
    use \library\MVC as l;
	$_t = new l\Template($this->txt->Login->forgot);
    $_t->addCss("home_global");
    $_t->addCss("Register/home_register");
   	$_t->getHeader();
?>
<body>
        <section id="language">
            <div>
                <?php $this->getLanguageSelector(); ?>
            </div>
        </section>

        <section id="header">
            <div id="logo"><img src="<?php echo MVC_ROOT; ?>/public/pictures/register/logo_anime.svg" /></div>
        </section>

        <section id="content">
            <div id="back"><p><a href="https://muonium.ch/photon/"><?php echo_h($this->txt->Global->back); ?></a></p></div>

            <div id="avatar"><p><img src="<?php echo MVC_ROOT; ?>/public/pictures/register/user.svg" /></p></div>
            <div id="text"><p><?php echo_h($this->txt->Login->forgot); ?></p></div>

            <br /><br />
			<form method="post" action="<?php echo MVC_ROOT; ?>/LostPass/SendMail">
                <?php echo $this->err_msg; ?><br />
                <label for="user"><?php echo_h($this->txt->LostPass->user); ?></label>
                <input type="text" name="user" id="user" required="required" value="<?php if(!empty($_POST['user'])) { echo_h($_POST['user']); } ?>">
                <input type="submit">
            </form>
        </section>
</body>
<?php
   $_t->getFooter();
?>
