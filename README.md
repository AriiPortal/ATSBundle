Module Autosys
==============

Ce module permet de suivre les traitements ordonnancés par un serveur Autosys.

Pré-requis
----------

Modules:
- Core
- User
- Graphviz

Configuration
-------------

### Lecture des informations dans la base de données

Seule la base Oracle est prise en charge.

Contenu de **app/config/parameters.yml**:

    repository_driver:    oracle
    repository_name:      Autosys TEST
    repository_dbname:    SID
    repository_host:      serveur
    repository_port:      1521
    repository_user:      user
    repository_password:  password

### Envoi de commandes

- Commandes par ssh (unix)
- Commandes web services (11.3.6)

Releases
--------

__1.5.0__
- Exécution de commmande en ssh (serveur Autosys Linux)

