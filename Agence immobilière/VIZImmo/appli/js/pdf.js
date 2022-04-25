let doc = new jsPDF();
window.onload = function () {
    document.getElementById("download")
        .addEventListener("click", () => {
			let image1= document.querySelector(".image_Reference");
			const coord = document.getElementById("coord");
			let logo=document.querySelector(".logoimage");
			let caracteristique=document.querySelector(".reference_Bien");
			
			
			


			doc.setFontSize(40)
			doc.text(55, 15, "VIZIMMO");
			doc.setFontSize(10);
			doc.setFontSize(20);
			doc.text(85,60,"Caracterisitiques du bien :" );
			doc.setFontSize(10);
			let info= listToString(caracteristique);
			let coordonnees = listToString(coord,1);
			doc.text(55,25,coordonnees);
			doc.text(85,70,info);
			
			addImg(logo,5,5,40,30);
			addImg(image1,0,60,80,60);
			doc.save("VIZIMMO.pdf");
        })

}

function addImg(img,x,y,w,h) {
    let canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;
    let ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);
    var dataURL = canvas.toDataURL("image/jpeg");

    let imgData = dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
	doc.addImage(imgData, 'JPEG',x, y, w, h );
}
function listToString(ul,decalage){
  let str = "";
  // On parcourt les enfants de la liste
  ul.childNodes.forEach(e=>{
    if(e.localName != undefined){
		// Si c'est un titre on l'ajoute
		if(e.localName == "h1"){ 
			str += e.innerText+"\n";
		}
		// Si c'est un element de la liste on le décale puis on l'ajoute
		if(e.localName == "li") {
			for(let i = 0; i < decalage; i++) str += " ";
			str += "- "+e.innerText+"\n";
			}
		// Si c'est une liste on rappelle récursivement notre fonction
		if(e.localName == "ul") str += listToString(e,decalage+2);
		
	}
  });  
  return str;

}