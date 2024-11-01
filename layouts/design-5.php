<?php
/**
 * 
 */

 $html .= '<li class="col-sm-4  fsdp-flip-card fsdp-flipbox-layout-5">
 <div class="fsdp-flip-card-inner '.$flip_class.'"
                            data-width="'.$width.'"
                            data-height="'.$height.'"
                            data-front-bgColor="" 
                            data-front-textColor=""
                            data-back-bgColor="'.$back_bgColor.'" 
                            data-back-textColor="'.$back_textColor.'"
                            data-bgImage="'.$feature_image.'"
                            data-bgImage2="'.$feature_image2.'"
                            data-front-bgenable="'.$bgImage_enable.'"
                            data-back-bgenable="'.$bgImage2_enable.'"
                                 >
                    <div class="fsdp-flip-card-front">
         
     </div>
     <div class="fsdp-flip-card-back">
        <div class="text position-relative w-100">
         <'.$heading_size.' class="flip-heading">'.$back_title.'</'.$heading_size.'>
         <p>'.$excerpt.'</p>
         <div><a href="'.$link_href.'" class="fsdp-flipbox-more-link">'.$link_text.'</a></div>
         </div>
     </div>
 </div>
</li>';