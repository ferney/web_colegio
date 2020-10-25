<div id="migaleria_rotar"></div>
<script type="text/javascript">
	var capa = 'migaleria_rotar';
	var count = 0;
	var migaleria_link = '{link}';
	var migaleria_imag = new Array();
	var migaleria_name = new Array();
{variables}
	function MiGaLeRiA_Rotar() {
		var enlace = '<div><a href="' + migaleria_link + '" target="_blank"><img src="' + migaleria_imag[count] + '" alt="' + migaleria_name[count] + '" /></a><br /><br />' + migaleria_name[count] + '</div>';
		document.getElementById(capa).innerHTML = enlace;
		if(count==migaleria_name.length-1) count=0; else count++;
	}
	MiGaLeRiA_Rotar();
	setInterval("MiGaLeRiA_Rotar()", 2000);
</script>
