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
        window.location.href = 'codex.php?id='+mscriptId;
        
    });
    
    $('#gallery-slider').Thumbelina({
        orientation:'vertical',         // Use vertical mode (default horizontal).
        $bwdBut:$('#gallery-slider .top'),     // Selector to top button.
        $fwdBut:$('#gallery-slider .bottom')   // Selector to bottom button.
    });
    
    $('#imageFullScreen').smartZoom({'containerClass':'zoomableContainer'});				
    $('#topPositionMap,#leftPositionMap,#rightPositionMap,#bottomPositionMap').bind("click", moveButtonClickHandler);
    $('#zoomInButton,#zoomOutButton').bind("click", zoomButtonClickHandler);

    function zoomButtonClickHandler(e){
    var scaleToAdd = 0.8;
        if(e.target.id === 'zoomOutButton')
                scaleToAdd = -scaleToAdd;
        $('#imageFullScreen').smartZoom('zoom', scaleToAdd);
    }

    function moveButtonClickHandler(e){
        var pixelsToMoveOnX = 0;
        var pixelsToMoveOnY = 0;

        switch(e.target.id){
                case "leftPositionMap":
                        pixelsToMoveOnX = 50;	
                break;
                case "rightPositionMap":
                        pixelsToMoveOnX = -50;
                break;
                case "topPositionMap":
                        pixelsToMoveOnY = 50;	
                break;
                case "bottomPositionMap":
                        pixelsToMoveOnY = -50;	
                break;
        }
        $('#imageFullScreen').smartZoom('pan', pixelsToMoveOnX, pixelsToMoveOnY);
    };
    
    $('.galleryItem').click(function() {
        $(this).toggleClass('imageSelectBorder');
        $("#imageFullScreen").attr('src', 'image.php?img_path=' + $(this).data('path'));
        $("#imageFullScreen").attr('data-folioid', $(this).data('folioid'));
        $('#imageFullScreen').smartZoom('destroy');
        $('#imageFullScreen').smartZoom({'containerClass':'zoomableContainer'});				
        $('#topPositionMap,#leftPositionMap,#rightPositionMap,#bottomPositionMap').bind("click", moveButtonClickHandler);
            $('#zoomInButton,#zoomOutButton').bind("click", zoomButtonClickHandler);
    });
    
    $('#bookshelf').delegate('#juxtaBtn', 'click', function(){
        var folioIdToBeAdded = $('#imageFullScreen').data('folioid');
        $.ajax({    
            url: 'saveArchives.php', //current page
            type: 'GET',
            data: {folio_id: folioIdToBeAdded, is_juxta: 'true' },
            dataType: "json",
            contentType: "application/json",                    
            success: function (msg) {
                //Add this folio to bookshelf                                 
                alert(msg.statusMsg);
                $.get('bookshelf.php', function(data){
                    $('#bookshelf').html(data);
                });
            }
        });
    });
    
    $('#bookshelf').delegate('#archiveBtn', 'click', function(){
        var folioIdToBeAdded = $('#imageFullScreen').data('folioid');
        $.ajax({    
            url: 'saveArchives.php', //current page
            type: 'GET',
            data: {folio_id: folioIdToBeAdded, is_juxta: 'false' }, //false says its for juxtaposing
            dataType: "json",
            contentType: "application/json",                    
            success: function (msg) {
                alert(msg.statusMsg);
            }
        });
    });

    $.ajax({
        url: 'bookshelf.php',
        type: 'GET',
        dataType: 'html',
        success: function(data){
            $('#bookshelf').html(data);
        }

    });


});