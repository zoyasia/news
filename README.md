# Site de news

## Point abordés

### Création d'une classe de contrôleurs

[`IndexController`](src/Controller/IndexController.php)
[`ArticleController`](src/Controller/ArticleController.php)

Avec le maker :

```bash
php bin/console make:controller
```

### Création d'une entité

[Entité `Article`](src/Entity/Article.php)

### Création d'une relation `OneToMany`

[Entité `Category`](src/Entity/Category.php)

> `OneToMany`, dans ce cas, signifie "One Category To Many Offers"

### Création des fixtures

Avec le package ayant pour alias `orm-fixtures`, création d'un ensemble de données regroupant les types de contrats et les offres.

Fichier : [`AppFixtures.php`](src/DataFixtures/AppFixtures.php)

Utilisation de la librairie [Faker](https://fakerphp.github.io/)
