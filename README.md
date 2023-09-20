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

### Affichage de liste

Injection de dépendance : [`ArticleRepository`](src/Repository/ArticleRepository.php)

### Affichage d'un élément

Utilisation du ParamConverter dans [`ArticleController`](https://github.com/HB-R5-2023/news/blob/main/src/Controller/ArticleController.php#L12-L13) : installation **manuelle** d'un bundle récemment abandonné : le SensioFrameworkExtraBundle.

```bash
composer require sensio/framework-extra-bundle
```

À partir de la version 6.2 de Symfony, le ParamConverter, pour lire une entité, est remplacé par [`EntityValueResolver`](https://symfony.com/doc/current/doctrine.html#automatically-fetching-objects-entityvalueresolver).

### Formulaires

Création d'un formulaire de newsletter avec un champ email.

Structure du formulaire : [NewsletterType](src/Form/NewsletterType.php)

Contrôleur pour gérer le formulaire : [IndexController](src/Controller/IndexController.php)

### Envoi d'email

Utilisation du composant `symfony/mailer`.

Type-hint de la `MailerInterface` dans le contrôleur `newsletterSubscribe`, dans la classe [`IndexController`](src/Controller/IndexController.php)
