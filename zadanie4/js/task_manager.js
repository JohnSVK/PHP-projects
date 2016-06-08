var taskStructZoznam;
var taskStructZoznamFinished;

//onclick listener na addtask button
function addTask() {
	var owner = $("#add_task_owner").val();
	var priority = $("#add_task_priority").val();
	var text = $("#add_task_text").val();
	
	//vytvorenie novej ulohy
	var new_task = { owner: owner, priority: priority, text: text};

	//overenie, ci boli vyplnene polia vo formulari
	if((text.length > 0) && (text.length < 2000)) {
		
		$.ajax({
			type: "POST",
			url: "addtask.php",
			data: new_task,
			success: function(result) {
				if(result)
					console.log("INSERT SUCCESFUL ");
			}
		});
	}
}

function finishTask(id, name) {
	var id = id;
	var name = name;
	
	var update_task = { id: id, name: name};
	console.log("CALL SUCCESFUL ");
	
	$.ajax({
			type: "POST",
			url: "finishtask.php",
			data: update_task,
			success: function(result) {
				if(result)
					console.log("UPDATE SUCCESFUL ");
			}
		});
}

//nacitanie jednej ulohy, vrati na vystupe
function getTask(curTask, taskObj, type) {
		
		if(type == 0) {
			if(taskObj.priority == 1) {
				$(".task_priority", curTask).text("Nízka priorita");
			} else if(taskObj.priority == 2) {
				$(".task_priority", curTask).text("Stredná priorita");
			} else if(taskObj.priority == 3) {
				$(".task_priority", curTask).text("Vysoká priorita");
			}
			
			var name = $("#add_task_owner").val();
			//var btn = "<button onChange=\"finishTask(" + taskObj.id + ",\'" + name + "\')\">Dokončiť</button>";
			
			var btn = document.createElement('input');
			btn.type = "button";
			btn.value = "Dokončiť";
			btn.addEventListener('click', function(){
				finishTask(taskObj.id, name);
			});

			$(".task_owner", curTask).text(taskObj.owner);
			$(".task_text", curTask).text(taskObj.text);
			$(".task_date", curTask).text(taskObj.date);
			$(".task_btn", curTask).append(btn);
		} else {
			$(".task_owner", curTask).text(taskObj.owner);
			$(".task_text", curTask).text(taskObj.text);
			$(".task_date", curTask).text(taskObj.date);
			
			$(".task_finished_by", curTask).text(taskObj.finished_by);
			$(".task_finished_at", curTask).text(taskObj.finished_at);
		}
		
		return curTask;
}

//nacitanie vsetkych uloh z data
function loadTasks(data, zoznam, type) {
		
		$(zoznam).empty();
		
		$(data).each(function(index, taskObj) {
			
			if(type == 0)
				var curTask = $(taskStructZoznam);
			else
				var curTask = $(taskStructZoznamFinished);
			
			//nacitanie ulohy
			curTask = getTask(curTask, taskObj, type);
			
			curTask.appendTo(zoznam);
			
		});
}

//hlavna funkcia nacitana s dokumentom
$(document).ready(function() {
		console.log("ready!");
		
		taskStructZoznam = '<div class="row zoznam_task">'+$("div.zoznam_task").html()+'</div>';
		taskStructZoznamFinished = '<div class="row zoznam_task_finished">'+$("div.zoznam_task_finished").html()+'</div>';
		
		if(typeof(EventSource) !== "undefined") {
			var sourceTasks = new EventSource("gettasks.php");
			var sourceUsers = new EventSource("getusers.php");
			
			sourceTasks.addEventListener("message", function(e) {
				var data = JSON.parse(e.data);
				console.log(data);
				
				if(data["tasks"][0]["id"]) {
					//nacitanie vsetkych nesplnenych uloh
					loadTasks(data["tasks"], "#zoznam", 0);
				} else {
					$("#zoznam").empty();
					document.getElementById("zoznam").innerHTML = "Neboli zatiaľ pridané žiadne úlohy<br>";
				}
				
				if(data["tasks_finished"][0]["id"]) {
					//nacitanie vsetkych dokoncenych uloh
					loadTasks(data["tasks_finished"], "#zoznam_finished", 1);
				} else {
					$("#zoznam_finished").empty();
					document.getElementById("zoznam_finished").innerHTML = "<div class=\"\">Neboli zatiaľ dokončené žiadne úlohy</div>";
				}
				
					}, false);
			
			sourceUsers.addEventListener("message", function(e) {
				var data = JSON.parse(e.data);
				console.log(data);
				
				$(".users").empty();
				
				$(data).each(function (index, userObj) {
					$(".users").append(userObj+"<br>");
				});
				
					}, false);
			  
		} else {
			//document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
		}
		
	});