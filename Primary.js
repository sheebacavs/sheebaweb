function login()
{
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	
	if (username !== "" && password !== "")
	{
		// Initialize your xml http handler
		var xmlhttp;

		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		// When the request comes back...
		xmlhttp.onreadystatechange=function()
		{
			// If the request is 4 (request finished and response is ready) or 200 (OK)
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var response = xmlhttp.responseText;
				if (response == "FAIL")
				{
					document.getElementById("LogInFail").style.visibility = "visible";
				}
				else if (response !== "")
				{
					document.getElementById("LogInFail").style.visibility = "visible";
					document.getElementById("LogInFail").innerHTML = response;
				}
				else
				{
					location.href = "Home.html";
				}
			}
		}
		
		// Open the request, setting the method to POST, the page, and the asynchronous flag
		var postdata = "username=" + username + "&password=" + password;
		xmlhttp.open("POST","Login.php",true); // POST silently passes variables
		
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", postdata.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.send(postdata); // Send your request
	}
}

function populateDogs()
{
	// Initialize your xml http handler
	var xmlhttp;

	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	// When the request comes back...
	xmlhttp.onreadystatechange=function()
	{
		// If the request is 4 (request finished and response is ready) or 200 (OK)
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			// Set the element with the id "content" (our div in Default.htm) to the response text
			document.getElementById("content").innerHTML= xmlhttp.responseText;
		}
	}
	
	// Open the request, setting the method to POST, the page, and the asynchronous flag
	xmlhttp.open("POST","GetDogs.php",true); // POST silently passes variables
	xmlhttp.send(); // Send your request
}

function getPedigree(id)
{
	if (id == null)
	{
		var select = document.getElementById("dogSelect");

		var id = select.options[select.selectedIndex].value;
	}
	
	var xmlhttp;

	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var myWindow = window.open("Pedigree.html");
			
			myWindow.window.onload = function() { myWindow.document.getElementById("content").innerHTML= xmlhttp.responseText; }
		}
	}
	
	xmlhttp.open("GET","GetPedigree.php?id=" + id,true); // GET passes variables in the url
	xmlhttp.send();
}

function search() 
{
	var searchText = document.getElementById("searchBox").value;
	if(searchText !== "")
	{
		// Initialize your xml http handler
		var xmlhttp;

		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		// When the request comes back...
		xmlhttp.onreadystatechange=function()
		{
			// If the request is 4 (request finished and response is ready) or 200 (OK)
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var myWindow = window.open("Pedigree.html");
				
				// Set the element with the id "content" (our div in Default.htm) to the response text
				myWindow.window.onload = function() { myWindow.document.getElementById("content").innerHTML= xmlhttp.responseText; }
			}
		}
		
		// Open the request, setting the method to POST, the page, and the asynchronous flag
		xmlhttp.open("GET","SearchDogs.php?searchText=" + searchText,true); // POST silently passes variables
		xmlhttp.send(); // Send your request
	}
	
	// Javascript popup
	// alert(searchText);
}

function editDog(id)
{
	if (id == null)
	{
		var select = document.getElementById("dogSelect");

		var id = select.options[select.selectedIndex].value;
	}
	
	var link = "EditDog.php?id=" + id;
	var myWindow = window.open(link);
}

function populateBirthDateOLD(date)
{
	//0000-00-00
	var dateArray = date.split("-");
	var dateYear = dateArray[0];
	var dateMonth = dateArray[1];
	var dateDay = dateArray[2];
	
	// Year Null Value
	var option1 = document.createElement("option");
	option1.value = "NULL";
	if (dateYear == "0000")
	{
		option1.selected = true;
	}
	
	// Month Null Value
	var option2 = document.createElement("option");
	option2.value = "NULL";
	if (dateMonth == "00")
	{
		option2.selected = true;
	}
	
	// Day Null Value
	var option3 = document.createElement("option");
	option3.value = "NULL";
	if (dateDay == "00")
	{
		option3.selected = true;
	}

	var yearSelect = document.getElementById("BIRTH_DATE_Y");
	yearSelect.appendChild(option1);
	
	var today = new Date();
	var thisYear = today.getFullYear();
	
	for ( var i = thisYear, count = 0; count < 100; count++ )
	{
		var opt = document.createElement("option");
		opt.value = i;
		opt.innerHTML = i;
		
		if (dateYear == i)
		{
			opt.selected = true;
		}

		yearSelect.appendChild(opt);
		i--;
	}
	
	var monthSelect = document.getElementById("BIRTH_DATE_M");
	monthSelect.appendChild(option2);
	
	for ( var i = 1; i < 13; i++ )
	{
		var opt = document.createElement("option");
		opt.value = i;
		opt.innerHTML = i;

		if (dateMonth == i)
		{
			opt.selected = true;
		}

		monthSelect.appendChild(opt);
	}
	
	var daySelect = document.getElementById("BIRTH_DATE_D");
	daySelect.appendChild(option3);
	
	for ( var i = 1; i < 32; i++ )
	{
		var opt = document.createElement("option");
		opt.value = i;
		opt.innerHTML = i;

		if (dateDay == i)
		{
			opt.selected = true;
		}

		daySelect.appendChild(opt);
	}
}

// console.log(date instanceof Date && !isNaN(date.valueOf())​)​;






















