<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnswerFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $answer = (new Answer())
            ->setText('Tim Berners-Lee, 1990')
            ->setHelp("Tim Berners-Lee est le créateur du World Wide Web, mais pas de JavaScript. Il a conçu le web en 1989 et 1990, mais cela n'inclut pas le développement de JavaScript.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-01'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-01-01', $answer);

        $answer = (new Answer())
            ->setText('Brendan Eich, 1995')
            ->setHelp("C'est la bonne réponse. Brendan Eich a créé JavaScript en 1995 alors qu'il travaillait pour Netscape. JavaScript a été initialement développé sous le nom de Mocha, puis renommé en LiveScript, et enfin en JavaScript.")
            ->setPosition(2)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-js-fondamentaux-01'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-01-02', $answer);

        $answer = (new Answer())
            ->setText('Guido van Rossum, 1991')
            ->setHelp("Guido van Rossum est le créateur du langage de programmation Python, qu'il a commencé à développer en 1989 et a publié pour la première fois en 1991, mais il n'a pas de lien avec le développement de JavaScript.")
            ->setPosition(3)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-01'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-01-03', $answer);

        $answer = (new Answer())
            ->setText('Dennis Ritchie, 1972')
            ->setHelp("Dennis Ritchie est connu pour avoir créé le langage de programmation C en 1972 à AT&T Bell Labs, mais il n'est pas lié à la création de JavaScript.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-01'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-01-04', $answer);

        $answer = (new Answer())
            ->setText('Les variables en JavaScript ne peuvent pas changer de type')
            ->setHelp("Cette affirmation est incorrecte. En JavaScript, qui est un langage à typage dynamique, les types de variables peuvent changer. Par exemple, une variable initialement définie comme un nombre peut être réaffectée à une chaîne de caractères.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-02'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-02-01', $answer);

        $answer = (new Answer())
            ->setText('JavaScript ne définit pas de types pour ses variables')
            ->setHelp("Ceci n'est pas exact. JavaScript a des types (comme Number, String, Boolean, etc.), mais contrairement à des langages à typage statique, le type d'une variable n'est pas fixé lors de la déclaration et peut changer au cours de l'exécution du programme.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-02'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-02-02', $answer);

        $answer = (new Answer())
            ->setText('JavaScript permet des conversions de type implicites')
            ->setHelp("C'est la bonne réponse. Le \"typage faible\" de JavaScript se réfère à sa capacité à effectuer des conversions de type automatiques. Par exemple, si vous additionnez un nombre et une chaîne de caractères, JavaScript convertira le nombre en chaîne pour réaliser l'opération.")
            ->setPosition(3)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-js-fondamentaux-02'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-02-03', $answer);

        $answer = (new Answer())
            ->setText('Les types en JavaScript ne sont pas importants')
            ->setHelp("Cette affirmation est fausse. Bien que JavaScript soit un langage à typage faible, la compréhension des types est cruciale pour éviter des erreurs inattendues dues aux conversions de type implicites.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-02'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-02-04', $answer);

        $answer = (new Answer())
            ->setText('Elle a une portée globale')
            ->setHelp("Ceci n'est pas exact. Une variable définie avec let peut être globale si elle est déclarée en dehors de tout bloc, mais ce n'est pas une caractéristique unique à let. La particularité de let est ailleurs.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-03'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-03-01', $answer);

        $answer = (new Answer())
            ->setText('Elle est constamment réassignable')
            ->setHelp("C'est vrai, mais ce n'est pas spécifique à let. Les variables définies avec let peuvent être réassignées, tout comme celles définies avec var. Toutefois, cela ne représente pas la particularité principale de let.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-03'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-03-02', $answer);

        $answer = (new Answer())
            ->setText('Elle a une portée limitée au bloc dans lequel elle est déclarée')
            ->setHelp("C'est la bonne réponse. La principale différence entre let et var est que let a une portée de bloc (block scope), ce qui signifie que la variable n'existe et ne peut être accédée que dans le bloc où elle a été déclarée.")
            ->setPosition(3)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-js-fondamentaux-03'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-03-03', $answer);

        $answer = (new Answer())
            ->setText('Elle est immuable')
            ->setHelp("Ceci est incorrect. Les variables déclarées avec let sont mutables, ce qui signifie qu'elles peuvent être modifiées après leur déclaration. Si vous souhaitez une variable immuable en JavaScript, vous utiliseriez const.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-03'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-03-04', $answer);

        $answer = (new Answer())
            ->setText('La variable ne peut pas être réassignée')
            ->setHelp("C'est la bonne réponse. Lorsqu'une variable est déclarée avec const en JavaScript, cela signifie qu'une fois qu'elle a été assignée, elle ne peut plus être réassignée à une autre valeur. C'est une différence clé par rapport aux déclarations avec let ou var.")
            ->setPosition(1)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-js-fondamentaux-04'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-04-01', $answer);

        $answer = (new Answer())
            ->setText('La variable est automatiquement globale')
            ->setHelp("Ceci est incorrect. Comme avec let, la portée d'une variable déclarée avec const est limitée au bloc dans lequel elle est déclarée, sauf si elle est déclarée en dehors de tout bloc, auquel cas elle peut être globale. Mais cela n'est pas une caractéristique unique ou automatique de const.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-04'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-04-02', $answer);

        $answer = (new Answer())
            ->setText('La variable est protégée contre les changements de type')
            ->setHelp("Ceci n'est pas exact. const empêche la réaffectation de la variable, mais ne concerne pas directement les types de données. En JavaScript, les types de données ne sont pas fixes, même pour les variables déclarées avec const.")
            ->setPosition(3)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-04'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-04-03', $answer);

        $answer = (new Answer())
            ->setText('La variable devient immuable')
            ->setHelp("Cette affirmation nécessite une précision. Une variable déclarée avec const ne peut pas être réassignée, mais si elle fait référence à un objet, les propriétés de cet objet peuvent être modifiées. Ainsi, const rend la référence immuable, mais pas nécessairement la valeur à laquelle elle fait référence. Par exemple, vous ne pouvez pas réaffecter un nouvel objet ou une nouvelle valeur à une constante, mais si cette constante est un objet, vous pouvez modifier ses propriétés.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-04'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-04-04', $answer);

        $answer = (new Answer())
            ->setText('Les types primitifs sont tous mutables')
            ->setHelp("Ceci est incorrect. Les types primitifs en JavaScript sont immuables, ce qui signifie que leurs valeurs ne peuvent pas être modifiées une fois créées. Par exemple, si vous modifiez une chaîne de caractères, en réalité, une nouvelle chaîne est créée.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-05'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-05-01', $answer);

        $answer = (new Answer())
            ->setText('Les types primitifs incluent des classes et des fonctions')
            ->setHelp("Ceci n'est pas correct. Les types primitifs en JavaScript sont des données qui ne sont pas des objets et qui n'ont pas de méthodes. Ils incluent des types tels que Number, String, Boolean, undefined, null, Symbol et BigInt. Les classes et les fonctions, en revanche, sont considérées comme des types complexes ou des objets.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-05'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-05-02', $answer);

        $answer = (new Answer())
            ->setText('Les types primitifs en JavaScript sont immuables')
            ->setHelp("C'est la bonne réponse. Les types primitifs sont immuables. Cela signifie que toute opération sur une valeur primitive résulte en une nouvelle valeur primitive, sans modifier la valeur originale.")
            ->setPosition(3)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-js-fondamentaux-05'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-05-03', $answer);

        $answer = (new Answer())
            ->setText('Les types primitifs ne peuvent pas être stockés dans des variables')
            ->setHelp("Ceci est incorrect. Les types primitifs peuvent être stockés dans des variables. En fait, stocker des nombres, des chaînes de caractères, des booléens, etc., dans des variables est une pratique courante en JavaScript.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-05'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-05-04', $answer);

        $answer = (new Answer())
            ->setText('C\'est une bibliothèque de fonctions JavaScript')
            ->setHelp("Ceci n'est pas correct. ECMAScript n'est pas une bibliothèque de fonctions. Il s'agit d'une spécification pour les langages de script, dont JavaScript est la mise en œuvre la plus connue.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-06'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-06-01', $answer);

        $answer = (new Answer())
            ->setText('C\'est le moteur d\'exécution de JavaScript')
            ->setHelp("Ceci est incorrect. Les moteurs d'exécution de JavaScript, comme V8 (utilisé dans Chrome et Node.js) ou SpiderMonkey (utilisé dans Firefox), sont des implémentations qui exécutent le code JavaScript conformément à la norme ECMAScript, mais ils ne sont pas la norme elle-même.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-06'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-06-02', $answer);

        $answer = (new Answer())
            ->setText('C\'est une norme qui guide l\'évolution de JavaScript')
            ->setHelp("C'est la bonne réponse. ECMAScript est la norme sur laquelle JavaScript est basé. Elle définit les règles, les détails et les complexités du langage, guidant ainsi son développement et son évolution.")
            ->setPosition(3)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-js-fondamentaux-06'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-06-03', $answer);

        $answer = (new Answer())
            ->setText('C\'est une version alternative de JavaScript')
            ->setHelp("Ceci n'est pas exact. ECMAScript n'est pas une version alternative de JavaScript, mais plutôt la spécification qui sert de base à JavaScript. Les différentes versions d'ECMAScript (comme ES5, ES6/ES2015, etc.) représentent des évolutions de la spécification, que les implémentations de JavaScript suivent.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-06'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-06-04', $answer);

        $answer = (new Answer())
            ->setText('Un mécanisme de gestion de la mémoire')
            ->setHelp("Ceci n'est pas correct. La Temporal Dead Zone (TDZ) n'a pas de rapport avec la gestion de la mémoire. Elle concerne plutôt la portée des variables dans le code.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-07'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-07-01', $answer);

        $answer = (new Answer())
            ->setText('La période où une variable let ou const est inaccessible avant son initialisation')
            ->setHelp("C'est la bonne réponse. La Temporal Dead Zone fait référence à la période de temps dans le code depuis le début du bloc jusqu'à ce qu'une variable déclarée avec let ou const soit déclarée. Durant cette période, la variable existe mais ne peut pas être accédée, ce qui entraîne une erreur si on essaie de l'utiliser.")
            ->setPosition(2)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-js-fondamentaux-07'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-07-02', $answer);

        $answer = (new Answer())
            ->setText('Une erreur générée lors de l\'utilisation incorrecte des fonctions')
            ->setHelp("Ceci est incorrect. Bien que l'utilisation incorrecte de fonctions puisse générer des erreurs en JavaScript, cela n'est pas spécifiquement lié à la TDZ.")
            ->setPosition(3)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-07'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-07-03', $answer);

        $answer = (new Answer())
            ->setText('Un espace de stockage temporaire pour les variables')
            ->setHelp("Ceci n'est pas exact. La TDZ ne désigne pas un espace de stockage, mais plutôt une période temporelle dans la portée d'une variable où elle n'est pas accessible.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-07'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-07-04', $answer);

        $answer = (new Answer())
            ->setText('Il remonte dans la chaîne de scopes jusqu\'à trouver une définition')
            ->setHelp("C'est la bonne réponse. En JavaScript, lorsque le moteur d'exécution ne trouve pas une variable dans le scope actuel, il remonte dans la chaîne des scopes parent jusqu'à ce qu'il trouve la variable. Si la variable n'est trouvée dans aucun scope parent, cela mène à une erreur de référence.")
            ->setPosition(1)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-js-fondamentaux-08'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-08-01', $answer);

        $answer = (new Answer())
            ->setText('Il génère immédiatement une erreur de référence')
            ->setHelp("C'est correct si la variable n'est trouvée dans aucun scope, mais ce n'est pas le comportement immédiat de JavaScript. Si une variable est utilisée mais n'est définie dans aucun scope accessible (y compris le scope global), JavaScript génère une erreur de référence (ReferenceError).")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-08'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-08-02', $answer);

        $answer = (new Answer())
            ->setText('Il crée une nouvelle variable globale')
            ->setHelp("Ceci est incorrect dans le mode strict (strict mode) de JavaScript. Dans le mode non-strict, si une variable est assignée sans être déclarée, elle peut effectivement devenir une variable globale, mais cela est considéré comme une mauvaise pratique et peut conduire à des erreurs difficiles à débusquer.")
            ->setPosition(3)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-08'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-08-03', $answer);

        $answer = (new Answer())
            ->setText('Il ignore la variable et continue l\'exécution')
            ->setHelp("Ceci est incorrect. JavaScript ne va pas ignorer une variable non définie. Si une variable est utilisée sans avoir été définie dans le scope actuel ou dans la chaîne de scopes, cela entraînera une erreur.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-08'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-08-04', $answer);

        $answer = (new Answer())
            ->setText('Les fonctions déclarées n\'ont pas de nom')
            ->setHelp("Ceci est incorrect. Les fonctions déclarées ont un nom. Par exemple, dans function maFonction() {}, maFonction est le nom de la fonction.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-09'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-09-01', $answer);

        $answer = (new Answer())
            ->setText('Les expressions de fonction sont toujours anonymes')
            ->setHelp("Cela n'est pas nécessairement vrai. Les expressions de fonction peuvent être anonymes, mais elles peuvent aussi être nommées. Par exemple, const maFonction = function() {} est une expression de fonction anonyme, mais const maFonction = function maFonctionNom() {} est une expression de fonction nommée.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-09'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-09-02', $answer);

        $answer = (new Answer())
            ->setText('Les fonctions déclarées sont hissées')
            ->SetHelp("C'est la bonne réponse. Le \"hissage\" (hoisting) signifie que les déclarations de fonctions sont déplacées au sommet de leur scope avant l'exécution du code. Ainsi, une fonction déclarée peut être appelée avant sa déclaration dans le code. En revanche, les expressions de fonction ne sont pas hissées de cette manière.")
            ->setPosition(3)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-js-fondamentaux-09'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-09-03', $answer);

        $answer = (new Answer())
            ->setText('Les expressions de fonction ne peuvent pas avoir de paramètres')
            ->setHelp("Ceci est incorrect. Les expressions de fonction peuvent tout à fait avoir des paramètres, tout comme les fonctions déclarées.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-09'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-09-04', $answer);

        $answer = (new Answer())
            ->setText('Il concatène plusieurs tableaux en un seul')
            ->setHelp("Ceci n'est que partiellement correct. L'opérateur de spread (...) peut être utilisé pour concaténer plusieurs tableaux, mais ce n'est pas sa seule utilisation. Par exemple, [...array1, ...array2] crée un nouveau tableau contenant tous les éléments de array1 suivis de tous les éléments de array2.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-10'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-10-01', $answer);

        $answer = (new Answer())
            ->setText('Il crée une copie superficielle d\'un objet')
            ->setHelp("Ceci est correct mais incomplet. L'opérateur de spread peut être utilisé pour créer une copie superficielle d'un objet. Par exemple, {...obj} crée une nouvelle copie de l'objet obj. Cette affiramtion ne reflète pas la fonctionnalité principale et la polyvalence de l'opérateur de spread.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-10'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-10-02', $answer);

        $answer = (new Answer())
            ->setText('Il étend un tableau ou un objet littéral en éléments individuels')
            ->setHelp("C'est la bonne réponse, car c'est la plus complète. L'opérateur de spread est utilisé pour étendre les éléments d'un tableau ou d'un objet littéral. Dans le cas des tableaux, il les décompose en éléments individuels, et pour les objets, il étend leurs propriétés.")
            ->setPosition(3)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-js-fondamentaux-10'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-10-03', $answer);

        $answer = (new Answer())
            ->setText('Il est utilisé pour déclarer des variables')
            ->setHelp("Ceci est incorrect. L'opérateur de spread n'est pas utilisé pour déclarer des variables. Il est utilisé pour étendre des éléments ou des propriétés dans des tableaux et des objets.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-js-fondamentaux-10'));
        $manager->persist($answer);
        $this->addReference('answer-js-fondamentaux-10-04', $answer);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 7;
    }
}
