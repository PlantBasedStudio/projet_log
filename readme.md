# projet_log :
Ce projet qui utilise bootstrap et PHP est fait dans le but d'obtenir un site brouillon d'e-commerce complet (afficher des produits, les trier, en ajouter, modifier des utilisateurs etc).

# Documentation :
Je vous invite à commencer par le fichier index.php pour comprendre le projet. Chaque script sera normalement documenté parfaitement lorsque le projet sera terminé. 

Pour tester le projet, il faut d'abord mettre en place la BDD et les tables. Utilisez donc le create_bdd.php suivi de create_table.php
Ensuite il faudra utiliser un compte admin. Vous devez donc vous inscrire dans l'onglet inscription. Ensuite, grâce au fichier role.php, vous pouvez suivre la procédure pour mettre en place votre compte comme administrateur du site. 
La prochaine étape consiste à accéder à votre onglet administrateur grâce à la navbar. Dans cette partie, vous pouvez ajouter des produits, des clients, modifier et supprimer aussi toutes ces choses. D'autres fonctionnalitées seront ajoutées comme celle permettant de lire les messages reçu dans votre formulaire de contact et d'autres en relations avec les prochains objectifs ci-dessous.

# Prochains objectifs : 
- Filtrer les produits par prix/disponibilité en stock.
- Ajouter des photos à des produits et afficher la première photo.
- Ajouter un script qui transfère la première photo d'un article en thumbnail et la défini par défaut à l'objet dans la bdd (la thumbnail nous sert pour la partie back)
- Cliquer sur un produit pour ouvrir sa page correspondante avec description etc.. 
- Ajouter un panier
- Ajouter un produit au panier
- Ajouter le panier dans les cookies
- Vider le panier si on est déconnecté.
- S'assurer que chaque session possède bien son propre panier
- Afficher un menu de validation/panier avec plusieurs articles
- Supprimer un produit du panier
- Enregistrer un produit en favori
- Vider le stock quand on procède au paiement d'un produit
- Envoyer un mail après achat du produit
- Generer une page récapitulatif commande
- Creer une partie profil avec présentation, image de profil, mes settings, mes commandes..
- Ajouter des commentaires à un article
- ajouter une note avec le commentaire
- Enorme debug + refactoring
- Verifier un utilisateur via email en générant un token à valider.
- Ajouter un client en Admin
- Refaire le projet en modèle MVC puis avec symfony