function nouveauclient()
{
    var xmlhttp;
    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    }
    else
    {
        xmlhttp = ActiveXobject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange = function()
    {
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
          document.getElementById('d_bottom').innerHTML = xmlhttp.responseText;
      }
    };
    xmlhttp.open("GET","nouveauclient.php",true);
    xmlhttp.send();
}


