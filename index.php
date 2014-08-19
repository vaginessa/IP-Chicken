<?php
	$addr = $_SERVER;
?>
<html>
	<head>
		<!-- Javascript Init -->
		<script language="JavaScript" src="http://www.ipaddresslocation.org/my-ip-address.php"  type="text/JavaScript">
		</script>

	</head>
	<body>
		<input type='button' value='Show Info' onclick='showIP()' />
		<br/><strong>About your IP</strong><br/>
		<table border=1>
			<tr>
				<td>
					Your IP Address: 
				</td>
				<td id='client_external_ip'>
					Secret
				</td>
			</tr>
			<tr>
				<td>
					Your Network is: 
				</td>
				<td id='client_hostname'>
					Secret
				</td>
			</tr>
			<tr>
				<td>
					Your ISP is: 
				</td>
				<td id='client_isp'>
					Secret
				</td>
			</tr>
		</table>
		<br/><strong>About your Browser</strong><br/>
		<table border=1>
			<tr>
				<td>
					Browser: 
				</td>
				<td id='client_browser'>
					Secret
				</td>
			</tr>
			<tr>
				<td>
					OS: 
				</td>
				<td id='client_os'>
					Secret
				</td>
			</tr>
			<tr>
				<td>
					Screen Dimension: 
				</td>
				<td id='client_dimension'>
					Secret
				</td>
			</tr>
			<tr>
				<td>
					Color Depth: 
				</td>
				<td id='client_depth'>
					Secret
				</td>
			</tr>
		</table>

		<!-- Javascript afterload -->
		<script type="text/javascript">

			var addr = <?php echo json_encode($addr) ?>;
			console.log(addr);

			navigator.sayswho= (function(){
			    var N= navigator.appName, ua= navigator.userAgent, tem;
			    var M= ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
			    if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
			    M= M? [M[1], M[2]]: [N, navigator.appVersion,'-?'];
			    return M;
			})();

			
			//Get IPLocation values
			//Extract External IP
			var external_ip = document.getElementsByTagName("td")[3].innerHTML;
			var start = external_ip.indexOf("<b>");
			var end = external_ip.indexOf("</b>");
			var external_ip = external_ip.substr(start,end);
			//Get Internal IP
			var internal_ip = addr['REMOTE_ADDR'];
			//Extract ISP
			var isp = document.getElementsByTagName("td")[5].innerHTML;
			var start = isp.indexOf("<b>");
			var end = isp.indexOf("</b>");
			var isp = isp.substr(start,end);
			//Destroy IPLocation Table
			document.getElementsByTagName("body")[0].removeChild(document.getElementsByTagName("table")[0]);

			function showIP(){
				//About IP							
				document.getElementById('client_external_ip').innerHTML = "<b>" + getLocation(external_ip) + "</b>";
				document.getElementById('client_isp').innerHTML = isp;
				//About Browser
				document.getElementById('client_browser').innerHTML = "<b>" + navigator.sayswho[0] + "</b>";
				document.getElementById('client_os').innerHTML = "<b>" + getOS(addr['HTTP_USER_AGENT']) + "</b>";
				document.getElementById('client_dimension').innerHTML = "<b>" + screen.width + "x" + screen.height + "</b>";
				document.getElementById('client_depth').innerHTML = "<b>" + screen.colorDepth + "</b>";
			}

			function getOS(data){
				var os;
				if(data.indexOf("Windows") != -1){
					os = "Windows";
				}
				else{
					os = "Linux";
				}
				return os;
			}

			function getLocation(data){
				var location;
				if(data.substr(3,3) == "210"){
					location = internal_ip + "(Inside Cloudstaff)";
					
				}
				else{
					location = external_ip + "(Outside Cloudstaff)";
				}
				return location;
				
			}

		</script>
	</body>
</html>