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
	font-family:Verdana, Tahoma, Arial;
	color:#015571;
	text-decoration: underline;
	}
	
div#lodgix_property_description {
  margin-top:10px;
}

div#lodgix_property_description h2 {
  margin-bottom:10px;
  border-bottom:3px dotted #FF0000; 
  padding-bottom:5px;  
}

div#property_policies {
  margin-top:10px;
}



div#property_policies table {
  border:0px;
}

div#property_policies table tr td {
  border:0px;
}

div#lodgix_photo table {
  border:0px;
}

div#lodgix_photo table tr td {
  border:0px;
}

div#property_policies h2 {
  margin-bottom:10px;
  border-bottom:3px dotted #FF0000; 
  padding-bottom:5px;  
}

div#lodgix_property_booking {
  margin-top:10px;
}

div#lodgix_property_booking h2#booking {
  margin-bottom:10px;
  border-bottom:3px dotted #FF0000; 
  padding-bottom:5px;  
}

div#lodgix_property_location {
  margin-top:10px;
}

div#lodgix_property_location h2 {
  margin-bottom:20px;
  border-bottom:3px dotted #FF0000; 
  padding-bottom:5px;  
}

div#lodgix_photo {
  margin-top:10px;
}

div#lodgix_photo h2 {
  margin-bottom:10px;
  border-bottom:3px dotted #FF0000; 
  padding-bottom:5px;  
}


div#lodgix_property_details {
  margin-top:10px;
}

div#lodgix_property_details h2 {
  margin-bottom:10px;
  border-bottom:3px dotted #FF0000; 
  padding-bottom:5px;
}

div#lodgix_property_amenities {
  margin-top:10px;
  margin-bottom:20px;
  padding-bottom:20px;
}

div#lodgix_property_amenities h2 {
  margin-bottom:10px;
  border-bottom:3px dotted #FF0000; 
  padding-bottom:5px;
}

div#lodgix_property_rates {
  margin-top:10px;
}

div#lodgix_property_rates h2 {
  margin-bottom:10px;
  border-bottom:3px dotted #FF0000; 
  padding-bottom:5px;
}

div#lodgix_property_reviews {
  margin-top:20px;
}

div#lodgix_property_reviews h2 {
  margin-bottom:10px;
  border-bottom:3px dotted #FF0000; 
  padding-bottom:5px;
}

#content_lodgix {
  padding-right: 0px !important;
  margin-right: 5px !important;
  display: table;
}

#content_lodgix table {
  background-color:#FFFFFF;
  border-collapse: separate;
  border:0px;
  max-width:1024px;
}

#lodgix_listing table {
  width:100%;
  border:0px;
  padding: 0px;
}

#content_lodgix table tr td {
  border:0px;
  padding: 0;
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

.lodgix_description {
	padding-left: 6px;
	width:99%;
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
  font: 12px Verdana, sans-serif;
  text-align:justify;
  margin-top:8px;  
}

.lodgix_comments div {
  color: #353535;
  font: "Droid Sans","Lucida Grande",Tahoma,sans-serif;
  height: 110px;
  overflow: auto;
  margin: 2px;
  text-align: left;
  white-space: pre-wrap;
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
margin-bottom: 20px;
padding:0;
width:100%;
}
ul.amenities li {
background:url("__PLUGIN_FOLDER__images/tick.png") no-repeat scroll left center transparent;
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
width:100%;
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
	width: auto;
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


/********** SEARCH LISTINGS **************/

.lodgix-search-properties {
	width: auto;
}

.lodgix-search-properties .lodgix-custom-search-listing {
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

.lodgix-search-properties .lodgix-custom-search-listing input {
	background-color: #FFFFFF;
}

.lodgix-search-properties .lodgix-custom-search-listing #lodgix-custom-search-results {
  margin-top:5px;
  padding-top:5px;
	border-top: 1px dotted #666666;
	width:98%;
}


.lodgix_image_cell_icons {
   width:200px;
   margin-top:5px;
   text-align:center;
}

.lodgix_google_map_icon {
	float:left;
}
.lodgix_contact_us_icon {
	float:left;
}
.lodgix_details_icon {
	float:left;
}

.lodgix_availability_icon {
	float:left;
}


#lodgix_property_badge_border {
 background-color: #d7d7d7;
 padding:4px;
 -moz-border-radius: 10px;
 -webkit-border-radius: 10px;
 border-radius: 10px; 
}

