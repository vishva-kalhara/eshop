const signupForm = document.getElementById("signupbox");
const signinForm = document.getElementById("signinbox");

const msg = document.getElementById("msg");
const msgdiv = document.getElementById("msgdiv");

const btnSignUp = document.getElementById("btnSignUp");

const txtfn = document.getElementById("fname");
const txtln = document.getElementById("lname");
const txtemail = document.getElementById("email");
const txtpassword = document.getElementById("password");
const txtmobile = document.getElementById("mobile");
const txtgender = document.getElementById("gender");

function switchScreens() {
	signupForm.classList.toggle("d-none");
	signinForm.classList.toggle("d-none");
}

function signUp() {
	// alert(txtfn.value);
	// alert(txtln.value);
	// alert(txtemail.value);
	// alert(txtpassword.value);
	// alert(txtmobile.value);
	// alert(txtgender.value);

	const frmData = new FormData();
	frmData.append("fn", txtfn.value);
	frmData.append("ln", txtln.value);
	frmData.append("email", txtemail.value);
	frmData.append("password", txtpassword.value);
	frmData.append("mobile", txtmobile.value);
	frmData.append("gender", txtgender.value);

	const req = new XMLHttpRequest();

	req.onreadystatechange = function () {
		if (req.readyState == 4 && req.status == 200) {
			let t = req.responseText;
			if (t == "success") {
				msg.innerHTML = t;
				msg.className = "alert alert-success";
				msgdiv.className = "d-block";
			} else {
				msg.innerHTML = t;
				msgdiv.className = "d-block";
			}
		}
	};

	// console.log(req.readyState);

	req.open("POST", "process/signUpProcess.php", true);

	req.send(frmData);
}
