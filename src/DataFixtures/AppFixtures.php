<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\DataFixtures\LogicException;




/**
 * classe abstraite pour simplifier l'enregistrement des entités
 * elle embarque Faker et permet de récupérer des entités aléatoires
 */

abstract class AppFixtures extends Fixture
{
    private $manager;
    /** @var Generator */
    protected $faker;
    /**
     * Listes des références vers des entités
     * @var string[][] un tableau contenant des tableaux de chaîne de caractères
     */
    private $references = [];

    /**
     * Methode à implémenter pour charger les entités
     * Une méthode abstraite ne possède pas de corps et doit obligatoirement être implémenter
     * par la classe qui en hérite
     */

    abstract protected function loadData() :void;
    /**
     * Méthode initialement appelée par la méthode fixtures
     * on enregistre nos propriétés et ensuite on appelle loadData()
     */

     public function load(ObjectManager $manager)
     {
        $this->manager = $manager;
        $this->faker = Factory::create('fr_FR');

        //les entités seront générées ds loadData() qui aura dc appelé $manager->persist()

        $this->loadData();
        $this->manager->flush();
     }

     /**
      * Créer un certain nombres d'entités
      *@param int $count Le nombre d'entités à générer
      *@param string $groupName le nom à donner en référence pour toutes les entités générées
      *@param callable $factory La fonction qui doit générer une entité à la fois
      */
      protected function createMany(int $count, string $groupName, callable $factory): void
      {
            for($i=0; $i< $count; $i++){

                //on doit exécuter la fonction $factory qui doit retourner l'entité générée
                $entity = $factory($i);

                if($entity === null){
                    throw new \LogicException('L\'entité doit être retournée !');
                }
                //on prépare à l'enregistrement de l'entité
                $this->manager->persist($entity);

                //on enregistre une référence pour l'entité récupéré
                //afin de pouvoir la récupérer plus tard dans d'autres classes de Fixtures
                $reference = sprintf('%s_%d',$groupName, $i);// ex : arttist_42
                $this->addReference($reference, $entity);

            }
      }
      /**
       * Récupérer une entité de manière aléatoire
       * @param string $groupName le nom commun aux références dans lesquelles receherchées
       * @return object une entité du groupe demandé
       */
      protected function getRandomReference(string $groupName): object
    {
        // si le groupe demandé est inconnu, on recherche les références
        if(!isset($this->references[$groupName]))
        {
            $this->references[$groupName]=[];

            //on parcourt l'ensemble des références
            foreach($this->referenceRepository->getReferences()as $refName => $val)
            {
                
                //$refName = référence d'un objet (ex : artist_42)
                //on vérifie si $refName commence par $groupName
                //sa position ds $refName doit être = 0
                if(strpos($refName,$groupName.'_') === 0 )
                {
                    $this->references[$groupName][] = $refName;
                }
            }
            
        }
        // on vérifie que l'on ait trouvé des références
        if($this->references[$groupName]===[])
        {
            throw new \Exception(sprintf('Aucune référence trouvée pour le groupe"%s"',$groupName));
        }

        //Récupération aléatoire d'un objet associé à une référence du groupe
        $randomRefName = $this->faker->randomElement($this->references[$groupName]);
        return $this->getReference($randomRefName);

    }

}
