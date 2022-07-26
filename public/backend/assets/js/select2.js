jQuery(function () {
	$('.select2').select2({
		placeholder: 'Select',
		searchInputPlaceholder: 'Search',
		width: '100%',
	});
	$('.campus-select2').select2({
		placeholder: 'Select Campus',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.session-select2').select2({
		placeholder: 'Select Session',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.system-select2').select2({
		placeholder: 'Select Class',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.class-select2').select2({
		placeholder: 'Select Class',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.section-select2').select2({
		placeholder: 'Select Section',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.group-select2').select2({
		placeholder: 'Select Section',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.gender-select2').select2({
		placeholder: 'Select Gender',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.blood-select2').select2({
		placeholder: 'Select Blood Group',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.current-area-select2').select2({
		placeholder: 'Select Current Area',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});

	$('.permanent-area-select2').select2({
		placeholder: 'Select permanent Area',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	
	$('.siblings-in-mpa-select2').select2({
		placeholder: 'Select Siblings',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.previous-class-id-select2').select2({
		placeholder: 'Select Previous Class',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.area-select2').select2({
		placeholder: 'Select Area',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.city-select2').select2({
		placeholder: 'Select City',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.test-group-select2').select2({
		placeholder: 'Select Test Group',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.interview-group-us-select2').select2({
		placeholder: 'Select Interview Group',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});

	$('.select2-no-search').select2({
		minimumResultsForSearch: Infinity,
		placeholder: 'All categories',
		width: '100%'
	});

	function formatState(state) {
		if (!state.id) { return state.text; }
		var $state = $(
			'<span><img src="backend/assets/plugins/flag-icon-css/flags/4x3/' + state.element.value.toLowerCase() +
			'.svg" class="img-flag" /> ' +
			state.text + '</span>'
		);
		return $state;
	};

	$(".select2-flag-search").select2({
		templateResult: formatState,
		templateSelection: formatState,
		escapeMarkup: function (m) { return m; }
	});

	$('.select2').on('click', () => {
		let selectField = document.querySelectorAll('.select2-search__field')
		selectField.forEach((element, index) => {
			element.focus();
		})
	});

	// $('.testGroup').select2({
	//     placeholder:'Select Test Group',
	//     tags:true,
	// }).on('select2:close', function(){
	//     var element = $(this);

	// 	alert('You want to save');

	//     console.log(element);
	//     console.log(element.val());

	// 	// $(this).remove();

	// 	// $('.testGroup').select2();

	// 	// var new_category = $.trim(element.val());

	//     // if(new_category != '')
	//     // {
	//     //   $.ajax({
	//     //     url:"add.php",
	//     //     method:"POST",
	//     //     data:{category_name:new_category},
	//     //     success:function(data)
	//     //     {
	//     //       if(data == 'yes')
	//     //       {
	//     //         element.append('<option value="'+new_category+'">'+new_category+'</option>').val(new_category);
	//     //       }
	//     //     }
	//     //   })
	//     // }

	// });

});
