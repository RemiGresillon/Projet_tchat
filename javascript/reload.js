var xhr = new XMLHttpRequest();
function reloading(){
    xhr.open('GET', '../script/messages.php');
    xhr.send(null);
    xhr.onreadystatechange = function() {
        var DONE = 4; // readyState 4 means the request is done.
        var OK = 200; // status 200 is a successful return.
        if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
                console.log(xhr.responseText); // 'This is the returned text.'
                document.getElementById('container_messages').innerHTML = xhr.responseText;

            } else {
            console.log('Error: ' + xhr.status); // An error occurred during the request.
            }
        }
    }
}
setInterval(reloading,100);    