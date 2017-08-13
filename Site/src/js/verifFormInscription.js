/**
 * Created by stocchetjo on 03.03.2017.
 */
function verifForm(f)
{
    if(verifNom(f.nom) && verifNom(f.prenom) && verifMail(f.email) && verifMDP(f.password, f.vpassword))
        return true;
    else
    {
        alert("Veuillez remplir correctement tous les champs.");
        return false;
    }
}

/*Vérifie si le nom ou le prénom est correct*/
function verifNom(champ)
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

/*Vérification de l'adresse e-mail*/
function verifMail(champ)
{
    var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
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

/*Vérification du mot de passe*/
function verifMDP(pass,verifpass)
{
    var regex = /^.+$/;
    if(!regex.test(pass.value) || pass.value != verifpass.value)
    {
        surligne(pass, true);
        return false;
    }
    else
    {
        surligne(pass, false);
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