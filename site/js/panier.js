function add(Id,image){
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
          document.getElementById('jax').innerHTML = xmlhttp.responseText;
          var b = document.getElementById('block');
          b.style.display = "block";
          b.style.width = screen.width + "px";
          var d = document.getElementById('dmsg');
          d.style.display = "block";
          d.style.top = ((screen.height / 2) - 200) + "px";
          d.style.left = ((screen.width / 2) - 200) + "px";
          document.getElementById('msgimg').setAttribute("src","../administration/images/produits/" + image);
      }
    };
    xmlhttp.open("GET","panier.php?id="+ Id,true);
    xmlhttp.send();
    
}