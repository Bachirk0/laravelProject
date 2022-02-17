<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">home</a></li>
					<li class="item-link"><span>Cart</span></li>
				</ul>
			</div>
			<div class=" main-content-area">

				@if(Cart::instance('cart')->count() > 0)
				<div class="wrap-iten-in-cart">
					@if(Session::has('success_message'))
					<div class="alert  alert-success">
						<strong>Success</strong> {{Session::get('success_message')}}
					</div>
					@endif
					@if(Cart::instance('cart')->count() > 0 )
					<h3 class="box-title">Nom des produits</h3>
					<ul class="products-cart">
						@foreach(Cart::instance('cart')->content() as $item)
						<li class="pr-cart-item">
							<div class="product-image">
								<figure><img src="{{('assets/images/products')}}/{{$item->model->image}}" alt="{{$item->model->name}}"></figure>
							</div>
							<div class="product-name">
								<a class="link-to-product" href="{{route('product.details', ['slug'=>$item->model->slug])}}">{{$item->model->name}}</a>
							</div>
							<div class="price-field produtc-price"><p class="price">${{$item->model->regular_price}}</p></div>
							<div class="quantity">
								<div class="quantity-input">
									<input type="text" name="product-quatity" value="{{$item->qty}}" data-max="120" pattern="[0-9]*" >									
									<a class="btn btn-increase" href="#"wire:click.prevent="increaseQuantity('{{$item->rowId}}')"></a>
									<a class="btn btn-reduce" href="#" wire:click.prevent ="decreaseQuantity('{{$item->rowId}}')"></a>
								</div>
								<p class="text-center"><a href="#" wire:click.prevent="switchToSaveForLater('{{$item->rowId}}')">Enregistrer pour plus tard</a></p>
							</div>
							<div class="price-field sub-total"><p class="price">${{$item->subtotal}}</p></div>
							<div class="delete">
								<a href="#" wire:click.prevent="destroy('{{$item->rowId}}')"class="btn btn-delete" title="">
									<span>Supprimer du panier</span>
									<i class="fa fa-times-circle" aria-hidden="true"></i>
								</a>
							</div>
						</li>
						@endforeach	
					</ul>
					@else
					  <p>Panier vide</p>
					  @endif
				</div>

				<div class="summary">
					<div class="order-summary">
						<h4 class="title-box">Recapitulatif commande</h4>
						<p class="summary-info"><span class="title">Sous total</span><b class="index">${{Cart::instance('cart')->subtotal()}}</b></p>
						@if(Session::has('coupon'))
						<p class="summary-info"><span class="title">Reduction({{Session::get('coupon')['code']}})<a href="#" wire:click.prevent="removeCoupon"><i class="fa fa-times text-danger"></i></a></span><b class="index">-${{$discount}}</b></p>
						<p class="summary-info"><span class="title">Sous total</span><b class="index">${{$subtotalAfterDiscount}}</b></p>

						<p class="summary-info"><span class="title">Tax ({{config('cart.tax')}}%)</span><b class="index">${{$taxAfterDiscount}}</b></p>
						<p class="summary-info total-info "><span class="title">Total</span><b class="index">${{$totalAfterDiscount}}</b></p>



                        @else 
						<p class="summary-info"><span class="title">Tax</span><b class="index">${{Cart::instance('cart')->tax()}}</b></p>
						<p class="summary-info"><span class="title">Livraison</span><b class="index">Free Shipping</b></p>
						<p class="summary-info total-info "><span class="title">Total</span><b class="index">${{Cart::instance('cart')->total()}}</b></p>
						@endif
						
					</div>
					
						<div class="checkout-info">
							@if(!Session::has('coupon'))
							<label class="checkbox-field">
								<input class="frm-input " name="have-code" id="have-code" value="1" type="checkbox" wire:model="haveCouponCode"><span>J'ai un coupon</span>
							</label>
							@if($haveCouponCode == 1)
							<div class="summary-item">
								<form wire:submit.prevent="applyCouponCode">
									<h4 class="title-box">Code coupon </h4>
									@if(Session::has('coupon_message'))
									<div class="alert alert-danger" role="danger"> {{Session::get('coupon_message')}}</div>
									@endif
									<p class="row-in-form">
										<label for="coupon-code">Entrer votre coupon :</label>
										<input type="text" name="coupon-code" wire:model="couponCode"/>
									</p>
									<button type="submit" class="btn btn-small">Appliquer</button>
								</form>
							</div>
							@endif
						@endif
						<a class="btn btn-checkout" href="#" wire:click.prevent="checkout">Commandes</a>
						<a class="link-to-shop" href="shop.html">Continuer mon shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
					</div>
					<div class="update-clear">
						<a class="btn btn-clear" href="#" wire:click.prevent="destroyAll() ">Clear Shopping Cart</a>
						<a class="btn btn-update" href="#">Mettre à jour le panier</a>
					</div>
				</div>
					
				@else
					<div class="text-center" style="padding: 30px 0;">
						<h1>Votre panier est vide!</h1>
						<p>Ajouter des produits</p>
						<a href="/shop" class="btn btn-success">Aller à la boutique </a>
					</div>
				@endif

				<div class="wrap-iten-in-cart">
					<h3 class="title-box" style="border-bottom: 1px solid; padding-bottom:15px;">{{	Cart::instance('saveForLater')->count()}}Produit(s) enregistrer pour plus tard</h3>
					@if(Session::has('s_success_message'))
					<div class="alert  alert-success">
						<strong>Success</strong> {{Session::get('s_success_message')}}
					</div>
					@endif
					@if(Cart::instance('saveForLater')->count() > 0 )
					<h3 class="box-title">Nom du produit</h3>
					<ul class="products-cart">
						@foreach(Cart::instance('saveForLater')->content() as $item)
						<li class="pr-cart-item">
							<div class="product-image">
								<figure><img src="{{('assets/images/products')}}/{{$item->model->image}}" alt="{{$item->model->name}}"></figure>
							</div>
							<div class="product-name">
								<a class="link-to-product" href="{{route('product.details', ['slug'=>$item->model->slug])}}">{{$item->model->name}}</a>
							</div>
							<div class="price-field produtc-price"><p class="price">${{$item->model->regular_price}}</p></div>
							<div class="quantity">
								<p class="text-center"><a href="#" wire:click.prevent="moveToCart('{{$item->rowId}}')">Emmener au panier </a></p>
							</div>
							<div class="delete">
								<a href="#" wire:click.prevent="deleteFromSaveForLater('{{$item->rowId}}')"class="btn btn-delete" title="">
									<span>Supprimer </span>
									<i class="fa fa-times-circle" aria-hidden="true"></i>
								</a>
							</div>
						</li>
						@endforeach	
					</ul>
					@else
					  <p>Pas de produit enregistrer pour plus tard </p>
					  @endif
				</div>

				<div class="wrap-show-advance-info-box style-1 box-in-site">
					<h3 class="title-box">Produits plus vues </h3>
					<div class="wrap-products">.
						<div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="{{('assets/images/products/digital_04.jpg')}}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label">Nouveau</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Sac Luis vuton</span></a>
									<div class="wrap-price"><span class="product-price">25000 fcfa </span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="{{('assets/images/products/digital_17.jpg')}}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item sale-label">Ventes</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Chaussure nike </span></a>
									<div class="wrap-price"><ins><p class="product-price">15000 fcfa </p></ins> <del><p class="product-price">10000 fcfa </p></del></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="{{('assets/images/products/digital_15.jpg')}}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label">Nouveau</span>
										<span class="flash-item sale-label">Ventes</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Montre Cartier </span></a>
									<div class="wrap-price"><ins><p class="product-price">35000 fcfa </p></ins> <del><p class="product-price">45000 fcfa</p></del></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="{{('assets/images/products/digital_01.jpg')}}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item bestseller-label">Meilleurs vennte</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Parfum Dior </span></a>
									<div class="wrap-price"><span class="product-price">35000 fcfa</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="{{('assets/images/products/digital_21.jpg')}}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Sac à mains </span></a>
									<div class="wrap-price"><span class="product-price">17000 fcfa </span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="{{('assets/images/products/digital_03.jpg')}}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item sale-label"> Ventes</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="{{('assets/images/products/digital_04.jpg')}}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label">Nouveaux</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Parfum Zara</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="{{('assets/images/products/digital_05.jpg')}}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item bestseller-label">Meilleur ventes</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								
							</div>
						</div>
					</div><!--End wrap-products-->
				</div>

			</div><!--end main content area-->
		</div><!--end container-->

	</main>