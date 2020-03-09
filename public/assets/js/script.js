function viewmodel() {
	var self = this;
}

function GetBookings(vm){
	
	var self = vm, day = "2020-03-09";
	
	self.dayText = ko.observable(day);	
	self.headerColumns = ko.observableArray([]);	
	self.bodyRows = ko.observableArray([]);	
		
	$.ajax({
		type: "POST",
		dataType: "json",
		url: "getBookings.php?day="+day,
		data: JSON.stringify(),
		success: function (data) {
			
			self.headerColumns($.map(data.headers, function (column) {
				return new HeaderColumnViewModel(column);
			}));
			
			self.bodyRows($.map(data.body, function (row) {
				return new BodyRowViewModel(row);
			}));
			
		}
	});
	
}

function HeaderColumnViewModel(column){
	
	var self = this;
	
	self.headerColumnText = ko.observable(column.text);

}

function BodyRowViewModel(row){
	
	var self = this;
	
	self.bodyColumns = ko.observableArray([]);
	
	self.bodyColumns($.map(row.columns, function (column) {
		return new BodyColumnViewModel(column);
	}));

}

function BodyColumnViewModel(column){
	
	var self = this;
	
	self.bodyColumnText = ko.observable(column.text);

}

$(document).ready(function(){
	
	var vm = new viewmodel();
	
	GetBookings(vm);
	
	ko.applyBindings(vm);

});