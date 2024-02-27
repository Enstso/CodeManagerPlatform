# CodeManagerPlateform

Ce projet, CodeManagerPlateform, permet de gérer les différents codes promo d'une campagne marketing. Il utilise le framework CodeIgniter pour le développement de l'application.


## Installation

1. Cloner ce repository sur votre machine locale.
2 . Assurez-vous d'avoir Docker installé sur votre machine.
3. Exécutez la commande suivante pour lancer l'application avec Docker :

```bash
docker-compose up -d        
``` 

## Fonctionnalités

### Pour les Clients (Entreprises)

Une fois authentifié, les clients (entreprises) peuvent :

- Générer une liste de codes promo.
- Bénéficier d'une réduction en utilisant un code promo valide.
- Importer des codes promo.
- Transmettre des codes uniques aux clients finaux.

### Pour les Administrateurs

Les administrateurs peuvent :

- Gérer les différents clients (entreprises).

## Technologies Utilisées

- **CodeIgniter** : Framework PHP utilisé pour le développement de l'application.
- **MySQL** : Système de gestion de base de données relationnelle pour stocker les données des utilisateurs et des codes promo.
- **Docker** : Conteneurisation de l'application avec Docker.
  
## Structure de la Base de Données

Voici la structure de la base de données utilisée dans l'application :

```sql
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT NOT NULL,
    username VARCHAR(20) NOT NULL,
    password VARCHAR(20) NOT NULL,
    status BOOLEAN DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS code (
    id INT NOT NULL AUTO_INCREMENT,
    code_unique VARCHAR(255) NOT NULL,
    code_promo VARCHAR(255) NOT NULL,
    status VARCHAR(20) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS ci_sessions (
    id VARCHAR(40) NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    timestamp INT(10) UNSIGNED DEFAULT 0 NOT NULL,
    data BLOB NOT NULL,
    PRIMARY KEY (id),
    KEY ci_sessions_timestamp (timestamp)
);

```
