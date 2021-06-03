$(document).ready( function(){
    // Pegar nome do(s) arquivo(s) upado(s)
    var e = $(".rs-input-file + input:file");
    e.change(function(){
        var fileName = e[0].value.split("\\").pop();
        // e.after("<p>" + fileName + "</p>");
        $("#rs-filename").html(fileName);
        // alert(fileName);
    });

    // Permitir o carregamento de modal com conteúdo externo
    // Utilize
    /* <a href="www.pmt.pi.gov.br" class="rs-open-modal" title="Exibir" data-toggle="modal" data-target="#modalBox" aria-label="Exibir"><i class="material-icons">pageview</i>
    </a> */
    $('.rs-open-modal').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $(".modal-body").html('<iframe width="100%" height="100%" frameborder="0" scrolling="yes" allowtransparency="true" src="'+url+'"></iframe>');
        $('#modalBox .modal-content').css("height", $(window).height() - 56);
    });

    //Altera comportamento do botão de abrir o footer
    $('.rs-btn-footer').click( function(e){
        $(this).toggleClass('rs-clicked');
        $('.rs-display-none').toggle(600);
    });
    // usar div com largura total da tela
    /*$('.rs-width-full').css("width", $(window).width() - 20);
    $(window).resize( function(e){
        $('.rs-width-full').css("width", $(window).width() - 20);
    });*/
    // $("#notifica:checked");
    $("#rs-notifica").click(function(){
        $("#rs-inputs-notificar").toggle(1000);
        $("[for='rs-notifica'] > i").toggleClass("rs-toggle-off");
        // $("[for='rs-notifica'] > i").toggleClass("fa-toggle-on");
    });

    // Load File - imagem
    $("#rs-import-file").change(function() {
        var length = this.files.length;
        if (!length) {
            return false;
        }
        useImage(this);
    });
    // Iniciar o FileReader() e carregar a instância da imagem
    function useImage(img) {
        var file = img.files[0];
        var imagefile = file.type;
        // var match = ["image/jpeg", "image/png", "image/jpg", "application/pdf"];
        // if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]) || (imagefile == match[3]))) {
        //     alert("Extensão de arquivo inválida!");
        // } else {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(img.files[0]);
        // }
    }
    
    // Carregar imagem na view
    function imageIsLoaded(e) {
        // $("#rs-view-file").html("<img src='assets/img/teresina2.jpg' height=80px>");
        // $("#rs-view-file").html("<img src='"+ e.target.result +"' height=80px>");
        $("#rs-view-file img").attr("src", e.target.result);
        $("#rs-container-vwfile").show();
    }




    // Botão de limpar campo de pesquisa de endereço
    $("#btn-clear-srch").click(function(){
        $("#localizacao").val("").focus();
        // $(this).hide();
    });

    // Formatar número de telefone
    $('#ocorrencia-fone1').on('input', function (e) {
        var aux = e.target.value.replace(/\D/g, "");
        
        if (aux.length < 11) {
            aux = aux.replace(/(\d{2})(\d)/,"($1) $2");
            aux = aux.replace(/(\d{4})(\d)/,"$1-$2");
        } else {
            aux = aux.replace(/(\d{2})(\d)/,"($1) $2");
            aux = aux.replace(/(\d{5})(\d)/,"$1-$2");
        }
        e.target.value = aux.substr(0, 15);
        
    });
});