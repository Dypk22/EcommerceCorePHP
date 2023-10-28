$('input').attr('autocomplete','off');
$('form').attr('autocomplete','off');

jQuery("#proceedRecharge").validate({
	rules: {
		amount: {
			required: true,
			min: 10
		},
		mobile: {
			required: true,
			minlength: 10,
			maxlength: 10,
			digits: true
		},
		operator: "required",
		circle: "required"
	},
	messages: {
		amount: {
			required: "Enter any recharge plan!",
			min: "Enter Amount Greater Or Equal To 10"
		},
		mobile: {
			required: "Enter Mobile Number!",
			minlength: "Enter Your 10 Digit Number",
			maxlength: "Mobile Number Must Be 10 Digit"
		},
		operator: "Confirm Mobile Operator!",
		circle: "Confirm Operator Circle!",
	},
	submitHandler: function (b) {
		jQuery("#rechargeBtn1").html('<span class="spinner-border wait spinner-border-sm" style="height: 16px; width: 16px; margin-bottom: 3px;" role="status" aria-hidden="true"></span> Hold on ...');
		b.submit()
	}
});
jQuery("#dthRechargeBill").validate({
	rules: {
		DTHamount: {
			required: true,
			min: 10
		},
		DTHoperator: "required",
		cardNumber: "required"
	},
	messages: {
		DTHamount: {
			required: "Enter Any Amount!",
			min: "Enter Amount Greater Or Equal To 10"
		},
		DTHoperator: "Confirm DTH Operator!",
		cardNumber: "Confirm Your Card Number!",
	},
	submitHandler: function (b) {
		jQuery("#btnSubmitdthRechargeBill").html('<span class="spinner-border wait spinner-border-sm" style="height: 16px; width: 16px; margin-bottom: 3px;" role="status" aria-hidden="true"></span> Hold on ...');
		b.submit()
	}
});

function fetchOPerator(b) {
	if (b.length == 10) {
		jQuery("#rechargeBtn1").html('<span class="spinner-border wait spinner-border-sm" style="height: 16px; width: 16px; margin-bottom: 3px;" role="status" aria-hidden="true"></span> Fetching');
		jQuery.ajax({
			url: "fetchoperator",
			type: "post",
			data: "number=" + b,
			success: function (a) {
				jQuery("#rechargeBtn1").html("Continue to Recharge");
				jQuery("#operator").val(a.carrier);
				if (a.carrier != "") {
					jQuery("#operator").val(a.carrier);
					jQuery("#recharge_plan_operator").val(a.carrier)
				}
				if (a.location != "") {
					if (a.location == "chennai") {
						jQuery("#circle").val("tamil nadu")
					} else {
						jQuery("#circle").val(a.location)
					}
				}
				jQuery("#recharge_plan_operator_circle").val(a.location);
				jQuery("#show_view_plans").show();
				jQuery("#circle-error").hide();
				jQuery("#operator-error").hide();
				jQuery("#amount").focus();
				if (a.operator_type != "") {
					var d = a.operator_type;
					if (d == "postpaid") {
						jQuery("#postpaid").prop("checked", true)
					} else {
						jQuery("#prepaid").prop("checked", true)
					}
				}
			}
		})
	} else {
		jQuery("#operator").val("");
		jQuery("#circle").val("");
		jQuery("#recharge_plan_operator").val("");
		jQuery("#recharge_plan_operator_circle").val("");
		jQuery("#recharge_plan_type").val("");
		jQuery(".prev_rows").remove();
		jQuery("#show_view_plans").hide()
	}
}

function recharge_plan() {
	var b = jQuery("#operator").val();
	jQuery(".prev_rows").remove();
	jQuery.ajax({
		url: "rechargeplan?operator=" + b,
		success: function (a) {
			jQuery("#show_recharge_plan").append(a)
		}
	})
}

function submit_recharge_plan() {
	var d = jQuery("#recharge_plan_operator").val();
	var c = jQuery("#recharge_plan_type").val();
	jQuery(".prev_rows").remove();
	jQuery.ajax({
		url: "rechargeplan",
		data: "recharge_plan_operator=" + d + "&recharge_plan_type=" + c,
		type: "post",
		success: function (a) {
			jQuery(".prev_rows").remove();
			if (a == "null" || a == "") {} else {
				jQuery("#show_recharge_plan").append(a)
			}
		}
	})
}

