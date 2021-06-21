$(document).ready(function(){
        $('#form_editor').hide();
        $('#form_editor_resume').hide();
        $('#form_editor_contenu').hide();
        $('#form_editor_auteur').hide();
        $('#DivFormAddPj').hide();
        $('#importImg').hide();
        $('.inputImg').hide();
        $('#importPlaqt').hide();
        $('#importImgBan').hide();
        $('#importVideo').hide();
        $('#form_editor_type').hide();
        $('#form_editor_description').hide();
        $('#form_editor_resume').hide();
        $('#form_editor_nom').hide();
        $('#form_editor_ville').hide();
        $('#form_editor_pays').hide();
        $('#form_editor_adresse').hide();
        $('#form_editor_slogan').hide();
        $('#form_editor_date_creation').hide();
        $('#form_editor_site').hide();
        $('#form_editor_position').hide();
        $('#form_editor_rubrique').hide();
        $('#form_editor_titre').hide();
        $('#form_editor_detail').hide();
        $('#form_editor_date_pub').hide();
        $('#form_editor_facebook').hide();
        $('#form_editor_twitter').hide();
        $('#form_editor_instagram').hide();
        $('#form_editor_linkedin').hide();
        $('#form_editor_fonction').hide();
        $('#form_editor_email').hide();
        $('#form_editor_departement').hide();
        $('#form_editor_agence').hide();
        $('#modify_video').hide();
        $('#form_editor_texte3').hide();
        $('#form_editor_texte2').hide();
        $('#form_editor_texte1').hide();
        $('#form_editor_source').hide();
        $('#form_editor_date_ref').hide();
        $('#form_editor_chiffre').hide();
        $('#form_editor_timing').hide();
        $('#form_editor_certif').hide();
        $('#form_editor_mode').hide();

        $('.editor').click(function(){
            $('#form_editor').show();
            $('.editor').hide();
        
        });

        $('.editor_timing').click(function(){
            $('#form_editor_timing').show();
            $('.editor_timing').hide();
        
         });

         $('.editor_date_ref').click(function(){
            $('#form_editor_date_ref').show();
            $('.editor_date_ref').hide();
      
         });
         $('.editor_chiffre').click(function(){
            $('#form_editor_chiffre').show();
            $('.editor_chiffre').hide();
      
         });

        $('.editor_type').click(function(){
            $('.editor_type').hide();
            $('#form_editor_type').show();
        });

        $('.editor_texte3').click(function(){
            $('.editor_texte3').hide();
            $('#form_editor_texte3').show();
        });

        $('.editor_texte2').click(function(){
            $('.editor_texte2').hide();
            $('#form_editor_texte2').show();
        });

        $('.editor_texte1').click(function(){
            $('.editor_texte1').hide();
            $('#form_editor_texte1').show();
        });


        $('.editor_nom').click(function(){
            $('.editor_nom').hide();
            $('#form_editor_nom').show();
        });


        $('#Add_mod_vid').click(function(){
            $('#AddPj').hide();
            $('#modify_video').show();
        });


        $('.editor_agence').click(function(){
            $('.editor_agence').hide();
            $('#form_editor_agence').show();
        });


        $('.editor_ville').click(function(){
            $('.editor_ville').hide();
            $('#form_editor_ville').show();
        });


        $('.editor_pays').click(function(){
            $('.editor_pays').hide();
            $('#form_editor_pays').show();
        });


        $('.editor_adresse').click(function(){
            $('.editor_adresse').hide();
            $('#form_editor_adresse').show();
        });


        $('.editor_slogan').click(function(){
            $('.editor_slogan').hide();
            $('#form_editor_slogan').show();
        });


        $('.editor_description').click(function(){
            $('.editor_description').hide();
            $('#form_editor_description').show();
        });


        $('.editor_date_creation').click(function(){
            $('.editor_date_creation').hide();
            $('#form_editor_date_creation').show();
        });


        $('.editor_site').click(function(){
            $('.editor_site').hide();
            $('#form_editor_site').show();
        });


        $('.editor_rubrique').click(function(){
            $('.editor_rubrique').hide();
            $('#form_editor_rubrique').show();
        });


        $('.editor_titre').click(function(){
            $('.editor_titre').hide();
            $('#form_editor_titre').show();
        });


        $('.editor_detail').click(function(){
            $('.editor_detail').hide();
            $('#form_editor_detail').show();
        });


        $('.editor_resume').click(function(){
            $('.editor_resume').hide();
            $('#form_editor_resume').show();
        });


        $('.editor_date_pub').click(function(){
            $('.editor_date_pub').hide();
            $('#form_editor_date_pub').show();
        });


        $('.editor_facebook').click(function(){
            $('.editor_facebook').hide();
            $('#form_editor_facebook').show();
        });


        $('.editor_fonction').click(function(){
            $('.editor_fonction').hide();
            $('#form_editor_fonction').show();
        });


        $('.editor_twitter').click(function(){
            $('.editor_twitter').hide();
            $('#form_editor_twitter').show();
        });


        $('.editor_instagram').click(function(){
            $('.editor_instagram').hide();
            $('#form_instagram').show();
        });


        $('.editor_linkedin').click(function(){
            $('.editor_linkedin').hide();
            $('#form_editor_linkedin').show();
        });


        $('.editor_departement').click(function(){
            $('.editor_departement').hide();
            $('#form_editor_departement').show();
        });


        $('.editor_email').click(function(){
            $('.editor_email').hide();
            $('#form_editor_email').show();
        });

        $('.editor_certif').click(function(){
            $('#form_editor_certif').show();
            $('.editor_certif').hide();
      
         });
         $('.editor_mode').click(function(){
            $('#form_editor_mode').show();
            $('.editor_mode').hide();
      
         });

         $('.editor_contenu').click(function(){
            $('.editor_contenu').hide();
            $('#form_editor_contenu').show();
         });

         $('.editor_auteur').click(function(){
            $('.editor_auteur').hide();
            $('#form_editor_auteur').show();
         });

         $('.editor_source').click(function(){
            $('.editor_source').hide();
            $('#form_editor_source').show();
         });


        $('#mod1').click(function(){
            $('#modify_video').hide();
           $('#DivFormAddPj').show();
           $('#AddPj').hide();
           $('#importImg').show();
           $('#AddDetail').show();
        });


        $('#modplaquette').click(function(){
            $('#modify_video').hide();
           $('#DivFormAddPj').show();
           $('#AddPj').hide();
           $('#importPlaqt').show();
        });


         $('.close_editor').click(function(){
            $('#form_editor_type').hide();
            $('.editor_type').show();
            $('.editor_resume').show();
            $('#form_editor_resume').hide();
            $('#form_editor_nom').hide();
            $('.editor_nom').show();
            $('#form_editor_ville').hide();
            $('.editor_ville').show();
            $('#form_editor_pays').hide();
            $('.editor_pays').show();
            $('#form_editor_adresse').hide();
            $('.editor_adresse').show();
            $('#form_editor_logo').hide();
            $('.editor_logo').show();
            $('#form_editor_plaquette').hide();
            $('.editor_plaquette').show();
            $('#form_editor_slogan').hide();
            $('.editor_slogan').show();
            $('#form_editor_site').hide();
            $('.editor_site').show();
            $('#form_editor_date_creation').hide();
            $('.editor_date_creation').show();
            $('#form_editor_description').hide();
            $('.editor_description').show();
            $('#form_editor_position').hide();
            $('.editor_position').show();
            $('#form_editor_rubrique').hide();
            $('.editor_rubrique').show();
            $('#form_editor_titre').hide();
            $('.editor_titre').show();
            $('#form_editor_detail').hide();
            $('.editor_detail').show();
            $('#form_editor_date_pub').hide();
            $('.editor_date_pub').show();
            $('#form_editor_fonction').hide();
            $('.editor_fonction').show();
            $('#form_editor_facebook').hide();
            $('.editor_facebook').show();
            $('#form_editor_twitter').hide();
            $('.editor_twitter').show();
            $('#form_instagram').hide();
            $('.editor_instagram').show();
            $('#form_editor_linkedin').hide();
            $('.editor_linkedin').show();
            $('#form_editor_email').hide();
            $('.editor_email').show();
            $('#form_editor_departement').hide();
            $('.editor_departement').show();
            $('#form_editor_agence').hide();
            $('.editor_agence').show();
            $('#modify_video').hide();
            $('#form_editor_texte3').hide();
            $('.editor_texte3').show();
            $('#form_editor_texte2').hide();
            $('.editor_texte2').show();
            $('#form_editor_texte1').hide();
            $('.editor_texte1').show();
            $('#form_editor').hide();
            $('.editor').show();
            $('#form_editor_contenu').hide();
            $('.editor_contenu').show();
            $('#form_editor_auteur').hide();
            $('.editor_auteur').show();
            $('#form_editor_source').hide();
            $('.editor_source').show();
            $('#form_editor_date_ref').hide();
            $('.editor_date_ref').show();
            $('#form_editor_chiffre').hide();
            $('.editor_chiffre').show();
            $('.editor_timing').show();
            $('#form_editor_timing').hide();
            $('.editor_mode').show();
            $('#form_editor_mode').hide();
            $('.editor_certif').show();
            $('#form_editor_certif').hide();

        });

        $('#addImg').click(function(){
           $('#DivFormAddPj').show();
           $('#AddPj').hide();
           $('#importImg').show();
    
        });

        $('#addImgBan').click(function(){
            $('#DivFormAddPj').show();
            $('#AddPj').hide();
            $('#importImgBan').show();
  
        });

        $('#addPlaquette').click(function(){
           $('#DivFormAddPj').show();
           $('#AddPj').hide();
           $('#importPlaqt').show();
        
        });


        $('#addVideo').click(function(){
           $('#DivFormAddPj').show();
           $('#AddPj').hide();
           $('#importVideo').show();
          
        });

        $('.close_DivFormAddPj').click(function(){
           $('#DivFormAddPj').hide();
           $('#AddPj').show();
            $('#importImg').hide();
            $('#importPlaqt').hide();
            $('#importVideo').hide();
            $('#AddDetail').hide();
          
        });



        
         
         
});