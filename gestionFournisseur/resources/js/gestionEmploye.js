import 'flowbite';

//recherche dans la suppression d'employe
document.getElementById('barre-recherche-emp').addEventListener('input', function() {
    let searchTerm = this.value.toLowerCase();
    let employees = document.querySelectorAll('.employe');
    
    employees.forEach(function(employee) {
        let email = employee.querySelector('label').textContent.toLowerCase();
        if (email.includes(searchTerm)) {
            employee.style.display = '';
        } else {
            employee.style.display = 'none';
        }
    });
});

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
    let roleCheck = document.querySelectorAll('.checkEmploye');

    let nbrAdmin = 0;
    let nbrResponsable = 0;

    // Fonction pour compter les rôles
    function countRoles() {
        nbrAdmin = 0;
        nbrResponsable = 0;

        roleSelect.forEach(select => {
            let roleChoisi = select.value;

            if (roleChoisi == "Administrateur") {
                nbrAdmin++;
            } else if (roleChoisi == "Responsable") {
                nbrResponsable++;
            }
        });
    }

    updateFields();
    // Fonction pour désactiver/activer les selects et checkboxes
    function updateFields() {
        // Désactivation des selects en fonction du nombre d'administrateurs/responsables
        roleSelect.forEach(select => {
            if (nbrAdmin >= 2 && select.value == "Administrateur") {
                select.disabled = true; 
            } else if (nbrResponsable >= 1 && select.value == "Responsable") {
                select.disabled = true;
            } else {
                select.disabled = false; 
            }
        });

        // Désactivation des checkboxes en fonction du nombre d'administrateurs/responsables
        roleCheck.forEach(checkbox => {
            if (nbrAdmin >= 2 && checkbox.value == "Administrateur") {
                checkbox.disabled = true;
            } else if (nbrResponsable >= 1 && checkbox.value == "Responsable") {
                checkbox.disabled = true;
            } else {
                checkbox.disabled = false;
            }
        });
    }

    // Compter les rôles et mettre à jour les selects et checkboxes au chargement de la page
    countRoles();
    updateFields();
});


///Desactiver les checkboxs pour les admin et les responsable
