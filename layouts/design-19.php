<?php
/**
 * 
 * 
 */

 $html .= '<li class="col-sm-4 fsdp-flip-card fsdp-flipbox-layout-19">
                    <div class="fsdp-flip-card-inner '.$flip_class.'"
                    data-width="'.$width.'"
                    data-height="'.$height.'"
                    data-front-bgColor="'.$front_bgColor.'" 
                    data-front-textColor="'.$front_textColor.'"
                    data-back-bgColor="'.$back_bgColor.'" 
                    data-back-textColor="'.$back_textColor.'"
                    data-bgImage="'.$feature_image.'"
                    data-bgImage2="'.$feature_image2.'"
                    data-front-bgenable="true"
                    data-back-bgenable="'.$bgImage2_enable.'"
                    >
                    <div class="fsdp-flip-card-front">
                            <div class="text position-relative w-100">
                            </div>
                    </div>

                    <div class="fsdp-flip-card-back">
                            <div class="text position-relative w-100">
                                <'.$heading_size.' class="flip-heading">'.$back_title.'</'.$heading_size.'>
                                <p>'.$excerpt.'</p>
                                <a href="'.$link_href.'"><i class="fas fa-arrow-right"></i></a>
                            </div>
                    </div>
                </div>
            </li>';