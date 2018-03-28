'use strict';

var login = 'cir2';

ajaxRequest('GET','php/request.php/photos/',displayPhotos);









function displayPhotos(responseText){
  var data=JSON.parse(responseText);
  for(var i=0;i<data.length;i++){
    /*var div=document.getElementById("div");
    var element;*/
    var div= document.createElement("div");
    var a=document.createElement("a");
    var img=document.createElement("img");
    a.appendChild(img);
    div.appendChild(a);
    div.className="col-xs-2 col-md-2";
    a.href="#";
    a.target="_self";
    a.className="thumbnail";

    img.src=data[i].src;
    img.id="photo-"+data[i].id;
    img.alt=data[i].title;
    img.title = img.alt;
    img.style.width="100%";
    img.addEventListener("click",function(event){
      event.preventDefault();
      var id=event.target.id.substr(6);
      ajaxRequest('GET','php/request.php/photos/'+id,loadPhoto);
      ajaxRequest('GET','php/request.php/comments/'+id,loadComments);
    });
    document.getElementById("thumbnails").appendChild(div);



  }




/*  $('#comment-sent').off('click').click(function (event)
  {

    event.preventDefault();
      var id=event.target.id.substr(6);
    ajaxRequest('POST', 'php/request.php/comments/'+id, function ()
    {
      ajaxRequest('GET', 'php/request.php/comments/'+id, loadComments);
    }, '&text=' + $('#add-commentaire-area').val());
  });





*/
};

function loadPhoto(responseText)
{
  console.log(responseText);
  var data=JSON.parse(responseText);
  var text="<a href='#' class='thumbnail'><img id="+"photo-"+data[0].id+" src="+data[0].src+"></a>";
//  console.log(data[0].id);
  $('#photo2').html(text);
  $('#photo').attr('photoid', data[0].id);
}

function loadComments(responseText)
{
  console.log(responseText);
  var data=JSON.parse(responseText);
  $('#comments').html('');
  for (var i = 0; i < data.length; i++)
  {
    var div = document.createElement("div");
    div.className="input-group";
    var text ="  <span class="+"input-group-addon"+">"+data[i].userLogin+" </span><p  class="+"form-control"+" id="+"commentaire-area >"+data[i].comment+"</p>";
    //console.log(data[i].photoId);
    console.log(data[i].comment);
    div.innerHTML = text;
    document.getElementById("comments").appendChild(div);

  }

}
