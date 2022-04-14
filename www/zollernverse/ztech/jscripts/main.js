if(self.location.href != top.location.href) { 
	top.location = self.location; 
} 

function changeTitle(newTitle){
	document.title = 'zTech+ Web - '+newTitle;
}