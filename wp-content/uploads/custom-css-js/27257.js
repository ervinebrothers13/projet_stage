<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
 

jQuery(document).ready(function($){
	
	jQuery('select[multiple].active.3col').multiselect({
            columns: 3,
            placeholder: 'Selectionner les établissements',
            search: true,
            searchOptions: {
                'default': 'Chercher établissements'
            },
            selectAll: true
        });
	
	jQuery(".nav-tabs .nav-item").on( "click", function() {
	  
	   jQuery(".nav-tabs .nav-item").find(".nav-link").removeClass("active");
	   
	   jQuery(this).find(".nav-link").addClass("active");
	   
	} );
	
	
	//***********activer/désactiver checkbox en cliquant sur le texte
	jQuery(".hosting_info").on( "click", function() {
	   
	   if(jQuery(this).parents(".hosting_infocontent").first().find(".hosting_infocheck").is(':checked')){
		 
		   jQuery(this).parents(".hosting_infocontent").first().find(".hosting_infocheck").prop('checked', false);
		   
		}else{
			
		   jQuery(this).parents(".hosting_infocontent").first().find(".hosting_infocheck").prop('checked', true);
			
		  }
	 	
	   
	} );
	
	
	//***********activer/désactiver checkbox en liquant sur le texte
   jQuery(".filteritemlib").on( "click", function() {
	   
	   if(jQuery(this).parents(".filteritem").first().find(".filteritemcheck").is(':checked')){
		 
		   jQuery(this).parents(".filteritem").first().find(".filteritemcheck").prop('checked', false);
		   
		}else{
			
		   jQuery(this).parents(".filteritem").first().find(".filteritemcheck").prop('checked', true);
			
		  }
	 	
	   
	} );
	
	
	
	jQuery("#usertahitisearch").autocomplete({
		source: "http://localhost/monstage/wp-content/themes/Avada/ajaxsearch.php?typ=numerotahiti",
		minLength: 2,
		select: function (event, ui) {
			jQuery("#usertahitisearch").val(ui.item.value); // affiche le texte
			jQuery("#ent_infodiv").val(ui.item.id); // affiche le texte
			
		},
		response: function (event, ui) {
			jQuery("#ent_infodiv").val(''); // initialise le champ id si modification de libellé
		}			
	});
	
	jQuery("#rcheleve").autocomplete({
		source: "http://localhost/monstage/wp-content/themes/Avada/ajaxsearch.php?typ=eleve",
		minLength: 2,
		select: function (event, ui) {
			jQuery("#rcheleve").val(ui.item.value); // affiche le texte
			jQuery("#ideleve").val(ui.item.id); // alimente l'id dans le champ caché
			
		},
		response: function (event, ui) {
			jQuery("#ideleve").val(''); // initialise le champ id si modification de libellé
		}			
	});
	
	
	
	
	jQuery('#chpddnais').datepicker({
			startView: "decade"
		});
	
	var mindate1=jQuery('#chpdddebut').attr("mindate");
	var maxdate1=jQuery('#chpdddebut').attr("maxdate");
		
	jQuery('#chpdddebut').datepicker({
			dateFormat: 'dd/mm/yy',
			startView: "decade",
			minDate: mindate1,
 		 	maxDate: maxdate1
		});
	
	var mindate2=jQuery('#chpddfin').attr("mindate");
	var maxdate2=jQuery('#chpddfin').attr("maxdate");
	
	jQuery('#chpddfin').datepicker({
			dateFormat: 'dd/mm/yy',
			startView: "decade",
			minDate: mindate2,
 		 	maxDate: maxdate2
		});
	
	 jQuery("#usersecteurid1").on( "click", function() {
	   
	  
			 jQuery("#usersecteurinput1").prop('checked', true);
		   jQuery("#usersecteurinput2").prop('checked', false);
		 jQuery("#usersecteurinput3").prop('checked', false);
		  
		  jQuery("#usersecteurdiv3").addClass("displaynone");
			jQuery("#usersecteurdiv2").addClass("displaynone");
		 jQuery("#usersecteurdiv1").removeClass("displaynone");
		 
			
	} );
	
	jQuery("#usersecteurid2").on( "click", function() {
	   
			jQuery("#usersecteurinput2").prop('checked', true);
		   jQuery("#usersecteurinput1").prop('checked', false);
		 jQuery("#usersecteurinput3").prop('checked', false);
		  
		jQuery("#usersecteurdiv3").addClass("displaynone");
			jQuery("#usersecteurdiv1").addClass("displaynone");
		 jQuery("#usersecteurdiv2").removeClass("displaynone");
			
	} );
	
	jQuery("#usersecteurid3").on( "click", function() {
	   
			jQuery("#usersecteurinput3").prop('checked', true);
		   jQuery("#usersecteurinput2").prop('checked', false);
		 jQuery("#usersecteurinput1").prop('checked', false);
		  
		jQuery("#usersecteurdiv2").addClass("displaynone");
			jQuery("#usersecteurdiv1").addClass("displaynone");
		 jQuery("#usersecteurdiv3").removeClass("displaynone");
			
	} );
	
	 jQuery("#horairesemainetab").on("click", function() {
	   
	    if(jQuery("#horairesemainecontent2").hasClass("displaynone")){
		 	
		   
		   jQuery(this).find(".horairesemainetabclass").prop('checked', false);
		   
		   jQuery("#horairesemainecontent1").addClass("displaynone");
		    jQuery("#horairesemainecontent2").removeClass("displaynone");
		   
		}else{
			
		   jQuery(this).find(".horairesemainetabclass").prop('checked', true);
			
			jQuery("#horairesemainecontent1").removeClass("displaynone");
		   jQuery("#horairesemainecontent2").addClass("displaynone");
			
		  }
	 	
	   
	} );
	
	 jQuery("#datestage1but").on( "click", function() {
	   
	  
			 jQuery("#datestage1").prop('checked', true);
		   jQuery("#datestage2").prop('checked', false);
		 jQuery("#datestage3").prop('checked', false);
		  
			jQuery("#selectdatestagediv").addClass("displaynone");
			jQuery("#selectdatestagediv2").addClass("displaynone");
	} );
	
	jQuery("#datestage2but").on( "click", function() {
	   
			 jQuery("#datestage2").prop('checked', true);
			 jQuery("#datestage1").prop('checked', false);
		 jQuery("#datestage3").prop('checked', false);
		  
		    jQuery("#selectdatestagediv").removeClass("displaynone");
		jQuery("#selectdatestagediv2").addClass("displaynone");
			
	} );
	
	jQuery("#datestage3but").on( "click", function() {
	   
			 jQuery("#datestage2").prop('checked', false);
			 jQuery("#datestage1").prop('checked', false);
			 jQuery("#datestage3").prop('checked', true);
		  
		    jQuery("#selectdatestagediv").addClass("displaynone");
		jQuery("#selectdatestagediv2").removeClass("displaynone");
			
	} );
	
	
	 jQuery("#typnbstage1but").on( "click", function() {
	   
	  
			 jQuery("#typnbstage1").prop('checked', true);
		   jQuery("#typnbstage2").prop('checked', false);
		  
			  jQuery("#selecttypnbstagediv").addClass("displaynone");
			
		  
	 	
	   
	} );
	
	 jQuery("#typnbstage2but").on( "click", function() {
	   
		    jQuery("#typnbstage2").prop('checked', true);
			 jQuery("#typnbstage1").prop('checked', false);
		  
		    jQuery("#selecttypnbstagediv").removeClass("displaynone");
		  
	} );
	
	jQuery(".selectreserveetab").on("click", function() {
	   
	    if(jQuery("#selectreserveetabdiv").hasClass("displaynone")){
		 	
		   
		   jQuery(this).find(".selectreserveetabclass").prop('checked', true);
		   
		   jQuery("#selectreserveetabdiv").removeClass("displaynone");
		   
		}else{
			
		   jQuery(this).find(".selectreserveetabclass").prop('checked', false);
			
			jQuery("#selectreserveetabdiv").addClass("displaynone");
			
		  }
	 	
	   
	} );

});


