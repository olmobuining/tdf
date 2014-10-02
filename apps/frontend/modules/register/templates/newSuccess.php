<script>
	function disableEnterKey(e)
	{
		 var key;     
		 if(window.event)
			  key = window.event.keyCode; //IE
		 else
			  key = e.which; //firefox     
	
		 return (key != 13);
	}

	function enableSubmit() {
		$('#submit').show(500);
		$('.okSign').show(500);
	}
	function disableSubmit() {
		$('#submit').hide(500);
		$('.okSign').hide(500);
	}
	function checkPassword(){
		var password1 = $('#user_password');
		var password2 = $('#user_password_check');
		if((password1.val() == password2.val()) && (password1.val().length > 3)) {
			enableSubmit();	
		} else {
			disableSubmit();
		}
	}
		
	$(function() {
		disableSubmit();
		$( "#user_birthdate" ).datepicker({
			dateFormat: 'dd-mm-yy',
			minDate: '-80y',
			maxDate: '-14y',
			changeMonth: true,
			changeYear: true,
			yearRange: '1940:1999'
			
			});
		
		var password1 = $('#user_password');
		var password2 = $('#user_password_check');
		password1.keypress(function () {
			setTimeout(checkPassword, 200);
		});
		password1.change(function () {
			checkPassword()
		});
		password2.keypress(function () {
			setTimeout(checkPassword, 200);
		});
		password2.change(function () {
			checkPassword()
		});
	});
	
</script>
<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Registreer</h1>
		</header>
		<?php if(isset($isLoggedIn)):?>
			<p class="error">U kunt niet registreren, u bent al ingelogd.<br><br></p>
		<?php else: ?>
			<p>Heb je interesse om je aan te sluiten bij The Dutch Fellowship?<br> 
			Meld je dan aan via <a href="<?php echo url_for('apply'); ?>">het aanmeld formulier</a>!<br>
			Het aanmeld formulier maakt automatisch een account aan. <br>
			Dit formulier is alleen voor als het aanmeld formulier is mislukt.
			<br><br></p>
			<?php include_partial('form', array('form' => $form)) ?>
		<?php endif; ?>
	</article>
</div>
<?php if(!isset($isLoggedIn)):?>
<aside class="text">
	<article>
		<header>
			<h2 class="ringbearer">Informatie</h2>
		</header>
		<p>Na het registreren van uw account zult u moeten wachten op goedkeuring van de admins. Als uw account is goedgekeurd, kunt u reageren op onze blog en plaatjes.</p>
	</article>
	<br>
	<p>Foutmeldingen:</p>
	<section class="errors">
		
		<ul>
			<?php foreach($form->getWidgetSchema()->getPositions() as $widgetName): ?>
				<?php if($form[$widgetName]->hasError()): ?>
					<li><?php echo $form[$widgetName]->renderLabelName().': '.$form[$widgetName]->getError(); ?></li>
				<?php endif; ?>
			<?php endforeach;?>
		</ul>
		
	</section>
</aside>
<?php endif; ?>