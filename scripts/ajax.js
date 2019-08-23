
$(function(){
  $('#menu-list a, #profile').click(function(e) {
    e.preventDefault();
    var pageName = $(this).attr('data_target');
    $.ajax({
      url: pageName,
      cache: false,
      success: function(html){
        $("#content").html(html);
      }
    });
  });
});
