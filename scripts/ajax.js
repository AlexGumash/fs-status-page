
$(function(){
  $.get( "../pages/news.php", function( data ) {
    $( "#content" ).html( data );
  });

  $('#menu-list a, #profile').click(function(e) {
    e.preventDefault();
    var pageName = $(this).attr('data_target');
    $.ajax({
      url: pageName,
      cache: true,
      success: function(html){
        $("#content").html(html);
      }
    });
  });

});
