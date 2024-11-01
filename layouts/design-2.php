<?php
/***
*/

$html .= '<li class="col-sm-4 fsdp-flip-card fsdp-flipbox-layout-2">
			<div class="fsdp-flip-card-inner '.$flip_class.'"
			data-width="'.$width.'"
			data-height="'.$height.'"
			data-front-bgColor="'.$front_bgColor.'" 
			data-front-textColor="'.$front_textColor.'"
			data-back-bgColor="'.$back_bgColor.'" 
			data-back-textColor="'.$back_textColor.'"
			data-bgImage="'.$feature_image.'"
			data-bgImage2="'.$feature_image2.'"
			data-front-bgenable="'.$bgImage_enable.'"
			data-back-bgenable="'.$bgImage2_enable.'"
			>
	  								<div class="fsdp-flip-card-front">
			  							<div class="text position-relative">
			  								<i class="'.$fa_icon.'"></i>
											  <'.$heading_size.' class="flip-heading">'.$title.'</'.$heading_size.'>
											  <p>'.$front_subheading.'</p>
				  						</div>
				  					</div>

				  					<div class="fsdp-flip-card-back">
									  <div class="text position-relative w-100">
										  <p>'.$excerpt.'</p>
										  <div><a href="'.$link_href.'" class="fsdp-flipbox-more-link">'.$link_text.'</a></div>
					  					</div>
				  					</div>
			  					</div>
	  						</li>';