function setRechargeValue(b) {
	jQuery("#amount").val(b)
}

function resetOperatorValue(b) {
	jQuery("#recharge_plan_operator").val(b);
	jQuery("#amount").val("")
}

function applyCoupon(d, e) {
	var c = jQuery("#coupon_code").val();
	jQuery("#billerType").val(e);
	jQuery("#FinalcouponCode").val(c);
	if (c != "" && d != "") {
		jQuery('#applyCouponBtn').html('<span class="spinner-border wait" role="status" style="height: 20px; width:20px; margin-bottom: 0;" aria-hidden="true"></span>');
		jQuery.ajax({
			url: "setCoupon",
			data: jQuery("#submitCouponForm").serialize(),
			type: "post",
			success: function (a) {
				if (jQuery.trim(a.response) == "proceed") {
					jQuery("#FinalcouponCode").val(c);
					Swal.fire({
						position: "top-end",
						icon: "success",
						title: "Coupon Applied Successfully!",
						showConfirmButton: false,
						timer: 1500
					});
					if (jQuery.trim(a.balanceUse) == 1) {
						jQuery("#payBtn1").show();
						jQuery("#fakepayBtn1").hide()
					}
					if (jQuery.trim(a.balanceUse) == 0) {
						jQuery("#payBtn1").hide();
						jQuery("#fakepayBtn1").show()
					}
					jQuery("#coupon_code").attr("readonly", true);
					jQuery("#coupon_code").addClass("bg-light-1");
					jQuery("#removeCouponBtn").show();
					jQuery("#applyCouponBtn").hide()
				} else {
					jQuery('#applyCouponBtn').html('APPLY');
					jQuery("#FinalcouponCode").val("");
					Swal.fire({
						position: "top-end",
						icon: "error",
						title: a.response + "!",
						showConfirmButton: false,
						timer: 1500
					})
				}
			}
		})
	} else {
		Swal.fire({
			position: "top-end",
			icon: "question",
			title: "Enter Coupon First!",
			showConfirmButton: false,
			timer: 1500
		});
		jQuery("#FinalcouponCode").val("")
	}
}

function removeCoupon() {
	jQuery("#removeCouponBtn").hide();
	jQuery("#applyCouponBtn").show();
	jQuery("#payBtn1").show();
	jQuery("#fakepayBtn1").hide();
	var b = jQuery("#coupon_code").val();
	if (b != "") {
		jQuery("#coupon_code").attr("readonly", false);
		jQuery('#applyCouponBtn').html('APPLY');
		jQuery("#coupon_code").removeClass("bg-light-1");
		jQuery("#FinalcouponCode").val("");
		jQuery("#coupon_code").val("");
		jQuery.ajax({url: "deleteCoupon"});
		Swal.fire({
			position: "top-end",
			icon: "success",
			title: "Coupon Removed Successfully!",
			showConfirmButton: false,
			timer: 1500
		})
	}
}

function applyAddMoneyCoupon() {
	var d = jQuery("#addamount").val();
	var c = jQuery("#coupon_code").val();
	if (c != "" && d != "") {
		jQuery('#applyCouponBtn').html('<span class="spinner-border wait" role="status" style="height: 20px; width:20px; margin-bottom: 0;" aria-hidden="true"></span>');
		jQuery.ajax({
			url: "setAddMoneyCoupon",
			data: "couponCode=" + c + "&amount=" + d,
			type: "post",
			success: function (a) {
				if (jQuery.trim(a.response) == "Proceed") {
					jQuery("#FinalcouponCode").val(c);
					Swal.fire({
						position: "top-end",
						icon: "success",
						title: "Coupon Applied Successfully!",
						showConfirmButton: false,
						timer: 1500
					});
					if (jQuery.trim(a.balanceUse) == 1) {
						jQuery("#payBtn1").show();
						jQuery("#fakepayBtn1").hide()
					}
					if (jQuery.trim(a.balanceUse) == 0) {
						jQuery("#payBtn1").hide();
						jQuery("#fakepayBtn1").show()
					}
					jQuery("#coupon_code").attr("readonly", true);
					jQuery("#coupon_code").addClass("bg-light-1");
					jQuery("#removeCouponBtn").show();
					jQuery("#applyCouponBtn").hide()
				} else {
					jQuery("#FinalcouponCode").val("");
					jQuery('#applyCouponBtn').html('APPLY');
					Swal.fire({
						position: "top-end",
						icon: "error",
						title: jQuery.trim(a.response) + "!",
						showConfirmButton: false,
						timer: 1500
					})
				}
			}
		})
	} else {
		Swal.fire({
			position: "top-end",
			icon: "question",
			title: "Enter Coupon First!",
			showConfirmButton: false,
			timer: 1500
		})
	}
}


