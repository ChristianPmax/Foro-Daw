class FilaCategoria extends HTMLElement{



	constructor(){

		super();

		this.attachShadow({

			mode:"open"

		})

		this.atributoTit="";
		this.atributoDescr="";

		this.template = document.getElementById("plantillaFilaCat");
		this.plantilla = document.importNode(this.template.content,true);
	}

	render(){
		this.shadowRoot.appendChild(this.plantilla);
		this.shadowRoot.getElementById("titulo").innerHTML = this.atributoTit;
		this.shadowRoot.getElementById("desc").innerHTML = this.atributoDescr;
	}

	connectedCallback(){

		this.render();
	}

	attributeChangedCallback(nomAttrib, valViejo, valNuevo){

		if (nomAttrib==="tit") {

			this.atributoTit = valNuevo;
			this.render();

		}

		if (nomAttrib === "descr") {

			this.atributoDescr = valNuevo;
			this.render();

		}
	}

	static get observedAttributes(){

		return['tit','descr'];
	}
}

window.customElements.define("foro-fila-catregoria",FilaCategoria);