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

## Bonus: Null Object Pattern

Qu'est-ce que le modèle Null Object ? C'est une façon intelligente d'éviter les vérifications de nullité. Au lieu de vérifier si une propriété est nulle, comme nous l'avons fait dans le passé, nous allons créer un « objet nul » qui implémente la même interface et ne fait rien dans ses méthodes. En termes simples, si une méthode renvoie une valeur, elle renverra une valeur aussi proche que possible de null. Par exemple, si elle renvoie un tableau, elle renverra un tableau vide. Une chaîne de caractères ? Vous renverrez une chaîne vide. Un int ? Vous renverrez 0. Cela peut être encore plus compliqué que cela, mais vous voyez l'idée.

```php
<?php

namespace App\ChainHandler;

use App\Character\Character;
use App\FightResult;

class NullHandler implements XpBonusHandlerInterface
{

    public function handle(Character $player, FightResult $fightResult): int
    {
        return 0;
    }

    public function setNext(XpBonusHandlerInterface $next): void
    {
        // Doing nothing
    }
}
```

![07.png](docs/07.png)
![08.png](docs/08.png)

## The state pattern

State pattern est un moyen d'organiser votre code de manière à ce qu'un objet puisse modifier son comportement lorsque son état interne change. Il vous aide à représenter les différents états comme des classes séparées et permet à l'objet de passer d'un état à l'autre de manière transparente.

![09.png](docs/09.png)

Supposons que nous ayons une fonction publishPost() qui fera différentes choses en fonction du statut d'un article. Si l'article est un brouillon, elle changera le statut en « modération » et informera le modérateur. Si l'article est déjà en modération et que l'utilisateur est un administrateur, il passera au statut « publié » et enverra un tweet.

![10.png](docs/10.png)

Si le joueur gagne, nous appelons `victory()` sur l'objet du jeu, sinon nous appelons `defeat()`. Jetons un coup d'œil à la méthode `victory()`. Maintenez la touche « Commande » enfoncée, cliquez, et... oh ! c'est juste un raccourci pour appeler victory() sur cette propriété difficultyContext. Il s'agit d'une instance de la classe GameDifficultyContext, chargée de gérer les niveaux de difficulté.

![11.png](docs/11.png)
![12.png](docs/12.png)

![13.png](docs/13.png)
![14.png](docs/14.png)
![15.png](docs/15.png)
![16.png](docs/16.png)
![17.png](docs/17.png)
![18.png](docs/18.png)
![19.png](docs/19.png)
