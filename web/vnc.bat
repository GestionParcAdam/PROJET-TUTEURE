rem désactive l'affichage des commandes
                    echo off
                    rem remise à blanc de l'écran
                    cls
                    rem définition de la valeur de la variable
                    set variable=%CD%
                    rem affiche du texte en rappelant la variable grâce aux %
                    echo %variable%
                    rem on se deplace
                    cd "C:\wamp\www\PROJET-TUTEURE\web\ "
                    rem on lance vnc
                    start vncviewer.exe 127.0.0.1
                    rem on revien la ou il y avait le bat
                    cd %variable%
                    rem on le suprime
                    del vnc.bat
                    rem arrêt
                    pause