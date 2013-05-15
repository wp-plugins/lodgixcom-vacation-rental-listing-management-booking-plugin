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
}

.ldgxShadow {
	margin: 5px 10px 10px 5px;
	padding: 5px;
	border: 1px solid #eee;
	-moz-box-shadow: 0 0 8px 2px #ccc;
	-webkit-box-shadow: 0 0 8px 2px #ccc;
	box-shadow: 2px 2px 8px 0 #666;
}

.ldgxListingImg {
	float: left;
	margin-right: 7px;
}

.ldgxListingName {
	padding-left: 7px;
	background: #eee;
}

.ldgxListingName a {
	font: bold 18px Verdana, sans-serif;
	color: #9f1314;
	text-decoration: underline;
	white-space: nowrap;
}

.ldgxListingBody {
	background: #f7f7f7;
	font: 12px Verdana, sans-serif;
}

.ldgxListingWarn {
	margin-top: 14px;
	text-align: justify;
	color: #666;
}

.ldgxListingDesc {
	font: 14px "Maven Pro", sans-serif;
	color: #5f5e5e;
}

.lodgixTextExpanderWrapper {
	padding: 7px;
	min-height: 114px;
}

.lodgixTextExpander {
	padding: 4px;
	width: 20px;
	height: 20px;
	color: #960;
	font: bold 14px Arial, sans-serif;
	line-height: 2;
	text-align: right;
	cursor: pointer;
}

.lodgixTextExpanderShadow {
	border-top: 14px solid transparent;
	border-right: 14px solid #9cf;
	border-bottom: 14px solid #9cf;
	border-left: 14px solid transparent;
}

.ldgxListingSeparator {
	clear: both;
}

.ldgxListingFeatCell {
	margin: 2px 1px;
	height: 33px;
	line-height: 33px;
	padding: 0 2px;
	background: #ebebeb;
	text-align: center;
	vertical-align: middle;
	font-family: "Maven Pro", sans-serif;
	font-size: 12px;
	color: #5f5e5e;
	white-space: nowrap;
}

.ldgxListingFeatDaily {
	background: #ddd;
}

.ldgxListingFeatWeekly {
	background: #cfcfcf;
}

.ldgxListingFeatMonthly {
	background: #c2c2c2;
}

.ldgxPetsNo {
	background:url("__PLUGIN_FOLDER__images/pets_friendly_no.gif") no-repeat scroll center center transparent;
	height: 33px;
}

.ldgxPetsYes {
	background:url("__PLUGIN_FOLDER__images/pets_friendly_yes.gif") no-repeat scroll center center transparent;
	height: 33px;
}

.ldgxListingButs {
	text-align: center;
}

.ldgxListingButsBlock1 {
	display: inline;
	margin: 0 20px;
}

.ldgxListingButsBlock2 {
	display: inline;
	white-space: nowrap;
}

.ldgxListingButs a {
	display: inline-block;
	margin: 7px 5px 3px 5px;
}










.ldgxPowered {
	margin: 20px 0;
	text-align: center;
	font-size: 10px;
}








#content_lodgix table {
  background-color:#FFFFFF;
  border-collapse: separate;
  border:0px;
  max-width:1024px;
  width:100%;
}

#content_lodgix table tr td {
  border:0px;
  padding: 0;
}

div#lodgix_sort_div { 
  margin-left:15px;
  margin-bottom:15px;
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
	background: #E8E8E8 url(__PLUGIN_FOLDER__images/feat-bg.png) repeat-x;
	border: 1px solid #E0E0E0;
	padding: 10px;
	margin-bottom:15px;
	-moz-box-shadow: 3px 3px 5px #999;
	-webkit-box-shadow: 3px 3px 5px #999;
	box-shadow: 3px 3px 5px #999;
	FILTER: progid:DXImageTransform.Microsoft.Shadow(color="#969696", Direction=135, Strength=3); ZOOM: 1
}

.lodgix-search-properties .lodgix-custom-search-listing tr {
	background: transparent;
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

.lodgix-custom-search-listing tr, .lodgix-custom-search-listing th, .lodgix-custom-search-listing td {
	padding:0;
}

.lodgix-custom-search-listing input[readonly] {
	cursor:default;
}

.lodgix-custom-search-amenities-list {
	margin-bottom:8px;
}

.lodgix-search-properties .lodgix-custom-search-listing .lodgix-custom-search-amenities {
	margin:0;
	vertical-align:baseline;
}

#lodgix-custom-search-button {
		background: none repeat scroll 0 0 #666666 !important;
    border: medium none !important;
    border-radius: 2px 2px 2px 2px;
    color: #FFFFFF;
    font-family: Arial,Tahoma,Verdana;
    font-size: 12px !important;
    font-weight: bold !important;
    margin: 0;
    padding: 5px 7px !important;
    text-decoration: none;
    text-transform: none;
    width: auto !important;
}

