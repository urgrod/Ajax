'use strict';

var url = document.location.href;
var login = url.substring(45);;


ajaxRequest('GET','php/request.php/photos/',displayPhotos);

/*
  fonction permettant d'afficher la gallerie photo complete
  parametre entree: - reponse du serveur
*/

function displayPhotos(responseText){
  var data=JSON.parse(responseText);
  for(var i=0;i<data.length;i++){
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
};


//permet d'ajouter les commentaires en base lors du click du bouton d'envoi
$('#comment-send').unbind('click').click(function (event)
{
  event.preventDefault();
  var  photoId = $('#photo2 img').attr('photoid');
  ajaxRequest('POST', 'php/request.php/comments/', function (val)
  {
    ajaxRequest('GET', 'php/request.php/comments/'+photoId, loadComments);
  }, 'photoId='+ photoId + '&text= '+ $('#add-commentaire-area').val());
  $('#add-commentaire-area').val('');
});



/*
fonction permettant permettant de charger une photo selon son id
affiche le panel du zoom de la photo ainsi que le panel d'ajout et de visualisation des commentaires lors du click sur une photo dans la gallerie
parametre d'entree: -reponse du serveur

*/
function loadPhoto(responseText)
{
  var data=JSON.parse(responseText);
  var text="<a href='#' class='thumbnail'><img id="+"photo-"+data[0].id+" src="+data[0].src+"></a>";
  $('#photo2').html(text);
  $('#photo2 img').attr('photoid', data[0].id);
  $('#photo-title').html(data[0].title);
  $('#panel-photo').css('visibility', 'visible');
  $('#panel-add-comments').css('visibility', 'visible');


}

/*
fonction permettant de charger les commentaires lies a la photo
parametre d'entree: -reponse du serveur
*/

function loadComments(responseText)
{
  var data=JSON.parse(responseText);
  $('#comments').html('');
  for (var i = 0; i < data.length; i++)
  {
    var div = document.createElement("div");
    div.className="input-group";

    var text ='<div class = "panel panel-default"><div class="panel-body">'+
    '<strong>'+ data[i].userLogin + "</strong>:" +data[i].comment +
    '&nbsp<a><span id=del' + data[i].id +
    ' class="glyphicon glyphicon-trash pull-right" aria-hidden="true"></a>' +
    '</div></div>';

    div.innerHTML = text;
    document.getElementById("comments").appendChild(div);

    $('#del'+data[i].id).unbind('click').click(function (event)
    {
      var id = event.target.id.substr(3);
      var photoId = $('#photo2 img').attr('photoid');
      ajaxRequest('DELETE', 'php/request.php/comments/'+id +'?login=' + login, function ()
      {
        ajaxRequest('GET', 'php/request.php/comments/'+photoId, loadComments);
      });

    });

    $('#photo-close').unbind('click').click(function(event){
      $('#panel-photo').css('visibility', 'hidden');
      $('#panel-add-comments').css('visibility', 'hidden');
    });

  }

}

/*=======================================================*/
