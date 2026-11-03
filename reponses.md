# Réponses TP 4 - POO PHP

Nom : El Barnoussi
Prénom : Meryem
Groupe : Gr_02
N° Apogée : 2522708

## Partie 0

0.3 : Non, $v1 et $v2 sont deux objets différents créés avec new. Chacun a ses propres valeurs ($v1->marque vaut Toyota et $v2->marque vaut Renault). La classe est seulement le modèle.

## Partie 1

1.1 : Les lignes echo $p->cin et echo $p->dateNaissance donnent l'erreur "Cannot access private property". La ligne echo $p->getAge() donne "Call to private method Personne::getAge() from global scope". Seuls getName() et nom marchent car ils sont en public.

1.2 : Si cin est public, on peut le lire ou le modifier directement depuis l'extérieur sans aucun contrôle.

1.3 : Non, elle sert à l'intérieur de la classe. Une autre méthode publique de la même classe peut l'appeler (comme __toString() dans la partie 4).

1.4 : Non, depuis l'extérieur c'est toujours inaccessible ("Cannot access protected property"). La différence se voit seulement avec l'héritage dans les classes filles.

## Partie 2

2.1.a : Avec new Voiture("Noire"), la couleur est "Noire" et la vitesse prend la valeur par défaut 0. Avec new Voiture(120), PHP convertit 120 en chaîne "120" pour la couleur et met la vitesse à 0.

2.1.b : C'est plus court : on déclare et on initialise les attributs directement dans les paramètres du constructeur sans tout réécrire avec $this.

2.2.a : On a une erreur fatale "Cannot redeclare Personne::__construct()". En PHP on ne peut pas mettre deux constructeurs dans la même classe.

2.2.b : On garde un seul constructeur et on met des valeurs par défaut vides aux paramètres ($nom = "", etc.).

2.2.c : Une méthode statique de fabrique est une méthode static qui crée et retourne un objet avec new (par exemple Personne::depuisTableau($data)).

2.3.a :
1. Voiture Blanche créée.
2. Voiture Blanche détruite.
3. Fin du script.

2.3.b : Sans unset(), l'objet est détruit automatiquement à la fin du script, donc "Fin du script." s'affiche avant "Voiture Blanche détruite.".

2.3.c : À la fin du script, $b est détruit avant $a (dans l'ordre inverse de leur création).

## Partie 3

3.1 : On obtient Hachimi, puis bool(true), puis bool(false) après unset(). Pour $p->telephone, ça affiche "Propriété telephone inexistante".

3.2 : Sans __set, $p->nom = "X" donne une erreur fatale car nom est private. Avec __set, PHP appelle la méthode automatiquement et modifie la valeur depuis l'intérieur de la classe.

3.3 : Oui, si __set accepte toutes les valeurs sans vérifier, c'est comme si l'attribut était public. Pour valider, on ajoute une condition if dans __set avant de modifier l'attribut.

3.4 : Si le nom est vide ou a moins de 2 caractères (strlen($value) < 2), on lance une exception avec throw new InvalidArgumentException.

## Partie 4

4.1 : Parce que __toString() est à l'intérieur de la classe Personne, donc elle a le droit d'appeler la méthode privée getAge().

4.2 : __toString() doit retourner une chaîne de caractères (string). Si on retourne un entier, PHP le convertit en chaîne s'il peut, mais le type de retour attendu est string.

4.3 : Ça permet de faire echo $p directement sans appeler getName(). C'est pratique dans une boucle foreach ou pour concaténer l'objet dans du texte.

## Partie 5

5.1 : Non, le mot de passe n'est pas dans la chaîne car __serialize() retourne seulement le tableau avec nom et age.

5.2 : Si on met __serialize() en commentaire, le mot de passe (secret123) apparaît en clair dans la chaîne sérialisée même s'il est private. C'est dangereux si on garde la chaîne dans un fichier ou une session.

5.3 : Après unserialize(), $motDePasse est vide (""). Dans une vraie application, il faudrait le récupérer depuis la base de données ou reconnecter l'utilisateur.

5.4 : Il ne faut jamais faire unserialize() sur des données de l'utilisateur à cause de la faille PHP Object Injection (l'utilisateur peut injecter un objet qui exécute du code via __wakeup ou __destruct). À la place on utilise json_encode() et json_decode().

## Partie 6

6.1.b : Non, $c est un Chien et la méthode miauler() existe seulement dans la classe Chat ("Call to undefined method Chien::miauler()").

6.2.a : L'attribut $nom du parent n'est pas initialisé car le constructeur de Personne n'est pas appelé, ce qui donne une erreur quand on appelle presentation().

6.2.b : Pour que la classe fille Etudiant puisse y accéder. S'il était private, il serait visible uniquement dans Personne.

6.3.a :
1. "Cannot override final method Base::afficher()"
2. "Class SousOutil cannot extend final class Outil"
3. "Cannot modify readonly property Produit::$reference"

6.3.b : readonly est utile pour une valeur qui ne change jamais après création (référence produit, CIN, ISBN). final est utile pour interdire de modifier une méthode ou d'hériter d'une classe.

6.4.a : On a l'erreur "Call to private method Personne::getAge() from scope Etudiant". Il faut mettre getAge() en protected.

6.4.b : Parce que dateNaissance est private dans Personne, donc même la classe fille Etudiant ne peut pas y accéder directement.

6.4.c : On réutilise le code déjà écrit dans Personne sans répéter l'affichage du nom, du prénom et de l'âge.

## Partie 7

7.1 : Dans un_an(), il manque le signe + avant le 1 ($this->montant 1 * ...), ce qui donne une erreur de syntaxe.

7.2 : La bonne formule est : $this->montant = $this->montant * (1 + $this->interet / 100);

7.3 : Non, l'énoncé demande le montant initial puis l'intérêt, mais le constructeur avait inversé l'ordre ($interet, $montantInitial). On risque d'inverser le montant et le taux lors de l'appel.

7.4 : Au bout de 10 ans, on trouve 1 037,50 dirhams pour le compte 1 et 4 072,24 dirhams pour le compte 2.

## Questions de synthèse

1. La classe est le modèle (le plan) qui contient les attributs et méthodes, et l'objet est une instance créée à partir de cette classe avec new.
2. Meilleure organisation du code, maintenance plus facile, et réutilisation du code avec l'héritage sans duplication.
3. C'est l'encapsulation : ça permet de protéger les données de l'objet pour qu'on ne puisse pas les modifier n'importe comment depuis l'extérieur.
4. private est accessible uniquement dans la classe elle-même, alors que protected est accessible dans la classe et dans les classes filles.
5. Oui, elles doivent être public (sinon PHP affiche un E_WARNING). Les exceptions autorisées sont __construct(), __destruct() et __clone().