<table style="width:700px; background-color: #f7f7f7; margin: 0 auto; font-family: sans-serif;">
  <tr>
    <th colspan="3" style="background-color:#1397DF; color:#ffffff; padding: 10px 20px;"><img style="width:120px;" src="https://prism-me.b-cdn.net/ezDigital/logo.png" /></th>
  </tr>
  <tr>
    <td colspan="3" style="padding: 15px 20px; font-weight: 600; text-align:left; border-bottom: 1px solid #e6e6e6 !important;"><p><img style="width:23px;position: absolute; margin: -5px 0px 0px;" src="https://prism-me.b-cdn.net/ezDigital/mdi_package-check.png" /> <strong style="padding-left: 30px;">Order Confirmed!</strong></p></td>
  </tr>
  <tr>
    <td colspan="3" style="paddigng: 20px;"><p>{{ $user['name']}}, </p> <p>With {{@$user['service'] }} {{@$user['plan']}} Plan for the {{ @$user['package']}}  activated successfully.</p>
	</td>
</tr>
  <tr>
	<td colspan="3" style="padding:0px 20px;">
	
		<table style="width:100%; background-color: #ffffff;  padding:20px; border-radius: 5px;">
		
			<tr>
			<td colspan="3" style="padding:15px; border-bottom: 1px solid #e6e6e6;"><strong>Package Detail</strong></td>
			</tr>
			
			<tr>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;">Item</td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;">Description</td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;">Total Price</td>
			</tr>
			
			<tr>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;"><img style="width:30px;" src="https://prism-me.b-cdn.net/ezDigital/seo.png" /></td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;"><strong>Service Name</strong></td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;">{{@$user['service']}}</td>
			</tr>
			<tr>
			<td style="padding:15px;"></td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;"><strong>Plan Name</strong></td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;">{{@$user['plan']}}</td>
			</tr>
			<tr>
			<td style="padding:15px;"></td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;"><strong>Package</strong></td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;">{{@$user['package']}}</td>
			</tr>
			
			<tr>
			<td style="padding:15px;"></td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;">Subtotal</td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;">{{@$user['sub_total']}}</td>
			</tr>
			
			<tr>
			<td style="padding:15px;"></td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;">GST{{ @$user['gst'] }}:</td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;">{{@$user['gst_total']}}</td>
			</tr>
			
			<tr>
			<td style="padding:15px;"></td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;">Total</td>
			<td style="padding:15px; border-bottom: 1px solid #e6e6e6;">{{@$user['total']}}</td>
			</tr>
		
		</table>
	</td>
  </tr>
  
 
  
  <tr>
	<td style="padding:15px;"><img style="width:150px;" src="https://prism-me.b-cdn.net/ezDigital/ezlogo.png" /></td>
	<td style="padding:15px; text-align:right;">
		<a href="https://www.facebook.com/PrismSocial"><img style="width:20px;height:20px;" src="https://prism-me.b-cdn.net/ezDigital/fb.png" /></a>
		<a href="https://www.linkedin.com/company/prismmarketing"><img style="width:20px;height:20px; margin:0px 10px;" src="https://prism-me.b-cdn.net/ezDigital/LinkedIn.png" /></a>
		<a href="https://www.instagram.com/prismsocial/"><img style="width:20px;height:20px;" src="https://prism-me.b-cdn.net/ezDigital/insta.png" /></a>
	</td>
  </tr>
  

</table>