'use strict'


function ajaxRequest(type, request, callback, data = null)
{
  var xhr;

  // Create XML HTTP request.
  xhr = new XMLHttpRequest();
  if (type == 'GET' && data != null)
    request += '?' + data;
  xhr.open(type, request, true);

  // Add the onload function.
  xhr.onload = function ()
  {
    switch (xhr.status)
    {
      case 200:
      case 201:
        console.log(xhr.responseText);
        callback(xhr.responseText);
        break;
      default:
        httpErrors(xhr.status);
    }
  };

  // Send XML HTTP request.
  xhr.send(data);
}





function httpErrors(errorNumber)
{
  switch (errorNumber) {
    case 200:
      $('#errors').html('OK : '+ errorNumber);
      break;
    case 201:
    $('#errors').html('OK + Modification: '+ errorNumber);
    break;
    case 400:
      $('#errors').html('  Bad Request ERROR : '+ errorNumber);
      break;
    case 401:
      $('#errors').html('  Unauthorized ERROR : '+ errorNumber);
      break;
    case 403:
      $('#errors').html(' Forbidden ERROR : '+ errorNumber);
      break;
    case 404:
      $('#errors').html(' Not Found ERROR : '+ errorNumber);
      break;
    case 500:
      $('#errors').html('  Internal Server Error ERROR : '+ errorNumber);
      break;
    case 401:
      $('#errors').html('  Service Unavailable ERROR : '+ errorNumber);
      break;
    default:

  }

  //console.log('ERROR : ' + errorNumber);
}
