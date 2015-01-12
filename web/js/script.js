//<!--
function change_onglet(name) {
    document.getElementById('onglet_' + anc_onglet).className = 'onglet_0 onglet';
    document.getElementById('onglet_' + name).className = 'onglet_1 onglet';
    document.getElementById('contenu_onglet_' + anc_onglet).style.display = 'none';
    document.getElementById('contenu_onglet_' + name).style.display = 'block';
    anc_onglet = name;
}
//-->

function recupSaisiePopupUser(){
    
    var tableau = document.getElementById("tabUser");
    
    var ligne = tableau.insertRow(-1);//on a ajouté une ligne

    var colonne = ligne.insertCell(0);//on a une ajouté une cellule
    
    colonne.innerHTML += document.getElementById("nomUser").value;//on y met le contenu de titre
    
    
    var champs = document.getElementById("tabUser");
    
    console.log(champs);
    document.getElementById("champsInvisilbeUsers").value=champs;
          
   
    var colonne2 = ligne.insertCell(1);
    colonne2.innerHTML += '<a onclick="supprimerLigneUser(this)">X</a>';  
}

function recupSaisiePopupLog(){
    
    var tableau = document.getElementById("tabLog");
    
    var ligne = tableau.insertRow(-1);//on a ajouté une ligne

    var colonne = ligne.insertCell(0);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("form_editeur").value;//on y met le contenu de titre
    
    var colonne2 = ligne.insertCell(1);//on a une ajouté une cellule
    colonne2.innerHTML += document.getElementById("form_nomLog").value;//on y met le contenu de titre
    
    var colonne3 = ligne.insertCell(2);//on a une ajouté une cellule
    colonne3.innerHTML += document.getElementById("form_licence").value;//on y met le contenu de titre
    
    var colonne4 = ligne.insertCell(3);
    colonne4.innerHTML += '<a onclick="supprimerLigneLog(this)">X</a>'; 
}

function recupSaisiePopupMaintenance(){
    
    var tableau = document.getElementById("tabMaintenance");
    
    var ligne = tableau.insertRow(-1);//on a ajouté une ligne

    var colonne = ligne.insertCell(0);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("dateInterv").value;//on y met le contenu de titre
    
    var colonne = ligne.insertCell(1);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("objInterv").value;//on y met le contenu de titre
    
    var colonne = ligne.insertCell(2);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("descInterv").value;//on y met le contenu de titre
    
    var colonne = ligne.insertCell(3);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("prestaInterv").value;//on y met le contenu de titre
    
    var colonne = ligne.insertCell(4);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("coutInterv").value;//on y met le contenu de titre
    
    var colonne2 = ligne.insertCell(5);
    colonne2.innerHTML += '<a onclick="supprimerLigneMaintenance(this)">X</a>';  
}

function supprimerLigneMaintenance(r)
{
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById('tabMaintenance').deleteRow(i-1);
}

function supprimerLigneUser(r)
{
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById('tabUser').deleteRow(i-1);
}

function supprimerLigneLog(r)
{
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById('tabLog').deleteRow(i-1);
}

