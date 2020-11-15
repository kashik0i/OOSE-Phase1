<?php

#$link = "./VolunteerController.php?id=3";
#$id=3;
echo "<script>

function Get_xhr(link)
{
// 1. Create a new XMLHttpRequest object
let xhr = new XMLHttpRequest();

// 2. Configure it: GET-request for the URL /article/.../load
xhr.open('GET', link);

// 3. Send the request over the network
xhr.send();

// 4. This will be called after the response is received
xhr.onload = function () {
    
  if (xhr.status != 200) {
    // analyze HTTP status of the response
    alert(`Error \${xhr.status}: \${xhr.statusText}`); // e.g. 404: Not Found
  } else {
    // show the result
    //alert(`Done, got \${xhr.response.length} bytes`); // response is the server
    document.getElementById('dynamic').innerHTML = xhr.response;
  }
};
console.log('yeet');
xhr.onprogress = function (event) {
  if (event.lengthComputable) {
    alert(`Received \${event.loaded} of \${event.total} bytes`);
  } else {
    alert(`Received \${event.loaded} bytes`); // no Content-Length
  }
};

xhr.onerror = function () {
  alert('Request failed');
};

console.log('yeet');
return false;
}
</script>
<div id='dynamic'></div>

";
