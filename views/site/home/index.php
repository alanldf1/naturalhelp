<section class="home-content" id="home"> 
	<div class="banner-top">
		<h2 class="font-black text-light">ASSISTÊNCIA EM CASOS DE DESASTRES NATURAIS</h2>
	</div>
	<div class="panel-choose">
		<a href="<?=$url?>/contact">
			<div class="need-help">
				<div class="contrast-card">
					<h3 class="font-black text-light">Quero ajuda!</h3>
				</div>
			</div>
		</a>
		<a href="<?=$url?>/doacoes">
			<div class="want-help">
				<div class="contrast-card">
					<h3 class="font-black text-light">Quero ajudar!</h3>
				</div>
			</div>
		</a>
	</div>
	<div class="panel-cases">
		<h2 class="text-center font-black">ATINGIDOS</h2>
		<div class="cases">
			<div class="card-case">
				<div class="col-md-9 col-12 carousel double-row">
                <div class="owl-carousel w-100 product">
					<?php foreach ($products['categoryproduct'] as $i => $product) { ?>
                        <div class="div-product" data-slide-index="<?=$i?>">
							<a href="<?=$url?>/produto/ver/<?=$product['id'] . '/' . strtolower($this->helpers['SanitizeString']->sanitizeString($product['name']))?>"><?=$produt['name']?>
								<div class="product-image" style="background-image: url(<?=$url?>/assets/img/product/<?=$product['id']?>/<?=$product['photo']?>);">
								</div>
							</a>
							<div class="name">
								<?=$product['name']?>
							</div>
							<div class="price">
								<strong>R$</strong><strong class="price-number"><?=number_format($product['price'], 2, ",", ".")?></strong>
							</div>
						</div>
                    <?php } ?>
                        
                </div>
                
            </div>
			</div>
		</div>
	</div>

	<!-- <h1 class=""> O que fazemos </h1>
	<p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>		    -->

</section>