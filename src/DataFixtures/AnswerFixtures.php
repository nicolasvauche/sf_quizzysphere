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
            ->setText('AltaVista était le premier moteur de recherche à utiliser des algorithmes de recherche sémantique')
            ->setHelp("Bien qu'AltaVista ait été un moteur de recherche innovant pour son époque, il n'était pas le premier à utiliser des algorithmes de recherche sémantique. Les moteurs de recherche précédents utilisaient également des techniques d'indexation sémantique.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-01'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-01-01', $answer);

        $answer = (new Answer())
            ->setText('AltaVista offrait une recherche rapide et une indexation plus complète que ses concurrents')
            ->setHelp("AltaVista était considéré comme avancé car il proposait une recherche rapide et une indexation plus complète que la plupart de ses concurrents de l'époque. Il pouvait indexer une grande quantité de pages web, offrant ainsi aux utilisateurs un accès à une vaste quantité d'informations.")
            ->setPosition(2)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-histoire-du-web-01'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-01-02', $answer);

        $answer = (new Answer())
            ->setText('AltaVista avait une interface utilisateur révolutionnaire avec des fonctionnalités de recherche avancées')
            ->setHelp("Bien qu'AltaVista ait eu une interface utilisateur avancée pour son époque, avec des fonctionnalités de recherche avancées, cela n'a pas été la principale raison de sa renommée. Sa vitesse de recherche et son indexation exhaustive étaient plus importantes.")
            ->setPosition(3)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-01'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-01-03', $answer);

        $answer = (new Answer())
            ->setText('AltaVista était le premier moteur de recherche à proposer des publicités ciblées aux utilisateurs')
            ->setHelp("AltaVista n'a pas été le premier moteur de recherche à proposer des publicités ciblées aux utilisateurs. Cette fonctionnalité est apparue plus tard dans l'évolution des moteurs de recherche.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-01'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-01-04', $answer);

        $answer = (new Answer())
            ->setText('HTTP (Hypertext Transfer Protocol)')
            ->setHelp("C'est la réponse correcte. Tim Berners-Lee a introduit le protocole HTTP en 1990, qui est fondamental pour le fonctionnement du World Wide Web. Il permet la communication entre les navigateurs web et les serveurs web, facilitant ainsi le transfert d'informations sous forme de pages web.")
            ->setPosition(1)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-histoire-du-web-02'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-02-01', $answer);

        $answer = (new Answer())
            ->setText('HTML (Hypertext Markup Language)')
            ->setHelp("Bien que Tim Berners-Lee ait joué un rôle clé dans le développement d'HTML, il n'a pas introduit ce langage en 1990. HTML est un langage de balisage utilisé pour créer la structure des pages web.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-02'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-02-02', $answer);

        $answer = (new Answer())
            ->setText('TCP/IP (Transmission Control Protocol/Internet Protocol)')
            ->setHelp("Tim Berners-Lee n'a pas introduit TCP/IP en 1990. Ce protocole existait déjà et est à la base de la communication sur Internet. Il gère le routage des données sur le réseau.")
            ->setPosition(3)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-02'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-02-03', $answer);

        $answer = (new Answer())
            ->setText('FTP (File Transfer Protocol)')
            ->setHelp("Tim Berners-Lee n'a pas introduit FTP en 1990. FTP est un protocole utilisé pour le transfert de fichiers sur Internet, mais il est distinct du protocole HTTP utilisé pour la navigation web.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-02'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-02-04', $answer);

        $answer = (new Answer())
            ->setText('Gopher était le moteur de recherche le plus populaire en 1993')
            ->setHelp("Cette réponse est incorrecte. En 1993, Gopher était une technologie de recherche et de partage de fichiers, mais il n'était pas le moteur de recherche le plus populaire.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-03'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-03-01', $answer);

        $answer = (new Answer())
            ->setText('Gopher était un outil de recherche concurrent de Google')
            ->setHelp("Cette réponse est incorrecte. En 1993, Google n'existait pas encore. Gopher n'était pas en concurrence avec Google à cette époque.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-03'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-03-02', $answer);

        $answer = (new Answer())
            ->setText('Gopher était largement utilisé pour la recherche d\'informations sur Internet en 1993')
            ->setHelp("Cette réponse est partiellement correcte. En 1993, Gopher était utilisé pour rechercher et accéder à des informations sur Internet, mais il n'était pas aussi répandu que d'autres technologies.")
            ->setPosition(3)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-03'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-03-03', $answer);

        $answer = (new Answer())
            ->setText('Gopher était un protocole de recherche d\'informations')
            ->setHelp("Cette réponse est correcte. En 1993, Gopher était un protocole de recherche et de partage de fichiers largement utilisé pour trouver et accéder à des informations en ligne.")
            ->setPosition(4)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-histoire-du-web-03'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-03-04', $answer);

        $answer = (new Answer())
            ->setText('Tim Berners-Lee')
            ->setHelp("Cette réponse est incorrecte. Tim Berners-Lee est célèbre pour avoir inventé le World Wide Web, mais il n'est pas l'auteur de \"As We May Think\".")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-04'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-04-01', $answer);

        $answer = (new Answer())
            ->setText('Alan Turing')
            ->setHelp("Cette réponse est incorrecte. Alan Turing était un mathématicien et informaticien britannique célèbre pour ses contributions à l'informatique, mais il n'est pas l'auteur de \"As We May Think\".")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-04'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-04-02', $answer);

        $answer = (new Answer())
            ->setText('Vannevar Bush')
            ->setHelp("Cette réponse est correcte. Vannevar Bush, un ingénieur américain et inventeur, est l'auteur de l'article \"As We May Think\", publié en 1945. Dans cet article, il a conceptualisé l'idée d'un système d'hypertexte appelé le \"Memex\", qui a influencé le développement ultérieur de l'informatique et du World Wide Web.")
            ->setPosition(3)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-histoire-du-web-04'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-04-03', $answer);

        $answer = (new Answer())
            ->setText('John von Neumann')
            ->setHelp("Cette réponse est incorrecte. John von Neumann était un mathématicien et physicien hongrois-américain, connu pour ses contributions à la physique quantique et à la théorie des jeux, mais il n'a pas écrit \"As We May Think\".")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-04'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-04-04', $answer);

        $answer = (new Answer())
            ->setText('Safari')
            ->setHelp("Cette réponse est incorrecte. Safari est un navigateur web développé par Apple, mais il a été introduit bien plus tard, en 2003, et n'a pas été le premier à permettre la navigation par clics.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-05'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-05-01', $answer);

        $answer = (new Answer())
            ->setText('iTunes')
            ->setHelp("Cette réponse est incorrecte. iTunes est un logiciel développé par Apple pour gérer et lire de la musique, des vidéos, et d'autres médias, mais il n'a pas été conçu pour la navigation par clics.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-05'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-05-02', $answer);

        $answer = (new Answer())
            ->setText('HyperCard')
            ->setHelp("Cette réponse est correcte. HyperCard était un logiciel révolutionnaire développé par Apple en 1987, et non en 1981, qui a permis la création de systèmes d'hypertexte et la navigation par clics. Il a joué un rôle important dans le développement des applications interactives et a influencé le développement ultérieur du World Wide Web.")
            ->setPosition(3)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-histoire-du-web-05'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-05-03', $answer);

        $answer = (new Answer())
            ->setText('QuickTime')
            ->setHelp("Cette réponse est incorrecte. QuickTime est un framework multimédia développé par Apple pour la lecture de vidéos et d'audio, mais il n'a pas été conçu pour la navigation par clics.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-05'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-05-04', $answer);

        $answer = (new Answer())
            ->setText('Le XHTML était un langage de programmation orienté objet destiné à créer des jeux vidéo')
            ->setHelp("Cette réponse est incorrecte. Le XHTML (eXtensible HyperText Markup Language) n'était pas un langage de programmation pour créer des jeux vidéo. En réalité, il s'agissait d'une technologie liée au web, conçue pour structurer et présenter le contenu des pages web de manière plus rigoureuse et conforme aux normes XML.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-06'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-06-01', $answer);

        $answer = (new Answer())
            ->setText('Le XHTML était une version améliorée du HTML, visant à être plus strictement conforme aux normes XML')
            ->setHelp("Cette réponse est correcte. Le XHTML (eXtensible HyperText Markup Language) était une évolution du HTML visant à être plus conforme aux normes XML (eXtensible Markup Language). Son ambition initiale était de rendre les pages web plus structurées, lisibles par les machines et compatibles avec XML.")
            ->setPosition(2)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-histoire-du-web-06'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-06-02', $answer);

        $answer = (new Answer())
            ->setText('Le XHTML était un langage de programmation pour le développement d\'intelligence artificielle')
            ->setHelp("Cette réponse est incorrecte. Le XHTML n'était pas lié au développement de l'intelligence artificielle. Il s'agissait d'une technologie de balisage utilisée pour créer des pages web, mais elle n'avait pas pour objectif de développer de l'intelligence artificielle.")
            ->setPosition(3)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-06'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-06-03', $answer);

        $answer = (new Answer())
            ->setText('Le XHTML était un système d\'exploitation open source pour les smartphones')
            ->setHelp("Cette réponse est incorrecte. Le XHTML n'était pas un système d'exploitation pour les smartphones. Il s'agissait d'une technologie de balisage spécialement conçue pour le web, visant à améliorer la structure et la compatibilité des pages web.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-06'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-06-04', $answer);

        $answer = (new Answer())
            ->setText('Google')
            ->setHelp("Cette réponse est incorrecte. Google a été lancé en 1998, mais il est devenu un moteur de recherche distinct et concurrent de Bing, développé par Microsoft.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-07'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-07-01', $answer);

        $answer = (new Answer())
            ->setText('AltaVista')
            ->setHelp("Cette réponse est incorrecte. AltaVista a été créé par une entreprise appelée Digital Equipment Corporation (DEC), le projet a été dirigé par Louis Monier, un ingénieur français. AltaVista a été lancé en 1995, mais il n'est pas devenu Bing. En fait, AltaVista a disparu en 2013.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-07'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-07-02', $answer);

        $answer = (new Answer())
            ->setText('Yahoo!')
            ->setHelp("Cette réponse est incorrecte. Yahoo! a été fondé par deux étudiants de l'Université Stanford, Jerry Yang et David Filo. L'idée originale était de créer un répertoire en ligne pour aider les utilisateurs à trouver des sites web intéressants sur Internet. Yahoo! a commencé comme un projet étudiant baptisé \"Jerry's Guide to the World Wide Web\" avant de devenir Yahoo! en 1994. Il n'est pas devenu Bing, bien que Yahoo! ait utilisé la technologie de recherche de Bing pendant un certain temps, les deux moteurs de recherche sont restés distincts.")
            ->setPosition(3)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-07'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-07-03', $answer);

        $answer = (new Answer())
            ->setText('MSN Search')
            ->setHelp("C'est la bonne réponse. MSN Search, lancé en 1998, est devenu Bing. Microsoft a renommé son moteur de recherche MSN Search en Bing en 2009 dans le cadre de sa stratégie de rebranding pour concurrencer Google. Depuis lors, Bing est devenu le moteur de recherche phare de Microsoft.")
            ->setPosition(4)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-histoire-du-web-07'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-07-04', $answer);

        $answer = (new Answer())
            ->setText('Internet Explorer')
            ->setHelp("Cette réponse est incorrecte. Internet Explorer n'était pas le premier navigateur web créé par Tim Berners-Lee. Il s'agissait d'un navigateur développé par Microsoft bien après les débuts du web.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-08'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-08-01', $answer);

        $answer = (new Answer())
            ->setText('Mosaic')
            ->setHelp("Cette réponse est incorrecte. Mosaic n'était pas le premier navigateur web créé par Tim Berners-Lee. Il a été développé par Marc Andreessen et Eric Bina à l'Université de l'Illinois.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-08'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-08-02', $answer);

        $answer = (new Answer())
            ->setText('WorldWideWeb')
            ->setHelp("Le premier navigateur web créé par Tim Berners-Lee s'appelait \"WorldWideWeb\". Il a été développé en 1990 au CERN (Organisation européenne pour la recherche nucléaire) et était le premier navigateur capable de visualiser des pages web.")
            ->setPosition(3)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-histoire-du-web-08'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-08-03', $answer);

        $answer = (new Answer())
            ->setText('Netscape Navigator')
            ->setHelp("Cette réponse est incorrecte. Netscape Navigator était un navigateur web populaire dans les années 1990, mais il n'a pas été créé par Tim Berners-Lee.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-08'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-08-04', $answer);

        $answer = (new Answer())
            ->setText('Windows')
            ->setHelp("Cette réponse est incorrecte. Windows est un système d'exploitation développé par Microsoft, mais il n'a pas été le précurseur de l'édition de texte en mode hypertexte en 1960.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-09'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-09-01', $answer);

        $answer = (new Answer())
            ->setText('Macintosh')
            ->setHelp("Cette réponse est incorrecte. Le Macintosh, également connu sous le nom de Mac, était un ordinateur personnel développé par Apple, mais il n'a pas été le précurseur de l'édition de texte en mode hypertexte en 1960.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-09'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-09-02', $answer);

        $answer = (new Answer())
            ->setText('Xerox')
            ->setHelp("C'est la bonne réponse. Le système précurseur de l'édition de texte en mode hypertexte en 1960 était développé par Xerox. Il s'agissait du système NLS (oN-Line System) créé par Douglas Engelbart au Stanford Research Institute (SRI). Ce système a introduit des concepts tels que la souris et l'édition de texte hypertexte.")
            ->setPosition(3)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-histoire-du-web-09'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-09-03', $answer);

        $answer = (new Answer())
            ->setText('IBM')
            ->setHelp("Cette réponse est incorrecte. IBM est une grande entreprise informatique, mais elle n'a pas été le précurseur de l'édition de texte en mode hypertexte en 1960.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-09'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-09-04', $answer);

        $answer = (new Answer())
            ->setText('HTML 1')
            ->setHelp("HTML 1 était la première version du langage HTML, introduite en 1993. À cette époque, les feuilles de style n'étaient pas encore une caractéristique intégrée dans HTML.")
            ->setPosition(1)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-10'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-10-01', $answer);

        $answer = (new Answer())
            ->setText('HTML 2')
            ->setHelp("HTML 2 était une version suivante du langage HTML, publiée en 1995. Bien qu'elle ait apporté certaines améliorations, elle n'a pas introduit les feuilles de style en tant que fonctionnalité majeure.")
            ->setPosition(2)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-10'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-10-02', $answer);

        $answer = (new Answer())
            ->setText('HTML 3')
            ->setHelp("HTML 3.2, publié en 1997, a fait une tentative significative pour introduire les feuilles de style dans le langage HTML. Il a été développé en parallèle avec la spécification CSS1 (Cascading Style Sheets Level 1) pour permettre la séparation de la structure du contenu et de la présentation visuelle. Bien que cette tentative n'ait pas été immédiatement couronnée de succès, elle a jeté les bases de l'utilisation ultérieure des feuilles de style dans le développement web.")
            ->setPosition(3)
            ->setCorrect(true)
            ->setQuestion($this->getReference('question-histoire-du-web-10'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-10-03', $answer);

        $answer = (new Answer())
            ->setText('HTML 4')
            ->setHelp("HTML 4.0 a été publié en décembre 1997 par le World Wide Web Consortium (W3C). Cette version du langage HTML a introduit des améliorations significatives par rapport aux versions précédentes, notamment en ce qui concerne les feuilles de style, mais elle n'a pas introduit le concept des feuilles de styles.")
            ->setPosition(4)
            ->setCorrect(false)
            ->setQuestion($this->getReference('question-histoire-du-web-10'));
        $manager->persist($answer);
        $this->addReference('answer-histoire-du-web-10-04', $answer);

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
