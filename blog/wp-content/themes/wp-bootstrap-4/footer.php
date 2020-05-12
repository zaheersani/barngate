<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_4
 */

?>

	</div><!-- #content -->

	<?php /*?><footer id="colophon" class="site-footer text-center bg-white mt-4 text-muted">

		<section class="footer-widgets text-left">
			<div class="container">
				<div class="row">
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<div class="col">
							<aside class="widget-area footer-1-area mb-2">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</aside>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
						<div class="col">
							<aside class="widget-area footer-2-area mb-2">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</aside>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
						<div class="col">
							<aside class="widget-area footer-3-area mb-2">
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</aside>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
						<div class="col">
							<aside class="widget-area footer-4-area mb-2">
								<?php dynamic_sidebar( 'footer-4' ); ?>
							</aside>
						</div>
					<?php endif; ?>
				</div>
				<!-- /.row -->
			</div>
		</section>

		<div class="container-site-info">
			<div class="site-info text-center">
                <p><a href="">Privacy</a> </p>
                <p>Copyright &copy; 2019 by Barngate.</p>
                <p>All Rights Reserved.</p>

			</div><!-- .site-info -->
		</div>
		<!-- /.container -->
	</footer><!-- #colophon --><?php */?>

	<section id="footer" class="footer">
		<div class="container">
			<div class="row align-items-center row-eq-height">
				<div class="col-md-2">
					<img src="https://barngate.com/images/logos/logo-footer.svg">
				</div>
				<div class="col-md-2">
					<ul>
						<li><a href="https://barngate.com/" target="_blank">Home</a></li>
						<li><a href="https://barngate.com/about" target="_blank">About Us</a></li>
						<li><a href="https://barngate.com/faqs" target="_blank">FAQ's</a></li>
						<li><a href="https://blog.barngate.com/" target="_blank">Blog</a> </li>
						<li><a href="https://barngate.com/contact" target="_blank">Contact Us</a> </li>
                        <li><a href="https://barngate.com/privacy-policy" target="_blank">Privacy Policy</a> </li>
					</ul>
				</div>
				
				<div class="col-md-6">
					<p class="text-blue-light fz-20 mb-5">Subscribe to our weekly Newsletter</p>
					<form id="signup" action="" method="post" class="form-inline">
						<div class="form-group mb-2">
							<label for="inputPassword2" class="sr-only">Enter your email</label>
						</div>
						<div class="form-group mx-sm-3 mb-2 w-60">
							<input type="email" class="form-control w-100" id="email" name="email" placeholder="Enter your email" data-name="Email" data-required="true" data-mail="true">
						</div>
						<input type="submit" class="btn btn-primary btn-red mb-2 w-35" id="mc-embedded-subscribe" value="Subscribe >">
					</form>
					<div class="fz-16 mb-10" id="message"></div>
					<ul class="list-inline">
						<li class="list-inline-item"><a href="https://www.facebook.com/barngate/" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
						<li class="list-inline-item"><a href="https://www.instagram.com/barngate_" target="_blank"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<div class="container">
		<div class="row text-center">
			<div class="col-md-12 mt-20 mb-20 fz-18">
				© 2020 by Barngate. All Rights Reserved.
			</div>
		</div>
	</div>

</div><!-- #page -->

<script>
    
function validar(idForma)
{
	var error = false;
	var camposRequeridos = '#'+idForma + ' [data-required="true"]';

 	jQuery(camposRequeridos).each(function(index, element) {
		if(jQuery(this).val() == '')
		{
			var selectorCampo = '#' + idForma + ' [name="' + jQuery(this).attr('name') + '"]';
			console.log(jQuery(this).attr('name') + ' vacío');
			jQuery(selectorCampo).attr('placeholder', jQuery(this).attr('data-name') + ' requerido').addClass('requerido');
			error = true;
		}
    }); // Cierra $(camposRequeridos).each

	var correo = '#'+idForma + ' [data-mail="true"]';

	jQuery(correo).each(function(index, element) {

        var selectorCorreo = '#' + idForma + ' [name="' + jQuery(this).attr('name') + '"]';

		var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);

		if(jQuery(this).val() !== '')
		{
			if(!pattern.test(jQuery(this).val()))
			{
				jQuery(selectorCorreo).attr('placeholder', 'Correo inválido').addClass('requerido');
				jQuery(selectorCorreo).val('');
				console.log(jQuery(this).attr('name') + ' incorrecto');
				error = true;
			} // if(!pattern.test($(this).val()))
		} // Cierra if($(this).val() !== '')
    }); // Cierra $(correo).each

    var camposSelect = '#'+idForma + ' [data-select="true"]';

 	jQuery(camposSelect).each(function(index, element) {
		if(jQuery(this).val() == 'vacio') {
			jQuery(this).addClass('requerido');
			error = true;   
		} else {
			jQuery(this).removeClass('requerido');
		}
	});

	return error;
}

jQuery('.form-inline').submit(function(e) {
	if(validar('signup')){ 
		e.preventDefault();
	} else {
		e.preventDefault();
		jQuery("#message").html("Registering your information...");		

		jQuery.ajax({
			url: 'https://blog.barngate.com/wp-content/themes/wp-bootstrap-4/mailchimp/News.php', // proper url to your "store-address.php" file
			type: 'POST', // <- IMPORTANT
			data: jQuery('#signup').serialize() + '&ajax=true',
			success: function(msg) {

				var message = jQuery.parseJSON(msg),
					result = '';

				if (message.status === 'subscribed') { // success
					jQuery('#signup').html('<p class="fz-20 mb-5">Thank you for subscribing to our newsletter!</p>');
				} else { // error
					result = 'Error: ' + message.detail + 'message.status';
					jQuery('#message').html(result); // display the message
				} 
			}
		});
	}
});

</script>

<?php wp_footer(); ?>

</body>
</html>
