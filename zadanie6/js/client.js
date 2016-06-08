var country;
var service;
var query;

function formatDate(date) {
	return date.substring(2, 4) + "." + date.substring(0, 2);
}

$(document).ready(function(){
	$("#getNameByDate").click(function(){
		country = $("#inputField1_2").val();
		service = "meniny";
		query = {date:$("#inputField1_1").val()};
		
		if (country == null || !country) {
			country = "all";
		}
		
	  $.ajax({
		 type: 'GET',
		 url: 'http://147.175.98.161/zadanie06/index.php/' + country + '/' + service,
		 data: query,
		 dataType: 'json',
		 success: function(msg){
			var json = msg;
			
			if(json.success) {
				$("#result").html("<br>" + json.result.name);
			} else {
				$("#result").html("<br>Nenašiel sa žiadny záznam.");
			}
			
			}});
	});
	
	$("#getDateByName").click(function(){
		country = $("#inputField2_2").val();
		service = "meniny";
		query = {name:$("#inputField2_1").val()};
		
		if (country == null || !country) {
			country = "all";
		}
		
	  $.ajax({
		 type: 'GET',
		 url: 'http://147.175.98.161/zadanie06/index.php/' + country + '/' + service,
		 data: query,
		 dataType: 'json',
		 success: function(msg){
			var json = msg;
			
			if(json != null && json.success) {
				$("#result").html("<br>" + formatDate(json.result.date));
			} else {
				$("#result").html("<br>Nenašiel sa žiadny záznam.");
			}
			
			}});
	});
	
	$("#getSKsviatky").click(function(){
		country = "SK";
		service = "sviatky";
		
	  $.ajax({
		 type: 'GET',
		 url: 'http://147.175.98.161/zadanie06/index.php/' + country + '/' + service,
		 dataType: 'json',
		 success: function(msg){
			var json = msg;
			
			if(json != null && json.success) {
				var result = "";
				
				json.result.sviatky.forEach(function(sviatok) {
					result += "<br>" + formatDate(sviatok.den) + " " + sviatok.sviatok;
				});
				$("#result").html(result);
			} else {
				$("#result").html("Nenašiel sa žiadny záznam.");
			}
			
			}});
	});
	
	$("#getCZsviatky").click(function(){
		country = "CZ";
		service = "sviatky";
		
	  $.ajax({
		 type: 'GET',
		 url: 'http://147.175.98.161/zadanie06/index.php/' + country + '/' + service,
		 dataType: 'json',
		 success: function(msg){
			var json = msg;
			
			if(json != null && json.success) {
				var result = "";
				
				json.result.sviatky.forEach(function(sviatok) {
					result += "<br>" + formatDate(sviatok.den) + " " + sviatok.sviatok;
				});
				$("#result").html(result);
			} else {
				$("#result").html("Nenašiel sa žiadny záznam.");
			}
			
			}});
	});
	
	$("#getSKpamiatky").click(function(){
		country = "SK";
		service = "pamiatky";
		
	  $.ajax({
		 type: 'GET',
		 url: 'http://147.175.98.161/zadanie06/index.php/' + country + '/' + service,
		 dataType: 'json',
		 success: function(msg){
			var json = msg;
			
			if(json != null && json.success) {
				var result = "";
				
				json.result.pamiatky.forEach(function(pamiatka) {
					result += "<br>" + formatDate(pamiatka.den) + " " + pamiatka.pamiatka;
				});
				$("#result").html(result);
			} else {
				$("#result").html("Nenašiel sa žiadny záznam.");
			}
			
			}});
	});
	
	$("#addMeniny").click(function(){
		country = "meniny";
		service = "new";
		query = {date:$("#inputField3_1").val(), name:$("#inputField3_2").val()};
		
	  $.ajax({
		 type: 'POST',
		 url: 'http://147.175.98.161/zadanie06/index.php/' + country + '/' + service,
		 data: query,
		 dataType: 'json',
		 success: function(msg){
			var json = msg;
			
			if(json != null && json.success) {
				$("#result").html("<br>Meniny úspešne pridané.");
			} else {
				$("#result").html("<br>Nasprávne zadané parametre. Meniny neboli pridané.");
			}
			
			}});
	});
	/*
	$("#addMeniny").click(function(){
		country = "meniny";
		//service = "new";
		query = {date:$("#inputField3_1").val(), name:$("#inputField3_2").val()};
		
	  $.ajax({
		 type: 'PUT',
		 url: 'http://147.175.98.161/zadanie06/index.php',// + country + '/' + service,
		 data: query,
		 dataType: 'json',
		 success: function(msg){
			var json = msg;
			
			if(json != null && json.success) {
				$("#result").html("<br>Meniny úspešne pridané." + json.success);
			} else {
				$("#result").html("<br>Nasprávne zadané parametre. Meniny neboli pridané.");
			}
			
			}});
	});*/
	 
});