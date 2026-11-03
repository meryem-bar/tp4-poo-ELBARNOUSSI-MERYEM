<?php
class Personne {
    private string $nom = "";
    private string $prenom = "";
    private string $dateNaissance = "";

    public function __set(string $name, mixed $value): void {
        if (property_exists($this, $name)) {
            if ($name == "nom" && strlen($value) < 2) {
                throw new InvalidArgumentException("Le nom doit contenir au moins 2 caractères");
            }
            $this->$name = $value;
        } else {
            echo "Propriété $name inexistante" . PHP_EOL;
        }
    }

    public function __get(string $name): mixed {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }

    public function __isset(string $name): bool {
        return property_exists($this, $name) && $this->$name !== "";
    }

    public function __unset(string $name): void {
        if (property_exists($this, $name)) {
            $this->$name = "";
        }
    }
}

$p = new Personne();
$p->nom = "Hachimi";
echo $p->nom . PHP_EOL;
var_dump(isset($p->nom));
unset($p->nom);
var_dump(isset($p->nom));
$p->telephone = "0600000000";

try {
    $p->nom = "A";
} catch (InvalidArgumentException $e) {
    echo "Erreur : " . $e->getMessage() . PHP_EOL;
}

try {
    $p->nom = "";
} catch (InvalidArgumentException $e) {
    echo "Erreur : " . $e->getMessage() . PHP_EOL;
}
