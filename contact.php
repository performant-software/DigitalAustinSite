<?php require_once 'src/TemplateRenderer.class.php';
require_once('vendor/autoload.php');
use Postmark\PostmarkClient;
use Postmark\Models\PostmarkException;

$success = null;
// Google recaptcha site key and secret
$site_key = $_ENV['CAPTCHA_SITE_KEY'];
$secret = $_ENV['CAPTCHA_SECRET'];

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

    try {
      $client = new PostmarkClient($_ENV['POSTMARK_TOKEN']);
      $subject = "Digital Austin Collection: " . $reason;
      $body = $message . "\n\n" . "From: " . $name . " - " . $email;

      $sendResult = $client->sendEmail($_ENV['EMAIL_SENDER'],
        $_ENV['EMAIL_RECIPIENT'],
        $subject,
        $body);

      $success = 'success';
    } catch(PostmarkException $ex){
      // If the client is able to communicate with the API in a timely fashion,
      // but the message data is invalid, or there's a server error,
      // a PostmarkException can be thrown.
      // echo $ex->httpStatusCode;
      // echo $ex->message;
      // echo $ex->postmarkApiErrorCode;
      echo 'Oops! Exception occured while trying to send mail with Postmark.';
    } catch(Exception $generalException){
      // A general exception is thrown if the API
      // was unreachable or times out.
      echo 'Oops! Exception occured while trying to send mail with Postmark.';
    }
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
