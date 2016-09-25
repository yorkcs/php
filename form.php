<style>
<!-- Reduce placeholder opacity when selected -->
[placeholder]:focus::-webkit-input-placeholder {
  transition: opacity 0.5s 0.5s ease; 
  opacity: 0;
}
</style>

<?php
  if (isset($_POST["submit"])) {
    $name = $_POST['contact-name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $from = 'Website Contact Form'; 
    $to = 'yorkcs@outlook.com'; 
    $subject = 'Message from caseyy.com';
		
    $body = "From: $name\n E-Mail: $email\n Message:\n $message";
 
    // Check if name has been entered
    if (!$_POST['contact-name']) {
      $errName = 'Please enter your name';
     }
		
    // Check if email has been entered and is valid
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errEmail = 'Please enter a valid email address';
    }
		
    //Check if message has been entered
    if (!$_POST['message']) {
      $errMessage = 'Please enter your message';
    }
 
    // If there are no errors, send the email
    if (!$errName && !$errEmail && !$errMessage) {
      if (mail($to, $subject, $body, $from)) {
        $result='<div class="alert alert-success">Your message has been sent</div>';
      } else {
        $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
      }
    }
  }
?>
<legend class="mb40">
  Whether you're recruiting or simply looking for someone to talk shop with, send me a message and I'll get back to you ASAP.
</legend>
<form class="form-horizontal" role="form" method="post" action="#contact">
  <div class="form-group">
    <div class="col-xs-10 col-xs-offset-0 col-sm-10 col-sm-offset-1">
      <input type="text" class="form-control" id="name" name="contact-name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['contact-name']); ?>">
        <?php echo "<p class='text-danger'>$errName</p>";?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-xs-10 col-xs-offset-0 col-sm-10 col-sm-offset-1">
      <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($_POST['email']); ?>">
      <?php echo "<p class='text-danger'>$errEmail</p>";?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-xs-10 col-xs-offset-0 col-sm-10 col-sm-offset-1">
      <textarea class="form-control" rows="4" placeholder="Message" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
      <?php echo "<p class='text-danger'>$errMessage</p>";?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-xs-10 col-xs-offset-0 col-sm-10 col-sm-offset-1">
      <input id="submit" name="submit" type="submit" value="Send" class="button-blush">
    </div>
  </div>
  <div class="form-group">
    <div class="col-xs-10 col-xs-offset-0 col-sm-10 col-sm-offset-2">
      <?php echo $result; ?>	
    </div>
  </div>
</form> 
