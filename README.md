# **M2L**  
État du projet: terminé
Note finale: 20/20
## **Description du projet**  
Chaque ligue sportive possède un site web présentant ses activités. Afin d'améliorer l'interaction avec les internautes, une FAQ appelée **"AppFaq"** a été conçue pour chaque ligue.  

### **Fonctionnalités principales**  
- Les internautes peuvent poser des questions et consulter les questions/réponses liées au sport de la ligue.  
- Une inscription préalable sur le site est requise.  
- Les administrateurs de la FAQ sont responsables de fournir les réponses aux questions posées.  

Ce projet a été réalisé dans le cadre d'un **projet de classe de 1SIO en option SLAM** (Solutions Logicielles et Applications Métier).

---

## **Procédure d'installation**  

| **Étape**             | **Action à réaliser**                                                                 |
|------------------------|---------------------------------------------------------------------------------------|
| **Cloner le dépôt**    | `git clone https://github.com/MatheoPUEL/M2L.git`                                     |
| **Lancer les serveurs**| Démarrer les services **Apache** et **MySQL**                                         |
| **Importer la base**   | Importer le fichier `.SQL` disponible dans la documentation via l'interface de PHPMyAdmin    |
| **Accéder au site**    | Rendez-vous sur [https://localhost/](https://localhost/)                              |

Si toutes les étapes sont correctement réalisées, vous aurez accès au site **M2L Tennis**.

---

## **Documentation**  
La structure des documents du projet est organisée comme suit :  

```plaintext
CommentCode (Le même de le répertoire "Code" mais tout le code est commenté)
Code
├── admin_all_ligues.php
├── admin_respond.php
├── index.php
├── ligues.php
├── login.php
├── register.php
├── form
│   ├── add.form.php
│   ├── addMessage.form.php
│   ├── login.form.php
│   ├── register.form.php
├── header
│   ├── header.deco.css
├── img
│   ├── logo.svg
│   ├── tennis.jpg
│   └── svg
│       ├── Bottomcorner.svg
│       ├── Leftcorner.svg
├── inc
│   ├── footer.inc.php
│   ├── header.inc.php
│   ├── template.php
├── style
│   ├── footer.css
│   ├── header.co.css
│   ├── ligues.css
│   ├── login.inc.css
│   ├── main.css
└── temp
    ├── readme.txt
Documents
├── DCU
│   ├── DCU AppFaq.drawio
│   ├── DCU.drawio.pdf
├── IHM
│   ├── IHM M2L.bmpr
│   ├── IHM M2L.pdf
├── MCD et MLD
│   ├── MCD M2L.jpg
│   ├── MCD M2L.loo
│   ├── MLD M2L.jpg
├── SiteMap
│   ├── SiteMap.drawio
│   ├── SiteMap.drawio.pdf
├── appfaq.sql
```

- **DCU** : Diagrammes de Cas d'Utilisation (Draw.io et PDF).  
- **MCD/MLD** : Modèle Conceptuel de Données et Modèle Logique de Données (formats image et loo).  
- **SiteMap** : Architecture du site sous forme de diagramme.  

---

## **Comptes de connexion par défaut**  
| **Rôle**         | **Identifiant**     | **Mot de passe** | **Email** |
|-------------------|---------------------|-------------------|------------------- |
| **Administrateur**| `Admin`            | `admin`           | `admin@m2l.com`|
| **Utilisateur**   | `User`             | `user`            |`user@m2l.com`|
| **Super-Admin**   | `Super-Admin`      | `super-admin`     |`super-admin@m2l.com`|

---

## **Technologies utilisées**  

| **Technologie/Outil** | **Utilisation**                                                |
|------------------------|--------------------------------------------------------------|
| **HTML, CSS, JavaScript** | Structure, style et interactivité du site web.              |
| **PHP**                | Gestion du back-end et des interactions avec la base de données. |
| **MySQL**              | Gestion des données et des utilisateurs.                     |
| **PHPMyAdmin**              | Pour le système de gestion de base de donnée (SGBD).    |
| **Balsamiq**           | Création des maquettes d'interface utilisateur.              |
| **Looping MCD**        | Modélisation du Modèle Conceptuel de Données (MCD).          |
| **Visual Studio Code** | Logiciel utilisé pour le développement.          |


---

**Projet 2024-2025**  
**Réalisé par :**  
- **Truwant Gaëtan**  
- **Puel Mathéo**  
- **Ramia Noa**  
- **Martin Noah**  

--- 

