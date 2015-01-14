var c,c2, ch1, ch2;

//<!--
function change_onglet(name) {
    document.getElementById('onglet_' + anc_onglet).className = 'onglet_0 onglet';
    document.getElementById('onglet_' + name).className = 'onglet_1 onglet';
    document.getElementById('contenu_onglet_' + anc_onglet).style.display = 'none';
    document.getElementById('contenu_onglet_' + name).style.display = 'block';
    anc_onglet = name;
}
//-->


 
// ajouter un champ avec son "name" propre;
function plus(cadre,type,nb){
    c=document.getElementById(cadre);
    c2=c.getElementsByTagName('input');
    //ch1=document.createElement('input');
    ch2=document.createElement('input');
    /*
    ch1.setAttribute('type','text');
    ch1.setAttribute('name','ch1'+c2.length);
    ch1.setAttribute('readonly','readonly'); 
    ch1.setAttribute('value', 'etiquette'+c2.length/2);
    ch1.setAttribute('style','border:none');
    */
    ch2.setAttribute('type','text');
    ch2.setAttribute('name',type+nb);
    ch2.setAttribute('id',type+nb);
    ch2.setAttribute('readonly','readonly'); 
    //c.appendChild(ch1);
    c.appendChild(ch2);

    return c2.length;
}

function moins(i){
    if(c2.length>0){
            c.removeChild(c2[i]);
    }
    //if(c2.length===0){document.getElementById('form_nbUsers').value=0;};
}

idUser=0;
function recupSaisiePopupUser(){

    idUser++;
    var tableau = document.getElementById("tabUser");
    
    var ligne = tableau.insertRow(-1);//on a ajouté une ligne

    var colonne = ligne.insertCell(0);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("form_nomUser").value;//on y met le contenu de titre
    var colonne2 = ligne.insertCell(1);
    colonne2.innerHTML += '<a onclick="supprimerLigneUser(this)">X</a>'; 
    
    var nom=document.getElementById("form_nomUser").value;
    console.log(nom+" est le ");
    plus('cadreUser','user',idUser);
    
    console.log('user'+idUser);    
    document.getElementById('user'+idUser).value=nom;
    
    var nb=idUser;
    console.log((nb)+" est le nombre d'utilisateur"); 
    document.getElementById('form_nbUsers').value=(c2.length);
    
}


j=0;
function recupSaisiePopupLog(){
    idLog=0;
    idLog++;
    var tableau = document.getElementById("tabLog");
 
    var ligne = tableau.insertRow(-1);//on a ajouté une ligne

    var colonne = ligne.insertCell(0);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("form_editeur").value;//on y met le contenu de titre
    
    var colonne2 = ligne.insertCell(1);//on a une ajouté une cellule
    colonne2.innerHTML += document.getElementById("form_nomLog").value;//on y met le contenu de titre
    
    var colonne3 = ligne.insertCell(2);//on a une ajouté une cellule
    colonne3.innerHTML += document.getElementById("form_licence").value;//on y met le contenu de titre
    
    var colonne4 = ligne.insertCell(3);//on a une ajouté une cellule
    colonne4.innerHTML += document.getElementById("form_versionLogiciel").value;//on y met le contenu de titre
    
    var colonne5 = ligne.insertCell(4);
    colonne5.innerHTML += '<a onclick="supprimerLigneLog(this)">X</a>'; 
    
    var nom=document.getElementById("form_nomLog").value;
    var editeur=document.getElementById("form_editeur").value;
    var licence=document.getElementById("form_licence").value;
    var version=document.getElementById("form_versionLogiciel").value;
    console.log(editeur+" "+nom+" "+licence+" "+version+" ");
    
    plus('cadreLog','log'+(j+1)+'-',idLog);
    plus('cadreLog','log'+(j+1)+'-',idLog+1);
    plus('cadreLog','log'+(j+1)+'-',idLog+2);
    plus('cadreLog','log'+(j+1)+'-',idLog+3);
    j++;
 
    console.log('log'+(j)+'-'+(idLog));
    console.log('log'+(j)+'-'+(idLog+1));
    console.log('log'+(j)+'-'+(idLog+2));
    console.log('log'+(j)+'-'+(idLog+3));
    document.getElementById('log'+(j)+'-'+(idLog)).value=editeur;
    document.getElementById('log'+(j)+'-'+(idLog+1)).value=nom;
    document.getElementById('log'+(j)+'-'+(idLog+2)).value=licence;
    document.getElementById('log'+(j)+'-'+(idLog+3)).value=version; 
    
    var nb=j;
    console.log((nb)+" est le nombre de logiciel"); 
    document.getElementById('form_nbLog').value=(nb);
       
}

