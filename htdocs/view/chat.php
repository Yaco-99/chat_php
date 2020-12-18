<?php ob_start();?>

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
      </div>
      <div id="users"></div>
    </div>
    <div class="col-8 border border-dark p-0 window right-border">
      <div class="chat-box px-4 pb-2" id="target"></div>
      <div class="message-box d-flex justify-content-between">
        <input class="text-field window" type="text" id="message" maxlength="255" />
        <button id="submit">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</div>

<?php $content = ob_get_clean();
require 'template.php';?>
