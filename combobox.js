// JavaScript Document
<!--
// Copyright 1998, InsideDHTML.com, LLC. All rights reserved
// This script can be reproduced as long as the above copyright
// notice is maintained.

function doSelectChange(el,dest) {
  dest.value = el.options[el.selectedIndex].text
}

function lookupItem(el,dest) {
  if (!isDHTML) {
	el.blur(); el.focus()
  }
  var curValue = el.value.toLowerCase()
  var found = false
  var index = dest.selectedIndex
  var numOptions = dest.options.length
  var pos = 0
  while ((!found) && (pos < numOptions)) {
	found = (dest.options[pos].text.toLowerCase().indexOf(curValue)==0) 
	if (found) 
	  index = pos
	pos++
  }
  if (found)
	dest.selectedIndex = index
  if (!isDHTML) 
	el._v = setTimeout("lookupItem(document.lForm.textInput, document.lForm.pcode)",500)
}

function goValue(el) {
  var where
  if (el.selectedIndex>-1) {
	where = el.options[el.selectedIndex].value
	window.open(where,"")
  }
}

var ie4 = (document.all)
var ns4 = (document.layers)
var isDHTML = ie4 || ns4
// -->