l=0;
function recupSaisiePopupMaintenance(){
    idMaintenance=0;
    idMaintenance++;
    var tableau = document.getElementById("tabMaintenance");
    
    var ligne = tableau.insertRow(-1);//on a ajouté une ligne

    var colonne = ligne.insertCell(0);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("form_dateInterv").value;//on y met le contenu de titre
    
    var colonne = ligne.insertCell(1);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("form_objInterv").value;//on y met le contenu de titre
    
    var colonne = ligne.insertCell(2);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("form_descInterv").value;//on y met le contenu de titre
    
    var colonne = ligne.insertCell(3);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("form_prestaInterv").value;//on y met le contenu de titre
    
    var colonne = ligne.insertCell(4);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("form_coutInterv").value;//on y met le contenu de titre
    
    var colonne2 = ligne.insertCell(5);
    colonne2.innerHTML += '<a onclick="supprimerLigneMaintenance(this)">X</a>';  
    
    var date=document.getElementById("form_dateInterv").value;
    var objet=document.getElementById("form_objInterv").value;
    var description=document.getElementById("form_descInterv").value;
    var prestataire=document.getElementById("form_prestaInterv").value;
    var cout=document.getElementById("form_coutInterv").value;
    console.log(date+" "+objet+" "+description+" "+prestataire+" "+cout);
    
    plus('cadreMaintenance','maintenance'+(l+1)+'-',idMaintenance);
    plus('cadreMaintenance','maintenance'+(l+1)+'-',idMaintenance+1);
    plus('cadreMaintenance','maintenance'+(l+1)+'-',idMaintenance+2);
    plus('cadreMaintenance','maintenance'+(l+1)+'-',idMaintenance+3);
    plus('cadreMaintenance','maintenance'+(l+1)+'-',idMaintenance+4);
    l++;
    
    console.log('maintenance'+(l)+'-'+(idMaintenance));
    console.log('maintenance'+(l)+'-'+(idMaintenance+1));
    console.log('maintenance'+(l)+'-'+(idMaintenance+2));
    console.log('maintenance'+(l)+'-'+(idMaintenance+3));
    console.log('maintenance'+(l)+'-'+(idMaintenance+4));
    document.getElementById('maintenance'+(l)+'-'+(idMaintenance)).value=date;
    document.getElementById('maintenance'+(l)+'-'+(idMaintenance+1)).value=objet;
    document.getElementById('maintenance'+(l)+'-'+(idMaintenance+2)).value=description;
    document.getElementById('maintenance'+(l)+'-'+(idMaintenance+3)).value=prestataire; 
    document.getElementById('maintenance'+(l)+'-'+(idMaintenance+4)).value=cout; 
    
    var nb=l;
    console.log((nb)+" est le nombre de maitenance"); 
    document.getElementById('form_nbMaintenance').value=(nb);
}

function supprimerLigneMaintenance(r)
{
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById('tabMaintenance').deleteRow(i-1);
    for(var k=0;k<5;k++)
        moins(i-1);
    document.getElementById('form_nbMaintenance').value--;
}

function supprimerLigneUser(r)
{
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById('tabUser').deleteRow(i-1);
    console.log(i);
    moins(i-1);
    document.getElementById('form_nbUsers').value--;
}

function supprimerLigneLog(r)
{
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById('tabLog').deleteRow(i-1);
    for(var k=0;k<4;k++)
        moins(i-1);
    document.getElementById('form_nbLog').value--;
}

