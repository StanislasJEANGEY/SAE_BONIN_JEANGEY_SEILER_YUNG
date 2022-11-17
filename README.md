# SAE_BONIN_JEANGEY_SEILER_YUNG

## SAE Développer une application web sécurisée

### Lien vers le depot git :

https://github.com/StanislasJEANGEY/SAE_BONIN_JEANGEY_SEILER_YUNG

<br>

# Attention - Note au correcteur :

Sur le dernier commit and push de jeudi nous avons envoyer une version qui fonctionnait avec XAMPP.  
Ensuite, nous avons déposer sur le serveur web de l'IUT (Webetu) et nous avons constaté une erreur alors que nous n'avion pas touché au code. L'erreur venait du fichier _Projet/src/classes/video/tack/Episode.php_ à la _ligne 7_ : **extends video {**  
Cette ligne ne posait pas de problème à XAMPP pour charger la classe Video.php mais sur Webetu cela posait problème car il n'arrivait pas à trouver la classe en question.  
Le problème à été résolu en mettant une majuscule à : **video**.  
Donc si vous pouviez prendre en compte ce petit détail de majuscule qui ne nous posait pas de problème avant qu'on le depose sur Webetu, et que si vous rencontrer ce problème, merci de bien vouloir mettre un majuscule à l'endroit indiquer ou télécharger le dernier commit du git qui ne met à jour que le fichier README.md (pour ajouter cette note) et modifie juste la majuscule dans le fichier Episode.php (vous pouvez vérifier en regardant les détails du commit).  
Merci  
Signé : tout le groupe

<br>

### Lien vers webetu

https://webetu.iutnc.univ-lorraine.fr/www/jeangey1u/SAE_DevWeb/Projet/index.php

<br>

Dictionnaire BDD:
https://docs.google.com/document/d/18JlecGTAmzPNkR0mv3FkQhdQj7pgGciCsjey5xb32E8/edit?usp=sharing

<br>

## Membre du groupe :

BONIN Lucas  
JEANGEY Stanislas  
SEILER Mathis  
YUNG Théo

<br>
<br>

## Fonctionnalités :

### De base :

1. Identification/Authentification – Formulaire de login  
   OK

2. Inscription sur la plateforme  
   OK

3. Affichage du catalogue de séries  
   OK

4. Affichage détaillé d’une série et de la liste de ses épisodes  
   OK

5. Affichage/visionnage d’un épisode d’une série  
   OK

6. Ajout d’une série dans la liste de préférence d’un utilisateur  
   OK

7. Page d’accueil d’un utilisateur : afficher ses séries préférées  
   OK

8. Lors du visionnage d’un épisode, ajouter automatiquement la série à la liste « en cours » de l’utilisateur  
   OK

9. Lors du visionnage d’un épisode d’une série, noter et commenter la série  
   OK

10. Lors de l’affichage d’une série, indiquer sa note moyenne et donner accès aux
    commentaires  
    OK

### Etendue :

11. Activation de compte

12. Recherche dans le catalogue par mots clés

13. Tri dans le catalogue  
    OK

14. Filtrage du catalogue par genre, par public  
    OK

15. Gestion de la liste de préférence : retrait  
    OK

16. Gestion de la liste « déjà visionnées »  
    OK

17. Gestion du profil de l’utilisateur : ajouter des informations (nom, prénom, genre préféré ...)  
    OK

18. Accès direct à l’épisode à visionner lorsque l’on visualise une série qui est dans la liste « en cours »

19. Tri dans le catalogue selon la note moyenne
    OK

20. Mot de passe oublié

<br>
<br>

# Liste des utilateurs avec leur mot de passe :

      1. test@gmail.com
         azertyuiop
      2. test2@gmail.com
         azertyuiop
      3. test3@gmail.com
         azertyuiop

Si vous souhaiter lancer l'application web depuis un serveur local, vous avez juste à décommenter/commenter la ligne de signature de la méthode setConfig() dans le fichier ConnectionFactory.


** How to sign up and register on NetVOD. **
- To sign up in our application you should click in the button “s’inscrire”. 
- You will be redirected to a page where you can add your email and your password. 
- After these things done you have an account et now can register. 
To register it’s almost the same thing as sign up, but you must click on the button “connexion”.

** Now how to navigate on NetVOD.**
## Button “catalogue” 
- The first button you can see is “Catalogue” click on it. 
- Now you can see a catalogue of series, choose the one who interest you the most among all we have and click on the picture. 
- In addition, underneath each series you have a button “j’aime” 
- All episodes of the series will be available like previously choose one and click on the picture and watch it!
- Below all episodes you can click on the button “commentaire” and see all ratings
- After watching a series add a comment and an evaluation but look out you can only do it once for each series. 

## Button “Profile”
- The second button is “Profile” click on it. You can now edit your profile. 
- If it’s the first time put your last name, your name, and your favorite type of series. 
- You can add all by press on the button “ajouter”
- Go back to the last page by clicking in “retour à l’accueil” 

## Button “Se déconnecter” 
- Click on it and you should be kick of our streaming app
- To go back on NetVOD you need to log in

