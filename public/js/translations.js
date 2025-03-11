/*!
 *  Lang.js for Laravel localization in JavaScript.
 *
 *  @version 1.1.10
 *  @license MIT https://github.com/rmariuzzo/Lang.js/blob/master/LICENSE
 *  @site    https://github.com/rmariuzzo/Lang.js
 *  @author  Rubens Mariuzzo <rubens@mariuzzo.com>
 */
(function(root,factory){"use strict";if(typeof define==="function"&&define.amd){define([],factory)}else if(typeof exports==="object"){module.exports=factory()}else{root.Lang=factory()}})(this,function(){"use strict";function inferLocale(){if(typeof document!=="undefined"&&document.documentElement){return document.documentElement.lang}}function convertNumber(str){if(str==="-Inf"){return-Infinity}else if(str==="+Inf"||str==="Inf"||str==="*"){return Infinity}return parseInt(str,10)}var intervalRegexp=/^({\s*(\-?\d+(\.\d+)?[\s*,\s*\-?\d+(\.\d+)?]*)\s*})|([\[\]])\s*(-Inf|\*|\-?\d+(\.\d+)?)\s*,\s*(\+?Inf|\*|\-?\d+(\.\d+)?)\s*([\[\]])$/;var anyIntervalRegexp=/({\s*(\-?\d+(\.\d+)?[\s*,\s*\-?\d+(\.\d+)?]*)\s*})|([\[\]])\s*(-Inf|\*|\-?\d+(\.\d+)?)\s*,\s*(\+?Inf|\*|\-?\d+(\.\d+)?)\s*([\[\]])/;var defaults={locale:"en"};var Lang=function(options){options=options||{};this.locale=options.locale||inferLocale()||defaults.locale;this.fallback=options.fallback;this.messages=options.messages};Lang.prototype.setMessages=function(messages){this.messages=messages};Lang.prototype.getLocale=function(){return this.locale||this.fallback};Lang.prototype.setLocale=function(locale){this.locale=locale};Lang.prototype.getFallback=function(){return this.fallback};Lang.prototype.setFallback=function(fallback){this.fallback=fallback};Lang.prototype.has=function(key,locale){if(typeof key!=="string"||!this.messages){return false}return this._getMessage(key,locale)!==null};Lang.prototype.get=function(key,replacements,locale){if(!this.has(key,locale)){return key}var message=this._getMessage(key,locale);if(message===null){return key}if(replacements){message=this._applyReplacements(message,replacements)}return message};Lang.prototype.trans=function(key,replacements){return this.get(key,replacements)};Lang.prototype.choice=function(key,number,replacements,locale){replacements=typeof replacements!=="undefined"?replacements:{};replacements.count=number;var message=this.get(key,replacements,locale);if(message===null||message===undefined){return message}var messageParts=message.split("|");var explicitRules=[];for(var i=0;i<messageParts.length;i++){messageParts[i]=messageParts[i].trim();if(anyIntervalRegexp.test(messageParts[i])){var messageSpaceSplit=messageParts[i].split(/\s/);explicitRules.push(messageSpaceSplit.shift());messageParts[i]=messageSpaceSplit.join(" ")}}if(messageParts.length===1){return message}for(var j=0;j<explicitRules.length;j++){if(this._testInterval(number,explicitRules[j])){return messageParts[j]}}var pluralForm=this._getPluralForm(number);return messageParts[pluralForm]};Lang.prototype.transChoice=function(key,count,replacements){return this.choice(key,count,replacements)};Lang.prototype._parseKey=function(key,locale){if(typeof key!=="string"||typeof locale!=="string"){return null}var segments=key.split(".");var source=segments[0].replace(/\//g,".");return{source:locale+"."+source,sourceFallback:this.getFallback()+"."+source,entries:segments.slice(1)}};Lang.prototype._getMessage=function(key,locale){locale=locale||this.getLocale();key=this._parseKey(key,locale);if(this.messages[key.source]===undefined&&this.messages[key.sourceFallback]===undefined){return null}var message=this.messages[key.source];var entries=key.entries.slice();var subKey="";while(entries.length&&message!==undefined){var subKey=!subKey?entries.shift():subKey.concat(".",entries.shift());if(message[subKey]!==undefined){message=message[subKey];subKey=""}}if(typeof message!=="string"&&this.messages[key.sourceFallback]){message=this.messages[key.sourceFallback];entries=key.entries.slice();subKey="";while(entries.length&&message!==undefined){var subKey=!subKey?entries.shift():subKey.concat(".",entries.shift());if(message[subKey]){message=message[subKey];subKey=""}}}if(typeof message!=="string"){return null}return message};Lang.prototype._findMessageInTree=function(pathSegments,tree){while(pathSegments.length&&tree!==undefined){var dottedKey=pathSegments.join(".");if(tree[dottedKey]){tree=tree[dottedKey];break}tree=tree[pathSegments.shift()]}return tree};Lang.prototype._applyReplacements=function(message,replacements){for(var replace in replacements){message=message.replace(new RegExp(":"+replace,"gi"),function(match){var value=replacements[replace];var allCaps=match===match.toUpperCase();if(allCaps){return value.toUpperCase()}var firstCap=match===match.replace(/\w/i,function(letter){return letter.toUpperCase()});if(firstCap){return value.charAt(0).toUpperCase()+value.slice(1)}return value})}return message};Lang.prototype._testInterval=function(count,interval){if(typeof interval!=="string"){throw"Invalid interval: should be a string."}interval=interval.trim();var matches=interval.match(intervalRegexp);if(!matches){throw"Invalid interval: "+interval}if(matches[2]){var items=matches[2].split(",");for(var i=0;i<items.length;i++){if(parseInt(items[i],10)===count){return true}}}else{matches=matches.filter(function(match){return!!match});var leftDelimiter=matches[1];var leftNumber=convertNumber(matches[2]);if(leftNumber===Infinity){leftNumber=-Infinity}var rightNumber=convertNumber(matches[3]);var rightDelimiter=matches[4];return(leftDelimiter==="["?count>=leftNumber:count>leftNumber)&&(rightDelimiter==="]"?count<=rightNumber:count<rightNumber)}return false};Lang.prototype._getPluralForm=function(count){switch(this.locale){case"az":case"bo":case"dz":case"id":case"ja":case"jv":case"ka":case"km":case"kn":case"ko":case"ms":case"th":case"tr":case"vi":case"zh":return 0;case"af":case"bn":case"bg":case"ca":case"da":case"de":case"el":case"en":case"eo":case"es":case"et":case"eu":case"fa":case"fi":case"fo":case"fur":case"fy":case"gl":case"gu":case"ha":case"he":case"hu":case"is":case"it":case"ku":case"lb":case"ml":case"mn":case"mr":case"nah":case"nb":case"ne":case"nl":case"nn":case"no":case"om":case"or":case"pa":case"pap":case"ps":case"pt":case"so":case"sq":case"sv":case"sw":case"ta":case"te":case"tk":case"ur":case"zu":return count==1?0:1;case"am":case"bh":case"fil":case"fr":case"gun":case"hi":case"hy":case"ln":case"mg":case"nso":case"xbr":case"ti":case"wa":return count===0||count===1?0:1;case"be":case"bs":case"hr":case"ru":case"sr":case"uk":return count%10==1&&count%100!=11?0:count%10>=2&&count%10<=4&&(count%100<10||count%100>=20)?1:2;case"cs":case"sk":return count==1?0:count>=2&&count<=4?1:2;case"ga":return count==1?0:count==2?1:2;case"lt":return count%10==1&&count%100!=11?0:count%10>=2&&(count%100<10||count%100>=20)?1:2;case"sl":return count%100==1?0:count%100==2?1:count%100==3||count%100==4?2:3;case"mk":return count%10==1?0:1;case"mt":return count==1?0:count===0||count%100>1&&count%100<11?1:count%100>10&&count%100<20?2:3;case"lv":return count===0?0:count%10==1&&count%100!=11?1:2;case"pl":return count==1?0:count%10>=2&&count%10<=4&&(count%100<12||count%100>14)?1:2;case"cy":return count==1?0:count==2?1:count==8||count==11?2:3;case"ro":return count==1?0:count===0||count%100>0&&count%100<20?1:2;case"ar":return count===0?0:count==1?1:count==2?2:count%100>=3&&count%100<=10?3:count%100>=11&&count%100<=99?4:5;default:return 0}};return Lang});

(function () {
    Lang = new Lang();
    Lang.setMessages({"en.strings":{"Aucun quartier trouv\u00e9":"No neighborhood found","Aucun r\u00e9sultat trouv\u00e9":"No results found","Aucune ville trouv\u00e9":"No cites found","Avis":"Rating","Choisir un quartier":"Choose a neighborhood","Choisir une ville":"Choose a city","Distance":"Distance","Filtrer les r\u00e9sultats":"Filter results","Image de l'\u00e9tablissement":"Establishment image","Organisme":"Corporation","Prix":"Price","Que recherchez-vous ?":"What are you looking for ?","Recherche":"Search","Type":"Type","aPropos":"About","actif":"Active","action":"Action","activer":"activate","activerActivite":"Would you like to activate the activity","activites":"Activities","admin":"Administrator","administration":"Administration","adresse":"Address","afficher":"Display","ajouter":"Add","ajouterActivite":"Add an activity","ajouterLieu":"Add a location","annuler":"Cancel","attention":"Warning","aucunFichier":"No file selected","aucunLieu":"No locations saved","aucunLieuTrouve":"No location found with these filters.","aucunSiteWeb":"No Website","aucuneDescription":"No description","autreVille":"See other cities","bientotVille":"Coming soon to your city","boutonOuiSup":"Yes, delete it!","chargement":"Loading...","choisirQuartier":"Select a neighborhood","choisirVille":"Select a city","codePostal":"Postal code","compte":"Account","confirmation":"Confirmation","confirmationChangerEtat":"Are you sure you want to :action this location : :lieu ?","confirmationMotDePasse":"Password Confirmation","confirmationSuppressionActivite":"Are you sure you want to delete this activity : ","confirmationSuppressionLieu":"Are you sure you want to delete this location : ","connexion":"Log in","connexionMessage":"Login successful!","coordonnees":"Contact details","coordonneesEtInfo":"Contact details & information","courriel":"Email","courrielMotDePasse":"Email & password","dateDebut":"Start date","dateFin":"End date","debut":"Start","deconnexion":"Log out","deconnexionMessage":"Logout successful!","decouvrir":"Discover","demandes":"Requests","desactiver":"deactivate","desactiverActivite":"Would you like to deactivate the activity","description":"Description","droitsReserves":"All rights reserved.","enAttente":"Pending","enregistrer":"Save","erreur":"Error","erreur403":"Erreur 403 - Action not authorized","erreur403Texte":"You are not authorized to perform this action","erreur404":"Error 404 - Page not found","erreur404Texte":"The reason for your search did not return any results","erreur429":"Error 429 - Too many requests","erreur429Texte":"We\u2019re sorry, but you have sent too many requests to us recently. Please try again later.","erreurConnexion":"Email and\/or password is invalid.","erreurGenerale":"An error occurred. Please try again.","erreurSuppression":"Error during deletion","fin":"End","gestion":"Manager","inactif":"Inactive","inconnu":"Unknown","indiquerPosition":"For each selected image, indicate its position.","infoGenerales":"General information","informations":"Information","inscriptionMessage":"Signed up successfully!","langues":"Languages","lieux":"Locations","localisation":"Localisation","maxTaille":"(Can't exceed 2mb)","messageErreurConnexion":"Please fill in all the fields.","messageErreurInscription":"There has been an unforeseen error while creating the account.","messageSup":"You will not be able to go back!","messageSup2":"Your account has been deleted.","messageSup2Titre":"Deleted!","messageSupTitre":"Are you sure?","modifier":"Edit","modifierActivite":"Edit an activity","modifierLieu":"Edit a location","modifierMotDePasse":"Modify your password","motDePasse":"Password","nom":"Name","nomF":"Last name","numCivique":"Civic number","pasResultatFiltreActivites":"No activities were found with these filters.","pasResultatFiltreUsagers":"No users were found with these filters.","pays":"Country","photoActivite":"Activity photos","photoLieu":"Location photo","photosActuelle":"Current photos","positionImages":"Image positions","positionNouvelleImage":"Position of new images","positionNouvelleImageIndiquer":"For each new selected image, indicate its position.","positionPour":"Position for","prenom":"First name","prenomNom":"First Name & Last Name","province":"Province","quartier":"Neighborhood","rechercheAdminDemande":"Search by name, first name, or email","rechercheLieu":"Search by location name","rechercherNom":"Search by name","region":"Area","retour":"Back","role":"Role","rue":"Street","sInscrire":"Sign in","seConnecter":"Log in","selectMultipleLieux":"Select one or more locations","selectionnerType":"Select a type","selectionnerVilleAvant":"Select a city before to filter by neighborhood.","siteWeb":"Website","slogan":"Explore without limits","statut":"Status","succesAjout":"Added successfully!","succesModifier":"Modified successfully!","succesSupprimer":"Deleted successfully!","successModifierStatutActivite":"Activity status updated successfully","supLeCompte":"Delete Account","supprimer":"Delete","telephone":"Phone number","tousLesLieux":" All locations","tousLesRoles":"All the roles","tousLesStatus":"All status options","tousLesTypesActivites":"All types of activities","toutesVilles":"All cities","typeActivite":"Activity type","typeLieu":"Location type","utilisateur":"User","ville":"City|Cities","villeAvant":"(Select a city before)","voirPlus":"See more..."},"en.validations":{"FavoriIdExiste":"The favorite selected is invalid.","FavoriLieuIdExiste":"The location selected is invalid.","FavoriUsagerIdExiste":"The user selected is invalid.","actifBoolean":"The active field must be true or false.","actifRequis":"Le active field is required","codePostalFormat":"The postal code must be in A1A 1A1 format.","codePostalMax":"The postal code must not exceed 7 characters.","codePostalRequis":"The postal code is required.","courrielEmail":"The email address is not valid.","courrielMax":"The email address cannot exceed 32 characters.","courrielRequis":"The email is required.","courrielUnique":"The email address must be unique.","dateDebutAfterOrEqual":"The start date must not be earlier than today.","dateDebutDate":"The start date must be a valid date.","dateDebutRequise":"The start date is required.","dateFinAfterOrEqual":"The end date must not be before the start date.","dateFinDate":"The end date must be a valid date.","descriptionActiviteMax":"The description must not exceed 500 characters.","descriptionMax":"The description must not exceed 500 characters.","lieuIdExiste":"The selected location(s) is\/are invalid.","lieuIdRequis":"The location(s) is\/are required.","noCivicMax":"The civic number cannot exceed 99999.","noCivicNumerique":"The civic number must contain only numbers.","noCivicRequis":"The civic number is required.","nomActiviteMax":"The name field must not exceed 64 characters.","nomActiviteRequise":"The name field is required.","nomEtablissementRequis":"The establishment name is required.","nomMax":"The last name may not exceed 32 characters.","nomRegex":"The last name may only contain letters, apostrophes, hyphens, and spaces.","nomRequis":"The last name is required.","passwordConfirme":"The passwords do not match.","passwordMin":"The password must contain at least 8 characters.","passwordRegex":"The password must contain at least 8 characters, one uppercase letter, one number, and one special character.","passwordRequis":"The password is required.","passwordRequisAvec":"The password is required when the password confirmation is present.","photoASupprimerExiste":"One of the selected photos for deletion is invalid.","photoLieuFormat":"The photo must be in PNG or JPG format.","photoLieuImage":"The file must be an image.","photoLieuMax":"The photo size must not exceed 2 MB.","photoMax":"Each photo must not exceed 2048 kilobytes.","photoMime":"Each photo must be in PNG or JPG format.","photoPositionDistinct":"The positions of the photos must be unique.","photoPositionInteger":"The position of each photo must be an integer.","photoPositionRequise":"The position of each photo is required.","positionsActuellesDistinct":"The positions of the existing photos must be unique.","positionsActuellesInteger":"The position of each existing photo must be an integer.","positionsSequentielle":"The positions must form a sequential series without gaps (1, 2, \u2026, ).","prenomMax":"The first name may not exceed 32 characters.","prenomRegex":"The first name may only contain letters, apostrophes, hyphens, and spaces.","prenomRequis":"The first name is required.","quartierRequis":"Please select a neighborhood.","roleInvalide":"The selected role is invalid.","roleRequis":"The role is required.","rueFormatInvalide":"The street format is invalid.","rueMax":"The street must not exceed 64 characters.","rueRequise":"The street is required.","siteWebInvalide":"The website format is invalid.","siteWebMax":"The website must not exceed 64 characters.","statutInvalide":"The selected status is invalid.","statutRequis":"The status is required.","telephoneFormat":"The phone number format is invalid.","telephoneRequis":"The phone number is required.","typeActiviteIdExiste":"The selected activity type is invalid.","typeActiviteIdRequise":"The activity type is required.","typeLieuRequis":"Please select a place type."},"fr-ca.pagination":{"next":"Suivant &raquo;","of":"de","previous":"&laquo; Pr\u00e9c\u00e9dent","results":"r\u00e9sultats","showing":"Affichage","to":"\u00e0"},"fr-ca.strings":{"Corporation":"Organisme","Distance":"Distance","Filter the results":"Filtrer les r\u00e9sultats","No cities found":"Aucune ville trouv\u00e9e","No results found":"Aucun r\u00e9sultat trouv\u00e9","Price":"Prix","Rating":"Avis","Search":"Recherche","Select a city":"Choisir une ville","Select a quartier":"Choisir un quartier","Showing":"Affichage","Type":"Type","What are you looking for ?":"Que recherchez-vous ?","aPropos":"\u00c0 propos","actif":"Actif","action":"Action","activer":"activer","activerActivite":"Voulez-vous rendre actif l'activit\u00e9 ","activites":"Activit\u00e9s","admin":"Administrateur","administration":"Administration","adresse":"Adresse","afficher":"Afficher","ajouter":"Ajouter","ajouterActivite":"Ajouter une activit\u00e9","ajouterLieu":"Ajouter un lieu","annuler":"Annuler","attention":"Attention","aucunFichier":"Aucun fichier s\u00e9lectionn\u00e9","aucunLieu":"Aucun lieu d'enregistr\u00e9","aucunLieuTrouve":"Aucun lieu trouv\u00e9 avec ces filtres.","aucunSiteWeb":"Aucun Site Web","aucuneDescription":"Aucune description","autreVille":"Voir d'autres villes","bientotVille":"Bient\u00f4t disponible dans votre ville","boutonOuiSup":"Oui, supprime-le!","chargement":"Chargement...","choisirQuartier":"S\u00e9lectionner un quartier","choisirVille":"S\u00e9lectionner une ville","codePostal":"Code postal","compte":"Compte","confirmation":"Confirmation","confirmationChangerEtat":"Voulez-vous vraiment :action ce lieu : :lieu ?","confirmationMotDePasse":"Confirmation du mot de passe","confirmationSuppressionActivite":"\u00cates-vous certain(e) de vouloir supprimer cette activit\u00e9 : ","confirmationSuppressionLieu":"\u00cates-vous certain(e) de vouloir supprimer ce lieu : ","connexion":"Connexion","connexionMessage":"Connexion r\u00e9ussie!","coordonnees":"Coordonn\u00e9es","coordonneesEtInfo":"Coordonn\u00e9es & informations","courriel":"Courriel","courrielMotDePasse":"Courriel & mot de passe","dateDebut":"Date de d\u00e9but","dateFin":"Date de fin","debut":"D\u00e9but","deconnexion":"D\u00e9connexion","deconnexionMessage":"D\u00e9connexion r\u00e9ussie!","decouvrir":"D\u00e9couvrir","demandes":"Demandes","desactiver":"d\u00e9sactiver","desactiverActivite":"Voulez-vous rendre inactif l'activit\u00e9 ","description":"Description","droitsReserves":"Tous droits r\u00e9serv\u00e9s.","enAttente":"En attente","enregistrer":"Enregistrer","erreur":"Erreur","erreur403":"Erreur 403 - Action non autoris\u00e9e","erreur403Texte":" Vous n'\u00eates pas autoris\u00e9 \u00e0 faire cette action","erreur404":"Erreur 404 - Page non trouv\u00e9e","erreur404Texte":"Le motif de votre recherche n'a men\u00e9 \u00e0 aucun r\u00e9sultat","erreur429":"Erreur 429 - Trop de requ\u00eates","erreur429Texte":"Nous sommes d\u00e9sol\u00e9s, mais vous avez envoy\u00e9 trop de requ\u00eates r\u00e9cemment. Veuillez r\u00e9essayer plus tard.","erreurConnexion":"Courriel et\/ou le mot de passe est invalide.","erreurGenerale":"Une erreur est survenue. Veuillez r\u00e9essayer.","erreurSuppression":"Erreur lors de la suppression","fin":"Fin","gestion":"Gestionnaire","inactif":"Inactif","inconnu":"Inconnu","indiquerPosition":"Pour chaque image s\u00e9lectionn\u00e9e, indiquez sa position.","infoGenerales":"Informations g\u00e9n\u00e9rales","informations":"Informations","inscriptionMessage":"Inscription r\u00e9ussie!","langues":"Langues","lieux":"Lieux","localisation":"Localisation","maxTaille":"(Ne peut pas d\u00e9passer 2mo)","messageErreurConnexion":"Veuillez remplir tous les champs.","messageErreurInscription":"Il y a eu une erreur inattendue lors de la cr\u00e9ation du compte.","messageSup":"Vous ne pourrez pas revenir en arri\u00e8re!","messageSup2":"Votre compte a \u00e9t\u00e9 supprim\u00e9.","messageSup2Titre":"Supprim\u00e9!","messageSupTitre":"\u00cates-vous s\u00fbr?","modifier":"Modifier","modifierActivite":"Modifier une activit\u00e9","modifierLieu":"Modifier un lieu","modifierMotDePasse":"Modifier votre mot de passe","motDePasse":"Mot de passe","nom":"Nom","nomF":"Nom","numCivique":"Num\u00e9ro civique","of":"de","pasResultatFiltreActivites":"Aucune activit\u00e9 n'a \u00e9t\u00e9 trouv\u00e9e avec ces filtres.","pasResultatFiltreUsagers":"Aucun utilisateur n'a \u00e9t\u00e9 trouv\u00e9 avec ces filtres.","pays":"Pays","photoActivite":"Photos de l'activit\u00e9","photoLieu":"Photo du lieu","photosActuelle":"Photos actuelles","positionImages":"Positions des images","positionNouvelleImage":"Position des nouvelles images","positionNouvelleImageIndiquer":"Pour chaque nouvelle image s\u00e9lectionn\u00e9e, indiquez sa position. ","positionPour":"Position pour","prenom":"Pr\u00e9nom","prenomNom":"Pr\u00e9nom et nom","province":"Province","quartier":"Quartier","rechercheAdminDemande":"Rechercher par nom, pr\u00e9nom ou courriel","rechercheLieu":"Recherche par nom de lieu","rechercherNom":"Rechercher par nom","region":"R\u00e9gion","results":"r\u00e9sultats","retour":"Retour","role":"R\u00f4le","rue":"Rue","sInscrire":"S'inscrire","seConnecter":"Se connecter","selectMultipleLieux":"S\u00e9lectionnez un ou plusieurs lieux","selectionnerType":"S\u00e9lectionner un type","selectionnerVilleAvant":"S\u00e9lectionner une ville en premier pour filtrer par quartier.","siteWeb":"Site web","slogan":"Explorez sans limites","statut":"Statut","succesAjout":"Ajout effectu\u00e9 avec succ\u00e8s!","succesModifier":"Modification effectu\u00e9e avec succ\u00e8s!","succesSupprimer":"Supprim\u00e9 avec succ\u00e8s!","successModifierStatutActivite":"Modification du statut de l'activit\u00e9 avec succ\u00e8s","supLeCompte":"Supprimer votre compte","supprimer":"Supprimer","telephone":"T\u00e9l\u00e9phone","to":"\u00e0","tousLesLieux":"Tous les lieux","tousLesRoles":"Tous les r\u00f4les","tousLesStatus":"Tous les statuts","tousLesTypesActivites":"Tous les types d'activit\u00e9s","toutesVilles":"Toutes les villes","typeActivite":"type d'activit\u00e9","typeLieu":"Type de lieu","utilisateur":"Utilisateur","ville":"{1} Ville|[2,*] Villes","villeAvant":"(Choisir une ville avant)","voirPlus":"Voir plus..."},"fr-ca.validations":{"FavoriIdExiste":"Le favori s\u00e9lectionn\u00e9 est invalide.","FavoriLieuIdExiste":"Le lieu s\u00e9lectionn\u00e9 est invalide.","FavoriUsagerIdExiste":"L'usager s\u00e9lectionn\u00e9 est invalide.","actifBoolean":"Le champ actif doit \u00eatre vrai ou faux.","actifRequis":"Le champ actif est requis","codePostalFormat":"Le code postal doit \u00eatre au format A1A 1A1.","codePostalMax":"Le code postal ne doit pas d\u00e9passer 7 caract\u00e8res.","codePostalRequis":"Le code postal est requis.","courrielEmail":"L'adresse courriel n'est pas valide.","courrielMax":"L'adresse courriel ne peut pas d\u00e9passer 32 caract\u00e8res.","courrielRequis":"Le courriel est requis.","courrielUnique":"L'adresse courriel doit \u00eatre unique.","dateDebutAfterOrEqual":"La date de d\u00e9but ne doit pas \u00eatre ant\u00e9rieure \u00e0 aujourd'hui.","dateDebutDate":"La date de d\u00e9but doit \u00eatre une date valide.","dateDebutRequise":"La date de d\u00e9but est obligatoire.","dateFinAfterOrEqual":"La date de fin ne doit jamais \u00eatre avant la date de d\u00e9but.","dateFinDate":"La date de fin doit \u00eatre une date valide.","descriptionActiviteMax":"La description ne doit pas d\u00e9passer 500 caract\u00e8res.","descriptionMax":"La description ne doit pas d\u00e9passer 500 caract\u00e8res.","lieuIdExiste":"Le(s) lieu(x) s\u00e9lectionn\u00e9(s) est\/sont invalide(s).","lieuIdRequis":"Le(s) lieu(x) est\/sont obligatoire(s).","noCivicMax":"Le num\u00e9ro civique ne peut pas d\u00e9passer 99999.","noCivicNumerique":"Le num\u00e9ro civique doit contenir uniquement des chiffres.","noCivicRequis":"Le num\u00e9ro civique est requis.","nomActiviteMax":"Le champ nom ne doit pas d\u00e9passer 64 caract\u00e8res.","nomActiviteRequise":"Le champ nom est obligatoire.","nomEtablissementRequis":"Le nom de l'\u00e9tablissement est requis.","nomMax":"Le nom ne peut pas d\u00e9passer 32 caract\u00e8res.","nomRegex":"Le nom ne peut contenir que des lettres, des apostrophes, des traits d'union et des espaces.","nomRequis":"Le nom est requis.","passwordConfirme":"Les mots de passe ne correspondent pas.","passwordMin":"Le mot de passe doit contenir au moins 8 caract\u00e8res.","passwordRegex":"Le mot de passe doit contenir au moins 8 caract\u00e8res, une majuscule, un chiffre et un caract\u00e8re sp\u00e9cial.","passwordRequis":"Le mot de passe est requis.","passwordRequisAvec":"Le mot de passe est requis lorsque la confirmation du mot de passe est pr\u00e9sente.","photoASupprimerExiste":"Une des photos s\u00e9lectionn\u00e9es pour la suppression est invalide.","photoLieuFormat":"La photo doit \u00eatre au format PNG ou JPG.","photoLieuImage":"Le fichier doit \u00eatre une image.","photoLieuMax":"La taille de la photo ne doit pas d\u00e9passer 2 Mo.","photoMax":"Chaque photo ne doit pas d\u00e9passer 2048 kilo-octets.","photoMime":"Chaque photo doit \u00eatre au format PNG ou JPG.","photoPositionDistinct":"Les positions des photos doivent \u00eatre uniques.","photoPositionInteger":"La position de chaque photo doit \u00eatre un nombre entier.","photoPositionRequise":"La position de chaque photo est obligatoire.","positionsActuellesDistinct":"Les positions des photos existantes doivent \u00eatre uniques.","positionsActuellesInteger":"La position de chaque photo existante doit \u00eatre un nombre entier.","positionsSequentielle":"Les positions doivent \u00eatre une suite s\u00e9quentielle sans trou (1, 2, \u2026, ).","prenomMax":"Le pr\u00e9nom ne peut pas d\u00e9passer 32 caract\u00e8res.","prenomRegex":"Le pr\u00e9nom ne peut contenir que des lettres, des apostrophes, des traits d'union et des espaces.","prenomRequis":"Le pr\u00e9nom est requis.","quartierRequis":"Veuillez s\u00e9lectionner un quartier.","roleInvalide":"Le r\u00f4le s\u00e9lectionn\u00e9 est invalide.","roleRequis":"Le r\u00f4le est requis.","rueFormatInvalide":"Le format de la rue est invalide.","rueMax":"La rue ne doit pas d\u00e9passer 64 caract\u00e8res.","rueRequise":"La rue est requise.","siteWebInvalide":"Le format du site web est invalide.","siteWebMax":"Le site web ne doit pas d\u00e9passer 64 caract\u00e8res.","statutInvalide":"Le statut s\u00e9lectionn\u00e9 est invalide.","statutRequis":"Le statut est requis.","telephoneFormat":"Le format du num\u00e9ro de t\u00e9l\u00e9phone est invalide.","telephoneRequis":"Le num\u00e9ro de t\u00e9l\u00e9phone est requis.","typeActiviteIdExiste":"Le type d'activit\u00e9 s\u00e9lectionn\u00e9 est invalide.","typeActiviteIdRequise":"Le type d'activit\u00e9 est obligatoire.","typeLieuRequis":"Veuillez s\u00e9lectionner un type de lieu."}});
})();
