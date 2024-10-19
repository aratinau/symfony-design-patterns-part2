# Design Patterns Episode 2

## Setup

```
composer install
```

**Running the App!**

This is a command-line only app - so no web server needed. Instead, run:

```
php bin/console app:game:play
```

## Command Pattern (behavioral pattern)

*Remote control for a TV*

- The command interface
- The concrete command
- An invoker object

![01.png](docs/01.png)
![02.png](docs/02.png)
![03.png](docs/03.png)

Grâce au modèle Command, nous avons pu annuler des actions en toute simplicité. Mais ce n'est pas la seule chose que le pattern Command peut faire pour nous. Nous pouvons également l'utiliser pour placer nos actions dans une file d'attente et les exécuter quand nous le souhaitons.

Supposons que nous voulions rejouer nos batailles et regarder tout ce qui s'est passé à nouveau. Nous pourrions stocker toutes les commandes qui se sont produites lors d'une bataille quelque part, comme une liste, une base de données ou tout autre mécanisme de stockage. Ensuite, nous prenons la liste et nous les exécutons une par une.

![04.png](docs/04.png)
