$(document).ready(function(){

	
    
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
    
    $.ajax({
        url: 'bookshelf.php',
        type: 'GET',
        dataType: 'html',
        success: function(data){
            $('#bookshelf').html(data);
        }

    });


});