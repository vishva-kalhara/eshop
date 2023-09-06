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
				// window.location = "home.php";
			} else {
				msgSignIn.innerHTML = t;
				console.error(t);
				msgdivSignIn.className = "d-block";
			}
		}
	};
	req.open("POST", "./process/signIn.php", true);
	req.send(frmData);
}

let bootstrapModal;

const forgetPassword = function (ssss) {
	const req = new XMLHttpRequest();
	req.onreadystatechange = function () {
		if (req.readyState < 4) {
			msgSignIn.innerHTML = "Plase wait for a moment";

			msgSignIn.className = "alert alert-success";
			msgdivSignIn.className = "d-block";
		}
		if (req.readyState == 4 && req.status == 200) {
			const resText = req.responseText;
			// console.log(resText)
			if (resText == "Email_Sent_Success") {
				// console.log(req.responseText);
				bootstrapModal = new bootstrap.Modal(forgotPasswordModal);
				modalEmail.value = txtemail2.value;
				bootstrapModal.show();
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

const signout = function () {
	var r = new XMLHttpRequest();

	r.onreadystatechange = function () {
		if (r.readyState == 4 && r.status == 200) {
			var t = r.responseText;

			if (t == "success") {
				// window.location.reload();
				window.location = "index.php";
			} else {
				alert(t);
			}
		}
	};

	r.open("GET", "./process/signout.php", true);
	r.send();
};

const showHidePassword = function (btn, target) {
	if (modalNewPassword.type == "password") {
		modalNewPassword.type = "text";
	} else if (modalNewPassword.type == "text") {
		modalNewPassword.type = "password";
	}
};

// console.log("gg");

function updateProfile() {
	var profile_img = document.getElementById("profileImage");
	var first_name = document.getElementById("fname");
	var last_name = document.getElementById("lname");
	var mobile_no = document.getElementById("mobile");
	var password = document.getElementById("pw");
	var email_address = document.getElementById("email");
	var address_line1 = document.getElementById("line1");
	var address_line2 = document.getElementById("line2");
	var province = document.getElementById("province");
	var district = document.getElementById("district");
	var city = document.getElementById("city");
	var postal_code = document.getElementById("pc");

	var f = new FormData();
	f.append("img", profile_img.files[0]);
	f.append("fn", first_name.value);
	f.append("ln", last_name.value);
	f.append("mn", mobile_no.value);
	f.append("pw", password.value);
	f.append("ea", email_address.value);
	f.append("al1", address_line1.value);
	const valLine2 = address_line2.value;
	f.append("al2", valLine2);
	// console.log(province.value)
	f.append("p", province.value);
	f.append("d", district.value);
	f.append("c", city.value);
	f.append("pc", postal_code.value);

	var r = new XMLHttpRequest();

	r.onreadystatechange = function () {
		if (r.status == 200 && r.readyState == 4) {
			var t = r.responseText;
			alert(t);
		}
	};

	r.open("POST", "./process/userProfileUpdate.php", true);
	r.send(f);
}

const loadBrands = function () {
	const category = document.getElementById("category").value;
	// alert(category)
	const req = new XMLHttpRequest();
	req.onreadystatechange = function () {
		if (req.readyState == 4 && req.status == 200) {
			const markup = req.responseText;
			document.getElementById("brand").innerHTML = markup;
		}
	};

	req.open("GET", `./process/loadbrand.php?c=${category}`, true);
	req.send();
};

function loadModel() {
	const sel_brand = document.getElementById("brand").value;

	const req = new XMLHttpRequest();
	req.onreadystatechange = function () {
		if ((req.readyState = 4 && req.status == 200)) {
			const markup = req.responseText;
			document.getElementById("model").innerHTML = markup;
			console.log(markup);
		}
	};

	req.open("GET", `./process/load_model.php?b=${sel_brand}`, true);
	req.send();
}

function addColor() {
	const newColor = document.getElementById("clr_in");
	const newColorVal = newColor.value;

	const req = new XMLHttpRequest();
	req.onreadystatechange = function () {
		if (req.readyState == 4 && req.status == 200) {
			const responseT = req.responseText;
			if (responseT == "Already there is a color") {
				alert(responseT);
			} else {
				document.getElementById("clr").innerHTML = responseT;
				newColor.value = null;
			}
		}
	};

	req.open("GET", `./process/add_color.php?clr=${newColorVal}`, true);
	req.send();
}

const changeProductImage = function () {
	const images = document.getElementById("imageuploader");
	images.onchange = function () {
		const img_count = images.files.length;
		if (img_count <= 3) {
			for (let i = 0; i < img_count; i++) {
				const file = this.files[i];
				const url = window.URL.createObjectURL(file);
				document.getElementById(`i${i}`).src = url;
			}
		} else
			Alert(
				`${img_count} files uploaded! Please inset less than 4 files.`
			);
	};
};


function addProduct(){

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");
    var condition = 0;
    if(document.getElementById("b").checked){
        condition = 1;
    }else if(document.getElementById("u").checked){
        condition = 2;
    }
    var clr = document.getElementById("clr");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("ca",category.value);
    f.append("b",brand.value);
    f.append("m",model.value);
    f.append("t",title.value);
    f.append("con",condition);
    f.append("col",clr.value);
    f.append("qty",qty.value);
    f.append("cost",cost.value);
    f.append("dwc",dwc.value);
    f.append("doc",doc.value);
    f.append("desc",desc.value);
    
    var file_count = image.files.length;
    for(var x = 0;x < file_count;x++){
        f.append("img" + x,image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.status == 200 && r.readyState == 4){
            var t = r.responseText;

            if(t == "success"){
                window.location.reload();
            }else{
                alert (t);
            }
            
        }
    }

    r.open("POST","./process/add_product.php",true);
    r.send(f);

}