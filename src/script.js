const signupForm = document.getElementById("signupbox");
const signinForm = document.getElementById("signinbox");
const forgotPasswordModal = document.getElementById("forgotPasswordModal");

const msg = document.getElementById("msg");
const msgdiv = document.getElementById("msgdiv");
const msgSignIn = document.getElementById("msgSignIn");
const msgdivSignIn = document.getElementById("msgdivSignIn");

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

const modalEmail = document.getElementById("modalEmail");
const modalCode = document.getElementById("modalCode");
const modalNewPassword = document.getElementById("modalNewPassword");
const modalConfPassword = document.getElementById("modalConfPassword");
const modalBtnReset = document.getElementById("modalBtnReset");

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
				console.log(t);
				msgdiv.className = "d-block";
			}
		}
	};
	req.open("POST", "./process/signUpProcess.php", true);
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
			const t = req.responseText;
			console.log(t);
			if (t == "signInSuccess") {
				window.location = "home.php";
			} else {
				msgSignIn.innerHTML = t;
				console.log(t);
				msgdivSignIn.className = "d-block";
			}
		}
	};
	req.open("POST", "./process/signIn.php", true);
	req.send(frmData);
}

let bootstrapModal;

const forgetPassword =  function () {
	const req = new XMLHttpRequest();
	 req.onreadystatechange = function () {
		if (req.readyState == 4 && req.status == 200) {
			const resText = req.responseText;
			// console.log(resText)
			if (resText == "Email_Sent_Success") {
				// console.log(req.responseText);
				bootstrapModal = new bootstrap.Modal(forgotPasswordModal);
				modalEmail.value = txtemail2.value;
				bootstrapModal.show();
			} else {

			}
		}
	};

	 req.open("GET", "./process/forgetPassword.php?e=" + txtemail2.value, true);
	 req.send();
	//  bootstrapModal = new bootstrap.Modal(forgotPasswordModal);
	// await bootstrapModal.show();
};

function resetPassword() {
	if (modalNewPassword.value == modalConfPassword.value) {
		const frmData = new FormData();
		frmData.append("email", modalEmail.value);
		frmData.append("code", modalCode.value);
		frmData.append("newPassword", modalNewPassword.value);

		const req = new XMLHttpRequest();
		req.onreadystatechange = function () {
			if (req.readyState == 4 && req.status == 200) {
				// console.log(req.responseText);
				// bootstrapModal.hide();
				alert("Password Reset Successful");
			}
		};

		req.open("POST", "./process/resetPassword.php", true);
		req.send(frmData);
	} else {
		alert("Mismatching Passwords");
	}
}

const showHidePassword = function (btn, target) {
	if (modalNewPassword.type == "password") {
		modalNewPassword.type = "text";
	} else if (modalNewPassword.type == "text") {
		modalNewPassword.type = "password";
	}
};

console.log("gg");