function payBtnMsgPrepaidRecharge(f, e, h, g, b, e, d, i) {
	var c = '<div class="spinner-grow" role="status"></div><div class="spinner-grow" role="status"></div><div class="spinner-grow" role="status"></div>';
	jQuery("#payBtn1").html(c);
	window.location.href = "recharge-now?type=prepaid_recharge&operator=" + f + "&MobileNumber=" + h + "&amount=" + e + "&rechPlan=" + g + "&operatorCircle=" + b + "&validity=" + d + "&rechOperatorType=" + i;
	jQuery("#payBtn1").prop("onclick", null).off("click")
}

function payBtnMsgDth(d, e, c) {
	var b = '<div class="spinner-grow" role="status"></div><div class="spinner-grow" role="status"></div><div class="spinner-grow" role="status"></div>';
	jQuery("#payBtn1").html(b);
	window.location.href = "recharge-now?type=dth_recharge&dthoperator=" + d + "&cardnumber=" + e + "&amount=" + c;
	jQuery("#payBtn1").prop("onclick", null).off("click")
}

function getnewsletterEmail() {
	var d = '<div class="spinner-grow" role="status"></div><div class="spinner-grow" role="status"></div><div class="spinner-grow" role="status"></div>';
	jQuery("#submitNewsLetterBtn").html(d);
	jQuery("#newsletterEmail").removeClass("validate");
	var c = jQuery("#newsletterEmail").val();
	if (c == "") {
		jQuery("#submitNewsLetterBtn").html("Subscribe");
		jQuery("#newsletterEmail").attr("placeholder", "Enter Your E-Mail Here");
		jQuery("#newsletterEmail").addClass("validate")
	} else {
		jQuery("#newsletterEmail").removeClass("validate");
		jQuery.ajax({
			url: "getnewsletterEmail",
			data: "newsletterEmail=" + c,
			type: "post",
			success: function (a) {
				jQuery("#submitNewsLetterBtn").html("Subscribe");
				if (a == "valid") {
					Swal.fire({
						position: "top-end",
						icon: "success",
						title: "Your E-Mail Received Successfully!",
						showConfirmButton: false,
						timer: 1500
					});
					jQuery("#newsletterEmail").val("")
				} else {
					if (a == "present") {
						Swal.fire({
							position: "top-end",
							icon: "error",
							title: "Your E-Mail Already Submitted!",
							showConfirmButton: false,
							timer: 1500
						})
					} else {
						Swal.fire({
							position: "top-end",
							icon: "error",
							title: "Your E-Mail Is Invalid!",
							showConfirmButton: false,
							timer: 1500
						})
					}
				}
			}
		})
	}
}

