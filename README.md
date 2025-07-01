# Module Drupal : Inscription Newsletter

## Description
Formulaire personnalisé pour collecter des inscriptions à une newsletter. Enregistre les données sous forme de node.

## Installation
1. Copier le dossier `inscription_newsletter` dans `/modules/custom/`.
2. Créer un type de contenu "inscription_newsletter" avec les champs :
   - `field_civilite` (liste de sélection : M. / Mme)
   - `field_email` (champ email)
3. Activer le module dans `/admin/modules`.
4. Accéder au formulaire via : `/inscription-newsletter`

## Dépendances
- Module "Node" activé.
