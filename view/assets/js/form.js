$(document).ready(function(){

    if ($("#radio_tutor").is(":checked")){
        $(".frm_grp_area").show();
    }else{
        $(".frm_grp_area").hide();
    }

    $('input[type=radio][name=es_tut]').change(function() {
        if (this.value == 'tutor') {
            $(".frm_grp_area").show();
        }
        else if (this.value == 'estudiante') {
            $(".frm_grp_area").hide();
        }
    });

    
    $('#materias_txarea').keypress(function( e ) {
        var ew = e.which;
        //alert(ew);
        if(!(ew >= 65 && ew <= 120) && (ew != 32 && ew != 0 && ew != 241
            && ew != 225 && ew != 233 && ew != 237 && ew != 243 && ew != 250)) { 
            e.preventDefault(); 
        }
        if(ew === 32){
            var text = $('#materias_txarea').val();
            text = text.capitalize();
            text = text.replace(/  +/g, ' ');
            $('#materias_txarea').val(text);
        }
    });
    
    
    String.prototype.capitalize = function() {
        return this.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
    };
    
});