function submitRegisterForm() {
	jQuery("#reg_name_error").hide();
	jQuery("#reg_name_error").html("");
	jQuery("#reg_email_error").hide();
	jQuery("#reg_email_error").html("");
	jQuery("#reg_mobile_error").hide();
	jQuery("#reg_mobile_error").html("");
	jQuery("#reg_password_error").hide();
	jQuery("#reg_password_error").html("");
	jQuery("#tnc_error").hide();
	var j = jQuery("#reg_name").val();
	var k = jQuery("#reg_email").val();
	var f = jQuery("#reg_mobile").val();
	var g = jQuery("#reg_password").val();
	var i = jQuery("#agree").val();
	var h = jQuery("#refered_by").val();
	if (j == "" || k == "" || f == "" || g == "" || jQuery("#agree").is(":unchecked")) {
		if (j == "") {
			jQuery("#reg_name_error").show();
			jQuery("#reg_name_error").html("enter name*");
			jQuery("#reg_name").focus()
		} else {
			if (k == "") {
				jQuery("#reg_email_error").show();
				jQuery("#reg_email_error").html("enter E-Mail*");
				jQuery("#reg_email").focus()
			} else {
				if (f == "") {
					jQuery("#reg_mobile_error").show();
					jQuery("#reg_mobile_error").html("enter mobile*");
					jQuery("#reg_mobile").focus()
				} else {
					if (g == "") {
						jQuery("#reg_password_error").show();
						jQuery("#reg_password_error").html("enter password*");
						jQuery("#reg_password").focus()
					} else {
						if (jQuery("#agree").is(":unchecked")) {
							jQuery("#tnc_error").show();
							jQuery("#agree").focus()
						}
					}
				}
			}
		}
	} else {
		jQuery("#RegisterUserBtn").html('<span class="spinner-border wait spinner-border-sm" role="status" aria-hidden="true"></span> Please Wait');
		jQuery.ajax({
			url: "userregister",
			data: "name=" + j + "&email=" + k + "&mobile=" + f + "&password=" + g + "&refered_by=" + h,
			type: "post",
			success: function (a) {
				if (jQuery.trim(a) == "invalid email") {
					jQuery("#RegisterUserBtn").html("Sign Up");
					jQuery("#reg_email_error").show();
					jQuery("#reg_email_error").html("invalid E-Mail")
				} else {
					if (jQuery.trim(a) == "invalid mobile") {
						jQuery("#RegisterUserBtn").html("Sign Up");
						jQuery("#reg_mobile_error").show();
						jQuery("#reg_mobile_error").html("invalid mobile")
					} else {
						if (jQuery.trim(a) == "email present") {
							jQuery("#RegisterUserBtn").html("Sign Up");
							jQuery("#reg_email_error").show();
							jQuery("#reg_email_error").html("E-Mail present")
						} else {
							if (jQuery.trim(a) == "mobile present") {
								jQuery("#RegisterUserBtn").html("Sign Up");
								jQuery("#reg_mobile_error").show();
								jQuery("#reg_mobile_error").html("mobile present")
							} else {
								jQuery("#reg_name").val("");
								jQuery("#reg_email").val("");
								jQuery("#reg_mobile").val("");
								jQuery("#reg_password").val("");
								jQuery("#mbn").html(k);
								jQuery("#signup-modal").modal("hide");
								jQuery("#otp-modal").modal("show")
							}
						}
					}
				}
			}
		})
	}
}

function verifyuser() {
	var g = jQuery("#otp_val_1").val();
	var h = jQuery("#otp_val_2").val();
	var e = jQuery("#otp_val_3").val();
	var f = jQuery("#otp_val_4").val();
	if (g == "") {
		jQuery("#otp_val_1").focus()
	} else {
		if (h == "") {
			jQuery("#otp_val_2").focus()
		} else {
			if (e == "") {
				jQuery("#otp_val_3").focus()
			} else {
				if (f == "") {
					jQuery("#otp_val_4").focus()
				} else {
					jQuery("#VerifyUserBtn").html('<span class="spinner-border wait spinner-border-sm" role="status" aria-hidden="true"></span> Verifying ...');
					jQuery.ajax({
						url: "verifyuser",
						data: "otp_val_1=" + g + "&otp_val_2=" + h + "&otp_val_3=" + e + "&otp_val_4=" + f,
						type: "post",
						success: function (a) {
							if (jQuery.trim(a) == "verified") {
								jQuery("#VerifyUserBtn").html('Verified Successfully');
								Swal.fire({
									position: "top-end",
									icon: "success",
									title: "Mobile Verified Successfully!",
									showConfirmButton: false,
									timer: 1500
								})
								window.location.href = window.location.href;
								// setInterval(function(){ window.location.href = "/"; }, 1000);
							} else {
								jQuery("#VerifyUserBtn").html('Verify');
								Swal.fire({
									position: "top-end",
									icon: "error",
									title: "OTP Is Invalid!",
									showConfirmButton: false,
									timer: 1500
								})
							}
						}
					})
				}
			}
		}
	}
}

