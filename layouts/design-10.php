<?php
/**
 * 
 */

 $html .= '	<li class="col-sm-4 fsdp-flip-card fsdp-flipbox-layout-10">
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
                        <div class="text position-relative w-100">
                            <i class="'.$fa_icon.'"></i>
                            <'.$heading_size.' class="flip-heading">'.$title.'</'.$heading_size.'>
                        </div>
                    </div>

                    <div class="fsdp-flip-card-back">
                        <div class="text position-relative w-100">
                            <i class="'.$fa_icon.'"></i>
                            <p>'.$excerpt.'</p>
                        </div>
                    </div>
                </div>
            </li>';