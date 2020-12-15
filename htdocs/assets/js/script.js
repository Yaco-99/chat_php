document.addEventListener("DOMContentLoaded", async () => {
  await getMessage();
  await getOnline();

  function getMessage() {
    return new Promise((resolve) => {
      const xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = async function () {
        if (this.readyState == 4 && this.status == 200) {
          const data = JSON.parse(this.response);
          if (data.error == 0) {
            document.getElementById("target").innerHTML = data.messages;
          } else if (data.error == "unlog") {
            alert("You're not logged");
          }
          resolve();
        }
      };

      xmlhttp.open("GET", `controller/get-message.php`, true);

      xmlhttp.send();
    });
  }

  document.getElementById("submit").addEventListener("click", () => {
    postMessage();
  });

  document.getElementById("message").addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      postMessage();
    }
  });

  function postMessage() {
    return new Promise((resolve) => {
      let message = new FormData();
      const input = document.getElementById("message");

      const xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = async function () {
        if (this.readyState == 4 && this.status == 200) {
          if (this.response) {
            input.value = "";
          } else {
            alert(this.response);
          }
          resolve();
        }
      };

      xmlhttp.open("POST", `controller/post-message.php`, true);
      message.append("message", input.value);
      xmlhttp.send(message);
    });
  }

  function getOnline() {
    return new Promise((resolve) => {
      const xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = async function () {
        if (this.readyState == 4 && this.status == 200) {
          const data = JSON.parse(this.response);
          console.log(data);
          if (data.error == "0") {
            let online = "",
              i = 1,
              image,
              text;

            for (let id in data["list"]) {
              if (data["list"][id]["status"] == "busy") {
                text = "Occupé";
                image = "busy";
              } else if (data["list"][id]["status"] == "inactive") {
                text = "Absent";
                image = "inactive";
              } else {
                text = "En ligne";
                image = "active";
              }
              online +=
                '<a href="#post" onclick="insertLogin(\'' +
                data["list"][id]["login"] +
                '\')" title="' +
                text +
                '">';
              online += '<img src="status-' + image + '.png" /> ';
              online += data["list"][id]["login"] + "</a>";

              if (i == 1) {
                i = 0;
                online += "<br>";
              }
              i++;
            }
            document.getElementById("users").innerHTML = online;
          } else if (data.error == "1") {
            document.getElementById("users").innerHTML =
              "Aucun utilisateur connecté";
          }
          resolve();
        }
      };

      xmlhttp.open("GET", `controller/get-online.php`, true);
      xmlhttp.send();
    });
  }

  document.getElementById("selectStatus").addEventListener("change", (e) => {
    let status = new FormData();

    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = async function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.response);
      }
    };
    status.append("status", e.target.value);
    xmlhttp.open("POST", `controller/set-status.php`, true);
    xmlhttp.send(status);
  });

  setInterval(getMessage, 300);
  setInterval(getOnline, 5000);
});