function resendOtp() {
	jQuery.ajax({
		url: "resendotp",
		type: "post"
	});
	Swal.fire({
		position: "top-end",
		icon: "success",
		title: "OTP Resent Successfully!",
		showConfirmButton: false,
		timer: 1500
	})
}

function siginin(h) {
	jQuery("#login_error_msg").hide();
	jQuery("#login_error_msg").html("");
	jQuery("#login_password_error").hide();
	jQuery("#login_password_error").html("");
	jQuery("#login_name_error").hide();
	jQuery("#login_name_error").html("");
	var e = jQuery("#loginemail").val();
	var f = jQuery("#loginpassword").val();
	var g = "";
	g = jQuery("#rememberme").val();
	if (jQuery("#rememberme").is(":unchecked")) {
		g = "no"
	} else {
		g = jQuery("#rememberme").val()
	}
	jQuery("#loginBtn").html("");
	jQuery("#loginBtn").html("Loading");
	if (e == "") {
		jQuery("#login_name_error").show();
		jQuery("#login_name_error").html("enter email or mobile number");
		jQuery("#loginemail").focus()
	} else {
		if (f == "") {
			jQuery("#login_password_error").show();
			jQuery("#login_password_error").html("enter password");
			jQuery("#loginpassword").focus()
		} else {
			jQuery.ajax({
				url: "siginin",
				data: "email=" + e + "&password=" + f + "&rememberme=" + g,
				type: "post",
				success: function (a) {
					if (jQuery.trim(a) == "login") {
						jQuery("#loginBtn").html('<span class="spinner-border wait spinner-border-sm" role="status" aria-hidden="true"></span> Redirecting...');
						if (h == "login") {
							window.location.href = "home"
						} else {
							if (h == "recharge-order-summary") {
								location.reload()
							} else {
								window.location.href = window.location.href
							}
						}
					} else {
						if (jQuery.trim(a) == "wrong password") {
							jQuery("#loginBtn").html("Login");
							jQuery("#login_error_msg").show();
							short_temp_msg('error', 'Incorrect Password');
						} else {
							jQuery("#loginBtn").html("Login");
							jQuery("#login_error_msg").show();
							short_temp_msg('question', 'Account Not Exists!');
						}
					}
				}
			})
		}
	}
}

function showOTPModal() {
	jQuery("#otp-modal").modal("show")
}

function forget_password() {
	jQuery("#forget_msg").hide();
	jQuery("#forget_msg").html("");
	var b = jQuery("#forgetEmail").val();
	if (b != "") {
		jQuery.ajax({
			url: "forget_password",
			data: "email=" + b,
			type: "post",
			success: function (a) {
				if (a == "done") {
					jQuery("#forget_msg").show();
					jQuery("#forget_msg").html(a)
				} else {
					jQuery("#forget_msg").show();
					jQuery("#forget_msg").html(a)
				}
			}
		})
	} else {
		jQuery("#forget_msg").show();
		jQuery("#forgetEmail").focus();
		jQuery("#forget_msg").html("enter your email or mobile")
	}
}
$(".pagination_order").owlCarousel({
	items: 20,
	autoplay: false,
	animateOut: "fadeOut",
	animateIn: "fadeIn",
	lazyLoad: true,
	dots: false,
	loop: false,
	nav: false,
	responsive: {
		0: {
			items: 10,
		},
		576: {
			items: 10,
		},
		768: {
			items: 15,
		},
		992: {
			items: 20,
		}
	}
});

function noService() {
	jQuery("#no-service").modal("show")
}

function notSufficientAmount() {
	setTimeout(function () {
		jQuery("#not-sufficient-amount-modal").modal("show")
	}, 3000)
}

