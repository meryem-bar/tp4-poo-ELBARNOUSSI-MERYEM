<?php
// 6.1
class Animal {
    public function manger(): void {
        echo "Je mange." . PHP_EOL;
    }
}

class Chien extends Animal {
    public function aboyer(): void {
        echo "Wouf !" . PHP_EOL;
    }
}

class Chat extends Animal {
    public function miauler(): void {
        echo "Miaou !" . PHP_EOL;
    }
}

$c = new Chien();
$c->manger();
$c->aboyer();

$ch = new Chat();
$ch->manger();
$ch->miauler();

// $c->miauler();

echo PHP_EOL;

// 6.2
class PersonneSimple {
    public function __construct(protected string $nom) {}

    public function presentation(): string {
        return "Je suis " . $this->nom;
    }
}

class EtudiantSimple extends PersonneSimple {
    public function __construct(string $nom, private string $filiere) {
        parent::__construct($nom);
    }

    public function presentation(): string {
        return parent::presentation() . ", étudiant en " . $this->filiere;
    }
}

$e = new EtudiantSimple("Ahmed", "Informatique");
echo $e->presentation() . PHP_EOL;

echo PHP_EOL;

// 6.3
class Base {
    final public function afficher(): void {
        echo "Méthode finale" . PHP_EOL;
    }
}

final class Outil {
    public const VERSION = "1.0";
}

class Produit {
    public function __construct(public readonly string $reference) {}
}

$produit = new Produit("REF-001");
echo $produit->reference . PHP_EOL;

// class Fille extends Base {
//     public function afficher(): void {}
// }

// class SousOutil extends Outil {}

// $produit->reference = "REF-002";

echo PHP_EOL;

// 6.4
class Personne {
    public string $nom;
    public string $prenom;
    private string $dateNaissance;
    private string $villeNaissance;
    private string $cin;

    public function __construct(
        string $nom,
        string $prenom,
        string $dateNaissance,
        string $villeNaissance,
        string $cin
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->villeNaissance = $villeNaissance;
        $this->cin = $cin;
    }

    private function getAge(): int {
        $naissance = new DateTime($this->dateNaissance);
        $aujourdhui = new DateTime();
        return $naissance->diff($aujourdhui)->y;
    }

    public function __toString(): string {
        return $this->prenom . " " . $this->nom . " (" . $this->getAge() . " ans)";
    }
}

class Etudiant extends Personne {
    private string $cne;

    public function __construct(
        string $nom,
        string $prenom,
        string $dateNaissance,
        string $villeNaissance,
        string $cin,
        string $cne
    ) {
        parent::__construct($nom, $prenom, $dateNaissance, $villeNaissance, $cin);
        $this->cne = $cne;
    }

    public function getCne(): string {
        return $this->cne;
    }

    public function __toString(): string {
        return parent::__toString() . " - CNE : " . $this->cne;
    }
}

$etudiants = [];
$etudiants[] = new Etudiant("Hachimi", "Sara", "2003-05-14", "Marrakech", "EE123456", "R130123456");
$etudiants[] = new Etudiant("Alaoui", "Karim", "2002-11-02", "Casablanca", "BK654321", "R130234567");
$etudiants[] = new Etudiant("Bennani", "Lina", "2003-01-27", "Rabat", "A789012", "R130345678");
$etudiants[] = new Etudiant("Tazi", "Omar", "2002-08-19", "Fès", "CD345678", "R130456789");
$etudiants[] = new Etudiant("Idrissi", "Salma", "2004-03-09", "Tétouan", "L901234", "R130567890");

foreach ($etudiants as $e) {
    echo $e . PHP_EOL;
}
