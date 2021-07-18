

jQuery(document).ready(function( $ ) {

	$('#cat_filter').change(function(){
    if ($(this).val() !== 'all') {
      $('.kitty-cat').each(function(){
        $(this).hide();
      });
      $('.cat-'+$(this).val()).show();
    } else {
      $('.kitty-cat').each(function(){
        $(this).show();
      });
    }

  });

  $('.grid a').simpleLightbox();


});