.lodgix_nowrap {
	white-space: nowrap;
}

#lodgix_property_badge {
	background-color: #F0F7EE;
	height: auto;
#	margin: 0 auto 15px auto;
	padding-left: 20px;
	padding-right: 20px;
	padding-top: 10px;
	padding-bottom: 5px;
	
	border: 1px solid #d7d7d7;
	font-family:Verdana, Tahoma, Arial;
	font-weight:bold;
	
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
	border-radius: 8px;

}

#lodgix_property_badge hr {
	margin-top: 5px;
	margin-bottom: 5px;
	width:100%;
	height:1px;
}

#lodgix_property_badge table {
	border:0px;
	width:100%;
}

#lodgix_property_badge tr td {
	border:0px;
}

#lodgix_property_badge_title {
  vertical-align:top;
	color: #8DB339;
	font-size:16px;
	padding:0px;
	
}

#lodgix_property_badge_rooms {
	font-size:12px;
	color: #000000;
	
}

#lodgix_property_badge_rates {
  width:10px;
  white-space:nowrap;
  vertical-align:top; 
}

#lodgix_property_badge_icons_left {
 	text-align:left;
  height:50px;
  padding:0px;
}

#lodgix_property_badge_icons_right {
  width:10px;
  white-space:nowrap;
  height:50px;
  padding:0px;
}



/*
 * FancyBox - jQueryLodgix Plugin
 * Simple and fancy lightbox alternative
 *
 * Examples and documentation at: http:/fancybox.net
 * 
 * Copyright (c) 2008 - 2010 Janis Skarnelis
 * That said, it is hardly a one-person project. Many people have submitted bugs, code, and offered their advice freely. Their support is greatly appreciated.
 * 
 * Version: 1.3.4 (11/11/2010)
 * Requires: jQueryLodgix v1.3+
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http:/www.opensource.org/licenses/mit-license.php
 *   http:/www.gnu.org/licenses/gpl.html
*/


#fancybox-loading {
	position: fixed;
	top: 50%;
	left: 50%;
	width: 40px;
	height: 40px;
	margin-top: -20px;
	margin-left: -20px;
	cursor: pointer;
	overflow: hidden;
	z-index: 1104;
	display: none;
}

#fancybox-loading div {
	position: absolute;
	top: 0;
	left: 0;
	width: 40px;
	height: 480px;
	background-image: url("__PLUGIN_FOLDER__gallery/fancybox.png");
}

#fancybox-overlay {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	z-index: 1100;
	display: none;
}

#fancybox-tmp {
	padding: 0;
	margin: 0;
	border: 0;
	overflow: auto;
	display: none;
}

#fancybox-wrap {
	position: absolute;
	top: 0;
	left: 0;
	padding: 20px;
	z-index: 1101;
	outline: none;
	display: none;
}

#fancybox-outer {
	position: relative;
	width: 100%;
	height: 100%;
	background: #fff;
}

#fancybox-content {
	width: 0;
	height: 0;
	padding: 0;
	outline: none;
	position: relative;
	overflow: hidden;
	z-index: 1102;
	border: 0px solid #fff;
}

#fancybox-hide-sel-frame {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: transparent;
	z-index: 1101;
}

#fancybox-close {
	position: absolute;
	top: -15px;
	right: -15px;
	width: 30px;
	height: 30px;
	background: transparent url("__PLUGIN_FOLDER__gallery/fancybox.png") -40px 0px;
	cursor: pointer;
	z-index: 1103;
	display: none;
}

#fancybox-error {
	color: #444;
	font: normal 12px/20px Arial;
	padding: 14px;
	margin: 0;
}

#fancybox-img {
	width: 100%;
	height: 100%;
	padding: 0;
	margin: 0;
	border: none;
	outline: none;
	line-height: 0;
	vertical-align: top;
}

