<?php
	session_start();
?>
<!DOCTYPE html>
	<head>
		<title>PHP Test</title>
		<!--<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"> -->
		<meta charset = "UTF-8">
		<style>
			.Whole_form{
				position: absolute;
				top: 5px;
				margin-top: 0;
				margin-left: 450px;
				margin-right: 450px;
				background-color: #FBF9FB;
				padding-top: 5px;
				padding-left:10px;
				width: 570px;
				height: 250px;
				border-style: solid;
				border-width: 2px;
				border-color: #CAC8CA;
			}

			#Search_title{
				position: relative;
				left:-5px;
				margin-left: 1%;
				margin-right: 1%;
				padding-left: 35%;
				padding-right: 33%;
				padding-bottom: 3px;
				display: inline-block;
				font-style: italic;
				font-size: 25px;
				white-space: nowrap;
				border-bottom-style: solid;
				border-bottom-color: grey;
				border-width: 1px;
			}

			#myform{
				top: 5px;
			}

			.space_created{
				margin-top: 5px;
			}

			.direction_check{
				display:inline;
			}

			.defaultNotEnable{
				display: inline;
				opacity: 0.5;
			}

			.choice{
				position: relative;
				left: 10px;
				top: 0px;
				width: 160px;
				display:inline-block;
				vertical-align: top;

			}

			.form_button{
				position: relative;
				left: 650px;
				margin-top: 210px;
				width: 200px;
			}

			#infoTable{
				position: absolute;
				top: 400px;
				left: 100px;
				text-align: left;
			}

			.errors{
				position: absolute;
				left: 425px;
				text-align: center;
				padding-left: 220px;
				padding-right: 220px; 
				top: 300px;
				background-color: #FBF9FB;
				border-color: #CAC8CA;
				border-style: solid;
				border-width: 2px;
				white-space: nowrap;
			}

			#details{
				font-weight: bold;
				font-size: 30px;
				top: 280px;
				position: absolute;
				margin-left: 650px;
			}

			#detail_table{
				position: relative;
				top: 100px;
				margin-left: 380px;
			}

			#detailImage{
				width: 300px;
				height: 300px;
			}

			#click_arrow_prompt1{
				color: grey;
				position: relative;
				margin-top: 10%;
				margin-left: -10px;
				text-align: center;
			}

			#click_arrow_prompt2{
				color: grey;
				position: relative;
				margin-top: 0%;
				margin-left: -10px;
				text-align: center;
			}

			#click_arrow1{
				position: relative;
				margin-top: 0%;
				margin-left: 680px;
				width: 45px;
				height: 25px;
			}

			#click_arrow2{
				position: relative;
				margin-top: 0%;
				margin-left: 680px;
				width: 45px;
				height: 25px;
			}

			#click_arrow1:hover{
				cursor: pointer;
			}

			#click_arrow2:hover{
				cursor: pointer;
			}

			.displayAsLink:hover{
				color: #CAC8CA;
				cursor: pointer;
			}

			#sellerSrc{
				display: none;
			}

			#theSeller{
				border: none;
			}

			#noDetail{
				font-weight: bold;
				background-color: #CAC8CA;
				text-align: center;
				padding-left: 0px;
				padding-right: 0px;
				margin-left: 400px;
				margin-right: 400px;
				white-space: nowrap;
			}

			#noSimilar{
				display: none;

				font-weight: bold;
				border-color: #CAC8CA;
				border-style: solid;
				border-width: 2px;
				padding-left: 200px;
				padding-right: 200px;
				margin-left: 400px;
				position: relative;
			}

			#similarTable{
				border-style: solid;
				border-width: 2px;
				border-color: #CAC8CA;
				position: relative;
				left: 380px;
				width: 600px;
				display: none;
				overflow-x: scroll;
			}

			#simTable{
				text-align: center;
				overflow-x: scroll;
			}

		</style>
	</head>
	<body onload='loadGeoLoc()'>
		<?php
			$detailURL = '';
			$detailURL .= 'http://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=YuncongX-mytest01-PRD-816de56dc-5fbeda8c&siteid=0&version=967&ItemID=';
			$similarURL = 'http://svcs.ebay.com/MerchandisingService?OPERATION-NAME=getSimilarItems&SERVICE-NAME=MerchandisingService&SERVICE-VERSION=1.1.0&CONSUMER-ID=YuncongX-mytest01-PRD-816de56dc-5fbeda8c&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&itemId=';
			$theItemID = $_POST['itemID'];
			$detailURL .= $theItemID;
			$detailURL .= '&IncludeSelector=Description,Details,ItemSpecifics';
			$similarURL .= $theItemID;
			$similarURL .= '&maxResults=8';
			//echo $detailURL;
			$detailContent = file_get_contents($detailURL);
			$detailFile = json_encode($detailContent);
			$similarContent = file_get_contents($similarURL);
			$similarFile = json_encode($similarContent);
		?>

		<script>
			function loadGeoLoc(){
				var URL = "http://ip-api.com/json";
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open("GET", URL, false);
				xmlhttp.send();
				var jsonObj = JSON.parse(xmlhttp.responseText);
				theZip = jsonObj.zip;
				document.getElementById("localzip").value = theZip;
			}

			function clearOpacity(){
				if(document.getElementsByClassName("defaultNotEnable") != undefined){
					document.getElementsByClassName("defaultNotEnable")[0].style.opacity = 1.0;
				}
			}

			function testEnable(){
				if(document.getElementById("NearbySearch").checked == false){

					var y = document.getElementsByClassName("notEnable");
					document.getElementsByClassName("defaultNotEnable")[0].style.opacity = 0.5;
					for(var i = 0;i < y.length; i++){
						y[i].disabled = true;
					}
					document.getElementById("zip_choice").disabled = true;
					document.getElementById("zip_here").disabled = true;
					document.getElementById("zip").disabled = true;
				}
				else{
					var y = document.getElementsByClassName("notEnable");
					document.getElementsByClassName("defaultNotEnable")[0].style.opacity = 1;
					for(var i = 0;i < y.length; i++){
						y[i].disabled = false;
					}
					document.getElementById("zip_choice").disabled = false;
					document.getElementById("zip_here").disabled = false;
				}
			}

			function testDisable(){
				var y = document.getElementsByClassName("notEnable");
				for(var i = 0;i < y.length; i++){
						y[i].disabled = true;
				}
				document.getElementsByClassName("defaultNotEnable")[0].style.opacity = 0.5;
				document.getElementById("zip").disabled = true;
				document.getElementById("zip_choice").disabled = true;
				document.getElementById("zip_here").disabled = true;
				if(document.getElementById("click_arrow1") != null){
					document.getElementById("click_arrow1").style.visibility = "hidden";
				}
				if(document.getElementById("click_arrow2") != null){
					document.getElementById("click_arrow2").style.visibility = "hidden";
				}
				if(document.getElementById("click_arrow_prompt1") != null){
					document.getElementById("click_arrow_prompt1").display = "none";
					document.getElementById("click_arrow_prompt1").innerHTML = "";
				}
				if(document.getElementById("click_arrow_prompt2") != null){
					document.getElementById("click_arrow_prompt2").display = "none";
					document.getElementById("click_arrow_prompt2").innerHTML = "";
				}
				if(document.getElementById("similarTable") != null){
					document.getElementById("similarTable").innerHTML= "";
					document.getElementById("similarTable").display= "none";
				}
				if(document.getElementById("detailTable") != null){
					document.getElementById("detailTable").innerHTML = "";
					document.getElementById("detailTable").display = "none";
				}
				if(document.getElementsByClassName("errors")[0] != undefined){
					document.getElementsByClassName("errors")[0].style.display = "none";
				}
				if(document.getElementById("details") != undefined){
					document.getElementById("details").innerHTML = "";
				}
				if(document.getElementById("detail_table") != undefined){
					document.getElementById("detail_table").innerHTML = "";
					document.getElementById("detail_table").display = "none";
				}
				if(document.getElementById("infoTable") != undefined){
					document.getElementById("infoTable").innerHTML = "";
				}
				if(document.getElementById("noSimilar") != null){
					document.getElementById("noSimilar").style.display = "none";
				}
				if(document.getElementById("noDetail") != null || document.getElementById("noDetail") != undefined){
					document.getElementById("noDetail").style.display = "none";
				}
			}

			function enableZip(){
				if(document.getElementById("zip_choice").checked == true){
					document.getElementById("zip").disabled = false;
				}
				else{
					document.getElementById("zip").disabled = true;
				}
			}

			function disableZip(){
				if(document.getElementById("zip_here").checked == true){
					document.getElementById("zip").disabled = true;
				}
			}
		
			function searchDetail(itemID){
				var theForm = document.createElement("form");
				theForm.method = "POST";
				theForm.action = "<?php echo $_SERVER['PHP_SELF']?>";
				var theID = document.createElement("input");
				var prevKeyword = document.createElement("input");
				var prevCategory =  document.createElement("input");

				var prevCondition1 = document.createElement("input");
				prevCondition1.type = 'checkbox';
				var prevCondition2 = document.createElement("input");
				prevCondition2.type = 'checkbox';
				var prevCondition3 = document.createElement("input");
				prevCondition3.type = 'checkbox';
				var prevShippingOption1 = document.createElement("input");
				prevShippingOption1.type = 'checkbox';
				var prevShippingOption2 = document.createElement("input");
				prevShippingOption2.type = 'checkbox';				
				var prevNearBy = document.createElement("input");
				prevNearBy.type = 'checkbox';	
				var prevDist = document.createElement("input");	
				var prevDirection = document.createElement("input");	
				var prevZipCode = document.createElement("input");
				document.body.appendChild(theForm);
				theID.name = "itemID";
				theID.value = itemID;
				prevKeyword.name = 'Keyword';
				prevKeyword.value = THE_KEYWORD;
				prevCategory.name = 'Category';
				if(THE_CATEGORY != ""){
					prevCategory.value = THE_CATEGORY; 
				}
				prevCondition1.name = 'Condition1';
				if(THE_CONDITION1 == "New"){
					prevCondition1.value = THE_CONDITION1;
				}
				prevCondition2.name = 'Condition2';
				if(THE_CONDITION2 == "Used"){
					prevCondition2.value = THE_CONDITION2;
				}
				prevCondition3.name = 'Condition3';
				if(THE_CONDITION3 == "Unspecified"){
					prevCondition3.value = THE_CONDITION3;
				}
				prevShippingOption1.name = 'Shipping1';
				if(THE_SHIP1 == "localpick"){
					prevShippingOption1.value = THE_SHIP1; 
				}
				prevShippingOption2.name = 'Shipping2';
				if(THE_SHIP2 == "freeship"){
					prevShippingOption2.value = THE_SHIP2; 
				}
				prevNearBy.name = 'nearby';
				if(NEARBY_SEARCH == "enable"){
					prevNearBy.value = NEARBY_SEARCH;
				}
				prevDist.name ='far';
				if(HOW_FAR != ""){
					prevDist.value = HOW_FAR;
				}
				prevDirection.name = 'direction';
				if(THE_DIRECTION == "here" || THE_DIRECTION == "nothere"){
					prevDirection.value = THE_DIRECTION;
				}
				prevZipCode.name = 'zipcode';
				if(THE_ZIP != ""){
					prevZipCode.value = THE_ZIP;
				}
				theID.type = 'hidden';
				theID.setAttribute("type","hidden");
				prevKeyword.setAttribute("type","hidden");
				prevCategory.setAttribute("type","hidden");
				prevCondition1.setAttribute("type","hidden");
				prevCondition2.setAttribute("type","hidden");
				prevCondition3.setAttribute("type","hidden");
				prevNearBy.setAttribute("type","hidden");
				prevDist.setAttribute("type","hidden");
				prevDirection.setAttribute("type","hidden");
				prevZipCode.setAttribute("type","hidden");
				theForm.appendChild(theID);
				theForm.appendChild(prevKeyword);
				theForm.appendChild(prevCategory);
				theForm.appendChild(prevCondition1);
				theForm.appendChild(prevCondition2);
				theForm.appendChild(prevCondition3);
				theForm.appendChild(prevShippingOption1);
				theForm.appendChild(prevShippingOption2);
				theForm.appendChild(prevNearBy);
				theForm.appendChild(prevDist);
				theForm.appendChild(prevDirection);
				theForm.appendChild(prevZipCode);
				theForm.submit();
			}
			
			function showSimilar(someID){
				if(document.getElementById("click_arrow2").src == "http://csci571.com/hw/hw6/images/arrow_down.png"){
					document.getElementById("click_arrow2").src = "http://csci571.com/hw/hw6/images/arrow_up.png";
					document.getElementById("sellerSrc").style.display = "none";
					if(document.getElementById("noDetail") != null || document.getElementById("noDetail") != undefined){
						document.getElementById("noDetail").style.display = "none";
					}
					document.getElementById("click_arrow1").src = "http://csci571.com/hw/hw6/images/arrow_down.png";
					document.getElementById("click_arrow_prompt2").innerHTML = "click to hide similar items";
					document.getElementById("click_arrow_prompt1").innerHTML = "click to show seller message";
					var similarJSON = JSON.parse(theSimilarFile);
					if(similarJSON.getSimilarItemsResponse.itemRecommendations.item != null && similarJSON.getSimilarItemsResponse.itemRecommendations.item != undefined){
						var items = similarJSON.getSimilarItemsResponse.itemRecommendations.item;
						if(items.length > 0){
							var sim_table = "";
							sim_table += '<table id="simTable" width="500px" height="300px">';
							sim_table += "<tr>";
							for(var i = 0; i < items.length;i++){
								sim_table += "<th>";
								sim_table += '<img src="';
								if(items[i].imageURL != null && items[i].imageURL != undefined){
									sim_table += items[i].imageURL;
								}
								else{
									sim_table += "N/A";
								}
								sim_table +='">';
								sim_table += "</th>";				
							}
							sim_table += "</tr>";
							sim_table += "<tr>";
							for(var i = 0; i < items.length;i++){
								sim_table += '<td class="displayAsLink" onclick="searchDetail(';
								sim_table += items[i].itemId;
								sim_table += ')">';
								if(items[i].title != null && items[i].title != undefined){
									sim_table += items[i].title;
								}
								else{
									sim_table += "N/A";
								}
								sim_table += "</td>";				
							}
							sim_table += "</tr>";
							sim_table += "<tr>";
							for(var i = 0; i < items.length;i++){
								sim_table += "<td>";
								sim_table += "<b>";
								if(items[i].buyItNowPrice.__value__ != null && items[i].buyItNowPrice.__value__  != undefined){
									sim_table += "$";
									sim_table += items[i].buyItNowPrice.__value__ ;
								}
								else{
									sim_table += "N/A";
								}
								sim_table += "</b>";
								sim_table += "</td>";				
							}
							sim_table += "</tr>";
							sim_table += "</table>";
							document.getElementById("similarTable").style.display = "block";
							document.getElementById("similarTable").innerHTML = sim_table;
						}
						else{
							document.getElementById("noSimilar").style.display = "inline";
						}
					}
				}
				else if(document.getElementById("click_arrow2").src == "http://csci571.com/hw/hw6/images/arrow_up.png"){
					document.getElementById("click_arrow2").src = "http://csci571.com/hw/hw6/images/arrow_down.png";
					document.getElementById("sellerSrc").style.display = "none";
					document.getElementById("click_arrow1").src = "http://csci571.com/hw/hw6/images/arrow_down.png";
					document.getElementById("similarTable").innerHTML = "";
					document.getElementById("similarTable").style.display = "none";
					document.getElementById("click_arrow_prompt2").innerHTML = "click to show similar items";
					document.getElementById("click_arrow_prompt1").innerHTML = "click to show seller message";
					if(document.getElementById("noSimilar") != null){
						document.getElementById("noSimilar").style.display = "none";
					}
				}
			}

			function resizeIframe(){
				var height = document.getElementById("theSeller").contentWindow.document.body.scrollHeight;
				height = height + 20;
				document.getElementById("theSeller").height = height;
			}

			function displaySeller(somefile){
				var description = somefile;
				if(document.getElementById("click_arrow1").src == "http://csci571.com/hw/hw6/images/arrow_down.png"){
					document.getElementById("click_arrow_prompt1").innerHTML = "click to hide seller message";
					document.getElementById("click_arrow1").src = "http://csci571.com/hw/hw6/images/arrow_up.png";
					document.getElementById("sellerSrc").style.display = "none";
					document.getElementById("similarTable").innerHTML = "";
					document.getElementById("similarTable").style.display = "none";
					if(document.getElementById("noSimilar") != null){
						document.getElementById("noSimilar").style.display = "none";
					}
					document.getElementById("click_arrow2").src = "http://csci571.com/hw/hw6/images/arrow_down.png";
					document.getElementById("click_arrow_prompt2").innerHTML = "click to show similar items";
					if(description != ''){
						document.getElementById("sellerSrc").style.display = "inline";
						document.getElementById("theSeller").srcdoc = description;
						document.getElementById("theSeller").width = window.innerWidth;
						setTimeout(resizeIframe(), 1);
					}
					else{
						document.getElementById("sellerSrc").style.display = "inline";
						if(document.getElementById("theSeller") != null){
							document.getElementById("theSeller").style.display = "none";
						}
						var noDetailPropmt = '<div id ="noDetail">';
						noDetailPropmt += 'No Seller Message found.';
						noDetailPropmt += '</div>';
						document.getElementById("sellerSrc").innerHTML = noDetailPropmt;
					}
				}
				else if(document.getElementById("click_arrow1").src == "http://csci571.com/hw/hw6/images/arrow_up.png"){
					document.getElementById("click_arrow1").src = "http://csci571.com/hw/hw6/images/arrow_down.png";
					document.getElementById("sellerSrc").style.display = "none";
					if(document.getElementById("noDetail") != null || document.getElementById("noDetail") != undefined){
						document.getElementById("noDetail").style.display = "none";
					}
					document.getElementById("click_arrow_prompt1").innerHTML = "click to show seller message";
				}
			}

			function displayResult(certainJSON, itemsID){
				var judgmentID = itemsID;
				var y = document.getElementsByClassName("notEnable");
				if(document.getElementById("NearbySearch").checked == true){
					document.getElementsByClassName("defaultNotEnable")[0].style.opacity = 1.0;
					for(var i = 0;i < y.length; i++){
						y[i].disabled = false;
					}
					document.getElementById("zip_choice").disabled = false;
					document.getElementById("zip_here").disabled = false;
				}
				if(judgmentID == ""){
					thejsonObj = JSON.parse(certainJSON);
					var html_text = '';
					if(thejsonObj.findItemsAdvancedResponse[0].ack[0] == "Failure"){
						if(thejsonObj.findItemsAdvancedResponse[0].errorMessage[0].error[0].message[0] == "Invalid postal code for specified country."){
							html_text += '<div class="errors">';
							html_text += "Zipcode is invalid";
							html_text += '</div>';
						}
						else{
							html_text += '<div class="errors">';
							html_text += thejsonObj.findItemsAdvancedResponse[0].errorMessage[0].error[0].message[0];
							html_text += '</div>';
						}
					}
					else{
						if(thejsonObj.findItemsAdvancedResponse != undefined && thejsonObj.findItemsAdvancedResponse != null){
							if(thejsonObj.findItemsAdvancedResponse[0].searchResult[0].item == undefined || thejsonObj.findItemsAdvancedResponse[0].searchResult[0].item == null){
								html_text += "<div class = 'errors'>";
								html_text += "No Records has been found";
								html_text += "</div>";
							}
							else{
								var items = thejsonObj.findItemsAdvancedResponse[0].searchResult[0].item;
								html_text += '<div id = \'infoTable\'>';
								html_text += "<table border='2'>";
								html_text += '<tr>';
								html_text += '<th>';
								html_text += '<b>Index</b>';
								html_text += '</th>';
								html_text += '<th>';
								html_text += '<b>Photo</b>';
								html_text += '</th>';
								html_text += '<th>';
								html_text += '<b>Name</b>';
								html_text += '</th>';
								html_text += '<th>';
								html_text += '<b>Price</b>';
								html_text += '</th>';
								html_text += '<th>';
								html_text += '<b>Zip&nbspcode</b>';
								html_text += '</th>';
								html_text += '<th>';
								html_text += '<b>Condition</b>';
								html_text += '</th>';
								html_text += '<th>';
								html_text += '<b>Shipping&nbspOption</b>';
								html_text += '</th>';
								html_text +='</tr>';

								for(var i = 0; i < items.length;i++){
									var currIndex = i + 1;
									html_text += '<tr>';
									html_text += '<td>';
									html_text += currIndex;
									html_text += '</td>';
									html_text += '<td>';
									if(items[i].galleryURL != null && items[i].galleryURL != undefined){
										if(items[i].galleryURL[0] != null && items[i].galleryURL[0] != undefined){
											html_text += '<img src = "'
											html_text += items[i].galleryURL[0];
											html_text += '">';
										}
										else{
										html_text += 'N/A';
									}
									}
									else{
										html_text += 'N/A';
									}
									html_text += '</td>';
									html_text += '<td nowrap class="displayAsLink" onclick="searchDetail(';
									html_text += items[i].itemId[0];
									html_text += ');event.preventDefault();return false">';
									if(items[i].title != null && items[i].title != undefined){
										html_text += items[i].title;
									}
									else{
										html_text += 'N/A';
									}
									html_text += '</td>';
									html_text += '<td>';
									if(items[i].sellingStatus != null && items[i].sellingStatus != undefined){
										if(items[i].sellingStatus[0].currentPrice != null && items[i].sellingStatus[0].currentPrice != undefined){
											if(items[i].sellingStatus[0].currentPrice[0] != null && items[i].sellingStatus[0].currentPrice[0] != undefined){
												html_text += '\$';
												html_text += items[i].sellingStatus[0].currentPrice[0].__value__;
											}
											else{
												html_text += 'N/A';
											}
										}
										else{
											html_text += 'N/A';
										}
									}
									else{
											html_text += 'N/A';
									}
									html_text += '</td>';
									html_text += '<td>';
									if(items[i].postalCode != null && items[i].postalCode != undefined){
										html_text += items[i].postalCode[0];
									}
									else{
										html_text += 'N/A';
									}
									html_text += '</td>';
									html_text += '<td>';
									if(items[i].condition != null && items[i].condition != undefined){
										if(items[i].condition[0].conditionDisplayName != null && items[i].condition[0].conditionDisplayName != undefined){
											if(items[i].condition[0].conditionDisplayName[0] != null && items[i].condition[0].conditionDisplayName[0] != undefined){
												html_text += items[i].condition[0].conditionDisplayName[0];
											}
											else{
												html_text += 'N/A';
											}
										}
										else{
											html_text += 'N/A';	
										}
									}
									else{
											html_text += 'N/A';
									}
									html_text += '</td>';
									html_text += '<td>';
									if(items[i].shippingInfo != null && items[i].shippingInfo != undefined && items[i].shippingInfo[0] != null && items[i].shippingInfo[0] != undefined && items[i].shippingInfo[0].shippingType != null && items[i].shippingInfo[0].shippingType != undefined && items[i].shippingInfo[0].shippingType[0] != null && items[i].shippingInfo[0].shippingType[0] != undefined){
										if(items[i].shippingInfo[0].shippingType[0] == "Free"){
											html_text += "Free Shipping";
										}
										else{
											if(items[i].shippingInfo[0].shippingServiceCost != null && items[i].shippingInfo[0].shippingServiceCost != undefined){
												if(items[i].shippingInfo[0].shippingServiceCost[0].__value__ == "0.0"){
													html_text += "Free Shipping";
												}
												else{
													html_text += "$";
													html_text += items[i].shippingInfo[0].shippingServiceCost[0].__value__;
												}
											}
											else{
												html_text += items[i].shippingInfo[0].shippingType[0];
											}
										}
									}
									else{
										html_text += 'N/A';
									}
									html_text += '</td>';
									html_text += '</tr>';
								}
								html_text += '</table>';
								html_text += '</div>';
							}	
						}
					}
					document.write(html_text);
				}

				else{
					var theFile = <?php echo $detailFile?>;
					theSimilarFile = <?php echo $similarFile?>;

					function readDetailJSON(someFile1,someFile2){
						var detailObj = JSON.parse(someFile1);
						//var similarObj = JSON.parse(someFile2);
						var detail_text = '';
						if(detailObj.Item != null && detailObj.Item != undefined){
							var itemDetail = detailObj.Item; 
							detail_text += '<div id="details">';
							detail_text += "Item Details";
							detail_text += '</div>';
							detail_text += '<table id="detail_table" border="2">';
							detail_text += '<tr>';
							detail_text += '<th>';
							detail_text += 'photo';
							detail_text += '</th>';
							if(itemDetail.PictureURL != null && itemDetail.PictureURL != undefined && itemDetail.PictureURL[0] != undefined){
								detail_text += '<th>';
								detail_text += '<img id="detailImage" src="';
								detail_text += itemDetail.PictureURL[0];
								detail_text += '">';
								detail_text += '</th>';
							}
							else{
								detail_text += '<th>';
								detail_text += 'N/A';
								detail_text += '</th>';
							}
							detail_text += '</tr>';
							detail_text += '<tr>';
							detail_text += '<td>';
							detail_text += '<b>Title</b>';
							detail_text += '</td>';
							detail_text += '<td>';
							if(itemDetail.Title != null && itemDetail.Title != undefined){
								detail_text += itemDetail.Title ;
							}
							else{
								detail_text += 'N/A';
							}
							detail_text += '</td>';
							detail_text += '</tr>';
							if(itemDetail.Subtitle != null && itemDetail.Subtitle != undefined){
								detail_text += '<tr>';
								detail_text += '<td>';
								detail_text += '<b>Subtitle</b>';
								detail_text += '</td>';
								detail_text += '<td>';
								detail_text += itemDetail.Subtitle;
								detail_text += '</td>';
								detail_text += '</tr>';
							}	
							if(itemDetail.CurrentPrice != null && itemDetail.CurrentPrice != undefined && itemDetail.CurrentPrice.Value != undefined){
								detail_text += '<tr>';
								detail_text += '<td>';
								detail_text += '<b>Price</b>';
								detail_text += '</td>';
								detail_text += '<td>';
								detail_text += itemDetail.CurrentPrice.Value;
								detail_text += "USD";
								detail_text += '</td>';
								detail_text += '</tr>';								
							}				
							if(itemDetail.Location != null && itemDetail.Location != undefined){
								detail_text += '<tr>';
								detail_text += '<td>';
								detail_text += '<b>Location</b>';
								detail_text += '</td>';
								detail_text += '<td>';
								detail_text += itemDetail.Location;
								if(itemDetail.PostalCode != null && itemDetail.PostalCode != undefined){
									detail_text += ",";
									detail_text += itemDetail.PostalCode;
								}
								detail_text += '</td>';
								detail_text += '</tr>';
							}
							if(itemDetail.Seller != null && itemDetail.Seller != undefined && itemDetail.Seller.UserID != undefined){
								detail_text += '<tr>';
								detail_text += '<td>';
								detail_text += '<b>Seller</b>';
								detail_text += '</td>';
								detail_text += '<td>';
								detail_text += itemDetail.Seller.UserID;
								detail_text += '</td>';
								detail_text += '</tr>';
							}

							if(itemDetail.ReturnPolicy != null && itemDetail.ReturnPolicy != undefined && itemDetail.ReturnPolicy.ReturnsAccepted != undefined){
								detail_text += '<tr>';
								detail_text += '<td>';
								detail_text += '<b>Return Policy(US)</b>';
								detail_text += '</td>';
								detail_text += '<td>';
								detail_text += itemDetail.ReturnPolicy.ReturnsAccepted;
								detail_text += '</td>';
								detail_text += '</tr>';
							}

							if(itemDetail.ItemSpecifics != null && itemDetail.ItemSpecifics != undefined && itemDetail.ItemSpecifics.NameValueList != undefined){
								for(var i = 0; i < itemDetail.ItemSpecifics.NameValueList.length;i++){
									detail_text += '<tr>';
									detail_text += '<td>';
									detail_text += '<b>';
									detail_text += itemDetail.ItemSpecifics.NameValueList[i].Name;
									detail_text += '</b>';
									detail_text += '</td>';
									detail_text += '<td>';
									if(itemDetail.ItemSpecifics.NameValueList[i].Value[0] != null && itemDetail.ItemSpecifics.NameValueList[i].Value[0] != undefined){
										detail_text += itemDetail.ItemSpecifics.NameValueList[i].Value[0];
									}
									else{
										detail_text += 'N/A';
									}
									detail_text += '</td>';
									detail_text += '</tr>';
								}
							}
							detail_text += '</table>';
							detail_text += '<br>';
							detail_text += '<div id = "click_arrow_prompt1">';
							detail_text += 'click to show seller message';
							detail_text += '</div>';
							detail_text += '<img id = "click_arrow1" src="http://csci571.com/hw/hw6/images/arrow_down.png" onclick="displaySeller(';
							if(itemDetail.Description != null && itemDetail.Description != undefined){
								THE_DETAIL = itemDetail.Description;
							}
							else{
								THE_DETAIL = '';
							}
							detail_text += "THE_DETAIL";
							detail_text += ')">';
							detail_text += '<div id = "sellerSrc">';
							detail_text += '<iframe id = "theSeller" onload ="resizeIframe()">';
							detail_text += '</iframe>';
							detail_text += '</div>';
							detail_text += '<div id="click_arrow_prompt2">';
							detail_text += 'click to show similar items';
							detail_text += '</div>';
							detail_text += '<img id="click_arrow2" src="http://csci571.com/hw/hw6/images/arrow_down.png" onclick=showSimilar(';
							detail_text += itemDetail.ItemID;
							detail_text += ')>';
							detail_text += '</img>';
							detail_text += '<div id="similarTable">';
							detail_text += '</div>';
							detail_text += '<div id = "noSimilar">';
							detail_text += 'No Similar Item found.';
							detail_text += '</div>';
						}
						else if(detailObj.Ack == "Failure" && detailObj.Errors[0].ShortMessage != null && detailObj.Errors[0].ShortMessage != undefined){
							detail_text += '<div class = "errors">';
							detail_text += detailObj.Errors[0].ShortMessage;
							detail_text += '</div>';
						}
						document.write(detail_text);
					}
					readDetailJSON(theFile,theSimilarFile);
				}
			
				function writeCurrent(){
					THE_KEYWORD = "<?php echo $_POST['Keyword']?>";
					document.getElementById("kwinput").value = THE_KEYWORD;
					THE_CATEGORY = "<?php echo $_POST['Category']?>";
					document.getElementById("category").value = THE_CATEGORY;
					THE_CONDITION1 = "<?php echo $_POST['Condition1']?>";
					if(THE_CONDITION1 == "New"){
						document.getElementById("newcheck").checked = true;
					}
					THE_CONDITION2 = "<?php echo $_POST['Condition2']?>";
					if(THE_CONDITION2 == "Used"){
						document.getElementById("usedcheck").checked = true;
					}
					THE_CONDITION3 = "<?php echo $_POST['Condition3']?>";
					if(THE_CONDITION3 == "Unspecified"){
						document.getElementById("unspecheck").checked = true;
					}
					THE_SHIP1 = "<?php echo $_POST['Shipping1']?>";
					if(THE_SHIP1 == "localpick"){
						document.getElementById("localcheck").checked = true;
					}
					THE_SHIP2 = "<?php echo $_POST['Shipping2']?>";
					if(THE_SHIP2 == "freeship"){
						document.getElementById("freecheck").checked = true;
					}
					NEARBY_SEARCH = "<?php echo $_POST['nearby']?>";
					if(NEARBY_SEARCH == "enable"){
						document.getElementById("NearbySearch").checked = true;
					}
					else{
						document.getElementById("NearbySearch").checked = false;
					}
					HOW_FAR = "<?php echo $_POST['far']?>";
					if(HOW_FAR != ""){
						document.getElementById("dist").value = HOW_FAR;
					}
					THE_DIRECTION = "<?php echo $_POST['direction']?>";
					if(THE_DIRECTION == "here"){
						document.getElementById("zip_here").checked = true;
					}
					else if (THE_DIRECTION == "nothere"){
						document.getElementById("zip_choice").checked = true;
					}
					THE_ZIP = "<?php echo $_POST['zipcode']?>";
					if(THE_ZIP != ""){
						if(document.getElementById("zip_choice").checked == true){
							document.getElementById("zip").value = THE_ZIP;
						}
					}
					if(document.getElementById("NearbySearch").checked == true){
						document.getElementsByClassName("defaultNotEnable")[0].style.opacity = 1.0;
						for(var i = 0;i < y.length; i++){
							y[i].disabled = false;
						}
						document.getElementById("zip_choice").disabled = false;
						document.getElementById("zip_here").disabled = false;
					}
				}
				writeCurrent();
			}
			
		</script>
		<?php
			$count = 0;
			$conditionCount = 0;
			$searchURL = '';
			$searchURL .= 'http://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=YuncongX-mytest01-PRD-816de56dc-5fbeda8c&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&paginationInput.entriesPerPage=20&';
			if (isset($_POST['Keyword'])){
				$theKeyword = $_POST['Keyword'];
				$searchURL .= 'keywords=';
				$thiskeyword = str_replace(" ","+",$theKeyword);
				$searchURL .= $thiskeyword;
			}
			if (isset($_POST['Category'])){
				$theCategory = $_POST['Category'];
				if($theCategory == 'Art'){
					$searchURL .= '&categoryId=550';
				}
				elseif($theCategory== 'Baby'){
					$searchURL .= '&categoryId=2984';
				}
				elseif($theCategory== 'Books'){
					$searchURL .= '&categoryId=267';
				}
				elseif($theCategory == 'Clothing, Shoes & Accessories'){
					$searchURL .= '&categoryId=11450';
				}
				elseif($theCategory == 'Computers/Tablets & Networking'){
					$searchURL .= '&categoryId=58058';
				}
				elseif($theCategory== 'Health & Beauty'){
					$searchURL .= '&categoryId=26395';
				}
				elseif($theCategory == 'Music'){
					$searchURL .= '&categoryId=11233';
				}
				elseif($theCategory == 'Video Games & Consoles'){
					$searchURL .= '&categoryId=1249';
				}
				else{
				}	
			}

			if (isset($_POST['Condition1'])){
				$searchURL .= '&itemFilter[';
				$searchURL .= $count;
				$searchURL .='].name=Condition&itemFilter[';
				$searchURL .= $count;
				$searchURL .= '].value(';
				$searchURL .= $conditionCount;
				$searchURL .= ')=New';
				$conditionCount = $conditionCount + 1;
				if(isset($_POST['Condition2'])){
					$searchURL .='&itemFilter[';
					$searchURL .= $count;
					$searchURL .= '].value(';
					$searchURL .= $conditionCount;
					$searchURL .=')=Used';
					$conditionCount = $conditionCount + 1;
				}
				if(isset($_POST['Condition3'])){
					$searchURL .='&itemFilter[';
					$searchURL .= $count;
					$searchURL .= '].value(';
					$searchURL .= $conditionCount;
					$searchURL .=')=Unspecified';
					$conditionCount = $conditionCount + 1;
				}
					$count = $count + 1;
			}
			elseif(isset($_POST['Condition2'])){
				$searchURL .= '&itemFilter[';
				$searchURL .= $count;
				$searchURL .='].name=Condition&itemFilter[';
				$searchURL .= $count;
				$searchURL .= '].value(';
				$searchURL .= $conditionCount;
				$searchURL .= ')=Used';
				$conditionCount = $conditionCount + 1;
				if(isset($_POST['Condition1'])){
					$searchURL .='&itemFilter[';
					$searchURL .= $count;
					$searchURL .= '].value(';
					$searchURL .= $conditionCount;
					$searchURL .=')=New';
					$conditionCount = $conditionCount + 1;
				}
				if(isset($_POST['Condition3'])){
					$searchURL .='&itemFilter[';
					$searchURL .= $count;
					$searchURL .= '].value(';
					$searchURL .= $conditionCount;
					$searchURL .=')=Unspecified';
					$conditionCount = $conditionCount + 1;
				}
				$count = $count + 1;
			}
			elseif(isset($_POST['Condition3'])){
				$searchURL .= '&itemFilter[';
				$searchURL .= $count;
				$searchURL .= '].name=Condition&itemFilter[';
				$searchURL .= $count;
				$searchURL .= '].value(';
				$searchURL .= $conditionCount;
				$searchURL .= ')=Unspecified';
				$conditionCount = $conditionCount + 1;
				if(isset($_POST['Condition1'])){
					$searchURL .='&itemFilter[';
					$searchURL .= $count;
					$searchURL .= '].value(';
					$searchURL .= $conditionCount;
					$searchURL .=')=New';
					$conditionCount = $conditionCount + 1;
				}
				if(isset($_POST['Condition2'])){
					$searchURL .='&itemFilter[';
					$searchURL .= $count;
					$searchURL .= '].value(';
					$searchURL .= $conditionCount;
					$searchURL .=')=Used';
					$conditionCount = $conditionCount + 1;
				}
				$count = $count + 1;
			}
			
			if(isset($_POST['Shipping1'])){
				$searchURL .= '&itemFilter[';
				$searchURL .= $count;
				$searchURL .='].name=LocalPickupOnly&itemFilter[';
				$searchURL .= $count;
				$searchURL .='].value=true';
				$count = $count + 1;
			}
			if(isset($_POST['Shipping2'])){
				$searchURL .= '&itemFilter[';
				$searchURL .= $count;
				$searchURL .= '].name=FreeShippingOnly&itemFilter[';
				$searchURL .= $count;
				$searchURL .= '].value=true';
				$count = $count + 1;
			}
			$searchURL .= '&itemFilter[';
			$searchURL .= $count;
			$searchURL .= '].name=HideDuplicateItems&itemFilter[';
			$searchURL .= $count;
			$searchURL .= '].value=true';
			$count = $count + 1;

			if(isset($_POST['nearby'])){
				$theDirection = $_POST['direction'];
				$searchURL .= '&itemFilter[';
				$searchURL .= $count;
				$searchURL .='].name=MaxDistance&itemFilter[';
				$searchURL .= $count;
				$searchURL .='].value=';
				$searchURL .= $_POST['far'];
				if(isset($theDirection[0])){
					$searchURL .= '&buyerPostalCode=';
					$actualZipcode = str_replace(" ","",$_POST['zipcode']);
					$searchURL .= $actualZipcode;	
				}
				elseif(isset($theDirection[1])){
					$searchURL .= '&buyerPostalCode=';
					$actualZipcode = str_replace(" ","",$_POST['zipcode']);
					$searchURL .= $actualZipcode;
				}
			}	
			//echo $searchURL;
			$theContent = file_get_contents($searchURL);
			$theFile = json_encode($theContent);	
	    ?>	

	    <div class = "Whole_form">
			<span id = "Search_title">
				Product Search
			</span><br>
			<br>
			<form id = "myform" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
				<span><b>Keyword&nbsp</b><input id="kwinput" name="Keyword" type="text" value="" required></span><br>
				<div class = "space_created"></div>
				<span><b>Category&nbsp</b><select name="Category" id="category">
						<option>All Categories</option>
						<option>Art</option>
						<option>Baby</option>
						<option>Books</option>
						<option>Clothing, Shoes & Accessories</option>
						<option>Computers/Tablets & Networking</option>
						<option>Health & Beauty</option>
						<option>Music</option>
						<option>Video Games & Consoles</option>
					</select>
				</span>
				<div class = "space_created"></div>
				<span><b>Condition&nbsp&nbsp&nbsp</b>
					<input type="checkbox" name="Condition1" id="newcheck" value="New">New&nbsp&nbsp
					<input type="checkbox" name="Condition2" id="usedcheck" value="Used">Used&nbsp&nbsp
					<input type="checkbox" name="Condition3" id="unspecheck" value="Unspecified">Unspecified&nbsp&nbsp
				</span><br>
				<span><b>Shipping&nbspOptions&nbsp&nbsp&nbsp</b>
					<input type="checkbox" name="Shipping1" id="localcheck" value="localpick">Local&nbspPickup
					<input type="checkbox" name="Shipping2" id="freecheck" value="freeship">Free&nbspShipping
				</span><br>
				<div class = "space_created"></div>
				<span id="sameline">
					<input type="checkbox" id="NearbySearch" name="nearby" value="enable" onchange="testEnable()"><b>Enable Nearby Search&nbsp&nbsp&nbsp&nbsp</b>
					<div class="defaultNotEnable">
						<div class="direction_check">
							<input type="text" name="far" id="dist" size="7" required="number" class="notEnable" placeholder="10" value="10" disabled>
						</div>
						<b>miles&nbspfrom&nbsp</b>
						<div class="choice">
							<input type="radio" name = "direction" id="zip_here" value="here" disabled checked onchange="disableZip()">Here<br><input type="hidden" name = "zipcode" id="localzip">
							<input type="radio" name = "direction" id="zip_choice" value="nothere" disabled onchange="enableZip()"><input type="text" size="15" placeholder="zip code" id="zip" name="zipcode" required disabled>
						</div>
					</div>
				</div>
				</span>	
				<div class="form_button">
					<input type="submit" value="Search">
					<input type="reset" value="Clear" onclick="testDisable()">
				</div>
			</form>

			<script>
				theJSON = <?php echo $theFile;?>; 
				var itemsID = "<?php echo $theItemID;?>";
				if(theJSON != null && theJSON != undefined && theJSON !=''){
					displayResult(theJSON, itemsID);
				}
			</script>
			<div id='detailTable'>
			</div>
	</body>
</html>