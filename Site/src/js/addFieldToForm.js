/**
 * Created by dulexsa on 24.03.2017.
 */
var div = document.getElementById('champs');
function addInput(){
    var newdiv = document.createElement('div');
    newdiv.innerHTML = "<label class='control-label'>Nom de l'objet</label><div class=''><input class='form-control input-md' type='text' name='objNom[]'> </div> <label class='control-label'>Description de l'objet</label><div class=''><input class='form-control input-md' name='objDescription[]'></div>";
    document.getElementById('champs').appendChild(newdiv);
}
function addField() {
    addInput();
}