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

## Chain of Responsibility


Pour faire simple, la chaîne de responsabilité est un moyen de mettre en place une séquence de méthodes à exécuter, où chaque méthode peut décider d'exécuter la suivante dans la chaîne ou d'arrêter complètement la séquence.

Lorsque nous devons exécuter une séquence de vérifications pour déterminer ce qu'il faut faire ensuite, ce modèle peut nous aider à le faire. Supposons que nous voulions vérifier si un commentaire est un spam ou non, et que nous disposions de cinq algorithmes différents pour nous aider à faire cette détermination. Si l'un d'entre eux renvoie un résultat positif, cela signifie que le commentaire est un spam et que nous devrions arrêter le processus, car l'exécution d'algorithmes est coûteuse. Dans une situation comme celle-ci, nous devons encapsuler chaque algorithme dans une classe « handler », configurer la chaîne et l'exécuter.

![05.png](docs/05.png)
![06.png](docs/06.png)
