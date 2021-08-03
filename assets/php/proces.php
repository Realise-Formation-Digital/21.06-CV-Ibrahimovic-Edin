<?php
if (isset($_POST['Email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "edin_ibrahimovic@hotmail.com";
    $email_subject = "Contact CV";

    function problem($error)
    {
        echo "Nous sommes vraiment désolés, mais des erreurs ont été trouvées avec le formulaire que vous avez soumis.  ";
        echo "Les erreurs sont:<br><br>";
        echo $error . "<br><br>";
        echo "Veuillez revenir en arrière et corriger ces erreurs. <br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['Nom']) ||
        !isset($_POST['E-mail']) ||
        !isset($_POST['Message'])
    ) {
        problem('Nous sommes désolés, mais il semble y avoir un problème avec le formulaire que vous avez soumis. ');
    }

    $name = $_POST['Name']; // required
    $email = $_POST['Email']; // required
    $message = $_POST['Message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'L\'adresse e-mail que vous avez saisie ne semble pas valide. <br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'Le nom que vous avez entré ne semble pas valide. <br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Le message que vous avez saisi ne semble pas valide. <br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Nom: " . clean_string($name) . "\n";
    $email_message .= "E-mail: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- include your success message below -->

    Merci. Je vous contact très prochainement. 

<?php
}
?>
