import './bootstrap';
import 'flowbite';

/////////// script pour verifier si les checkbox sont cocher pour supprimer. page -> role.blade.php ///////////
function verifCheckSupprimer(){
    const checkboxes = document.querySelectorAll(".checkbox-emp") //recuperer les checkboxs
    const deleteBtn = document.getElementById("supprimerBtn");

    const estCocher = Array.from(checkboxes).some(checkbox => checkbox.checked); //vérifier si les checkbox sont cocher

    //désactive le bouton si rien est cocher
    if (!estCocher) {
        deleteBtn.disabled = true; // Désactiver le bouton
        deleteBtn.classList.add("text-gray-300"); // Changer la couleur en gris
        deleteBtn.classList.remove("text-red-600"); // Enlever la classe qui colorise en rouge
        deleteBtn.classList.remove("hover:underline")
    } else {
        deleteBtn.disabled = false; // Activer le bouton
        deleteBtn.classList.remove("text-gray-300"); // Retirer la couleur gris si activé
        deleteBtn.classList.add("text-red-600"); // Ajouter la classe rouge quand actif
        deleteBtn.classList.add("hover:underline")
    }
}

//ajoute un event listener sur toutes les check box
const checkboxes = document.querySelectorAll(".checkbox-emp") 
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', verifCheckSupprimer);
});

//faire en sorte qu'il y ai toujours 2 admin et 1 responsable
document.addEventListener("DOMContentLoaded", function(){
    
    let roleSelect = document.querySelectorAll('select[id="roleSelect"]');

    let nbrAdmin = 0;
    let nbrResponsable = 0;

    roleSelect.forEach(select => {
        let roleChoisi = select.value;

        if(roleChoisi == "Administrateur"){
            nbrAdmin ++;
        }
        else if (roleChoisi == "Responsable"){
            nbrResponsable ++;
        }

        roleSelect.forEach(select => {
            if (nbrAdmin <= 2 && select.value == "Administrateur") {
                select.disabled = true; // Désactive les rôles qui ne sont pas Administrateur si le nombre d'admins est <= 2
            } else if (nbrResponsable <= 1 && select.value == "Responsable") {
                select.disabled = true; // Désactive les rôles qui ne sont pas Responsable si le nombre de responsables est <= 1
            } else {
                select.disabled = false; // Réactive uniquement si aucune des conditions ne s'applique
            }
        });
    });
});



function champRaison() {
    let champRaison = document.getElementById("champRefus");
    let choixRole = document.getElementById("choixRole");

    // Vérifiez si les éléments existent
    if (choixRole && champRaison) {
        // Vérifiez la valeur initiale au chargement de la page
        if (choixRole.value === "Refus") {
            champRaison.style.display = "block"; // Affiche le champ si "Refus" est sélectionné
        } else {
            champRaison.style.display = "none"; // Cache le champ sinon
        }

        // Ajoutez un écouteur d'événement pour le changement de sélection
        choixRole.addEventListener("change", () => {
            if (choixRole.value === "Refus") {
                champRaison.style.display = "block"; // Affiche le champ
            } else {
                champRaison.style.display = "none"; // Cache le champ
            }
        });
    } else {
        console.error("Un des éléments n'existe pas !");
    }
}

//recherche pour la suppression d'employé
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('barre-recherche-emp').addEventListener('input', function() {
        let searchTerm = this.value.toLowerCase();
        let employees = document.querySelectorAll('.employe');
        
        employees.forEach(function(employee) {
            let emailLabel = employee.querySelector('label');
            
            if (emailLabel) {
                let email = emailLabel.textContent.toLowerCase();
                if (email.includes(searchTerm)) {
                    employee.style.display = '';
                } else {
                    employee.style.display = 'none';
                }
            }
        });
    });
});

//recherche pour la suppression de role de courriel
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('barre-recherche-roleCourriel').addEventListener('input', function() {
        let searchTerm = this.value.toLowerCase();
        let roles = document.querySelectorAll('.roleCourriel');
        
        roles.forEach(function(rolee) {
            let label = rolee.querySelector('label');
            if (label) {
                let role = label.textContent.toLowerCase();
                if (role.includes(searchTerm)) {
                    rolee.style.display = '';
                } else {
                    rolee.style.display = 'none';
                }
            }
        });
    });
});


