<?php

namespace iutnc\netVOD\renderer;

use iutnc\netVOD\user\User;

class ProfilRenderer implements renderer
{
    protected User $profil;

    /**
     * @param User $profil
     */
    public function __construct(User $profil)
    {
        $this->profil = $profil;
    }


    public function render(int $selector = 1): string
    {
        switch ($selector){
            case 1:
                $html = "
                    
                
                ";
                break;
        }
        return $html;
    }
}