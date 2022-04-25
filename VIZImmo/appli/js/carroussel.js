var tableauImage = new Array("../../../img/Appart/A1/1.jpg","../../../img/Appart/A1/2.jpg","../../../img/Appart/A1/3.jpg","../../../img/Appart/A1/4.jpg");
var numero = 0;

function ChangeSlide(sens){
    numero = numero + sens;
    if (numero<0)
        numero = tableauImage.length -1;
    if (numero > tableauImage.length -1)
        numero = 0;
    document.getElementById("defiler").src = tableauImage[numero];
}
setInterval("ChangeSlide(1)",10000);