function nopostpaidmodal() {
	setTimeout(function () {
		jQuery("#no-postpaid-modal").modal("show")
	}, 3000)
}

function contactSubmit() {
	jQuery("#contactSubmitBtn").html('<span class="spinner-border wait spinner-border-sm" role="status" aria-hidden="true"></span> Please Wait')
}

function ShowDirectAddMoney() {
	jQuery("#direct-transfer-steps").modal("hide");
	jQuery("#direct-transfer-source").modal("show");
	jQuery("#AddMoneyDirectFrm")[0].reset()
	if (jQuery("#HidfdsfdeFirsf43rwedsdMoney").is(":unchecked")) {
	}else{
		const d = new Date();
		d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
		let expires = "expires="+d.toUTCString();
		document.cookie = encodeURI('HidfdsfdeFirsf43rwedsdMoney') + "=" + encodeURI('Created') + ";" + expires + ";path=/";
	}
}

function getCookie(name) {
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    }
    else
    {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
        end = dc.length;
        }
    }
    // because unescape has been deprecated, replaced with decodeURI
    //return unescape(dc.substring(begin + prefix.length, end));
    return decodeURI(dc.substring(begin + prefix.length, end));
} 

function DirectAddMoneyShow() {
	jQuery('#DirectAddMoneyAmt').val('');
	jQuery('#DirectAddMoneyUPIId').val('');
	jQuery("#AmtError").hide();
	jQuery("#UpiIdError").hide();
	let username = getCookie("HidfdsfdeFirsf43rwedsdMoney");
	if (username != null) {
		jQuery('#direct-transfer-source').modal('show');
	}	
	else{
		jQuery('#direct-transfer-steps').modal('show');
	}
}

function ShowDirectAddMoneyVerifyBtn() {
	jQuery("#direct-transfer-source").modal("hide");
	jQuery("#direct-transfer").modal("show")
}

function DirectAddMoneyDirectBtn() {
	jQuery("#AmtError").hide();
	jQuery("#UpiIdError").hide();
	var b = jQuery("#DirectAddMoneyAmt").val();
	var a = jQuery("#DirectAddMoneyUPIId").val();
	if (b == "") {
		jQuery("#AmtError").show()
	}
	if (a == "") {
		jQuery("#UpiIdError").show()
	}
	if (b !== "" && a !== "") {
		jQuery("#FinalDirectAddmoneyBtn").html('<span class="spinner-border spinner-border-sm" style="height: 16px; width: 16px; margin-bottom: 3px;" role="status" aria-hidden="true"></span> Loading');
		jQuery.ajax({
			url: "add-money-direct",
			data: "amount=" + b + "&referenceId=" + a,
			type: "post",
			success: function (c) {
				jQuery("#FinalDirectAddmoneyBtn").html('Proceed');
				if (jQuery.trim(c.message) == "inserted") {
					jQuery("#direct-transfer").modal("hide");
					Swal.fire("All Set!", "We'll Verify & Update Your Wallet Balance Soon", "success")
				}
				else if(jQuery.trim(c.message)=='amountZero'){
					Swal.fire("Oooops...", "Amount Can't Be Zero", "error")
				}
				 else {
					if (jQuery.trim(c.status) == 0) {
						jQuery("#direct-transfer").modal("hide");
						jQuery("#direct-transfer").modal("hide");
						Swal.fire("Keep Wait...", "Your Payment is under verification", "info")
					} else {
						if (jQuery.trim(c.status) == 2) {
							Swal.fire("Oooops...<br/> Details Mismatched", "We cann't verified the details you provided", "error")
						} else {
							jQuery("#direct-transfer").modal("hide");
							Swal.fire("Hurray!", "Your Payment Details is Completed", "success")
						}
					}
				}
			}
		})
	}
}

