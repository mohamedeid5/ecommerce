$(function(){

    $('.addToWishList').on('click', function(e){
        e.preventDefault();

        var productId = $(this).data('product-id');
        var url = $(this).attr('href');
        var isFavored =  $('.product-'+productId).hasClass('fw-900');

        toggleFavored(url, productId);

    });
});


function toggleFavored(url, productId) {

    $('.product-'+productId).toggleClass('fw-900');

        $.ajax({

            url: url,
            type: 'get',
            data: {
                'productId': productId,
            }

        });
}
