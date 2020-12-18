<?php
session_start();
ob_start();
require __DIR__ . '/../controller/Users.php';
?>

<div class="container-fluid mt-5">
  <div class="row m-0">
    <div class="col-2 border border-dark offset-1 py-2 window left-border">
      <div class="you border-bottom border-dark" id="you">
        <div id="youTarget" class="d-flex align-items-center"></div>
        <select name="status" id="selectStatus" class="status window">
          <option value="0">Absent</option>
          <option value="1">Occupé</option>
          <option value="2">En ligne</option>
        </select>
        <form method="POST">
          <input type="submit" name="logout" value="logout">
        </form>
        <?php if (isset($_POST['logout'])) {
    $user = new Users();
    $user->logout($_SESSION);
}?>
      </div>
      <div id="users"></div>
    </div>
    <div class="col-8 border border-dark p-0 window right-border">
      <div class="chat-box px-4 pb-2" id="target"></div>
      <?php if($_SESSION['loggedin']):?>
      <div class="message-box d-flex justify-content-between">
        <input class="text-field window" type="text" id="message" maxlength="255" />
        <button id="submit">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
          </svg>
        </button>
        <?php else:?>
          <a type="button" href="view/users/login.php" class="btn btn-primary ml-1 mb-1">Login</a>
          <a type="button" href="view/users/register.php" class="btn btn-primary ml-1 mb-1">Register</a>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>

<?php $content = ob_get_clean();
require 'template.php';?>
