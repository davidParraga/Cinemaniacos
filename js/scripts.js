function mostrarregistro(){
    var formlogin=document.getElementById('formlogin');
    var enlaceregistrar=document.getElementById('enlaceregistrar');
    var formregistro=document.getElementById('formregistro');
    var enlacelogin=document.getElementById('enlacelogin');
    formlogin.style.visibility='hidden';
    formlogin.style.display='none';
    enlaceregistrar.style.visibility='hidden';
    enlaceregistrar.style.display='none';
    formregistro.style.visibility='visible';
    formregistro.style.display='flex';
    enlacelogin.style.visibility='visible';
    enlacelogin.style.display='flex';
    return true;
}

function mostrarlogin(){
    var formlogin=document.getElementById('formlogin');
    var enlaceregistrar=document.getElementById('enlaceregistrar');
    var formregistro=document.getElementById('formregistro');
    var enlacelogin=document.getElementById('enlacelogin');
    formregistro.style.visibility='hidden';
    formregistro.style.display='none';
    enlacelogin.style.visibility='hidden';
    enlacelogin.style.display='none';
    formlogin.style.visibility='visible';
    formlogin.style.display='flex';
    enlaceregistrar.style.visibility='visible';
    enlaceregistrar.style.display='flex';
    return true;
}