#fancybox-frame {
	width: 100%;
	height: 100%;
	border: none;
	display: block;
}

#fancybox-left, #fancybox-right {
	position: absolute;
	bottom: 0px;
	height: 100%;
	width: 35%;
	cursor: pointer;
	outline: none;
	background: transparent url("blank.gif");
	z-index: 1102;
	display: none;
}

#fancybox-left {
	left: 0px;
}

#fancybox-right {
	right: 0px;
}

#fancybox-left-ico, #fancybox-right-ico {
	position: absolute;
	top: 50%;
	left: -9999px;
	width: 30px;
	height: 30px;
	margin-top: -15px;
	cursor: pointer;
	z-index: 1102;
	display: block;
}

#fancybox-left-ico {
	background-image: url("__PLUGIN_FOLDER__gallery/fancybox.png");
	background-position: -40px -30px;
}

#fancybox-right-ico {
	background-image: url("__PLUGIN_FOLDER__gallery/fancybox.png");
	background-position: -40px -60px;
}

#fancybox-left:hover, #fancybox-right:hover {
	visibility: visible; /* IE6 */
}

#fancybox-left:hover span {
	left: 20px;
}

#fancybox-right:hover span {
	left: auto;
	right: 20px;
}

.fancybox-bg {
	position: absolute;
	padding: 0;
	margin: 0;
	border: 0;
	width: 20px;
	height: 20px;
	z-index: 1001;
}

#fancybox-bg-n {
	top: -20px;
	left: 0;
	width: 100%;
	background-image: url("__PLUGIN_FOLDER__gallery/fancybox-x.png");
}

#fancybox-bg-ne {
	top: -20px;
	right: -20px;
	background-image: url("__PLUGIN_FOLDER__gallery/fancybox.png");
	background-position: -40px -162px;
}

#fancybox-bg-e {
	top: 0;
	right: -20px;
	height: 100%;
	background-image: url("__PLUGIN_FOLDER__gallery/fancybox-y.png");
	background-position: -20px 0px;
}

#fancybox-bg-se {
	bottom: -20px;
	right: -20px;
	background-image: url("__PLUGIN_FOLDER__gallery/fancybox.png");
	background-position: -40px -182px; 
}

#fancybox-bg-s {
	bottom: -20px;
	left: 0;
	width: 100%;
	background-image: url("__PLUGIN_FOLDER__gallery/fancybox-x.png");
	background-position: 0px -20px;
}

#fancybox-bg-sw {
	bottom: -20px;
	left: -20px;
	background-image: url("__PLUGIN_FOLDER__gallery/fancybox.png");
	background-position: -40px -142px;
}

#fancybox-bg-w {
	top: 0;
	left: -20px;
	height: 100%;
	background-image: url("__PLUGIN_FOLDER__gallery/fancybox-y.png");
}

#fancybox-bg-nw {
	top: -20px;
	left: -20px;
	background-image: url("__PLUGIN_FOLDER__gallery/fancybox.png");
	background-position: -40px -122px;
}

#fancybox-title {
	font-family: Helvetica;
	font-size: 12px;
	z-index: 1102;
}

.fancybox-title-inside {
	padding-bottom: 10px;
	text-align: center;
	color: #333;
	background: #fff;
	position: relative;
}

.fancybox-title-outside {
	padding-top: 10px;
	color: #fff;
}

.fancybox-title-over {
	position: absolute;
	bottom: 0;
	left: 0;
	color: #FFF;
	text-align: left;
}

#fancybox-title-over {
	padding: 10px;
	background-image: url("__PLUGIN_FOLDER__gallery/fancy_title_over.png");
	display: block;
}

.fancybox-title-float {
	position: absolute;
	left: 0;
	bottom: -20px;
	height: 32px;
}

#fancybox-title-float-wrap {
	border: none;
	border-collapse: collapse;
	width: auto;
}

#fancybox-title-float-wrap td {
	border: none;
	white-space: nowrap;
}

#fancybox-title-float-left {
	padding: 0 0 0 15px;
	background: url("__PLUGIN_FOLDER__gallery/fancybox.png") -40px -90px no-repeat;
}

