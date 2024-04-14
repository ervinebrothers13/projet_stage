


(function() {

   

    tinymce.create('tinymce.plugins.weblink',{

        init: function(ed, url){

            ed.addButton('ajouterweblink',{

                title: 'You tube',

                image:url+'/weblink.png',

                onclick: function () {

                    var url = prompt('Entrer un lien ou un identifiant d\'article)','');
					var name = prompt('Entrer un nom d\'article)','');
					var nameid =  name + Math.floor((Math.random() * 1100) + 1);
                    ed.selection.setContent('[ajouterweblink url="'+url+'" name="'+name+'" nameid="'+nameid+'"]');

                }

            })

        },

        createControl: function(n,m){

            return null;

        }

    })

 

    tinymce.PluginManager.add('ajouterweblink',tinymce.plugins.weblink);

 

})();
;