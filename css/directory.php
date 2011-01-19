<?php

$url = str_replace('css/directory.php','',$_SERVER['PHP_SELF']);

header('Content-type: text/css');

$content = '



div#content_lodgix {
	margin: 0 auto;
	margin-left:0px;
	margin-right:12px;
	min-height:530px !important; height:auto;
	color:#000000;
	font-family: Verdana, Tahoma, Arial;
	font:Tahoma, Verdana, Arial;
	font-size:11px;
	#background-color:#FFFFFF;
	#border-bottom:1px solid #fff;
	width:100%;
}
div#content_lodgix h1{
	font-size:12px;
	font-weight:bold;
	margin-top:0px;
	padding-top:5px;
	margin-bottom:5px;
	text-transform:uppercase;
	text-align:center;
	}
div#content_lodgix h3 {
	font-size:12px;
	font-weight:bold;
	margin-top:0px;
	padding-top:5px;
	margin-bottom:5px;
	text-transform:uppercase;
	text-align:left;
	}	
div#content_lodgix a{	
	font-family:Verdana, Tahoma, Arial;
	color:#bc4339;
	text-decoration: underline;
	}
div#content_lodgix a:hover{	
	font-family:"Droid Serif",Calibri,"Times New Roman",serif;
	color:#015571;
	text-decoration: underline;
	}
	
div#lodgix_property_description {
  margin-top:10px;
}

div#lodgix_property_description h2 {
  margin-bottom:10px;
}

div#lodgix_property_details {
  margin-top:10px;
}

div#lodgix_property_details h2 {
  margin-bottom:10px;
}

#content_lodgix {
  padding-right: 0px !important;
  margin-right: 5px !important;
  display: table;
}

#content_lodgix table {
  background-color:#FFFFFF;
  border-collapse: separate;
}

#lodgix_listing table {
  width:100%;
}

.lodgix_border_top {
  background: url("__PLUGIN_FOLDER__images/decor/bord-top.gif") repeat-x bottom;
}

.lodgix_border_top div {
  height: 11px;
}

.lodgix_border_top_left {
  background: url("__PLUGIN_FOLDER__images/decor/bord-top-left.gif") no-repeat bottom right;
}

.lodgix_border_top_left div {
  width: 13px;
  height: 11px;
}

.lodgix_border_top_right {
  background: url("__PLUGIN_FOLDER__images/decor/bord-top-right.gif") no-repeat bottom left;
}

.lodgix_border_top_right div {
  width: 15px;
  height: 11px;
}

.lodgix_border_bot {
  background: url("__PLUGIN_FOLDER__images/decor/bord-bot.gif") repeat-x top;
}

.lodgix_border_bot div {
  height: 17px;
}

.lodgix_border_bot_left {
  background: url("__PLUGIN_FOLDER__images/decor/bord-bot-left.gif") no-repeat top right;
}

.lodgix_border_bot_right div {
  width: 13px;
  height: 17px;
}

.lodgix_border_bot_right {
  background: url("__PLUGIN_FOLDER__images/decor/bord-bot-right.gif") no-repeat top left;
}

.lodgix_border_bot_right div {
  width: 15px;
  height: 17px;
}

.lodgix_border_left {
  background: url("__PLUGIN_FOLDER__images/decor/bord-left.gif") repeat-y right;
}

.lodgix_border_right {
  background: url("__PLUGIN_FOLDER__images/decor/bord-right.gif") repeat-y left;
}


.lodgix_image_cell {
  vertical-align: top;
  padding: 0px 7px 7px 0px;
}

.lodgix_image_cell div {
  width: 200px;
}

.lodgix_description_cell {
  vertical-align: top;
  font: 12px Verdana, sans-serif;
}

.lodgix_description, .lodgix_name, .lodgix_comments {
width: 100%;
}

.lodgix_name, .lodgix_address {
  background: #eee;
}

.lodgix_name a, .lodgix_name a:link, .lodgix_name a:visited, .lodgix_name a:hover {
  font: bold 18px Verdana, sans-serif !important;
  font-family:Verdana, Tahoma, Arial;
	color:#9f1314;
	text-decoration: underline;  
}


.lodgix_comments {
  color: #666;
  font: 10px Verdana, sans-serif;
}

.lodgix_comments div {
  color: #353535;
  font: "Droid Sans","Lucida Grande",Tahoma,sans-serif;
  height: 110px;
  overflow: auto;
  margin: 2px;
  text-align: left;
}

div#lodgix_sort_div { 
  margin-left:15px;
  margin-bottom:15px;
}

