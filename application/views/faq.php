<div class="container">

	<h2 class="heading-title border-none mt-md-5 mt-3">FAQ</h2>

    <section class="pt-lg-3 pb-lg-4 py-4 faqlisting">

		<?php

			foreach($faqlisting as $faq){

				echo '<div>

						<h4 class="mb-md-3 mb-2">'.$faq->faq_title.'</h4>

						<p>'.$faq->faq_description.'</p>

						</div>';

			}

		?>

	</section>

</div>