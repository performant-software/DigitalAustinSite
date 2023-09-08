<?php require_once 'src/TemplateRenderer.class.php';
require_once('vendor/autoload.php');
use Postmark\PostmarkClient;
use Postmark\Models\PostmarkException;

$success = null;
// Google recaptcha site key and secret
$site_key = getenv('CAPTCHA_SITE_KEY');
$secret = getenv('CAPTCHA_SECRET');

if(isset($_POST['submit'])) {
  require_once('php/localCredentials.php');

  $recaptcha = new \ReCaptcha\ReCaptcha($secret);
  $resp = $recaptcha->verify(htmlspecialchars($_POST['g-recaptcha-response']));

  // set $success to fail by default on form submission
  $success = 'fail';

  if ($resp->isSuccess()) {
    $name = htmlspecialchars($_POST['contact_name']);
    $email = filter_var($_POST['contact_email'], FILTER_SANITIZE_EMAIL);
    $reason = filter_var($_POST['contact_reason']);
    $message = htmlspecialchars($_POST['contact_message']);

    $client = new PostmarkClient(getenv('POSTMARK_TOKEN'));
    $subject = "Digital Austin Collection: " . $reason;
    $body = $message . "\n\n" . "From: " . $name . " - " . $email;

    $sendResult = $client->sendEmail(getenv('EMAIL_SENDER'),
      getenv('EMAIL_RECIPIENT'),
      $subject,
      $body);

    $success = 'success';
  } else {
    $errors = $resp->getErrorCodes();
  }
}

$template = new TemplateRenderer();
// Include any variables as an array in the second param
print $template->render('contact.html.twig', array(
                        'success' => $success,
                        'body_id' => 'contact',
                        'site_key' => $site_key
));
