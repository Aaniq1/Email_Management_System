<?php
require('config.php');
?>
<form action="" method="post">
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="50"
		data-name="Programming with Vishal"
		data-description="Programming with Vishal Desc"
		
		data-currency="usd"
		data-email="phpvishal@gmail.com"
	>
	</script>

</form>