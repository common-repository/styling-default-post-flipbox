(function( $ ) {

    $(document).ready(function(){

        $(".fsdp-value-settings").hide();
        $(".fsdp-value-settings.general-settings").show("slow");
        $("td.fsdp-button:first").addClass("bt-active");

        $(document).on('click', function( evt ){

            $('tr[fsdp-layouts-only]').each(function(){
                let selected_layout = $("#fsdp-flipbox-layout-type option:selected").val();
                let choose = $(this).attr('fsdp-layouts-only').split(",") ;
                $(this).hide();
                if( choose.includes(selected_layout) == true ){
                    $(this).show();
                }
            });

            $('table[fsdp-layouts-not]').each(function(){
                let selected_layout = $("#fsdp-flipbox-layout-type option:selected").val();
                let choose = $(this).attr('fsdp-layouts-not').split(",") ;
                if( choose.includes(selected_layout) == true ){
                    $(this).hide();
                }
            });
            
        })

            // Add Color Picker to all inputs that have 'color-field' class
            $(function() {
                $(".color-field").wpColorPicker();
            });

            $("td.fsdp-button").on("click", function(){
                
                if( $(this).hasClass("bt-active") ){
                    return;
                }
                    

                let id = $(this).attr('fsdp-id');
                $("td.fsdp-button").removeClass("bt-active");
                $(this).addClass("bt-active");
                let target = 'table.fsdp-value-settings.'+id;
                $("table.fsdp-value-settings").hide("slow");
                $(target).show("slow");
                ;
            });

            // initialize iconpicker
            $("#fsdp-flipbox-fa-icon").iconpicker();

    })

})( jQuery );