<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécurisation des données
    $name = htmlspecialchars(trim($_POST["name"] ?? ""));
    $email = filter_var(trim($_POST["email"] ?? ""), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST["phone"] ?? ""));
    $service = htmlspecialchars(trim($_POST["service"] ?? ""));
    $message = htmlspecialchars(trim($_POST["message"] ?? ""));

    // Vérification des champs requis
    if (empty($name) || empty($email) || empty($message)) {
        echo "Veuillez remplir tous les champs obligatoires.";
        exit;
    }

    // Configuration de l'email
    $to = "brayankoutang7@gmail.com"; // Ton adresse email
    $subject = "📩 Nouveau message du formulaire de contact";
    $body = "👤 Nom : $name\n";
    $body .= "📧 Email : $email\n";
    $body .= "📞 Téléphone : $phone\n";
    $body .= "🛠 Service : $service\n\n";
    $body .= "💬 Message :\n$message";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Envoi de l'email
    if (mail($to, $subject, $body, $headers)) {
        // Redirection vers la page merci
        header("Location: merci.html");
        exit;
    } else {
        echo "❌ Une erreur est survenue. Veuillez réessayer plus tard.";
    }
} else {
    echo "Accès non autorisé.";
}
?>