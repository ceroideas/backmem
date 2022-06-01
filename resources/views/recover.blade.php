<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Eliteadmin Responsive web app kit</title>
</head>
<body style="margin:0px; background: #f8f8f8;">
	<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
	  	<div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px;">
	  		<div style="border: solid 1px #999;border-top: solid 1px transparent">
			    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
			      	<tbody>
			          	<tr>
			          		<td style="background-color: #fff">
			          			<img src="{{url('/logo-mem.jpg')}}" style="width: 400px;">
			          		</td>
			        	</tr>
			        	<tr>
			          		<td style="background:#333; padding:5px; color:#fff; text-align:left;">
			          			<h4 style="font-weight: normal; text-align: center;">
			          				¡Hola <b>{{ $u->name }}</b>!
			          			</h4>
			          		</td>
			          	</tr>
			      	</tbody>
			    </table>
			    <div style="padding-right: 40px;padding-left: 40px; background: #555;color: #fff">
			      	<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
				        <tbody>
				          	<tr>
				            	<td>
				            		<p>
				            			<b>
				            				¿Has perdido tu contraseña?
				            			</b>
				            		</p>
				              		<p>
				              			Para cambiarla utiliza este codigo en tu app
				              		</p>
				              		<center>
				                		<span style="display: inline-block; padding: 15px 50px; margin: 20px 0px 30px; font-size: 20px; color: #fff; background: silver; text-decoration:none;box-shadow: 0 4px #9B36B1;">
				                			{{$token}}
				                		</span>
				              		</center>
				              	</td>
				          	</tr>
				        </tbody>
			      	</table>
			    </div>
		    	<!-- <div style="text-align: left; font-size: 12px; color: #black;padding: 5px 20px;border-top: solid 1px #999;">
		      		<p> 
		      			Si tienes alguna duda o deseas contactarnos, entra en nuestra sección de ayuda
		        		<a href="javascript: void(0);" style="text-decoration: underline;">
		        			Click aquí
		        		</a> 
		        	</p>
		    	</div> -->
		    </div>
	  	</div>
	</div>
</body>
</html>
