<hmtl>
	<head>
		<title></title>
		<style type="text/css">
			#A4 {background-color:#FFFFFF;
				left:5px;
				right:5px;
				height:5.51in ; /*Ukuran Panjang Kertas */
				width: 8.50in; /*Ukuran Lebar Kertas */
				margin:1px solid #FFFFFF;	 
				font-family:Georgia, "Times New Roman", Times, serif;
			}
			  #atas, #kanan, #bawah
			  {display:none;}

			  #wrapper{
			  float: left;
			  width: 100%;
			  }
			  
			  #isi{
			  width: 100%;
			  }

			    #atas{
			  height: 100px; /*Height of top section*/
			  background:url(items/header.jpg) repeat-x #2D1721;
			  }
			  
			  #atas h1{
			  margin: 0;
			  padding-top: 15px;
			  }
			  
			  #wrapper{
			  float: left;
			  width: 100%;
			  }
			  
			  #isi{
			  margin-right: 170px; 
			  }
			  
			  #kanan{
			  float: left;
			  width: 170px; /*Width of right column in pixels*/
			  margin-left: -170px; /*Set left margin to -(RightColumnWidth) */
			  background-color:#00FFFF;
			  }
			  
			  #bawah{
			  clear: left;
			  width: 100%;
			  background: black;
			  color: #FFF;
			  text-align: center;
			  padding: 4px 0;
			  }

		</style>
	</head>

	<body>
		
		<script type="text/javascript">
			//<![CDATA[
				function printPage()
				{
				 if (typeof(window.print) != 'undefined') {
				        window.print();
				    }
				}
				</script>
				 
				<div id="atas"><h1>ATAS</h1></div>
<div id="wrapper">
	<div id="isi"><h1>ISI</h1>
	<input type="button" class="print_ignore"
    id="print" value="PRINT" onclick="printPage()" />
	</div>

</div>
	<div id="kanan"><h1>Kanan</h1>
	
	</div>
<div id="bawah"><h1>Bawah</h1></div>
	</body>
</hmtl>