#fancybox-title-float-main {
	color: #FFF;
	line-height: 29px;
	font-weight: bold;
	padding: 0 0 3px 0;
	background: url("__PLUGIN_FOLDER__gallery/fancybox-x.png") 0px -40px;
}

#fancybox-title-float-right {
	padding: 0 0 0 15px;
	background: url("__PLUGIN_FOLDER__gallery/fancybox.png") -55px -90px no-repeat;
}

/* IE6 */

.fancybox-ie6 #fancybox-close { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_close.png", sizingMethod="scale"); }

.fancybox-ie6 #fancybox-left-ico { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_nav_left.png", sizingMethod="scale"); }
.fancybox-ie6 #fancybox-right-ico { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_nav_right.png", sizingMethod="scale"); }

.fancybox-ie6 #fancybox-title-over { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_title_over.png", sizingMethod="scale"); zoom: 1; }
.fancybox-ie6 #fancybox-title-float-left { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_title_left.png", sizingMethod="scale"); }
.fancybox-ie6 #fancybox-title-float-main { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_title_main.png", sizingMethod="scale"); }
.fancybox-ie6 #fancybox-title-float-right { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_title_right.png", sizingMethod="scale"); }

.fancybox-ie6 #fancybox-bg-w, .fancybox-ie6 #fancybox-bg-e, .fancybox-ie6 #fancybox-left, .fancybox-ie6 #fancybox-right, #fancybox-hide-sel-frame {
	height: expression(this.parentNode.clientHeight + "px");
}

#fancybox-loading.fancybox-ie6 {
	position: absolute; margin-top: 0;
	top: expression( (-20 + (document.documentElement.clientHeight ? document.documentElement.clientHeight/2 : document.body.clientHeight/2 ) + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop )) + "px");
}

#fancybox-loading.fancybox-ie6 div	{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_loading.png", sizingMethod="scale"); }

/* IE6, IE7, IE8 */

.fancybox-ie .fancybox-bg { background: transparent !important; }

.fancybox-ie #fancybox-bg-n { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_shadow_n.png", sizingMethod="scale"); }
.fancybox-ie #fancybox-bg-ne { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_shadow_ne.png", sizingMethod="scale"); }
.fancybox-ie #fancybox-bg-e { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_shadow_e.png", sizingMethod="scale"); }
.fancybox-ie #fancybox-bg-se { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_shadow_se.png", sizingMethod="scale"); }
.fancybox-ie #fancybox-bg-s { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_shadow_s.png", sizingMethod="scale"); }
.fancybox-ie #fancybox-bg-sw { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_shadow_sw.png", sizingMethod="scale"); }
.fancybox-ie #fancybox-bg-w { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_shadow_w.png", sizingMethod="scale"); }
.fancybox-ie #fancybox-bg-nw { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="__PLUGIN_FOLDER__gallery/fancy_shadow_nw.png", sizingMethod="scale"); }




.pikachoose{width: 660px; margin: 0 auto;}