function openfilter(){
	jQuery("#fondgris").fadeIn();
	jQuery("#fondgris").css("display","flex");
}

function closefilter(){
	jQuery("#fondgris").fadeOut();
	jQuery("#fondgris").css("display","none");
}

function removefilter3eme(){
	jQuery(".filteritemcheck").prop('checked', false);
}


function removefilterbts(){
	jQuery(".filteritemcheck").prop('checked', false);
}

function applyfilter3eme(){
	
	var tab=[];
	
	jQuery(".filteritemcheck").each(function() {
    	
		if(jQuery(this).is(':checked')){
			tab.push(jQuery(this).val());
		}
	});
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=applyfilter3eme&tab="+tab, 
		beforeSend: function() {
			jQuery("#applyfilter3eme").html('<img src="http://localhost/monstage/wp-content/themes/Avada/images/loading.gif" />');
		},success: function(result){
			location.reload();

		}
	});
	
		
}



function applyfilterpfmp(){
	
	var tab=[];
	
	jQuery(".filteritemcheck").each(function() {
    	
		if(jQuery(this).is(':checked')){
			tab.push(jQuery(this).val());
		}
	});
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=applyfilterpfmp&tab="+tab, 
		beforeSend: function() {
			jQuery("#applyfilterpfmp").html('<img src="http://localhost/monstage/wp-content/themes/Avada/images/loading.gif" />');
		},success: function(result){
			location.reload();

		}
	});
	
		
}


