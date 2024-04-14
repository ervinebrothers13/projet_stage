
<html>
<head>
	<link href="model/stylempdf.css" rel="stylesheet">
</head>
<body>


<page orientation='1' backtop='5mm' backbottom='5mm' backleft='1mm'  >
	<table>
        <tr><td style="height:25px;"></td></tr>
    </table>
    <table style="border-collapse: collapse;width: 100%;" >
		<tr>
			<td style="padding:5 10 5 10;width:800px;text-align:left;">
				<span style="font-size:16px;" >CONVENTION TYPE RELATIVE A LA PERIODE DE FORMATION EN MILIEU PROFESSIONNEL</span>
			</td>
			<td style="padding:5 10 5 10;width:400px;text-align:right;">
				<span style="font-size:16px;" >Numéro de référence : <?php echo $tabconvention["reference"]; ?></span>
			</td>
		</tr>
	</table>
	<table style="width: 100%; padding: 0px;">
		<tr>
			<td style="width:33%;border-collapse: collapse;border:1px solid black;">
				<table class="fontsize16">
                    <tr><td class="fontbold">L'entreprise</td></tr>
					<tr><td style="height:150px;"></td></tr>
					<tr><td>Le Chef d’entreprise ou son représentant</td></tr>
					<tr><td>Nom et Prénom :</td></tr>
					<tr><td>Le :</td></tr>
				</table>
			</td>

			<td style="width:33%;border-collapse: collapse;border:1px solid black;">
				<table class="fontsize16" >
					<tr><td class="fontbold">Le chef d’établissement</td></tr>
					<tr><td style="height:190px;"></td></tr>
					<tr><td>Nom et Prénom :</td></tr>
					<tr><td>Le :</td></tr>
				</table>
			</td>

			<td style="width:33%;border-collapse: collapse;border:1px solid black;">
				<table class="fontsize16">
					<tr><td class="fontbold">L’élève ou son représentant légal (si mineur) :</td></tr>
					<tr><td style="height:170px;"></td></tr>
					<tr><td>Nom et Prénom :</td></tr>
					<tr><td>Le :</td></tr>
				</table>
			</td>
		</tr>

		<tr>
			<td style="border-collapse: collapse;border:1px solid black;">
				<table class="fontsize16">
					<tr><td class="fontbold">L’enseignant référent</td></tr>
					<tr><td style="height:160px;"></td></tr>
					<tr><td>Nom et Prénom :</td></tr>
					<tr><td>Le :</td></tr>
				</table>
			</td>

			<td style="border-collapse: collapse;border:1px solid black;">
				<table class="fontsize16">
					<tr><td class="fontbold">Le professeur principal</td></tr>
					<tr><td style="height:160px;"></td></tr>
					<tr><td>Nom et Prénom :</td></tr>
					<tr><td>Le :</td></tr>
				</table>
			</td>
           
		</tr>
	</table>
</page>
<htmlpagefooter name="page1">
	<table style="width: 100%;">
		<tr>
			<td style="text-align: right; font-size:10px;width: 100%">
				Page 5 sur 6
			</td>
		</tr>
	</table>
</htmlpagefooter>
<sethtmlpagefooter name="page1" value="on" show-this-page="1" />
</body>
</html>
