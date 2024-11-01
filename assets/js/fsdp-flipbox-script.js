(function($){

    /**
     * convert hexadecimal color values to RGB 
     */
    function hexToRgb(hex) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
          r: parseInt(result[1], 16),
          g: parseInt(result[2], 16),
          b: parseInt(result[3], 16)
        } : null;
    }

    $(document).ready(function(){
        /** Flip effetc using jquery flip */
        $(".fsdp-flip-card-inner.flip-horizontal-top").flip(
            {
                trigger:'hover',
                front:'.fsdp-flip-card-front',
                back:'.fsdp-flip-card-back',
                axis:'x',
            }
        );
        $(".fsdp-flip-card-inner.flip-vertical-right").flip(
            {
                trigger:'hover',
                front:'.fsdp-flip-card-front',
                back:'.fsdp-flip-card-back',
                axis:'y',
            }
        );

        $(".fsdp-flip-card-inner.flip-horizontal-top-reverse").flip(
            {
                trigger:'hover',
                front:'.fsdp-flip-card-front',
                back:'.fsdp-flip-card-back',
                axis:'x',
                reverse:true
            }
        );
        $(".fsdp-flip-card-inner.flip-vertical-right-reverse").flip(
            {
                trigger:'hover',
                front:'.fsdp-flip-card-front',
                back:'.fsdp-flip-card-back',
                axis:'y',
                reverse:true
            }
        );

        // process data fields for rendering custom data
        $(".fsdp-flip-card-inner").each( function(){
            $this = $(this);
            var height = $this.attr('data-height');
            if( height != null || height != '' ){
                $this.css({"height":height});
                $this.parent('li').css({"height": height });
            }

            if( ($this.attr('data-front-bgColor')).indexOf('#') > -1 ){
                let fbgc = $this.attr('data-front-bgColor');
                $this.find('.fsdp-flip-card-front').css({"background-color": fbgc});
            }
            if( ($this.attr('data-back-bgColor')).indexOf('#') > -1 ){
                let fbgc = $this.attr('data-back-bgColor');
                $this.find('.fsdp-flip-card-back').css({"background-color": fbgc});
            }
            if( ($this.attr('data-front-textColor')).indexOf('#') > -1 ){
                let fbgc = $this.attr('data-front-textColor');
                $this.find('.fsdp-flip-card-front .flip-heading, .fsdp-flip-card-front p').css({"color": fbgc});
            }
            if( ($this.attr('data-back-textColor')).indexOf('#') > -1 ){
                let fbgc = $this.attr('data-back-textColor');
                $this.find('.fsdp-flip-card-back .flip-heading, .fsdp-flip-card-back p').css({"color": fbgc});
            }

                let imageSrc = $this.attr('data-bgImage');
                let imageSrc2 = $this.attr('data-bgImage2');
                let fbgc = $this.attr('data-front-bgColor');
                let bbgc = $this.attr('data-back-bgColor');
                let bg_enable = $this.attr('data-front-bgenable');
                let bg2_enable = $this.attr('data-back-bgenable');
                let rgba = hexToRgb( fbgc ) ;
                let rgba2 = hexToRgb( bbgc ) == null ? rgba : hexToRgb( bbgc ) ;

                    if( bg_enable != "false" && imageSrc != '' ){
                        $this.find('[class*="fsdp-flip-card-front"]').css( {"background":"url("+imageSrc+")"} );
                        $this.find('[class*="fsdp-flip-card-front"]').css( {"background-size":"cover"} );
                    }

                    if( rgba != null ){
                        $this.find('[class*="fsdp-flip-card-front"]').css( {"box-shadow":"inset 100px 1000px 1000px rgba("+rgba.r+","+rgba.g+","+rgba.b+",0.6)"} );
                    }

                    if( bg2_enable != "false" && imageSrc2 != '' ){
                        $this.find('[class*="fsdp-flip-card-back"]').css( {"background":"url("+imageSrc2+")"} );
                        $this.find('[class*="fsdp-flip-card-back"]').css( {"background-size":"cover"} );
                        $this.find('[class*="fsdp-flip-card-back"] a.flipbox-more-link').css( {'background-color':rgba2} );
                    }

                    if( $this.parent().hasClass('fsdp-flipbox-layout-1') ){
                        $this.find('[class*="fsdp-flip-card-front"]').css({"box-shadow":"0 0 0 1px "+fbgc});
                        $this.find('[class*="fsdp-flip-card-front"]').css({"border":"2px solid white"});
                        $this.find('[class*="fsdp-flip-card-back"]').css({"box-shadow":"0 0 0 1px "+fbgc});
                        $this.find('[class*="fsdp-flip-card-back"]').css({"border":"2px solid white"}); 
                    }

                    if( rgba2 != null ){
                        $this.find('[class*="fsdp-flip-card-back"]').css( {"box-shadow":"inset 1000px 1000px 1000px rgba("+rgba2.r+","+rgba2.g+","+rgba2.b+",0.6)"} );
                    }


                    $this.find('[class*="fsdp-flip-card-front"]').css( {"background-color":fbgc} );
                    $this.find('[class*="fsdp-flip-card-back"]').css( {"background-color":bbgc} );

            // reset the machine
            $(this).css( {"perspective":"initial", "transform-style":"flat" } );
            
        })

    });

})(jQuery)