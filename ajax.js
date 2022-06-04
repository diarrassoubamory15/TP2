function ajax(){
    var xhr = null;

    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    //on definit l'appel de la fonction au retour serveur
    xhr.onreadystatechange = function(){
        alert_ajax(xhr);
    };
}