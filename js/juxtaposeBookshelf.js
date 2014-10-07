$(document).ready(function(){

     $('#bookshelf').delegate('.fa', 'click', function () {
        $('#bookBody').slideToggle('2000',"swing", function () {
        //Animation complete
        });
        $(".fa").toggleClass("fa-caret-square-o-down fa-caret-square-o-up");
    });
  
    $('#bookshelf').delegate('.delButton', 'click', function(event) {
        event.stopPropagation();
        var delBtn = $(event.target);
        var folioToBeDeleted = delBtn.parent().find('h4').attr('data-folioid');
        $.ajax({
            url: 'deleteBookshelfFolio.php',
            type: 'GET',
            data: {folio_id : folioToBeDeleted },
            dataType: 'json',
            contentType: 'application/json',    
            success: function(msg){
                //$('#bookshelf').html(data);
                if(msg.statusNum == 201){
                    alert(msg.statusMsg);
                }else{
                    delBtn.parents('.myBook').fadeOut();
                }
            }
        });
        
    });

    $('#bookshelf').delegate('.codexButton', 'click', function(event) {
        event.stopPropagation();
        var codexButton = $(event.target);
        var mscriptId = codexButton.parent().find('h4').attr('data-mscriptid');
        var folioId = codexButton.parent().find('h4').attr('data-folioid');
        window.location.href = 'codex.php?id='+mscriptId+'&folio_id='+folioId;
    });

    //No action for these two buttons
    
    // $('#bookshelf').delegate('#juxtaBtn', 'click', function(){
    //     var folioIdToBeAdded = -1 ;
    //     //Do validation and get proper folio id
    //     if( $('#lpage').hasClass('imageSelectBorder') && $('#rpage').hasClass('imageSelectBorder') ){
    //         alert('Select only one folio at a time');
    //         return;
    //     }else if($('#lpage').hasClass('imageSelectBorder')){
    //         if( $('#lpage').data('obj').pageNum === 'x'){
    //             alert("You have selected missing folio. Please select existing folio. ");
    //             return;
    //         }else{
    //             folioIdToBeAdded = $('#lpage').data('obj').pageId ;
    //         }
    //     }else if($('#rpage').hasClass('imageSelectBorder')){
    //         if( $('#rpage').data('obj').pageNum === 'x'){
    //             alert("You have selected missing folio. Please select existing folio. ");
    //             return;
    //         }else{
    //             folioIdToBeAdded = $('#rpage').data('obj').pageId ;
    //         }
    //     }else{
    //         alert('No folio selected. Please select one.');
    //         return;
    //     }

    //     $.ajax({    
    //         url: 'saveArchives.php', //current page
    //         type: 'GET',
    //         data: {folio_id: folioIdToBeAdded, is_juxta: 'true' },
    //         dataType: "json",
    //         contentType: "application/json",                    
    //         success: function (msg) {
    //             //Add this folio to bookshelf                                 
    //             alert(msg.statusMsg);
    //             $.get('bookshelf.php', function(data){
    //                 $('#bookshelf').html(data);
    //             });
    //         }
    //     });
    // });
    
    // $('#bookshelf').delegate('#archiveBtn', 'click', function(){
    //     var folioIdToBeAdded = -1 ;
    //     //Do validation and get proper folio id
    //     if( $('#lpage').hasClass('imageSelectBorder') && $('#rpage').hasClass('imageSelectBorder') ){
    //         alert('Select only one folio at a time');
    //         return;
    //     }else if($('#lpage').hasClass('imageSelectBorder')){
    //         if( $('#lpage').data('obj').pageNum === 'x'){
    //             alert("You have selected missing folio. Please select existing folio. ");
    //             return;
    //         }else{
    //             folioIdToBeAdded = $('#lpage').data('obj').pageId ;
    //         }
    //     }else if($('#rpage').hasClass('imageSelectBorder')){
    //         if( $('#rpage').data('obj').pageNum === 'x'){
    //             alert("You have selected missing folio. Please select existing folio. ");
    //             return;
    //         }else{
    //             folioIdToBeAdded = $('#rpage').data('obj').pageId ;
    //         }
    //     }else{
    //         alert('No folio selected. Please select one.');
    //         return;
    //     }

    //     $.ajax({    
    //         url: 'saveArchives.php', //current page
    //         type: 'GET',
    //         data: {folio_id: folioIdToBeAdded, is_juxta: 'false' }, //false says its for juxtaposing
    //         dataType: "json",
    //         contentType: "application/json",                    
    //         success: function (msg) {
    //             alert(msg.statusMsg);
    //         }
    //     });
    // });

    $('#bookshelf').delegate('#jxtAndCmpBtn', 'click', function(){
        var folio_ids = [];
        $('#bookshelf').find('input:checkbox').each(function(){
            if($(this).is(':checked') ){
                folio_ids.push($(this).parent().children('h4').data('folioid'));
            }
        });
        window.location.href = 'juxtapose.php?folio_ids='+folio_ids.toString();
    
    });
    

});