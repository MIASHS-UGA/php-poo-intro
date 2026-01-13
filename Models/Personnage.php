<?php
class Personnage
{
    private $id;
    private $nom;
    private $forcePerso;
    private $degats;
    private $niveau;
    private $experience;

    public function __construct($values = array())
    {
        if (!empty($values)) {
            $this->hydrate($values);
        }
    }

    // PARCOURS du tableau $donnees (avec pour clé $cle et pour valeur $valeur)
    //   On assigne à $setter la valeur « 'set'.$cle », en mettant la
    //   première lettre de $cle en majuscule (utilisation de ucfirst())
    //   SI la méthode $setter de notre classe existe ALORS
    //     On invoque $setter($valeur)
    //   FIN SI
    // FIN PARCOURS

    // $donnees = [
    //     'id' => 16,
    //     'nom' => 'Vyk12',
    //     'forcePerso' => 5,
    //     'degats' => 55,
    //     'niveau' => 4,
    //     'experience' => 20
    //   ];

    // Un tableau de données doit être passé à la fonction (d'où le préfixe « array »).
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set' . ucfirst($key); // ucfirst important! Par exemple, le setter correspondant à nom est setNom.

            // Si le setter correspondant existe.
            if (method_exists($this, $method)) {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }


    public function id()
    {
        return $this->id;
    }
    public function nom()
    {
        return $this->nom;
    }
    public function forcePerso()
    {
        return $this->forcePerso;
    }
    public function degats()
    {
        return $this->degats;
    }
    public function niveau()
    {
        return $this->niveau;
    }
    public function experience()
    {
        return $this->experience;
    }

    public function setId($id)
    {
        // L'identifiant du personnage sera, quoi qu'il arrive, un nombre entier.
        $this->id = (int) $id;
    }

    public function setNom($nom)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        // Dont la longueur est inférieure à 30 caractères.
        if (is_string($nom) && strlen($nom) <= 30) {
            $this->nom = $nom;
        }
    }

    public function forceAuHasard()
    {
        $this->setForcePerso(rand(0,100));
    }

    public function setForcePerso($forcePerso)
    {
        $forcePerso = (int) $forcePerso;

        // On vérifie que la force passée est comprise entre 0 et 100.
        if ($forcePerso >= 0 && $forcePerso <= 100) {
            $this->forcePerso = $forcePerso;
        }
    }

    public function setDegats($degats)
    {
        $degats = (int) $degats;

        // On vérifie que les dégâts passés sont compris entre 0 et 100.
        if ($degats >= 0 && $degats <= 100) {
            $this->degats = $degats;
        }
    }

    public function setNiveau($niveau)
    {
        $niveau = (int) $niveau;

        // On vérifie que le niveau n'est pas négatif.
        if ($niveau >= 0) {
            $this->niveau = $niveau;
        }
    }

    public function setExperience($exp)
    {
        $exp = (int) $exp;

        // On vérifie que l'expérience est comprise entre 0 et 100.
        if ($exp >= 0 && $exp <= 100) {
            $this->experience = $exp;
        }
    }

    public function frapper(Personnage $persoAFrapper)
    {
        // Utiliser les getters/setters plutôt que l'accès direct aux propriétés privées.
        $persoAFrapper->setDegats($persoAFrapper->degats() + $this->forcePerso());
    }

    public function gagnerExperience()
    {
        // Respecter les validations du setter.
        $this->setExperience($this->experience() + 1);
    }
}
