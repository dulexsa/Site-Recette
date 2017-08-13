/**
 * Created by stocchetjo on 05.05.2017.
 */

function verifFormAddCIF()
{
    cifName = document.getElementById("cifName");
    cifDescription = document.getElementById("cifDescription");
    objName = document.getElementById("objName");
    objDescription = document.getElementById("objDescription");

    if(verifWriting(cifName) && verifWriting(cifDescription) && verifWriting(objName) && verifWriting(objDescription))
        return true;
    else
    {
        alert("Veuillez remplir correctement tous les champs.");
        return false;
    }
}

/*Vérifie si le nom ou le prénom est correct*/
function verifWriting(champ)
{
    var regex = /^[A-Z](([-']?[a-zA-Z]+)[áéíóúàèìòùâêîôûäëïöü])*/;
    if(!regex.test(champ.value))
    {
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}

/*Vérifie si un image à bien était uploader*/
function verifImg(champ)
{
    var regex = /^[A-Z](([-']?[a-zA-Z]+)[áéíóúàèìòùâêîôûäëïöü])*/;
    if(!regex.test(champ.value))
    {
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}

/*Transforme la case incorrect en rouge*/
function surligne(champ, erreur)
{
    if(erreur)
        champ.style.backgroundColor = "#fba";
    else
        champ.style.backgroundColor = "";
}