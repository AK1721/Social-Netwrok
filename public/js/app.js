let postId = 0;
let postBodyElement = null;
$('.my-card-post').find('.actions').find('.edit').on('click', function(e){
  e.preventDefault();
  postBodyElement = e.target.parentNode.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.children[0];
  let postBody = postBodyElement.textContent;
  postId = e.target.parentNode.parentNode.dataset['postid'];
  postId = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.dataset['postid']
  $('#post-body').val(postBody);
});

$('#save-post').on('click', function(){
  $.ajax({
    method: 'POST',
    url: urlEdit,
    data: {body: $('#post-body').val(), postId: postId, _token: token}
  })
  .done(function(msg){
    
    $(postBodyElement).text(msg['new-body']);
    console.log(msg['new-body'])
  })
});

$('.like').on('click', function(e){

  e.preventDefault();
  let isLike = e.target.parentNode.parentNode.previousElementSibling == null;
  postId = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.dataset['postid'];
  console.log($(e.target.parentNode).hasClass('liked')); 
  $.ajax({
    method:'POST',
    url: urlLike,
    data: {isLike: isLike, postId: postId, _token: token}
  })
  .done(function(){
    e.target.parentNode.parentNode.previousElementSibling == null? $(e.target.parentNode).hasClass('liked')? $(e.target.parentNode).removeClass('liked'): $(e.target.parentNode).addClass('liked'): $(e.target.parentNode).hasClass('disliked')? $(e.target.parentNode).removeClass('disliked'):$(e.target.parentNode).addClass('disliked')
    
    if(isLike){
      $(e.target.parentNode.parentNode.nextElementSibling.children[0]).removeClass('disliked');
    }else{
      $(e.target.parentNode.parentNode.previousElementSibling.children[0]).removeClass('liked');
    }
  })
});