<?php
/*
*
* $Id$
--------------------------------------------------------------------------------------------------------------------------
* Information contained in this file is the intellectual property of Ladbrokes Plc
* Copyright � 2012 MarryDorr. All Rights Reserved.
* ---------------------------------------------------------------------------------------------------------------------------
*
* @author  Ageesh K Gopinath
* @title printCoupon.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>


<div id="main-content">
<form name="coupons" method="post" action="printCoupon">
<table width="450px">

 
<tr>
 <td valign="top"">
  <label for="startDate">Start Date*</label>
 </td>
 <td valign="top">
  <input  type="text" id="datepicker" name="startDate" readonly="true"  size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="endDate">End Date*</label>
 </td>
 <td valign="top">
  <input  type="text" id="datepicker1"  name="endDate" readonly="true" maxlength="80" size="30">
 </td>
 
</tr>

<tr>
 <td colspan="2" style="text-align:center">
  <input type="submit" value="Generate CSV">
 </td>
</tr>
</table>
</form>

</div>

<script>
$(function() {
	$( "#datepicker" ).datepicker(
			{
				inline: true,
				dateFormat: 'yy-m-d'
				
			});
	
	$( "#datepicker1" ).datepicker(
			{
				inline: true,
				dateFormat: 'yy-m-d'
			});
	//hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); },
		function() { $(this).removeClass('ui-state-hover'); }
	);
});
</script>