.pika-image {position: relative; height: 480px; width: 640px; background: #fafafa; border: 1px solid #e5e5e5; padding: 10px;}
	/*position image holders */
	.pika-image .animation, .pika-image .main-image {position: absolute; top: 10px; left: 10px;}
	.pika-image .animation {display: none;z-index:2;}
	.pika-image img {border:0;width:640px;height:480px; }

.pika-image .caption {position: absolute; background: url(__PLUGIN_FOLDER__gallery/75-black.png);  border: 1px solid #141414; font-size: 11px; color: #fafafa; padding: 10px; text-align: right; bottom: 30px; right: 10px;}
	.pika-image .caption p {padding: 0; margin: 0; line-height: 14px;}

.pika-imgnav a {position: absolute; text-indent: -5000px; display: none;z-index:3;}
	.pika-imgnav a.previous {background: url(__PLUGIN_FOLDER__gallery/prev.png) no-repeat left 50%; height: 480px; width: 50px; top: 10px; left: 10px;cursor:pointer;}
	.pika-imgnav a.next {background: url(__PLUGIN_FOLDER__gallery/next.png) no-repeat right 50%; height: 480px; width: 50px; top: 10px; right: 10px;cursor:pointer;}
	.pika-imgnav a.play {background: url(__PLUGIN_FOLDER__gallery/play.png) no-repeat 50% 50%; height: 100px; width: 40px;top:0;left:50%;display: none;cursor:pointer;}
	.pika-imgnav a.pause {background: url(__PLUGIN_FOLDER__gallery/pause.png) no-repeat 50% 50%; height: 100px; width: 40px;top:0;left:50%;display:none;cursor:pointer;}

.pika-textnav {overflow: hidden; margin: 10px 0 0 0; display:none;}
.pika-textnav a {font-size: 12px; text-decoration: none; font-family:  helvetica, arial, sans-serif; color: #333; padding: 4px;}
		.pika-textnav a:hover {background: #e5e5e5; color: #0065B2;}
	.pika-textnav a.previous {float: left; width: auto; display: block;}
	.pika-textnav a.next {float: right; width: auto; display: block;}
	
.pika-thumbs {margin: 10px 0 0 0; padding: 0; overflow: hidden; }
	.pika-thumbs li {float: left; list-style-type: none; width: 82px; padding: 3px; margin: 0 2px; background: #fafafa; border: 1px solid #e5e5e5; cursor: pointer;}
		.pika-thumbs li:last {margin: 0;}
		.pika-thumbs li .clip {position:relative;width: 74px; height: 74px; text-align: center; vertical-align: center; overflow: hidden;}

.clip span{background-color:black;position:absolute;top:0px;left:5px;display:block;}
.pika-tooltip{font-size:12px;position:absolute;color:white;padding:3px; background-color: rgba(0,0,0,0.7);border:3px solid black;}

ul#pikame{width:660px;margin-bottom:10px;margin-top:10px;margin-left:10px;margin-right:10px;}




#cee_closeBtn 		{ background-image: url(__PLUGIN_FOLDER__images/cee-close-btn.png); }
#cee_next 			{ background-image: url(__PLUGIN_FOLDER__images/cee-next-btn.png); }
#cee_prev 			{ background-image: url(__PLUGIN_FOLDER__images/cee-prev-btn.png); }
* html #cee_next 	{ background-image: url(__PLUGIN_FOLDER__images/cee-next-btn.gif); } /* IE6 hack */
* html #cee_prev 	{ background-image: url(__PLUGIN_FOLDER__images/cee-prev-btn.gif); } /* IE6 hack */
#cee_load 			{ background-image: url(__PLUGIN_FOLDER__images/loader.gif);}
/* ceebox border width controled as option in jquery.ceebox.js */
/* colors for ceebox background and border can also be set as option in jquery.ceebox.js  */
#cee_box			{background-color: #fff;border-color:#525252;border-style: solid; -moz-border-radius: 7px; -webkit-border-radius: 7px; border-radius: 7px; }



#cee_box {
	font: 12px Arial, Helvetica, sans-serif;
	color: #333333;
	background-color: #fff;
}

#cee_count {
	font: 10px Arial, Helvetica, sans-serif;
	-moz-opacity: 0.8;
	opacity: 0.8;/* opacity used to reduce contrast of font color so that any main color will work */
	clear:left;
	float:left;
	padding: 2px 0 4px;
}
.cee_html #cee_title h2 {float:left;}
.cee_html #cee_count {clear:none;padding-left:5px;}
* html #cee_count { /* ie6 hack */
	zoom:1;
	padding-bottom:6px;
}
#cee_next,#cee_prev{
	height:100%;
	width: 49%;
	text-indent:-10000px;
	text-decoration:none;
	visibility:visible;
	background-repeat:no-repeat;
}

#cee_box a {border:0;outline:none}
#cee_box a:link {color: #666;}
#cee_box a:visited {color: #666;}
#cee_box a:hover {color: #000;}
#cee_box a:active {color: #666;}
#cee_box a:focus{color: #666;}
#cee_closeBtn {
	background-repeat: no-repeat;
	display:box;
	width:24px;
	height:23px;
	position:absolute;
	text-indent:-10000px;
}

