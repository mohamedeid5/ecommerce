$(function(){

    $('.addToWishList').on('click', function(e){
        e.preventDefault();

        var productId = $(this).data('product-id');
        var url = $(this).attr('href');
        var isFavored =  $('.product-'+productId).hasClass('fw-900');

        toggleFavored(url, productId, isFavored);

    }); // end addToWishlist


    $('.removeFromWishlist').on('click', function(e){

        e.preventDefault();

        var productId = $(this).data('product-id');
        var url = $(this).attr('href');

        console.log(url);

        if(confirm('are you sure?')) {
            $('.wishlist-product-'+productId).fadeOut(600);

            $.ajax({
                url: url,
                type: 'get',
                data: {
                    productId: productId,
                }
            });
        }

    }); // end removeFromWishlist

});


function toggleFavored(url, productId, isFavored) {

    $('.product-'+productId).toggleClass('fw-900');

    console.log(isFavored);

    if(!isFavored) {
        $('.addToWishlistMessage-'+productId).text('remove from wishlist')
    } else {
        $('.addToWishlistMessage-'+productId).text('add to wishlist')
    }

        $.ajax({

            url: url,
            type: 'get',
            data: {
                'productId': productId,
            }

        });
}

