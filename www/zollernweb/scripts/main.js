$.ajaxSetup({type: "POST"});

var docTitle = "Zollern Web";

var ZollernJS = {
	changeTitle: function(newTitle){
		document.title = docTitle + ' - ' + newTitle;
	}
}