function applyfilterbts(){
	
	var tab=[];
	
	jQuery(".filteritemcheck").each(function() {
    	
		if(jQuery(this).is(':checked')){
			tab.push(jQuery(this).val());
		}
	});
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=applyfilterbts&tab="+tab, 
		beforeSend: function() {
			jQuery("#applyfilterbts").html('<img src="http://localhost/monstage/wp-content/themes/Avada/images/loading.gif" />');
		},success: function(result){
			location.reload();

		}
	});
	
		
}

function connexiondiv(){
	
	
var connexionheightmin=jQuery("#connexiondiv").attr("data-heightmin");
var connexionheightmax=jQuery("#connexiondiv").attr("data-heightmax");
var passwordforgetheightmin=jQuery("#passwordforget").attr("data-heightmin");
var passwordforgetheightmax=jQuery("#passwordforget").attr("data-heightmax");
var createaccountheightmin=jQuery("#createaccount").attr("data-heightmin");
var createaccountheightmax=jQuery("#createaccount").attr("data-heightmax");
var messageactiveheightmin=jQuery("#messageactive").attr("data-heightmin");
var messageactiveheightmax=jQuery("#messageactive").attr("data-heightmax");

	jQuery("#connexiondiv").find(".bouttonconnex2").hide(500);
	jQuery( "#connexiondiv" ).animate({
		height: connexionheightmax
	 }, 500, function() {
		
		jQuery("#connexiondiv").addClass("windowopen");
		jQuery("#connexiondiv").removeClass("windowclose");
		
	  });
	
	if(jQuery("#passwordforgetdiv").hasClass("windowopen")){
		
		jQuery("#passwordforgetdiv").find(".bouttonconnex2").show(500);
			
		jQuery( "#passwordforgetdiv" ).animate({
				height: passwordforgetheightmin
			 }, 500, function() {
			
				jQuery("#passwordforgetdiv").removeClass("windowopen");
				jQuery("#passwordforgetdiv").addClass("windowclose");
				
			  });
	
	}
	
	
	
	if(jQuery("#createaccountdiv").hasClass("windowopen")){
		
		jQuery("#createaccountdiv").find(".bouttonconnex2").show(500);
			
		jQuery( "#createaccountdiv" ).animate({
				height: createaccountheightmin
			 }, 500, function() {
			
				jQuery("#createaccountdiv").removeClass("windowopen");
				jQuery("#createaccountdiv").addClass("windowclose");
				
			  });
	
	}

	 if(jQuery("#messageactivediv").hasClass("windowopen")){
		
		 jQuery("#messageactivediv").find(".bouttonconnex2").show(500);
			
		 jQuery( "#messageactivediv" ).animate({
				height: messageactiveheightmin
			 }, 500, function() {
				
				jQuery("#messageactivediv").removeClass("windowopen");
				jQuery("#messageactivediv").addClass("windowclose");
				
			  });
	
	}
	
}


