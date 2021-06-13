<?php
class Contact extends Model
{
    
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    protected string $text;

    public function __construct(string $firstName = '', string $lastName = '', string $email = "", string $text = "")
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->text = $text;
    }

    public function sendContactForm()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPSendContactForm( :firstName, :lastName, :email, :text)");
                $stmt->execute([
            ':firstName' => $this->firstName,
            ':lastName' => $this->lastName,
            ':email' => $this->email,
            ':text' => $this->text
        ]);
    }
}