table.lodgix_property_features {
clear:both;
float:left;
font:11px/13px normal,Verdana,Tahoma sans-serif;
border-spacing: 2px;
width:100%;
}
table.lodgix_property_features tr td.lodgix_gray_box {
background:none repeat scroll 0 0 #EBEBEB;
height:33px;
text-align:center;
vertical-align:middle;
min-width:92px;
}
table.lodgix_property_features tr td.lodgix_gray_lower, table.lodgix_property_features tr th.lodgix_gray_lower {
background:none repeat scroll 0 0 #DDDDDD;
height:33px;
text-align:center;
vertical-align:middle;
min-width:90px;
border: 0 none;
}
table.lodgix_property_features tr td.lodgix_gray_medium, table.lodgix_property_features tr th.lodgix_gray_medium {
background:none repeat scroll 0 0 #CFCFCF;
height:33px;
text-align:center;
vertical-align:middle;
min-width:90px;
border: 0 none;
}
table.lodgix_property_features tr td.lodgix_gray_highest, table.lodgix_property_features tr th.lodgix_gray_highest {
background:none repeat scroll 0 0 #C2C2C2;
height:33px;
text-align:center;
vertical-align:middle;
min-width:90px;
border: 0 none;
}
div.lodgix_bedroom1 {
background:url("__PLUGIN_FOLDER__images/bedroom1_list.gif") no-repeat scroll center center transparent;
height:27px;
min-width:90px;
}
div.lodgix_bedroom2 {
background:url("__PLUGIN_FOLDER__images/bedroom2_list.gif") no-repeat scroll center center transparent;
height:27px;
min-width:90px;
}
div.lodgix_bedroom3 {
background:url("__PLUGIN_FOLDER__images/bedroom3_list.gif") no-repeat scroll center center transparent;
height:27px;
min-width:90px;
}
div.lodgix_bedroom4 {
background:url("__PLUGIN_FOLDER__images/bedroom4_list.gif") no-repeat scroll center center transparent;
height:27px;
min-width:90px;
}
div.lodgix_bedroom5 {
background:url("__PLUGIN_FOLDER__images/bedroom5_list.gif") no-repeat scroll center center transparent;
height:30px;
width:90px;
}
div.lodgix_pets_friendly_no {
background:url("__PLUGIN_FOLDER__images/pets_friendly_no.gif") no-repeat scroll center center transparent;
height:25px;
min-width:90px;
}
div.lodgix_pets_friendly_yes {
background:url("__PLUGIN_FOLDER__images/pets_friendly_yes.gif") no-repeat scroll center center transparent;
height:25px;
}

ul.amenities {
float:left;
margin-left:0;
margin-bottom: 10px;
padding:0;
width:100%;
}
ul.amenities li {
background:url("__PLUGIN_FOLDER__images/tick.gif") no-repeat scroll left center transparent;
float:left;
font-size:11px;
line-height:16px;
list-style-type:none;
margin-bottom:5px;
margin-right:5px;
text-indent:15px;
width:160px;
white-space: nowrap;
}

div.lodgix_rentalrates {
float:left;
margin:0 auto;
padding:0;
width:100%;
}
div.lodgix_rentalrates table { 
border-collapse: collapse; 
margin-top: 10px;
margin-bottom: 10px;
}
div.lodgix_rentalrates td, th 
{ 
padding: .3em;
border-style:solid;
border-width:1px;
border-color:#A4CE4B;
}
div.lodgix_rentalrates td.lodgix_policies
{ 
border-style:none;
border-left:1px solid #A4CE4B;
border-right:1px solid #A4CE4B;
}
div.lodgix_rentalrates td.lodgix_policies_bottom
{ 
border-style:none;
border-left:1px solid #A4CE4B;
border-right:1px solid #A4CE4B;
border-bottom:1px solid #A4CE4B;
}
div.lodgix_rentalrates thead { 
background: #A4CE4B; 
}
div.lodgix_rentalrates tbody { 
background: #FFFFFF; 
} 

div.lodgix_rentalrates td.lodgix_policies span p {
margin-bottom:0px;
}

table.lodgix_gallery {

}
table.lodgix_gallery tr td {
padding-top:7px;
text-align:center;
width:289px;
}
table.lodgix_gallery tr td a img {
border:0 none;
}

	box-shadow: 3px 3px 5px #999;
}

/********** FEATURED LISTINGS **************/

.lodgix-featured-properties {
	width: 210px;
  margin-left: 21px;
}

.lodgix-featured-properties .lodgix-featured-listing {
	width: 210px;
	background-color: #E8E8E8;
	background-image: url("__PLUGIN_FOLDER__images/feat-bg.png");
	background-repeat: repeat-x;
	border: 1px solid #E0E0E0;
	padding: 10px;
	margin-bottom:15px;
	-moz-box-shadow: 3px 3px 5px #999;
	-webkit-box-shadow: 3px 3px 5px #999;
	box-shadow: 3px 3px 5px #999;
	line-height:normal;
	FILTER: progid:DXImageTransform.Microsoft.Shadow(color="#969696", Direction=135, Strength=3); BACKGROUND-COLOR: #fff; ZOOM: 1
}
.lodgix-featured-properties .lodgix-featured-listing .imgset {
	position:relative;
}
.lodgix-featured-properties .lodgix-featured-listing .imgset img {
	height: 138px;
  width: 210px;	
	border: 1px solid #BDBDBD;
}
.lodgix-featured-properties .lodgix-featured-listing .imgset .featured-flag {
	position: absolute;
	left: 0px;
	top: 0px;
	height: 61px;
	width: 61px;
	border:none;
}
.lodgix-featured-properties .lodgix-featured-listing .address-link {
	display:block;
	text-decoration:none;
	font-weight:bold;
	padding: 4px 0;
	margin-bottom: 4px;
	border-bottom-width: 1px;
	border-bottom-style: dotted;
	border-bottom-color: #666;
}
.lodgix-featured-properties .lodgix-featured-listing .featured-details {
}
.lodgix-featured-properties .lodgix-featured-listing .featured-details span {
	display: block;
	padding-top:4px;
}
';

$content = str_replace('__PLUGIN_FOLDER__',$url,$content);

echo $content;


?>