function passwordforgetdiv(){
	
	
var connexionheightmin=jQuery("#connexiondiv").attr("data-heightmin");
var connexionheightmax=jQuery("#connexiondiv").attr("data-heightmax");
var passwordforgetheightmin=jQuery("#passwordforget").attr("data-heightmin");
var passwordforgetheightmax=jQuery("#passwordforget").attr("data-heightmax");
var createaccountheightmin=jQuery("#createaccount").attr("data-heightmin");
var createaccountheightmax=jQuery("#createaccount").attr("data-heightmax");
var messageactiveheightmin=jQuery("#messageactive").attr("data-heightmin");
var messageactiveheightmax=jQuery("#messageactive").attr("data-heightmax");

	if(jQuery("#connexiondiv").hasClass("windowopen")){
		
		jQuery("#connexiondiv").find(".bouttonconnex2").show(500);
		
			
		jQuery( "#connexiondiv" ).animate({
				height: connexionheightmin
			 }, 500, function() {
				jQuery("#connexiondiv").removeClass("windowopen");
				jQuery("#connexiondiv").addClass("windowclose");
				
			  });
	
	}
	
	jQuery("#passwordforgetdiv").find(".bouttonconnex2").hide(500);
	
	jQuery( "#passwordforgetdiv" ).animate({
		height: passwordforgetheightmax
	 }, 500, function() {
		
		jQuery("#passwordforgetdiv").addClass("windowopen");
		jQuery("#passwordforgetdiv").removeClass("windowclose");
		
	  
	 });
	
	if(jQuery("#createaccountdiv").hasClass("windowopen")){
		
		jQuery("#createaccountdiv").find(".bouttonconnex2").show(500);
		
		jQuery( "#createaccountdiv" ).animate({
			height: createaccountheightmin
		 }, 500, function() {
			jQuery("#createaccountdiv").removeClass("windowopen");
			jQuery("#createaccountdiv").addClass("windowclose");
			
		  });
	
	}

	if(jQuery("#messageactivediv").hasClass("windowopen")){
		
		jQuery("#messageactivediv").find(".bouttonconnex2").show(500);
		
		jQuery( "#messageactivediv" ).animate({
			height: messageactiveheightmin
		 }, 500, function() {
			jQuery("#messageactivediv").removeClass("windowopen");
			jQuery("#messageactivediv").addClass("windowclose");
			
		 
		 });
	
	}
	
}

function createaccountdiv(){
	
var connexionheightmin=jQuery("#connexiondiv").attr("data-heightmin");
var connexionheightmax=jQuery("#connexiondiv").attr("data-heightmax");
var passwordforgetheightmin=jQuery("#passwordforget").attr("data-heightmin");
var passwordforgetheightmax=jQuery("#passwordforget").attr("data-heightmax");
var createaccountheightmin=jQuery("#createaccount").attr("data-heightmin");
var createaccountheightmax=jQuery("#createaccount").attr("data-heightmax");
var messageactiveheightmin=jQuery("#messageactive").attr("data-heightmin");
var messageactiveheightmax=jQuery("#messageactive").attr("data-heightmax");

	if(jQuery("#connexiondiv").hasClass("windowopen")){
			
			jQuery("#connexiondiv").find(".bouttonconnex2").show(500);
			
			jQuery( "#connexiondiv" ).animate({
				height: connexionheightmin
			 }, 500, function() {
				jQuery("#connexiondiv").removeClass("windowopen");
				jQuery("#connexiondiv").addClass("windowclose");
				
			  });
	
	}
	
	if(jQuery("#passwordforgetdiv").hasClass("windowopen")){
			
			jQuery("#passwordforgetdiv").find(".bouttonconnex2").show(500);
			
			jQuery( "#passwordforgetdiv" ).animate({
				height: passwordforgetheightmin
			 }, 500, function() {
				jQuery("#passwordforgetdiv").removeClass("windowopen");
				jQuery("#passwordforgetdiv").addClass("windowclose");
				
			  });
	
	}
	
	jQuery("#createaccountdiv").find(".bouttonconnex2").hide(500);
	jQuery( "#createaccountdiv" ).animate({
		height: createaccountheightmax
	 }, 500, function() {
		
		jQuery("#createaccountdiv").addClass("windowopen");
		jQuery("#createaccountdiv").removeClass("windowclose");
		
	  });
	
	

	 if(jQuery("#messageactivediv").hasClass("windowopen")){
		
		jQuery("#messageactivediv").find(".bouttonconnex2").show(500);
		
			jQuery( "#messageactivediv" ).animate({
				height: messageactiveheightmin
			 }, 500, function() {
				jQuery("#messageactivediv").removeClass("windowopen");
				jQuery("#messageactivediv").addClass("windowclose");
				
			  });
	
	}
	
}


