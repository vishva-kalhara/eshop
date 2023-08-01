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

const txtemail2 = document.getElementById("email2");
const txtpassword2 = document.getElementById("password2");
const rememberMe = document.getElementById("rememberme");

function switchScreens() {
	signupForm.classList.toggle("d-none");
	signinForm.classList.toggle("d-none");
}

function signUp() {
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
	req.open("POST", "process/signUpProcess.php", true);
	req.send(frmData);
}

function signIn() {
	const frmData = new FormData();
	frmData.append("email", txtemail2.value);
	frmData.append("password", txtpassword2.value);
	frmData.append("rememberMe", rememberMe.checked);

	const req = new XMLHttpRequest();
	req.onreadystatechange = function () {
		if (req.readyState == 4 && req.status == 200) {
			console.log(req.responseText);
		}
	};
	req.open("POST", "process/signIn.php", true);
	req.send(frmData);
}

function forgetPassword() {
	const req = new XMLHttpRequest();
	req.onreadystatechange = function () {
		if ((req.readyState == 4 && req.status == 200)) {
			console.log(req.responseText);
		}
	};

	req.open("GET", "process/forgetPassword.php?e=" + txtemail2.value, true);
	req.send();
}
