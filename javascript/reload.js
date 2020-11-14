var xhr = new XMLHttpRequest();
function reloading(){
    xhr.open('GET', '../script/messages.php');
    xhr.send(null);
    xhr.onreadystatechange = function() {
        var DONE = 4;
        var OK = 200;
        if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
                document.getElementById('container_messages').innerHTML = xhr.responseText;
            } else {
            console.log('Error: ' + xhr.status);
            }
        }
    }
}
setInterval(reloading,100);    