#lodgix-custom-search-button:hover {
		background: none repeat scroll 0 0 #000000 !important;
    border: medium none;
    color: #FFFFFF;
    cursor: pointer;
    text-decoration: none;
}

.lodgix-datepicker-trigger {
		
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


.ldgxPropBadge {
	margin-bottom: 20px;
	border: 1px solid #d7d7d7;
	padding: 10px 20px 5px 20px;
	background: #F0F7FF;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
	border-radius: 8px;
}

.ldgxPropBadgeSingle {
	background: #F0F7EE;
}

.ldgxPropBadgeLine {
	background: #fafafa;
}

.ldgxPropBadgeTitle {
	float: left;
	font-size: 16px;
	color: #004185;
}

.ldgxPropBadgeSingle .ldgxPropBadgeTitle {
	color: #8DB339;
}

.ldgxPropBadgeRooms {
	font-size: 12px;
	color: #000;
}

.ldgxPropBadgeRates {
	float: right;
	white-space: nowrap;
}

@media only screen and (max-width: 640px) {

	.ldgxPropBadgeTitle, .ldgxPropBadgeRates {
		float: none;
	}

}

.ldgxPropBadgeIconsLeft {
	float: left;
}

.ldgxPropBadgeIconsRight {
	float: right;
	white-space: nowrap;
}

.ldgxPropBadgeSeparator {
	clear: both;
}

.ldgxPropBadge hr {
	margin: 5px 0;
	height:1px;
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

.ldgxTabs {
	display: none;
}

.ldgxMobileTab {
	clear: both;
	margin: 5px;
	border: 1px solid #99B3CE;
	border-radius: 6px;
	padding: 0.8em 1.6em;
	background: #E5ECF3;
	color: #004185;
	font-size: 16px;
	font-weight: bold;
}

@media only screen and (min-width: 40em) {

	.ldgxTabs {
		display: block;
	}

	.ldgxMobileTab {
		display: none;
	}

}


#lodgix_tabbed_content {
    clear: both;
    font-family: arial, sans-serif;
    color: #575757;
    font-size: 10pt;
    padding-bottom: 15px;
    margin-bottom: 15px;
}


.lodgix_tabbed_amenities {
  list-style: circle outside none;
  height: 350px;
  width:100%;
}
.lodgix_tabbed_amenities li {
  list-style: circle outside none;
  white-space: nowrap;
  width: 170px;  
  float:left;
}

#lodgix_tabbed_content h2 {
  color: #575757;
	font-size: 13pt;
	font-family: arial,sans-serif;
	margin: 1em 0 0.588em;
	border-bottom: 0 none;
}

#lodgix_tabbed_content h2#booking{
	border-bottom: 0 none;	
}

.lodgix_tabbed_headline_area {
    margin: 5px 5px;
    height:30px;
}

.lodgix_tabbed_headline_area {
  
}
.lodgix_tabbed_headline_areaLeft {
    width: 400px;
    float: left;
}
.lodgix_tabbed_headline_areaRight {
    float: right;
    text-align: right;
}

.lodgix_tabbed_headline_area h1 {
		font-family: arial,sans-serif;
    font-size: 14pt;
    color: #d73c38;
    margin: 0;
}

.lodgix_tabbed_headline_text h1
{
 color: #575757;
 font-family: arial,sans-serif;
}













#lodgix-image-gallery {
    background: none repeat scroll 0 0 #F5F5F5;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

#lodgix-image-gallery.royalSlider .royalControlNavOverflow a.royalThumb {
  background-size: 100px 75px;
}

#lodgix-image-gallery .royalCaption {
	position: absolute;
    left: 50%;
    bottom: 5%;
    margin-left: -185px;
    width: 370px;
    background-color: grey;
	color: #fff;
    font-weight: bold;
    text-align: center;
    opacity: 0.8;
    overflow: hidden;
}


';

$content = str_replace('__PLUGIN_FOLDER__',$url,$content);

echo $content;


?>
