function loadIframe() {
    frm.document.designMode = 'on';
}

function formatText(btn) {
    var cible = frm.document;

    switch(btn) {
        case 'g': {
            cible.execCommand('bold', false, null);
            break;
        }
        case 'i': {
            cible.execCommand('italic', false, null);
            break;
        }
        case 's': {
            cible.execCommand('underline', false, null);
            break;
        }
        case 'taille': {
            var taille = prompt('une taille entre 1 et 6', '');
            cible.execCommand('FontSize', false, taille);
            break;
        }
        case 'couleur': {
            var couleur = document.querySelector("#couleur").options[document.querySelector("#couleur").selectedIndex].value;
            cible.execCommand('ForeColor', false, couleur);
            break;
        }
        case 'ligne': {
            cible.execCommand('inserthorizontalrule', false, null);
            break;
        }
        case 'ol': {
            cible.execCommand('insertOrderedList', false, null);
            break;
        }
        case 'ul': {
            cible.execCommand('insertUnorderedList', false, null);
            break;
        }
        case 'lien': {
            var lien = prompt('Inserer un lien', 'http://');
            cible.execCommand('CreateLink', false, lien);
            break;
        }
        case 'image': {
            var image = prompt('Inserer une image', '');
            cible.execCommand('insertimage', false, image);
            break;
        }
    }
}

function submitForm() {
    var com = document.querySelector("#blog");
    com.elements['commentaire'].value = window.frames['frm'].document.body.innerHTML;

    com.submit();
}