<?php



class RegisterForm
{
    private string $name;
    private string $email;
    private string $password;
    private string $passwordConfirmation;
    private string $role;



    public function __construct() {}

    public function __call($name, $args)
    {

        if($name == 'instanceWithAll')
        {
            if(count($args) == 7)
            {
                $this->name = $args[0];
                $this->email = $args[1];
                $this->password = $args[2];
                $this->passwordConfirmation = $args[3];
                $this->role = $args[4];
            }
        }
    }

    public function getFirstname()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getPasswordConfirmation()
    {
        return $this->passwordConfirmation;
    }
    public function getRoleName()
    {
        return $this->role;
    }


    
}
