'use strict';

ajaxRequest('GET','php/request.php/photos/',displayPhotos);

function displayPhotos(responseText)
{
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
      // ajaxRequest('Get','php/request.php/comments/'+id,loadComments);
      ajaxRequest('Get','php/request.php/comments/'+id,sendComments);
      // $.cookie('current-id') = id;

    });
    document.getElementById("thumbnails").appendChild(div);
  }
}

function loadPhoto(responseText)
{
  console.log(responseText);
  var data=JSON.parse(responseText);
  //var div= document.createElement("div");
  //div.className="panel panel-default";
  //div.hinnerHTML='<div class="panel-body"><h2>'+data[i].title+'</h2><div class="row"><div class="col-xs-12 col-md-12"><a href="#" class="thumbnail"><img src="'+data[i].src+'"></a></div></div></div>';
  //document.getElementById("photo").appendChild(div);
  var text="<a href='#' class='thumbnail'><img id="+"photo-"+data[0].id+" src="+data[0].src+"></a>";

  console.log(data[0].id);
  $('#photo2').html(text);
  $('#photo').attr('photoid', data[0].id);
}

function loadComments(responseText)
{
  console.log(responseText);
  var data=JSON.parse(responseText);
  //var div= document.createElement("div");
  //div.className="panel panel-default";
  //div.hinnerHTML='<div class="panel-body"><h2>'+data[i].title+'</h2><div class="row"><div class="col-xs-12 col-md-12"><a href="#" class="thumbnail"><img src="'+data[i].src+'"></a></div></div></div>';
  //document.getElementById("photo").appendChild(div);

  for (var i = 0; i < data.length; i++) {
    var div= document.createElement("div");
    div.className="input-group";
    var text ="  <div class="+"input-group"+"><span class="+"input-group-addon"+">"+data[i].userLogin+" </span><p  class="+"form-control"+" id="+"commentaire-area >"+data[i].comment+"</p></div>";
    console.log(data[i].comment);
    div.innerHTML = text;

    document.getElementById("comments").appendChild(div);
  }
}


function sendComments(responseText)
{
  $('#comment-send').click(function() {

    var commentaire = $('#add-commentaire-area').val();

    var cookieLogin = $.cookie('login');
    var cookieId = $.cookie('current-id');

    console.log(commentaire);


    if (typeof cookieLogin == 'undefined' && typeof cookieId == 'undefined') {
      cookieLogin ='';
      cookieId ='';
    }

    ajaxRequest('POST', 'php/request.php/comments', loadComments, 'commentaire=' + commentaire + "&id_image=" + cookieId);


    $('#commentaire-area').val('');
  });
}
