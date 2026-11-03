<?php
// 2.1
class Voiture {
    public string $couleur;
    public int $vitesse;

    public function __construct(string $couleur = "Blanche", int $vitesse = 0) {
        $this->couleur = $couleur;
        $this->vitesse = $vitesse;
    }

    public function afficher(): void {
        echo "Couleur : {$this->couleur} | Vitesse : {$this->vitesse} km/h" . PHP_EOL;
    }
}

$v1 = new Voiture();
$v2 = new Voiture("Rouge", 50);
$v3 = new Voiture("Noire");
$v4 = new Voiture(120);
$v1->afficher();
$v2->afficher();
$v3->afficher();
$v4->afficher();

// promotion de propriétés
class VoiturePromo {
    public function __construct(
        public string $couleur = "Blanche",
        public int $vitesse = 0
    ) {}
}

$v5 = new VoiturePromo("Bleue", 80);
echo $v5->couleur . " " . $v5->vitesse . PHP_EOL;

echo PHP_EOL;

// 2.2 et 2.3.d
class Personne {
    public string $nom;
    public string $prenom;
    private string $dateNaissance;
    private string $villeNaissance;
    private string $cin;

    public function __construct(
        string $nom = "",
        string $prenom = "",
        string $dateNaissance = "",
        string $villeNaissance = "",
        string $cin = ""
    ) {
        echo "Création " . __CLASS__ . PHP_EOL;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->villeNaissance = $villeNaissance;
        $this->cin = $cin;
    }

    public static function depuisTableau(array $data): Personne {
        return new Personne(
            $data['nom'],
            $data['prenom'],
            $data['dateNaissance'],
            $data['villeNaissance'],
            $data['cin']
        );
    }

    public function __destruct() {
        echo "Détruire " . __CLASS__ . PHP_EOL;
    }
}

$p1 = new Personne();
$p2 = new Personne("Hachimi", "Sara", "2000-05-14", "Marrakech", "EE123456");
$p3 = Personne::depuisTableau([
    "nom" => "Alaoui",
    "prenom" => "Karim",
    "dateNaissance" => "2002-11-02",
    "villeNaissance" => "Casablanca",
    "cin" => "BK654321"
]);
echo $p3->prenom . " " . $p3->nom . PHP_EOL;

echo PHP_EOL;

// 2.3
class VoitureD {
    public function __construct(public string $couleur) {
        echo "Voiture {$this->couleur} créée." . PHP_EOL;
    }

    public function __destruct() {
        echo "Voiture {$this->couleur} détruite." . PHP_EOL;
    }
}

$maVoiture = new VoitureD("Blanche");
unset($maVoiture);
echo "Fin du script." . PHP_EOL;

$a = new VoitureD("A");
$b = new VoitureD("B");
