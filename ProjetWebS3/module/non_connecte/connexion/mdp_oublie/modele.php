<?php


include_once ("module/Parametre_connexion.php");

class Modele extends Parametre_connexion
{
    private $bdd;

    function __construct()
    {
        parent::__construct();
        try {
            $this->bdd = new PDO("mysql:host=$this->host_name; dbname=$this->database;", $this->user_name, $this->password);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function RecupMDP($email){
        $sql = "SELECT pseudo_client FROM Client WHERE email_client = ?";
        $requete = $this->bdd->prepare($sql);
        $requete->execute(array($email));

        $pseudo = $requete->fetch(PDO::FETCH_ASSOC);

        if($pseudo != null){

            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);

            $urlToEmail = 'https://livesport.onl?module=connexion&recup_mdp=in&'.http_build_query([
                    'selector' => $selector,
                    'validator' => bin2hex($token)
                ]);
            $expires = new DateTime('NOW');
            $expires->add(new DateInterval('PT01H')); // 1 hour

            $sql = "INSERT INTO password_recovery (pseudo_client, selector, token, expires) VALUES (:pseudo_client, :selector, :token, :expires);";
            $requete = $this->bdd->prepare($sql);
            $requete->execute([
                'pseudo_client' => $pseudo['pseudo_client'], // define this elsewhere!
                'selector' => $selector,
                'token' => hash('sha256', $token),
                'expires' => $expires->format('Y-m-d\TH:i:s')
            ]);


            $to = $email;
            $subject = 'Reset PassWord LIVESPORT';
            $message = '
                <html>
                    <head>                                          
                        <title>Reset PassWord LIVESPORT</title>
                    </head>
                    <body>
                        <p>Bonjour, suite a votre demande de reset de password, voici un lien de changement de mot de passe: <a href="'.$urlToEmail.'">lien</a></p>
                        <p>'.$pseudo['pseudo_client'].'</p>
                    </body>
                </html>
            ';
            $header = "MIME-VERSION: 1.0\r\n";
            $header .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $header .= "To: <".$email.">\r\n";
            $header .= "From: LiveSport <robot@livesport.onl>\r\n";

            mail($to, $subject, $message, $header);
        }
    }

    function verifRecup($selector, $validator){

        $retour = false;

        $sql = "SELECT * FROM password_recovery WHERE selector = ? AND expires >= NOW()";
        $requete = $this->bdd->prepare($sql);
        $requete->execute(array($selector));

        $result = $requete->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
            $calc = hash('sha256', hex2bin($validator));
            if(hash_equals($calc, $result['token'])){
                $retour = true;
                $_SESSION['pseudo'] = $result['pseudo_client'];
            }
        }

        $sql = "DELETE FROM password_recovery WHERE pseudo_client = ?";
        $requete = $this->bdd->prepare($sql);
        $requete->execute(array($result['pseudo_client']));

        return $retour;
    }

    function modifMDP(){
        if($_POST['pass'] == $_POST['pass2']){
            include_once ("src/crypto/key.php");

            $salt = crypt($_SESSION['pseudo'], $key);

            $pass = password_hash($_POST['pass'].$salt, PASSWORD_BCRYPT);

            $sql = "UPDATE Client SET mdp_client = ? WHERE pseudo_client = ?";
            $requete = $this->bdd->prepare($sql);
            $requete->execute(array($pass, $_SESSION['pseudo']));
        }
    }

}