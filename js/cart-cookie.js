jQuery(document).ready(function ($) {
	
	// use the custom woocommerce cookie to determine if the empty cart icon should show in the header or the full cart icon should show
	// *NOTE: I'm using the jQuery cookie plugin for convenience https://github.com/carhartl/jquery-cookie
	var cartCount = $.cookie("woocommerce_cart_total");
	if (typeof(cartCount) !== "undefined" && parseInt(cartCount, 10) > 0) {
		$(".full-cart-icon").show();
		$(".empty-cart-icon").hide();

		// optionally you can even use the cart total count if you want to show "(#)" after the icon
		// $(".either-cart-icon span").html("(" + cartCount + ")");
	}
	else {
		$(".full-cart-icon").hide();
		$(".empty-cart-icon").show();
	}

});