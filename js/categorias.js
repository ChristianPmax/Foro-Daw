function creaCategoria() {

	let cate = [];
	cate.push(document.getElementById("tituloCat").value);
	cate.push(document.getElementById("descCat").value);


	const llamada = new XMLHttpRequest();

	//**********************************************
	//recibir la respuesta
	llamada.onload = function() {

		if (JSON.parse(this.responseText) != -1) {
		    	
				var tbodyTabla = document.getElementById("tabCat");
				var fila = document.createElement("tr");
				var celda = document.createElement("td");

				var titu = document.createTextNode(cate[0]);

				celda.appendChild(titu);

				var etiqueta = document.createElement("span");
				etiqueta.setAttribute("class","text-secondary");
				var desc = document.createTextNode("-"+cate[1]);
				etiqueta.appendChild(desc);

				celda.appendChild(etiqueta);

				fila.appendChild(celda);

			fila.setAttribute("onclick","location.href='temas.php?cate="+JSON.parse(this.responseText)+"'");
		    	
			tbodyTabla.appendChild(fila);

		}else{

			alert("Error en la insercion");
		}
    }

	//**********************************************

	//**********************************************

	//construir la consulta
	llamada.open("POST", "registraCategoria.php", true);
	llamada.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//ejecutar la consulta
  	llamada.send("categoria="+JSON.stringify(cate));
	//**********************************************	

}