function addamountsubmit() {
	jQuery('#AddAmtError').hide();
	let amount= jQuery('#addamount').val();
	if (amount=='') {
		jQuery('#AddAmtError').show();
		jQuery('#AddAmtError').html('Enter the Amount Here!');
	}
	else if (amount<=10) { 
		jQuery('#AddAmtError').show();
		jQuery('#AddAmtError').html('Enter Must Be Greater Than 10!');
	}
	else {
		jQuery("#addamountsubmitBtn").html('<span class="spinner-border spinner-border-sm" style="height: 16px; width: 16px; margin-bottom: 3px;" role="status" aria-hidden="true"></span> Loading');
		window.location.href='pay/add/money/'+amount;
	}
}

function PerformDTHRecharge(d, c, a, g, balance) {
	// jQuery("#payBtn2").prop("onclick", null).off("click")
	var f = jQuery("#FinalcouponCode").val();
	var WalletUse='';
	var location='';
	if (jQuery("#WalletUse").is(":unchecked")) {
		WalletUse='no';
		location=g;//+jQuery.trim(p);
	}else{
		WalletUse='yes';
	}
	var b = '<div class="spinner-grow" role="status"></div><div class="spinner-grow" role="status"></div><div class="spinner-grow" role="status"></div>';
	jQuery("#payBtn2").html(b);
	jQuery.ajax({
		url: "PerformDTHRecharge",
		data: "DTHoperator=" + d + "&cardNumber=" + c + "&rechargeAmount=" + a + "&coupon_code=" + f + "&WalletUse=" + WalletUse + "&balance=" + balance,
		type: "post",
		success: function (result) {
			location=g+jQuery.trim(result);
			window.location.href = location;
		}
	});
}

function performRecharge(m, p, r, q, l, k, o, s, balance) {
	jQuery("#payBtn2").prop("onclick", null).off("click")
	var WalletUse='';
	var location='';
	if (jQuery("#WalletUse").is(":unchecked")) {
		WalletUse='no';
		location=s+jQuery.trim(p);
	}else{
		WalletUse='yes';
	}
	var n = jQuery("#FinalcouponCode").val();
	var j = '<div class="spinner-grow" role="status"></div><div class="spinner-grow" role="status"></div><div class="spinner-grow" role="status"></div>';
	jQuery("#payBtn2").html(j);
	jQuery.ajax({
		url: "performRecharge",
		data: "MobileNumber=" + m + "&rechargeAmount=" + p + "&operator=" + r + "&operatorCircle=" + q + "&validity=" + l + "&type=" + k + "&couponCode=" + n + "&operator_type=" + o + "&WalletUse=" + WalletUse + "&balance=" + balance,
		type: "post",
		success: function (result) {
			location=s+jQuery.trim(result);
			window.location.href = location;
		}
	});
}

function copyRefernRarnLink() {
	var a = document.getElementById("copyText");
	a.select();
	a.setSelectionRange(0, 99999);
	navigator.clipboard.writeText(a.value);
	Swal.fire({
		position: "top-end",
		icon: "success",
		title: "Link Copied Successfully!",
		showConfirmButton: false,
		timer: 1500
	})
};

function short_temp_msg(icon, title) {
	Swal.fire({
		position: "top-end",
		icon: icon,
		title: title,
		showConfirmButton: false,
		timer: 1500
	})
}

function UseWalletBalance(reachareAmt, bal) {
	if (jQuery("#WalletUse").is(":unchecked")) {
		jQuery('#payBtn2').html('Pay Now ₹'+(reachareAmt-bal)+' <i class="fas fa-angle-double-right"></i>');
		if ((reachareAmt-bal)>10) {
			jQuery('#fakepayBtn2').hide();
			jQuery('#payBtn2').show();
			jQuery('#payBtn2').html('Pay Now ₹'+(reachareAmt-bal)+' <i class="fas fa-angle-double-right"></i>');
		} else {
			jQuery('#payBtn2').hide();
			jQuery('#fakepayBtn2').show();
			jQuery('#fakepayBtn2').html('Pay Now ₹'+(reachareAmt-bal)+' <i class="fas fa-angle-double-right"></i>');
		}
		alert(123);

	}else{
		jQuery('#payBtn2').html('Pay Now ₹'+(reachareAmt)+' <i class="fas fa-angle-double-right"></i>');
		jQuery('#fakepayBtn2').hide();
		jQuery('#payBtn2').show();
	}
}