#cee_closeBtn {top:-3px;right:-3px;} /* base value only here for IE8 */
#cee_closeBtn, #ie8#hack {top:-10px;right:-10px;} /* All browsers except IE8 see this; IE8 keeps using the */
*:first-child+html #cee_closeBtn{top:-3px;right:-3px;} /* only IE7 sees this*/ 
* html #cee_closeBtn{top:-3px;right:-3px;} /*only IE 6 sees this*/

#cee_closeBtn:hover {
	background-position: 0px -23px;
	}
	
.cee_close {cursor:pointer}

#cee_box {
	text-align:left;
	color:#000;
}

#cee_box img#cee_img, #cee_vid,#cee_iframeContent,#cee_ajax {
	display:block;
	margin: 15px 15px 0;
	border-right: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	border-top: 1px solid #666;
	border-left: 1px solid #666;
}

#cee_title {
	padding:7px 15px 5px 15px;
	overflow:hidden;
}
.cee_html #cee_title{
	background-color:#e8e8e8;
	height:18px;
	-moz-border-radius: 7px 7px 0 0;
	-webkit-border-radius: 7px 7px 0 0;
	border-radius: 7px 7px 0 0;
}
#cee_title h2 {
	font-size:1em;
	font-weight:400;
	margin:0 0 1px;
}

#cee_ajax{
	clear:both;
	padding:2px 15px 15px 15px;
	overflow:auto;
	text-align:left;
	line-height:1.4em;
}

#cee_load{
	display:none;
	height:50px;
	width:50px;
	margin: -25px 0 0 -25px; /* -height/2 0 0 -width/2 */
	background-position: center center;
	background-repeat:no-repeat;
}

#cee_HideSelect{
	z-index:99;
	position:fixed;
	top: 0;
	left: 0;
	background-color:#fff;
	border:none;
	filter:alpha(opacity=0);
	-moz-opacity: 0;
	opacity: 0;
	height:100%;
	width:100%;
}


#cee_iframe{
	clear:both;
	border:none;
	margin-bottom:-1px;
	margin-top:1px;
}


/* TABBED */


#lodgix_tabbed_content {
    clear: both;
    width: 100%;
    font-family: arial, sans-serif;
    color: #575757;
    font-size: 10pt;
    padding-bottom: 15px;
    margin-bottom: 15px;
}

.lodgix_tabbed_amenities {
  list-style: circle outside none;
  height: auto;
  width:100%;
}
.lodgix_tabbed_amenities li {
  list-style: circle outside none;
  white-space: nowrap;
  width: 160px;  
}

#lodgix_tabbed_content h2 {
  color: #004185;
	font-size: 13pt;
	font-family: arial,sans-serif;
	margin: 1em 0 0.588em;
}

.lodgix_tabbed_headline_area {
    margin: 5px 5px;
}

.lodgix_tabbed_headline_areaRight {
    /*float: right;
    text-align: right;
    width: 300px;*/
}






.lodgix_tabbed_headline_area h1 {
    font-size: 14pt;
    color: #d73c38;
    margin: 0;
}
.lodgix_tabbed_detailHeader {
    overflow: auto;
}
.lodgix_tabbed_detailHeaderLeft {
    width: 400px;
    float: left;
}
.lodgix_tabbed_lodgix-sleep-icons {
    margin: 0 0 5px 0;
    position: relative;
}
.lodgix_tabbed_detailHeaderRight {
    width: 300px;
    float: right;
    text-align: right;
}

.lodgix_tabbed_detailPhotos {
    float: right;
    width: 400px;
    border: 10px solid #fff;
    -webkit-box-shadow: 0px 1px 5px 0px #4a4a4a;
    -moz-box-shadow: 0px 1px 5px 0px #4a4a4a;
    box-shadow: 0px 1px 5px 0px #4a4a4a;
    margin: 10px 0 15px 30px;
}
.lodgix_tabbed_clearFix {
    clear: both;
}

#lodgix_tabbed_map_canvas { 
    margin: 0 auto;
}
.lodgix_tabbed_locationText {
    margin: 25px;
}







';

$content = str_replace('__PLUGIN_FOLDER__',$url,$content);

echo $content;


?>
