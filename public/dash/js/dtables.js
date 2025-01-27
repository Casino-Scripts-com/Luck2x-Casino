"use strict";
var KTDatatablesData = function() {

	var initTable1 = function() {
		var table = $('#dtable');

		// begin first table
		table.DataTable({
			responsive: true,
			searchDelay: 500,
			"language": {
				  "processing": "Wait for it....",
				  "search": "Search:",
				  "lengthMenu": "Show _MENU_ records",
				  "info": "Records from _START_ to _END_ of _TOTAL_ records",
				  "infoEmpty": "Records from 0 to 0 of 0 records",
				  "infoFiltered": "(filtered from _MAX_ records)",
				  "infoPostFix": "",
				  "loadingRecords": "Uploading records...",
				  "zeroRecords": "There are no records.",
				  "emptyTable": "There are no data in the table",
				  "paginate": {
					"first": "The first one",
					"previous": "Previous",
					"next": "Next",
					"last": "The last one"
				  },
				  "aria": {
					"sortAscending": ": activate to sort the column in ascending order",
					"sortDescending": ": activate to sort the column in descending order"
				  }
			}
		});
	};
	var initTable2 = function() {
		var table = $('#dtable2');

		// begin first table
		table.DataTable({
			responsive: true,
			searchDelay: 500,
			"language": {
				  "processing": "Wait for it....",
				  "search": "Search:",
				  "lengthMenu": "Show _MENU_ records",
				  "info": "Records from _START_ to _END_ of _TOTAL_ records",
				  "infoEmpty": "Records from 0 to 0 of 0 records",
				  "infoFiltered": "(filtered from _MAX_ records)",
				  "infoPostFix": "",
				  "loadingRecords": "Uploading records...",
				  "zeroRecords": "There are no records.",
				  "emptyTable": "There are no data in the table",
				  "paginate": {
					"first": "The first one",
					"previous": "Previous",
					"next": "Next",
					"last": "The last one"
				  },
				  "aria": {
					"sortAscending": ": activate to sort the column in ascending order",
					"sortDescending": ": activate to sort the column in descending order"
				  }
			}
		});
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
			initTable2();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesData.init();
});