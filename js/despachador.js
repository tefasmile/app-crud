/***LINKS***/
//https://es.wikipedia.org/wiki/Anexo:C%C3%B3digos_de_estado_HTTP
//https://es.wikipedia.org/wiki/Multipurpose_Internet_Mail_Extensions
//http://sites.utoronto.ca/webdocs/HTMLdocs/Book/Book-3ed/appb/mimetype.html

//Constantes
var READY_STATE_COMPLETE = 4;
var OK = 200;

//Variables
var ajax = null;
var btnInsertar = document.querySelector('#insertar');
var precarga = document.querySelector('#precarga');
var respuesta = document.querySelector('#respuesta');

//Funciones
function objetoAJAX () {
	if(window.XMLHttpRequest) {
		return new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
}

function enviarDatos () {
	precarga.style.display = 'block';
	precarga.innerHTML = "<img src='img/loader.gif'/>";

	if(ajax.readyState == READY_STATE_COMPLETE){
		if(ajax.status == OK){
			//console.log(ajax);
			//alert('probandoo!');
			//alert(ajax.responseText);
			precarga.innerHTML = null;
			precarga.style.display = "none";
			respuesta.style.display = "block";
			respuesta.innerHTML = ajax.responseText;

			//condicionales de ayuda para desencadenar los eventos necesarios para cada uno de lo modulos
			if(ajax.responseText.indexOf("data-insertar")>-1)
			{
				document.querySelector("#alta-heroe").addEventListener("submit",insertarHeroe);
			}

			if(ajax.responseText.indexOf("data-recargar")>-1)
			{
				setTimeout(window.location.reload(),3000);
			}
		}
		else
		{
			//console.log(ajax);
			//alert('no hay nada');
			alert('El servidor no contesto ' + ajax.status + ": " + ajax.statusText);
		}

		//console.log(ajax);
	}
}

function ejecutarAJAX (datos){
	ajax = objetoAJAX();
	ajax.onreadystatechange = enviarDatos;
	ajax.open("POST","controlador.php");
	/*
	https://es.wikipedia.org/wiki/Multipurpose_Internet_Mail_Extensions#MIME-Version
	http://sites.utoronto.ca/webdocs/HTMLdocs/Book/Book-3ed/appb/mimetype.html
	*/
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send(datos);
}

function insertarHeroe(evento) 
{
	//alert("Procesa formulario");

	evento.preventDefault();
	/*console.log(e);
	console.log(e.target);
	console.log(e.target[0]);
	console.log(e.target.length);*/

	var nombre = new Array();
	var valor  = new Array();
	var hijosForm = evento.target;
	var datos = "";
	
	//empieza en 1 por etiqueta fieldset
	//construccion dinamica de cadena de datos con for
	for(var i=1; i<hijosForm.length; i++)
	{
		nombre[i] = hijosForm[i].name;
		valor[i] = hijosForm[i].value;

		datos += nombre[i]+ "=" +valor[i]+ "&";
		//console.log(datos);
	}
	ejecutarAJAX(datos);
}

function altaHeroe (evento) {
	evento.preventDefault();
	//alert('funciona');
	var datos = "transaccion=alta";
	ejecutarAJAX(datos);
}

function CargarDocumento () {
	btnInsertar.addEventListener("click",altaHeroe);
}

//Eventos
window.addEventListener('load',CargarDocumento);