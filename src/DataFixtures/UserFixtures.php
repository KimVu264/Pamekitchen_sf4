<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class UserFixtures extends AppFixtures
{
    private $encoder;


    /**
     * Dans la plupart des classes pour répurer un service
     * on peut le demander en argument du constructeur qui est la seule
     * méthode bénéficiant de l'autowiring
     */

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }



    protected function loadData(): void
    {

      //on va générer 3 administrateurs   
      $this->createMany(3, 'user_admin', function(int $num)
      {
        $user = new User();
        $password = $this->encoder->encodePassword($user,'admin'.$num);
        

        return $user

            ->setEmail('admin'.$num.'@pamekitchen.fr')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($password)
            ->setPseudo('admin'.$num)

         ;   
      });
    
    
      //on va générer 20 utilisateurs
      $this->createMany(20,'user_user',function(int $num){
          $user = new User();
          $password=$this->encoder->encodePassword($user, 'user'.$num);

          return $user
          ->setEmail('user'.$num.'@pamekitchen.fr')
          ->setPassword($password)
          ->setPseudo('user'.$num)
          ;

      });
    }
}
