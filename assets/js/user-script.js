/**
 * User Registration and Login Script
 *
 * @package cup
 */

(function ($) {
	"use strict";
	jQuery( document ).ready(
		function ($) {
			/*###### User Registration Start ######*/
			jQuery( document ).ready(
				function ($) {
					$( "#cup_registration_form" ).validate(
						{
							rules: {
								first_name: { required: true },
								last_name: { required: true },
								user_name: { required: true },
								user_email: { required: true, email: true },
								user_password: { required: true },
							},
							messages: {
								first_name: { required: "Please enter firstname." },
								last_name: { required: "Please enter lastname." },
								user_name: { required: "Please enter username." },
								user_email: {
									required: "Please enter email.",
									email: "Please enter valid email.",
								},
								user_password: { required: "Please enter password." },
							},
							errorPlacement: function (error, element) {
								error.insertAfter( element );
							},
							submitHandler: function (form, event) {
								event.preventDefault();
								let responseSection = ".registration-message";
								let formData        = new FormData( form );
								formData.append( "action", "cup_user_register" );
								formData.append( "security", ajax_object.nonce );

								// Disable form inputs and button.
								$( form ).find( "input, button" ).prop( "disabled", true );

								$.ajax(
									{
										type: "POST",
										url: ajax_object.ajax_url,
										data: formData,
										processData: false,
										contentType: false,
										success: function (response) {
											$( responseSection ).show().removeClass( "error success" ).html( "" );
											if (response.status) {
												$( responseSection ).addClass( "success" ).html( response.message );

												setTimeout(
													function () {
														$( form ).trigger( "reset" );
														$( responseSection )
														.show()
														.removeClass( "error success" )
														.html( "" );
													},
													1200
												);
											} else {
												$( responseSection ).addClass( "error" ).html( response.message );
											}
										},
										error: function (xhr, status, error) {
											console.error( xhr.responseText );
										},
										complete: function () {
											// Enable form inputs and button.
											$( form ).find( "input, button" ).prop( "disabled", false );
										},
									}
								);
							},
						}
					);
				}
			);
			/*###### User Registartion End #######*/

			/*###### User Login Code #######*/
			$( "#cup_login_form" ).validate(
				{
					rules: {
						login_user: { required: true },
						login_password: { required: true },
					},
					messages: {
						login_user: { required: "Please enter user or e-mail." },
						login_password: { required: "Please enter password." },
					},
					errorPlacement: function (error, element) {
						error.insertAfter( element );
					},
					submitHandler: function (form, e) {
						e.preventDefault();
						let responseSection = ".login-message";
						let login_user      = $( "#login_user" ).val();
						let login_pass      = $( "#login_password" ).val();

						let formData = {
							action: "cup_user_login",
							security: ajax_object.nonce,
							login_user: login_user,
							login_pass: login_pass,
						};

						// Disable form inputs and button.
						$( form ).find( "input, button" ).prop( "disabled", true );
						$.ajax(
							{
								type: "POST",
								url: ajax_object.ajax_url,
								data: formData,
								success: function (response) {
									if (response != "") {
										$( responseSection ).show();
										$( responseSection ).removeClass( "error" );
										$( responseSection ).removeClass( "success" );
										$( responseSection ).html( "" );

										if (response.status) {
											$( responseSection ).addClass( "success" );
											$( responseSection ).html( response.message );
										} else {
											$( responseSection ).addClass( "error" );
											$( responseSection ).html( response.message );
										}
										setTimeout(
											function () {
												if (response.status && response.redirect_url) {
													window.location.href = response.redirect_url;
												}
											},
											800
										);
									}
								},
								error: function (xhr, status, error) {
									console.error( xhr.responseText );
								},
								complete: function () {
									// Enable form inputs and button.
									$( form ).find( "input, button" ).prop( "disabled", false );
								},
							}
						);
					},
				}
			);
			/*###### User Login End #######*/
		}
	);
})( jQuery );
