<?php
namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\ListeDesPays;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $password_encoder){
        $this->password_encoder=$password_encoder;
    }
    public function load(ObjectManager $manager)
    {
        
        $user=new User();
        $user->setEmail($this->getUserData()[0]);
        $user->setPassword($this->password_encoder->encodePassword($user,$this->getUserData()[1]));
        $user->setRoles($this->getUserData()[2]);
        $manager->persist($user);

        foreach($this->getcountrie_data() as [$name,$code,$num_phone]){
            $num = (int)$num_phone;
            $countrie=new ListeDesPays();
            $countrie->SetNom($name);
            $countrie->SetCode($code);
            $countrie->setNumVert($num);
            $manager->persist($countrie);

        }
        $manager->flush();
    }
    private function getcountrie_data():array
    {
        return
         [
        ['France','fr','0900000000'],
        ['Belgique','be','0900000000'],
        ['Luxembourg','lu','0900000000'],
        ['Canada','ca','0900000000'],
        ['Suisse','ch','0900000000'],
        ['autres pays','universel','0900000000']    
    ];
    }

    private function getUserData()
    {
    
        return ['admin_monexetmoi@yahoo.fr','monexetmoi',['ROLE_ADMIN']];
    }
  
}
