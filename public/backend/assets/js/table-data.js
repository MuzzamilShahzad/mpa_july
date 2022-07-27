$(function (e) {
	var baseUrl = $(".base-url").val();
	'use strict'
	//______Basic Data Table
	$('#basic-datatable').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	});


	//______Responsive Data Table
	$('#responsive-datatable').DataTable({
		responsive: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	});

	admissingListing();

	$("#btn-admission-search").on("click", function (e) {

		e.preventDefault();
		admissingListing();

	});

	function admissingListingOld() {

		var session_id = $("#session-id").val();
		var campus_id = $("#campus-id").val();
		var system_id = $("#system-id").val();
		var class_id = $("#class-id").val();
		var group_id = $("#group-id").val();
		var section_id = $("#section-id").val();



		$('#admission-listing-datatable-old').DataTable({
			destroy: true,
			searchable: false,
			responsive: true,
			ajax: {
				url: baseUrl + '/admission/listingBySessionSystemClassGroupSection',
				data: {
					session_id: session_id,
					campus_id: campus_id,
					system_id: system_id,
					class_id: class_id,
					group_id: group_id,
					section_id: section_id,
				},
			},
			columnDefs: [
				{
					orderable: false,
					targets: [0, 1, 8]
				},
				{
					"targets": 0,
					"render": function (data) {
						return '';
					}
				},
				{
					"targets": 1,
					"render": function (data) {
						var checkbox = `<div class="form-check">
											<input class="form-check-input chkbox-select-admission" type="checkbox" data-id="`+ data.id + `">
										</div>`;
						return checkbox;
					}
				},
				{
					"targets": 2,
					"render": function (data) {
						return data.temporary_gr + ' / ' + data.gr;
					}
				},
				{
					"targets": 5,
					"render": function (data) {
						var data = JSON.parse(data);
						return data.name;
					}
				},
				{
					"targets": 6,
					"render": function (data) {
						return data.campus + ' ( ' + data.system + ' ) ';
					}
				},
				{
					"targets": 7,
					"render": function (data) {

						var class_group = data.class;

						if (data.group !== '' && data.group !== null) {
							class_group += ' ( ' + data.group + ' ) '
						}
						return class_group;
					}
				},
				{
					"targets": 9,
					"render": function (data) {
						var checkbox = `<a href="` + (baseUrl + '/admission/export-excel?admission_id=' + data.id) + `">
											<i class="fas fa-file-excel" id="btn-excel-download-admission="`+ data.id + `" title="Edit"></i> 
										</a>|
										<i class="fas fa-check" id="btn-view-admission" data-id="` + data.id + `" title="View"></i> |
										<a href="`+ (baseUrl + '/admission/edit/' + data.id) + `">
											<i class="fas fa-edit" id="btn-edit-admission" data-id="`+ data.id + `" title="Edit"></i> 
										</a>|
						 				<i class="fas fa-trash" id="btn-delete-admission" data-id="`+ data.id + `" title="Delete"></i>`;
						return checkbox;
					}
				},
			],
			order: [[2, 'asc']],
			columns: [
				{ data: null },
				{ data: null },
				{ data: null },
				{ data: 'first_name' },
				{ data: 'last_name' },
				{ data: 'father_details' },
				{ data: null },
				{ data: null },
				// { data: 'section' },
				{ data: 'admission_date' },
				{ data: null },
			],
		});
	}

	function admissingListing() {

		var session_id = $("#session-id").val();
		var campus_id = $("#campus-id").val();
		var system_id = $("#system-id").val();
		var class_id = $("#class-id").val();
		var group_id = $("#group-id").val();
		var section_id = $("#section-id").val();

		$('#admission-listing-datatable').DataTable({
			destroy: true,
			searchable: false,
			responsive: true,
			ajax: {
				url: baseUrl + '/admission/listingBySessionSystemClassGroupSection',
				data: {
					session_id: session_id,
					campus_id: campus_id,
					system_id: system_id,
					class_id: class_id,
					group_id: group_id,
					section_id: section_id,
				},
			},
			columnDefs: [
				{
					orderable: false,
					targets: [0, 1, 8]
				},
				{
					"targets": 0,
					"render": function (data) {
						return '';
					}
				},
				{
					"targets": 1,
					"render": function (data) {
						var checkbox = `<div class="form-check">
											<input class="form-check-input chkbox-select-admission" type="checkbox" data-id="`+ data.id + `">
										</div>`;
						return checkbox;
					}
				},
				{
					"targets": 2,
					"render": function (data) {

						var temporary_gr = 'N/A';
						if (data.temporary_gr !== '' && data.temporary_gr !== null) {
							temporary_gr = data.temporary_gr;
						}

						var gr = 'N/A'
						if (data.gr !== '' && data.gr !== null) {
							gr = data.gr;
						}


						return temporary_gr + ' / ' + gr;
					}
				},
				{
					"targets": 5,
					"render": function (data) {
						var data = JSON.parse(data);
						return data.name;
					}
				},
				{
					"targets": 6,
					"render": function (data) {
						return data.campus + ' ( ' + data.system + ' ) ';
					}
				},
				{
					"targets": 7,
					"render": function (data) {

						var class_group = data.class;

						if (data.group !== '' && data.group !== null) {
							class_group += ' ( ' + data.group + ' ) '
						}
						return class_group;
					}
				},
				{
					"targets": 10,
					"render": function (data) {
						var checkbox = `<a href="` + (baseUrl + '/admission/export-excel?admission_id=' + data.id) + `">
											<i class="fas fa-file-excel" id="btn-excel-download-admission="`+ data.id + `" title="Edit"></i> 
										</a>|
										<i class="fas fa-check" id="btn-view-admission" data-id="` + data.id + `" title="View"></i> |
										<a href="`+ (baseUrl + '/admission/edit/' + data.id) + `">
											<i class="fas fa-edit" id="btn-edit-admission" data-id="`+ data.id + `" title="Edit"></i> 
										</a>|
						 				<i class="fas fa-trash" id="btn-delete-admission" data-id="`+ data.id + `" title="Delete"></i>`;
						return checkbox;
					}
				},
			],
			order: [[2, 'asc']],
			columns: [
				{ data: null },
				{ data: null },
				{ data: null },
				{ data: 'first_name' },
				{ data: 'last_name' },
				{ data: 'father_details' },
				{ data: null },
				{ data: null },
				{ data: 'section' },
				{ data: 'admission_date' },
				{ data: null },
			],
		});
	}

	$(document).on('click', ".chkbox-select-all-admission", function () {
		if ($('.chkbox-select-all-admission').is(':checked')) {
			$('.chkbox-select-admission').prop('checked', true);
			var promote_btn = $('#promote').length;
			var student_slip = $('#student-slip').length;
			if (promote_btn == 0 && student_slip == 0) {
				$('.table-heading').after("&nbsp;&nbsp;<button data-bs-target='#print-sticker-modal' data-bs-toggle='modal' class='btn btn-sm btn-primary' id='student-slip'> Student Slip </button>");
				$('.table-heading').after("&nbsp;&nbsp;<button data-bs-target='#promote-student-modal' data-bs-toggle='modal' class='btn btn-sm btn-primary' id='promote'> Promote </button>");
			}
		} else {
			$('.chkbox-select-admission').prop('checked', false);
			$('#promote').remove();
			$('#student-slip').remove();
		}
	});

	$(document).on('click', ".chkbox-select-admission", function () {
		var check_box = $('.chkbox-select-admission').length;
		var checked_check_box = $('.chkbox-select-admission:checked').length;

		if (check_box == checked_check_box) {
			$('.chkbox-select-all-admission').prop('checked', true);
		} else {
			$('.chkbox-select-all-admission').prop('checked', false);
		}

		if (checked_check_box == 0) {
			$('#promote').remove();
			$('#student-slip').remove();
		} else {
			var promote_btn = $('#promote').length;
			// e.preventDefault();

			var student_slip = $('#student-slip').length;

			if (promote_btn == 0 && student_slip == 0) {
				$('.table-heading').after("&nbsp;&nbsp;<button data-bs-target='#print-sticker-modal' data-bs-toggle='modal' class='btn btn-sm btn-primary' id='student-slip'> Student Slip </button>");
				$('.table-heading').after("&nbsp;&nbsp;<button data-bs-target='#promote-student-modal' data-bs-toggle='modal' class='btn btn-sm btn-primary' id='promote'> Promote </button>");
			}
		}
	});

	$(document).on('click', '#student-slip', function (e) {
		e.preventDefault();

		var ids = [];
		$('.chkbox-select-admission:checked').each(function () {
			var registration_id = (this.checked ? $(this).attr('data-id') : "");
			if (registration_id) {
				ids.push(registration_id);
			}
		});

		formData = {
			"ids": ids
		}
		var message = '';

		$.ajax({
			url: baseUrl + '/fee-slip',
			type: "GET",
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			data: formData,
			dataType: "json",
			success: function (response) {
				if (response.status === false) {

					if (response.error) {

						message += `<div class="alert alert-danger alert-dismissible">
										<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
										<strong> Success!</strong> `+ response.message + `
									</div>`;

					} else {

						message += `<div class="alert alert-danger alert-dismissible">
										<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
										<strong> Success!</strong> `+ response.message + `
									</div>`;
					}

				} else {

					$('#print-sticker').html(response.message)

				}
			},
			error: function () {

				message = `<div class="alert alert-danger alert-dismissible">
								<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
								<strong> Whoops !</strong> Something went wrong please contact to admintrator.
							</div>`;

			},
			complete: function () {

				if (message !== '') {
					$(".table-responsive").prepend(message);
				}

			}
		});

	});

	$(document).on('click', '#btn-print-sticker', function (e) {
		e.preventDefault();
		var btn_print_sticker = document.getElementById('print-sticker');
		var newWin = window.open('', 'Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print()">' + btn_print_sticker.innerHTML + '</body></html>');
		// newWin.document.close();
		newWin.focus();
		newWin.print();
		newWin.document.close();
		// return true;
		// setTimeout(function () { newWin.close(); }, 10);
	});

	$(document).on('click', '#btn-delete-admission', function () {

		var admission_id = $(this).data('id');
		var url = baseUrl + '/admission/delete';

		swal.fire({

			icon: 'warning',
			title: 'Are you sure?',
			html: 'You want to <b>delete</b> this record',
			showCancelButton: true,
			showCloseButton: true,
			cancelButtonText: 'Cancel',
			confirmButtonText: 'Yes, Delete',
			cancelButtonColor: '#d33',
			confirmButtonColor: '#556ee6',
			allowOutsideClick: false

		}).then(function (result) {

			if (result.value) {

				$.ajax({
					url: url,
					type: 'DELETE',
					headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
					data: { admission_id: admission_id },
					dataType: "json",
					success: function (response) {
						if (response.status == false) {
							message = {
								icon: 'error',
								title: 'Oops...',
								text: response.message,
							};
						} else {
							message = {
								icon: 'success',
								title: 'Success',
								text: response.message,
							}
						}
					},

					error: function () {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Some thing went wrong please contact to Administrator!',
						})
					},

					complete: function () {

						admissingListing();

						Swal.fire({
							icon: message.icon,
							title: message.title,
							text: message.text,
						})
					}
				});
			}
		});
	});

	registrationListing();

	$("#btn-registration-search").on("click", function (e) {

		e.preventDefault();
		registrationListing();

	});

	function registrationListing() {

		var session_id = $("#session-id").val();
		var campus_id = $("#campus-id").val();
		var system_id = $("#system-id").val();
		var class_id = $("#class-id").val();
		var group_id = $("#group-id").val();

		$('#registraion-listing-datatable').DataTable({
			destroy: true,
			searchable: false,
			ajax: {
				url: baseUrl + '/student/registration/listingBySessionSystemClassGroup',
				data: {
					session_id: session_id,
					campus_id: campus_id,
					system_id: system_id,
					class_id: class_id,
					group_id: group_id,
				},
			},
			columnDefs: [
				// {	orderable: false,
				// 	targets: [0,8]
				// },
				{
					"targets": 0,
					"render": function (data) {
						var checkbox = `<div class="form-check">
											<input class="form-check-input chkbox-select-admission" type="checkbox" data-id="`+ data.id + `">
										</div>`;
						return checkbox;
					}
				},
				// {
				// 	"targets": 1,
				// 	"render": function (data) {
				// 		return data.registration_id;
				// 	}
				// },
				{
					"targets": 4,
					"render": function (data) {
						var data = JSON.parse(data);
						return data.name;
					}
				},
				{
					"targets": 5,
					"render": function (data) {
						return data.campus + ' ( ' + data.system + ' ) ';
					}
				},
				{
					"targets": 6,
					"render": function (data) {

						var class_group = data.class;

						if (data.group !== '' && data.group !== null) {
							class_group += ' ( ' + data.group + ' ) '
						}
						return class_group;
					}
				},
				{
					"targets": 7,
					"render": function (data) {
						var editUrl = baseUrl + '/student/registration/edit/' + data.id;
						var forwardUrl = baseUrl + '/student/forward/' + data.id;

						var checkbox = `<a href="` + forwardUrl + `"><i class="fas fa-forward" data-id="` + data.id + `" title="View"></i></a> |
										<i class="fas fa-check" id="btn-view-registration" data-id="` + data.id + `" title="View"></i> |
										<a href="`+ editUrl + `"><i class="fas fa-edit" data-id="` + data.id + `"  title="Edit"></i></a> |
						 				<i class="fas fa-trash" id="btn-delete-registration" data-id="`+ data.id + `" title="Delete"></i>`;
						return checkbox;
					}
				},
			],
			order: [[1, 'asc']],
			columns: [
				{ data: null },
				{ data: 'registration_id' },
				{ data: 'first_name' },
				{ data: 'last_name' },
				{ data: 'father_details' },
				{ data: null },
				{ data: null },
				{ data: null },
			],
		});
	}

	$(document).on('click', ".select-all-registration", function () {

		if ($('.select-all-registration').is(':checked')) {
			$('.select-registration').prop('checked', true);
		} else {
			$('.select-registration').prop('checked', false);
		}
	});

	$(document).on('click', ".select-registration", function () {

		var check_box = $('.select-registration').length;
		var checked_check_box = $('.select-registration:checked').length;

		if (check_box == checked_check_box) {
			$('.select-all-registration').prop('checked', true);
		} else {
			$('.select-all-registration').prop('checked', false);
		}
	});


	$(document).on('click', '#btn-delete-regisration', function () {

		var regisration_id = $(this).data('id');
		var url = baseUrl + '/regisration/delete';

		swal.fire({

			icon: 'warning',
			title: 'Are you sure?',
			html: 'You want to <b>delete</b> this record',
			showCancelButton: true,
			showCloseButton: true,
			cancelButtonText: 'Cancel',
			confirmButtonText: 'Yes, Delete',
			cancelButtonColor: '#d33',
			confirmButtonColor: '#556ee6',
			allowOutsideClick: false

		}).then(function (result) {

			if (result.value) {

				$.ajax({
					url: url,
					type: 'DELETE',
					headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
					data: { regisration_id: regisration_id },
					dataType: "json",
					success: function (response) {
						if (response.status == false) {
							message = {
								icon: 'error',
								title: 'Oops...',
								text: response.message,
							};
						} else {
							message = {
								icon: 'success',
								title: 'Success',
								text: response.message,
							}
						}
					},

					error: function () {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Some thing went wrong please contact to Administrator!',
						})
					},

					complete: function () {

						admissingListing();

						Swal.fire({
							icon: message.icon,
							title: message.title,
							text: message.text,
						})
					}
				});
			}
		});
	});

	studentFeesListing();

	$("#btn-admission-search").on("click", function (e) {

		e.preventDefault();
		studentFeesListing();

	});

	function studentFeesListing() {

		var session_id = $("#session-id").val();
		var campus_id = $("#campus-id").val();
		var system_id = $("#system-id").val();
		var class_id = $("#class-id").val();
		var group_id = $("#group-id").val();
		var section_id = $("#section-id").val();

		$('#admission-listing-datatable').DataTable({
			destroy: true,
			searchable: false,
			responsive: true,
			ajax: {
				url: baseUrl + '/admission/listingBySessionSystemClassGroupSection',
				data: {
					session_id: session_id,
					campus_id: campus_id,
					system_id: system_id,
					class_id: class_id,
					group_id: group_id,
					section_id: section_id,
				},
			},
			columnDefs: [
				{
					orderable: false,
					targets: [0, 1, 8]
				},
				{
					"targets": 0,
					"render": function (data) {
						return '';
					}
				},
				{
					"targets": 1,
					"render": function (data) {
						var checkbox = `<div class="form-check">
											<input class="form-check-input chkbox-select-admission" type="checkbox" data-id="`+ data.id + `">
										</div>`;
						return checkbox;
					}
				},
				{
					"targets": 2,
					"render": function (data) {

						var temporary_gr = 'N/A';
						if (data.temporary_gr !== '' && data.temporary_gr !== null) {
							temporary_gr = data.temporary_gr;
						}

						var gr = 'N/A'
						if (data.gr !== '' && data.gr !== null) {
							gr = data.gr;
						}


						return temporary_gr + ' / ' + gr;
					}
				},
				{
					"targets": 5,
					"render": function (data) {
						var data = JSON.parse(data);
						return data.name;
					}
				},
				{
					"targets": 6,
					"render": function (data) {
						return data.campus + ' ( ' + data.system + ' ) ';
					}
				},
				{
					"targets": 7,
					"render": function (data) {

						var class_group = data.class;

						if (data.group !== '' && data.group !== null) {
							class_group += ' ( ' + data.group + ' ) '
						}
						return class_group;
					}
				},
				{
					"targets": 10,
					"render": function (data) {
						var checkbox = `<a>
											<i class="fas fa-dollar" id="btn-collect-fees="`+ data.id + `" title="Edit"></i> 
										</a>|
										<a href="` + (baseUrl + '/admission/export-excel?admission_id=' + data.id) + `">
											<i class="fas fa-file-excel" id="btn-excel-download-admission="`+ data.id + `" title="Edit"></i> 
										</a>|
										<i class="fas fa-check" id="btn-view-admission" data-id="` + data.id + `" title="View"></i> |
										<a href="`+ (baseUrl + '/admission/edit/' + data.id) + `">
											<i class="fas fa-edit" id="btn-edit-admission" data-id="`+ data.id + `" title="Edit"></i> 
										</a>|
						 				<i class="fas fa-trash" id="btn-delete-admission" data-id="`+ data.id + `" title="Delete"></i>`;
						return checkbox;
					}
				},
			],
			order: [[2, 'asc']],
			columns: [
				{ data: null },
				{ data: null },
				{ data: null },
				{ data: 'first_name' },
				{ data: 'last_name' },
				{ data: 'father_details' },
				{ data: null },
				{ data: null },
				{ data: 'section' },
				{ data: 'admission_date' },
				{ data: null },
			],
		});
	}

	$('#modal-datatable').DataTable({
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function (row) {
						var data = row.data();
						return 'Details for ' + data[0] + ' ' + data[1];
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: 'table'
				})
			}
		}
	});

	//______File-Export Data Table
	var table = $('#file-datatable').DataTable({
		buttons: ['copy', 'excel', 'pdf', 'colvis'],
		responsive: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	});

	table.buttons().container()
		.appendTo('#file-datatable_wrapper .col-md-6:eq(0)');

	//______Delete Data Table
	var table = $('#delete-datatable').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	});

	$('#delete-datatable tbody').on('click', 'tr', function () {
		if ($(this).hasClass('selected')) {
			$(this).removeClass('selected');
		}
		else {
			table.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});

	$('#button').click(function () {
		table.row('.selected').remove().draw(false);
	});

	//______Form Input Datatable 
	$('#form-input-datatable').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		},
		responsive: true,
		columnDefs: [{
			orderable: false,
			targets: [1, 2, 3]
		}]

	});

	//______Select2 
	$('.select2').select2({
		minimumResultsForSearch: Infinity
	});


	$('.select2-no-search').select2({
		minimumResultsForSearch: Infinity,
		placeholder: 'All categories',
		width: '100%'
	});

	$('#form-input-datatable').on('draw.dt', function () {
		$('.select2-no-search').select2({
			minimumResultsForSearch: Infinity,
			placeholder: 'Choose one'
		});
	});

});

