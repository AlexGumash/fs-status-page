$(function(){
  $('#create-news-button').click(function() {
    $('.create-news-form').toggle()
  })

  $('.team').click(function() {
    $(this).children('.statuses').toggle()
  })
});