function messageactivediv(){
	
	
var connexionheightmin=jQuery("#connexiondiv").attr("data-heightmin");
var connexionheightmax=jQuery("#connexiondiv").attr("data-heightmax");
var passwordforgetheightmin=jQuery("#passwordforget").attr("data-heightmin");
var passwordforgetheightmax=jQuery("#passwordforget").attr("data-heightmax");
var createaccountheightmin=jQuery("#createaccount").attr("data-heightmin");
var createaccountheightmax=jQuery("#createaccount").attr("data-heightmax");
var messageactiveheightmin=jQuery("#messageactive").attr("data-heightmin");
var messageactiveheightmax=jQuery("#messageactive").attr("data-heightmax");
	
	if(jQuery("#connexiondiv").hasClass("windowopen")){
		
		jQuery("#connexiondiv").find(".bouttonconnex2").show(500);
		
			jQuery( "#connexiondiv" ).animate({
				height: connexionheightmin
			 }, 500, function() {
				jQuery("#connexiondiv").removeClass("windowopen");
				jQuery("#connexiondiv").addClass("windowclose");
				
			  });
	
	}
	
	
	if(jQuery("#passwordforgetdiv").hasClass("windowopen")){
		
		jQuery("#passwordforgetdiv").find(".bouttonconnex2").show(500);
		
			jQuery( "#passwordforgetdiv" ).animate({
				height: passwordforgetheightmin
			 }, 500, function() {
				jQuery("#passwordforgetdiv").removeClass("windowopen");
				jQuery("#passwordforgetdiv").addClass("windowclose");
				
			  });
	
	}
	
	if(jQuery("#createaccountdiv").hasClass("windowopen")){
		
		jQuery("#createaccountdiv").find(".bouttonconnex2").show(500);
		
			jQuery( "#createaccountdiv" ).animate({
				height: createaccountheightmin
			 }, 500, function() {
				jQuery("#createaccountdiv").removeClass("windowopen");
				jQuery("#createaccountdiv").addClass("windowclose");
				
			  });
	
	}

	jQuery("#messageactivediv").find(".bouttonconnex2").hide(500);
	
	jQuery( "#messageactivediv" ).animate({
		height: messageactiveheightmax
	 }, 500, function() {
		jQuery("#messageactivediv").addClass("windowopen");
				jQuery("#messageactivediv").removeClass("windowclose");
		
	  });
	
}


function sedeconnecter(){
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=deconnexion"
		,success: function(result){
			location.reload();

		}
	});
	
}


function supprimercvelv(){
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=supprimercvelv"
		,success: function(result){
			window.location.replace("http://localhost/monstage/espace-eleve/?ong=cv");
			//location.reload();

		}
	});
	
}

function supprimercvelv2(obj){
	
	var cand=jQuery(obj).attr("data-cand");
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=supprimercvelv"
		,success: function(result){
			window.location.replace("http://localhost/monstage/postuler/?etape=3&cand="+cand);
			//location.reload();

		}
	});
	
}

function supprimerlogo(){
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=supprimerlogo"
		,success: function(result){
			window.location.replace("http://localhost/monstage/espace-entreprise/?ong=info&msg=logosup");
		}
	});
	
}


function supprimerlogouai(obj){
	
	var uai_rne=jQuery(obj).attr("data-uai");
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=supprimerlogouai&uai_rne="+uai_rne
		,success: function(result){
			location.reload();

		}
	});
	
}




function aChpDel(obj){	
	jQuery("#deldata #chpiddel").val(obj.getAttribute('data-id'));
	jQuery("#deldata #chpidp").val(obj.getAttribute('data-idp'));
	jQuery("#deldata #actdel").val(obj.getAttribute('data-typ'));
	jQuery('.tdel').html(obj.getAttribute('title'));
}


function aChpAccept(obj){	
	jQuery("#acceptdata #chpidaccept").val(obj.getAttribute('data-id'));
	jQuery("#acceptdata #actaccept").val(obj.getAttribute('data-typ'));
	
}
function aChpRefus(obj){	
	jQuery("#refusdata #chpidrefus").val(obj.getAttribute('data-id'));
	jQuery("#refusdata #actrefus").val(obj.getAttribute('data-typ'));
	
}


function voireleve(obj){
	
	var id=jQuery(obj).attr("data-id");
	var name=jQuery(obj).attr("data-name");
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=voireleve&id="+id
		,success: function(result){
			jQuery("#voirelevename").html(name);
			jQuery("#voirelevediv").html(result);
		}
	});

	
}

function changetab(obj){
	jQuery(".nav-tabs .nav-item").on( "click", function() {

		   jQuery(".nav-tabs .nav-item").find(".nav-link").removeClass("active");

		   jQuery(this).find(".nav-link").addClass("active");

	} );
}



function viewnotifcandent(){
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=viewnotifcandent"
		,success: function(result){
			
			jQuery("#notificationcand").fadeOut();
		}
	});
	
}

function viewnotifconvent(){
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=viewnotifconvent"
		,success: function(result){
			
			jQuery("#notificationconv").fadeOut();
		}
	});
	
}


