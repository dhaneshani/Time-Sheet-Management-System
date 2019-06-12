
function showData() {
    document.getElementById("date").value = localStorage.getItem("date");
    document.getElementById("customer").value = localStorage.getItem("customer");
    document.getElementById("module").value = localStorage.getItem("module");
    document.getElementById("workType").value = localStorage.getItem("workType");
    document.getElementById("startTime").value = localStorage.getItem("startTime");
    document.getElementById("endTime").value = localStorage.getItem("endTime");
    document.getElementById("description").value = localStorage.getItem("description");
    
}
function saveData() {
    var date = document.getElementById("date").value;
	localStorage.setItem("date", date);

	var customer = document.getElementById("customer").value;
	localStorage.setItem("customer", customer);

	var module = document.getElementById("module").value;
	localStorage.setItem("module", module);

	var workType = document.getElementById("workType").value;
	localStorage.setItem("workType", workType);

	var startTime = document.getElementById("startTime").value;
	localStorage.setItem("startTime", startTime);

	var endTime = document.getElementById("endTime").value;
	localStorage.setItem("endTime", endTime);

	var description = document.getElementById("description").value;
	localStorage.setItem("description", description);

    location.reload();
    
}
