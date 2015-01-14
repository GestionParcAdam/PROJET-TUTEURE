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
function plus(cadre,type){
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
    ch2.setAttribute('name',type+c2.length);
    ch2.setAttribute('id',type+c2.length);
    ch2.setAttribute('readonly','readonly'); 
    //c.appendChild(ch1);
    c.appendChild(ch2);

    return c2.length;
}

function moins(i){
    if(c2.length>0){
            c.removeChild(c2[i]);
    }
    if(c2.length==0){document.getElementById('sup').style.display='none'};
}

function recupSaisiePopupUser(){
    var i;
    
    var tableau = document.getElementById("tabUser");
    
    var ligne = tableau.insertRow(-1);//on a ajouté une ligne

    var colonne = ligne.insertCell(0);//on a une ajouté une cellule
    colonne.innerHTML += document.getElementById("form_nomUser").value;//on y met le contenu de titre
    var colonne2 = ligne.insertCell(1);
    colonne2.innerHTML += '<a onclick="supprimerLigneUser(this)">X</a>'; 
    
    var nom=document.getElementById("form_nomUser").value;
    console.log(nom+" est le ");
    plus('cadreUser','user');
    i=(c2.length)-1;
    console.log('user'+i);    
    document.getElementById('user'+i).value=nom;
    
}
j=0;
function recupSaisiePopupLog(){
    var i;
   
    
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
    
    plus('cadreLog','log'+j+'-'+(j+1)+'-');
    plus('cadreLog','log'+j+'-'+(j+1)+'-');
    plus('cadreLog','log'+j+'-'+(j+1)+'-');
    plus('cadreLog','log'+j+'-'+(j+1)+'-');
    j++;
    i=(c2.length)-1;
    console.log('log'+(j-1)+'-'+(j)+'-'+(i-2));
    console.log('log'+(j-1)+'-'+(j)+'-'+(i-3));
    console.log('log'+(j-1)+'-'+(j)+'-'+(i-1));
    console.log('log'+(j-1)+'-'+(j)+'-'+i);
    document.getElementById('log'+(j-1)+'-'+(j)+'-'+(i-3)).value=editeur;
    document.getElementById('log'+(j-1)+'-'+(j)+'-'+(i-2)).value=nom;
    document.getElementById('log'+(j-1)+'-'+(j)+'-'+(i-1)).value=licence;
    document.getElementById('log'+(j-1)+'-'+(j)+'-'+i).value=version; 
       
}
l=0;
function recupSaisiePopupMaintenance(){
    
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
    
    plus('cadreMaintenance','maintenance'+l+'-'+(l+1)+'-');
    plus('cadreMaintenance','maintenance'+l+'-'+(l+1)+'-');
    plus('cadreMaintenance','maintenance'+l+'-'+(l+1)+'-');
    plus('cadreMaintenance','maintenance'+l+'-'+(l+1)+'-');
    plus('cadreMaintenance','maintenance'+l+'-'+(l+1)+'-');
    l++;
    i=(c2.length)-1;
    console.log('maintenance'+(l-1)+'-'+(l)+'-'+(i-4));
    console.log('maintenance'+(l-1)+'-'+(l)+'-'+(i-3));
    console.log('maintenance'+(l-1)+'-'+(l)+'-'+(i-2));
    console.log('maintenance'+(l-1)+'-'+(l)+'-'+(i-1));
    console.log('maintenance'+(l-1)+'-'+(l)+'-'+i);
    document.getElementById('maintenance'+(l-1)+'-'+(l)+'-'+(i-4)).value=date;
    document.getElementById('maintenance'+(l-1)+'-'+(l)+'-'+(i-3)).value=objet;
    document.getElementById('maintenance'+(l-1)+'-'+(l)+'-'+(i-2)).value=description;
    document.getElementById('maintenance'+(l-1)+'-'+(l)+'-'+(i-1)).value=prestataire; 
    document.getElementById('maintenance'+(l-1)+'-'+(l)+'-'+i).value=cout; 
}

function supprimerLigneMaintenance(r)
{
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById('tabMaintenance').deleteRow(i-1);
    for(var k=0;k<5;k++)
        moins(i-1);
}

function supprimerLigneUser(r)
{
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById('tabUser').deleteRow(i-1);
    
        moins(i-1);
}

function supprimerLigneLog(r)
{
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById('tabLog').deleteRow(i-1);
    for(var k=0;k<4;k++)
        moins(i-1);
}