function viewnotifcandelv1(){
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=viewnotifcandelv1"
		,success: function(result){
			
			jQuery("#notificationcand1").fadeOut();
		}
	});
	
}


function viewnotifcandelv2(){
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=viewnotifcandelv2"
		,success: function(result){
			
			jQuery("#notificationcand2").fadeOut();
		}
	});
	
}

function viewnotifcandelv3(){
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=viewnotifcandelv3"
		,success: function(result){
			
			jQuery("#notificationcand3").fadeOut();
		}
	});
	
}

function viewnotifconvelv(){
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=viewnotifconvelv"
		,success: function(result){
			
			jQuery("#notificationconv").fadeOut();
		}
	});
	
}

function viewnotifcandpeda1(obj){
	
	var id=jQuery(obj).attr("data-elv");
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=viewnotifcandpeda1&id="+id
		,success: function(result){
			
			jQuery("#notificationcand1").fadeOut();
		}
	});
	
}



function viewnotifcandpeda2(obj){
	
	var id=jQuery(obj).attr("data-elv");
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=viewnotifcandpeda2&id="+id
		,success: function(result){
			
			jQuery("#notificationcand2").fadeOut();
		}
	});
	
}

function viewnotifcandpeda3(obj){
	
	var id=jQuery(obj).attr("data-elv");
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=viewnotifcandpeda3&id="+id
		,success: function(result){
			
			jQuery("#notificationcand3").fadeOut();
		}
	});
	
}

function viewnotifconvpeda(obj){
	
	var id=jQuery(obj).attr("data-elv");
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=viewnotifconvpeda&id="+id
		,success: function(result){
			
			jQuery("#notificationconv").fadeOut();
		}
	});
	
}


function postulerelv(obj){
	
	var id=jQuery(obj).attr("data-id");
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=postulerel&id="+id
		,success: function(result){
			
			jQuery("#postulerelvdiv").html(result);
		}
	});

	
}


 function file_explorer(obj) {
	 	
	 var elementid=jQuery(obj).attr("id");
	 
        document.getElementById(elementid+'button').click();
        document.getElementById(elementid+'button').onchange = function() {
            fileobj = document.getElementById(elementid+'button').files;
            ajax_file_upload(fileobj,elementid);
        };
    }

function ajax_file_upload(file_obj,elementid) {
        
	var cand=jQuery("#candid").val();
		jQuery(".signatureerror").html("");
		$.each(file_obj, function(index, item) {
    
            var form_data = new FormData();                  
            form_data.append('file', item);
			
            $.ajax({
                type: 'POST',
                url: 'http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=uploadfile&cand='+cand+'&elementid='+elementid,
                contentType: false,
                processData: false,
                data: form_data,
                success:function(response) {
                    
					if(response=="1"){
						
						jQuery("#"+elementid+"sign").removeClass("colorred");
						jQuery("#"+elementid+"sign").addClass("colorgreen");
						jQuery("#"+elementid+"sign").html("Signé");
						
						location.reload();
						
					}else{
						
						jQuery("#"+elementid+"sign").addClass("colorred");
						jQuery("#"+elementid+"sign").removeClass("colorgreen");
						jQuery("#"+elementid+"sign").html("Pas encore signé");
						
						
						var errormsg="";
						
						switch(response) {
						  case "errorupload":
							errormsg="Erreur de téléchargement";
							break;
						  case "errorext":
							errormsg="Erreur d'extension, ce n'est pas un pdf";
							break;
						  case "errorbug":
							errormsg="Erreur : vous ne pouvez pas signer pour cette personne";
							break;
						   case "error":
							errormsg="Erreur de fichier";
							break;
						}
						
						jQuery("#"+elementid+"error").html(errormsg);
						
						
					}
					
					
					
                }
            });
      
		});
		
}


function changepublish(obj){
	var id=jQuery(obj).attr("data-id");id
	
	jQuery.ajax({
		url:"http://localhost/monstage/wp-content/themes/Avada/ajax.php?typ=changepublish&id="+id
		,success: function(result){
			
			if(result=="1"){
				jQuery(obj).removeClass("btn-danger");
				jQuery(obj).addClass("btn-success");
				jQuery(obj).html('<i class="fa fa-toggle-on"></i>');
				
			}else{
				jQuery(obj).removeClass("btn-success");
				jQuery(obj).addClass("btn-danger");
				jQuery(obj).html('<i class="fa fa-toggle-off"></i>');
			}
			
		}
	});
}</script>
<!-- end Simple Custom CSS and JS -->
